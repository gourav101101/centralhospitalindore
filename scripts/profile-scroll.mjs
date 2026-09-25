import {writeFile} from 'node:fs/promises';
const tabs=await(await fetch('http://127.0.0.1:9555/json')).json();
const socket=new WebSocket(tabs.find(t=>t.type==='page').webSocketDebuggerUrl);
await new Promise(r=>socket.addEventListener('open',r,{once:true}));
let id=0;const pending=new Map(),errors=[];
socket.addEventListener('message',event=>{const m=JSON.parse(event.data);if(m.method==='Runtime.exceptionThrown')errors.push(m.params.exceptionDetails.text+': '+m.params.exceptionDetails.exception?.description);if(pending.has(m.id)){pending.get(m.id)(m.result);pending.delete(m.id)}});
const send=(method,params={})=>new Promise(resolve=>{const request=++id;pending.set(request,resolve);socket.send(JSON.stringify({id:request,method,params}))});
const evaluate=async expression=>(await send('Runtime.evaluate',{expression,returnByValue:true})).result.value;
const pause=ms=>new Promise(r=>setTimeout(r,ms));
await send('Page.enable');await send('Runtime.enable');
const shot=async name=>{const r=await send('Page.captureScreenshot',{format:'png'});await writeFile('storage/app/atelier-'+name+'.png',Buffer.from(r.data,'base64'))};

await send('Performance.enable');
await send('Emulation.setDeviceMetricsOverride',{width:1440,height:950,deviceScaleFactor:1,mobile:false});
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'no-preference'}]});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(2200);
const results=[];
for(const [name,selector] of [['hero','.at-arrival'],['sculpture','.at-philosophy']]){
const top=await evaluate("document.querySelector('"+selector+"').getBoundingClientRect().top+scrollY-150");
await evaluate('window.scrollTo({top:'+top+',behavior:"instant"})');await pause(450);
const before=Object.fromEntries((await send('Performance.getMetrics')).metrics.map(m=>[m.name,m.value]));
const run=await send('Runtime.evaluate',{expression:'new Promise(resolve=>{const start=performance.now();let last=start;const gaps=[];function tick(now){gaps.push(now-last);last=now;window.scrollTo({top:'+top+'+Math.sin((now-start)/700)*90,behavior:"instant"});if(now-start<2400)requestAnimationFrame(tick);else resolve({frames:gaps.length,duration:now-start,slowFrames:gaps.filter(g=>g>34).length,maxGap:Math.round(Math.max(...gaps))})}requestAnimationFrame(tick)})',returnByValue:true,awaitPromise:true});
const after=Object.fromEntries((await send('Performance.getMetrics')).metrics.map(m=>[m.name,m.value]));
const result={section:name,...run.result.value,taskMs:Math.round((after.TaskDuration-before.TaskDuration)*1000),scriptMs:Math.round((after.ScriptDuration-before.ScriptDuration)*1000)};results.push(result);console.log(result);
}
console.log('errors',errors);await writeFile('storage/app/scroll-profile-'+(process.argv[2]||'current')+'.json',JSON.stringify(results,null,2));socket.close();
