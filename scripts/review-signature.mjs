import assert from 'node:assert/strict';
﻿import {writeFile} from 'node:fs/promises';
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

await send('Page.addScriptToEvaluateOnNewDocument',{source:'window.__draws=0;const draw=WebGLRenderingContext.prototype.drawElements;WebGLRenderingContext.prototype.drawElements=function(...args){window.__draws++;return draw.apply(this,args)};'});
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'no-preference'}]});
for(const width of [1440,390,768]){
await send('Emulation.setDeviceMetricsOverride',{width,height:950,deviceScaleFactor:1,mobile:width<600});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(2200);
console.log('initial',width,await evaluate("({overflow:document.documentElement.scrollWidth>innerWidth,heroHeight:document.querySelector('.at-hero-stage').offsetHeight,ink:getComputedStyle(document.documentElement).getPropertyValue('--at-ink'),fine:matchMedia('(hover: hover) and (pointer: fine)').matches})"));
assert.equal(await evaluate('document.documentElement.scrollWidth>innerWidth'),false);await shot('signature-hero-'+width);
if(width===1440){
await send('Input.dispatchMouseEvent',{type:'mouseWheel',x:700,y:650,deltaX:0,deltaY:420});await pause(60);const early=await evaluate('scrollY');await pause(1150);const settled=await evaluate('scrollY');console.log('wheel',{early,settled});assert.ok(early>0&&early<400);assert.ok(Math.abs(settled-420)<3);
await shot('signature-hero-mid');await evaluate('window.scrollTo({top:670,behavior:"instant"})');await pause(400);await shot('signature-hero-open');
assert.equal(await evaluate("document.querySelector('.at-hero-heading').inert"),true);
await send('Input.dispatchMouseEvent',{type:'mouseWheel',x:700,y:650,deltaX:0,deltaY:500});await pause(60);await send('Input.dispatchKeyEvent',{type:'keyDown',key:'Home',code:'Home',windowsVirtualKeyCode:36});await send('Input.dispatchKeyEvent',{type:'keyUp',key:'Home',code:'Home',windowsVirtualKeyCode:36});await pause(500);assert.equal(await evaluate('scrollY'),0);
}
await evaluate("window.scrollTo({top:document.querySelector('.at-sculpture').getBoundingClientRect().top+scrollY-150,behavior:'instant'})");await pause(600);const draws=await evaluate('window.__draws');
await send('Input.dispatchMouseEvent',{type:'mouseWheel',x:700>width?200:700,y:500,deltaX:0,deltaY:180});await pause(400);assert.ok(await evaluate('window.__draws')>draws,'Sculpture stays animated while scrolling');await shot('signature-sculpture-'+width);
await evaluate("window.scrollTo({top:document.querySelector('.at-journey').offsetTop-100,behavior:'instant'})");await pause(400);await evaluate("document.querySelectorAll('[data-gallery-step]')[1].click()");await pause(1400);console.log('gallery',width,await evaluate("({transform:document.querySelector('.at-gallery-track').style.transform,left:document.querySelector('.at-gallery-window').scrollLeft})"));
if(width===390){await evaluate("document.querySelector('.chi-menu-toggle').click()");assert.equal(await evaluate("document.querySelector('.chi-mobile-menu').hidden"),false);await evaluate("document.querySelector('.chi-menu-toggle').click()");}
console.log('images',await evaluate("[...document.images].filter(i=>i.complete&&!i.naturalWidth).map(i=>i.src)"));
}
await send('Emulation.setDeviceMetricsOverride',{width:1440,height:950,deviceScaleFactor:1,mobile:false});
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'reduce'}]});await evaluate('window.scrollTo({top:0,behavior:"instant"})');await pause(400);
console.log('reduced',await evaluate("({hero:getComputedStyle(document.querySelector('.at-arrival')).transform,copyVisible:!document.querySelector('.at-hero-heading').inert,motionButtonHidden:document.getElementById('sculpture-motion').hidden})"));assert.equal(await evaluate("document.querySelector('.at-hero-heading').inert"),false);assert.deepEqual(errors,[]);console.log('PASS: desktop inertia, keyboard cancellation, continuous 3D, gallery, responsive hero, mobile menu and reduced motion');socket.close();
