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

const paths=['/about','/doctors','/services','/contact','/appointment','/gallery','/resources-downloads','/health-library','/patient-stories','/privacy-policy','/terms-of-service'];
await send('Page.navigate',{url:'http://127.0.0.1:8011/doctors'});await pause(1300);
const doctor=await evaluate("document.querySelector('.v2-team-card')?.getAttribute('href')");if(doctor)paths.push(new URL(doctor).pathname);
await send('Page.navigate',{url:'http://127.0.0.1:8011/health-library'});await pause(1000);
const article=await evaluate("document.querySelector('.article-image')?.getAttribute('href')");if(article)paths.push(new URL(article).pathname);
for(const width of [1440,390]){
 await send('Emulation.setDeviceMetricsOverride',{width,height:1000,deviceScaleFactor:1,mobile:width<600});
 for(const path of paths){
  await send('Page.navigate',{url:'http://127.0.0.1:8011'+path});await pause(950);
  const name=path.replaceAll('/','-');await shot('inner'+name+'-'+width);
  const state=await evaluate(`({title:document.title,h1:document.querySelector('h1')?.innerText,overflow:document.documentElement.scrollWidth>innerWidth,broken:[...document.querySelectorAll('img[src]:not([src=""])')].filter(i=>i.complete&&!i.naturalWidth).map(i=>i.src),sections:document.querySelectorAll('#main-content>section').length})`);
  console.log(JSON.stringify({path,width,...state}));
  await evaluate("window.scrollTo({top:document.querySelector('#main-content>section:nth-of-type(2)')?.offsetTop-100||600,behavior:'instant'})");await pause(550);await shot('inner'+name+'-body-'+width);
 }
}
console.log('errors',errors);socket.close();
