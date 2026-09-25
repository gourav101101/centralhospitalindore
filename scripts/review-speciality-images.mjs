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
for(const width of [1440,768,390,320]){
 await send('Emulation.setDeviceMetricsOverride',{width,height:950,deviceScaleFactor:1,mobile:width<600});
 await send('Page.navigate',{url:'http://127.0.0.1:8011/services'});await pause(1300);
 for(let index=0;index<15;index++){
  await evaluate(`document.querySelectorAll('.speciality-card')[${index}].scrollIntoView({behavior:'instant',block:'center'})`);await pause(170);
 }
 await pause(600);
 console.log(width,await evaluate(`(()=>{const cards=[...document.querySelectorAll('.speciality-card')];return {cards:cards.length,loaded:cards.filter(c=>c.querySelector('img')?.naturalWidth>0).length,unique:new Set(cards.map(c=>c.querySelector('img')?.src)).size,overflow:document.documentElement.scrollWidth>innerWidth,linksCorrect:cards.every(c=>new URL(c.href).searchParams.get('department')===c.querySelector('h3').textContent)}})()`));
 await evaluate("window.scrollTo({top:document.querySelector('#specialities').offsetTop-95,behavior:'instant'})");await pause(700);await shot('specialities-'+width);
 if(width===1440){await evaluate("document.querySelectorAll('.speciality-card')[6].scrollIntoView({behavior:'instant',block:'center'})");await pause(650);await shot('specialities-lower');}
}
console.log('errors',errors);socket.close();
