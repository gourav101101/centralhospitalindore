import {writeFile} from 'node:fs/promises';
const tabs = await (await fetch('http://127.0.0.1:9555/json')).json();
const socket = new WebSocket(tabs.find(tab=>tab.type==='page').webSocketDebuggerUrl);
await new Promise(resolve=>socket.addEventListener('open',resolve,{once:true}));
let id=0;const pending=new Map();
socket.addEventListener('message',event=>{const m=JSON.parse(event.data);if(pending.has(m.id)){pending.get(m.id)(m.result);pending.delete(m.id)}});
const send=(method,params={})=>new Promise(resolve=>{const request=++id;pending.set(request,resolve);socket.send(JSON.stringify({id:request,method,params}))});
const evaluate=async expression=>(await send('Runtime.evaluate',{expression,returnByValue:true})).result.value;
const pause=ms=>new Promise(resolve=>setTimeout(resolve,ms));
await send('Page.enable');

await send('Emulation.setDeviceMetricsOverride',{width:1440,height:900,deviceScaleFactor:1,mobile:false});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(3500);
console.log(await evaluate(`({opacity:getComputedStyle(document.querySelector('.elite-hero-content')).opacity,height:document.documentElement.scrollHeight})`));
for(const [name,selector] of [['hero','.elite-hero'],['care','.elite-care'],['team','.elite-team']]) {
await evaluate(`window.scrollTo({top:document.querySelector('${selector}').getBoundingClientRect().top+scrollY-110,behavior:'instant'})`);await pause(1400);
const shot=await send('Page.captureScreenshot',{format:'png'});await writeFile('storage/app/elite-review-'+name+'.png',Buffer.from(shot.data,'base64'));
}
socket.close();