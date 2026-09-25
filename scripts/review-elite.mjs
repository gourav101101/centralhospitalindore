import { readFile, writeFile } from 'node:fs/promises';
for (const file of ['resources/views/home.blade.php','resources/views/partials/header.blade.php','resources/css/elite.css']) {
 const source = await readFile(file,'utf8'); await writeFile(file,source.replace(/^\uFEFF/,''));
}
const tabs = await (await fetch('http://127.0.0.1:9555/json')).json();
const socket = new WebSocket(tabs.find(tab=>tab.type==='page').webSocketDebuggerUrl);
await new Promise(resolve=>socket.addEventListener('open',resolve,{once:true}));
let id=0;const pending=new Map();
socket.addEventListener('message',event=>{const m=JSON.parse(event.data);if(pending.has(m.id)){pending.get(m.id)(m.result);pending.delete(m.id)}});
const send=(method,params={})=>new Promise(resolve=>{const request=++id;pending.set(request,resolve);socket.send(JSON.stringify({id:request,method,params}))});
const evaluate=async expression=>(await send('Runtime.evaluate',{expression,returnByValue:true})).result.value;
const pause=ms=>new Promise(resolve=>setTimeout(resolve,ms));
await send('Page.enable');
for (const width of [1440,390,768]) {
 await send('Emulation.setDeviceMetricsOverride',{width,height:900,deviceScaleFactor:1,mobile:width<600});
 await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(1800);
 console.log('page',await evaluate(`({width:innerWidth,overflow:document.documentElement.scrollWidth>innerWidth,title:document.title,hero:!!document.querySelector('.elite-hero'),broken:[...document.images].filter(i=>i.complete&&!i.naturalWidth).map(i=>i.src)})`));
 let shot=await send('Page.captureScreenshot',{format:'png'});await writeFile(`storage/app/elite-${width}.png`,Buffer.from(shot.data,'base64'));
 if(width===390){await evaluate(`document.querySelector('.chi-menu-toggle').click()`);console.log('menu',await evaluate(`({open:!document.querySelector('.chi-mobile-menu').hidden,expanded:document.querySelector('.chi-menu-toggle').getAttribute('aria-expanded')})`));await send('Input.dispatchKeyEvent',{type:'keyDown',key:'Escape',code:'Escape',windowsVirtualKeyCode:27});console.log('escape',await evaluate(`document.querySelector('.chi-mobile-menu').hidden`));}
 const height=await evaluate('document.documentElement.scrollHeight');
 for(let top=0;top<height;top+=650){await evaluate(`window.scrollTo({top:${top},behavior:'instant'})`);await pause(110)}
 await pause(900);
 await evaluate(`document.querySelector('[data-space="1"]').click()`);await pause(700);
 console.log('interactions',await evaluate(`({reveals:document.querySelectorAll('.chi-reveal.is-visible').length,diagnostics:document.getElementById('elite-space-image').src.endsWith('hospital-interior.png'),caption:document.getElementById('elite-space-caption').textContent,broken:[...document.images].filter(i=>i.complete&&!i.naturalWidth).map(i=>i.src)})`));
 await evaluate(`window.scrollTo({top:0,behavior:'instant'})`);await pause(400);
 shot=await send('Page.captureScreenshot',{format:'png',captureBeyondViewport:true,clip:{x:0,y:0,width,height,scale:1}});await writeFile(`storage/app/elite-full-${width}.png`,Buffer.from(shot.data,'base64'));
}
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'reduce'}]});
console.log('reducedMotion',await evaluate(`({imageTransform:getComputedStyle(document.querySelector('.elite-hero-image img')).transform,revealOpacity:getComputedStyle(document.querySelector('.chi-reveal')).opacity})`));
for(const path of ['/about','/services','/doctors','/gallery','/contact','/appointment']){await send('Page.navigate',{url:'http://127.0.0.1:8011'+path});await pause(550);console.log('route',path,await evaluate(`({title:document.title,main:!!document.querySelector('main'),overflow:document.documentElement.scrollWidth>innerWidth})`))}
socket.close();
