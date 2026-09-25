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

for(const width of [1440,390,320]){
 await send('Emulation.setDeviceMetricsOverride',{width,height:1000,deviceScaleFactor:1,mobile:width<600});
 await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(1000);
 await evaluate("scrollTo({top:document.querySelector('#care-team').getBoundingClientRect().top+scrollY-document.querySelector('header').offsetHeight,behavior:'instant'})");await pause(500);
 console.log(await evaluate("({width:innerWidth,heading:getComputedStyle(document.querySelector('#care-team h2')).fontSize,overflow:document.documentElement.scrollWidth>innerWidth,visible:getComputedStyle(document.querySelector('#care-team .at-section-heading')).opacity})"));
 await shot('team-scale-'+width);
}
console.log('errors',errors);socket.close();
