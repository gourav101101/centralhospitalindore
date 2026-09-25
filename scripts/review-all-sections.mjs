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

for(const width of [1440,390]){
await send('Emulation.setDeviceMetricsOverride',{width,height:900,deviceScaleFactor:1,mobile:width<600});await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'no-preference'}]});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(1700);
const sections=await evaluate("[...document.querySelectorAll('main > section')].map(s=>s.classList[0])");
for(const name of sections){
await evaluate("window.scrollTo({top:document.querySelector('."+name+"').getBoundingClientRect().top+scrollY-document.querySelector('header').offsetHeight,behavior:'instant'})");await pause(700);
const state=await evaluate("(()=>{const s=document.querySelector('."+name+"');return {name:'"+name+"',width:innerWidth,height:s.offsetHeight,heading:s.querySelector('h1,h2')?.innerText,hidden:[...s.querySelectorAll('.at-inview')].filter(el=>getComputedStyle(el).opacity==='0').length,overflow:document.documentElement.scrollWidth>innerWidth,broken:[...s.querySelectorAll('img')].filter(i=>i.complete&&!i.naturalWidth).length}})()");console.log(state);
await shot('section-'+name+'-'+width);
}
await evaluate("document.querySelector('footer').scrollIntoView({behavior:'instant'})");await pause(500);await shot('section-footer-'+width);
}
console.log('errors',errors);socket.close();
