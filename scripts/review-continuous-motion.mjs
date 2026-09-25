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
for(const width of [1440,390]){
await send('Emulation.setDeviceMetricsOverride',{width,height:950,deviceScaleFactor:1,mobile:width<600});
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'no-preference'}]});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(1800);
const hero=await evaluate("({label:document.querySelector('.at-image-caption small').textContent,transform:getComputedStyle(document.querySelector('.at-arrival')).transform,overflow:document.documentElement.scrollWidth>innerWidth,technicalLabel:document.querySelector('main').innerText.includes('AI-GENERATED')})");
assert.equal(hero.label,'INTERIOR CONCEPT');if(width===1440)assert.notEqual(hero.transform,'none');assert.equal(hero.overflow,false);assert.equal(hero.technicalLabel,false);console.log('hero',width,hero);await shot('continuous-hero-'+width);
await evaluate("window.scrollTo({top:document.querySelector('.at-sculpture').getBoundingClientRect().top+scrollY-140,behavior:'instant'})");await pause(600);
const renderer=await evaluate("({webgl:!!document.getElementById('care-sculpture').getContext('webgl'),fallback:!!document.querySelector('.at-sculpture-fallback'),hidden:document.getElementById('care-sculpture').hidden,draws:window.__draws})");console.log('renderer',width,renderer);assert.equal(renderer.webgl,true);assert.equal(renderer.fallback,false);
const before=await evaluate('window.__draws');await pause(500);assert.ok(await evaluate('window.__draws')>before,'Sculpture should animate while idle');
await shot('continuous-sculpture-'+width);
await evaluate("document.getElementById('sculpture-motion').click()");await pause(100);const paused=await evaluate('window.__draws');await pause(300);assert.equal(await evaluate('window.__draws'),paused,'Pause must stop rendering');
await evaluate("document.getElementById('sculpture-motion').click()");await pause(100);
await evaluate('window.scrollBy({top:1,behavior:"instant"})');await pause(40);const during=await evaluate('window.__draws');
for(let i=0;i<5;i++){await evaluate('window.scrollBy({top:2,behavior:"instant"})');await pause(45)}
assert.ok(await evaluate('window.__draws')>during,'Sculpture must keep rendering during scrolling');await pause(400);assert.ok(await evaluate('window.__draws')>during,'Sculpture must resume after scroll');
await evaluate("window.scrollTo({top:document.querySelector('.at-journey').offsetTop-100,behavior:'instant'})");await pause(500);await evaluate("document.querySelectorAll('[data-gallery-step]')[1].click()");await pause(1100);
const gallery=await evaluate("({enhanced:document.documentElement.classList.contains('at-scroll-gallery'),transform:document.querySelector('.at-gallery-track').style.transform,scroll:document.querySelector('.at-gallery-window').scrollLeft})");console.log('gallery',width,gallery);assert.ok(width===1440?gallery.transform.includes('-'):gallery.scroll>0);

for(const [name,selector] of [['opening','.at-breathe'],['stack','.at-considered']]){
await evaluate("window.scrollTo({top:document.querySelector('"+selector+"').getBoundingClientRect().top+scrollY+250,behavior:'instant'})");await pause(700);await shot('continuous-'+name+'-'+width);
console.log(name,width,await evaluate("({overflow:document.documentElement.scrollWidth>innerWidth,shutters:[...document.querySelectorAll('.at-breathe-shutter')].map(el=>el.style.transform),stack:[...document.querySelectorAll('.at-considered-card')].map(el=>getComputedStyle(el).position)})"));
}
const opacity=await evaluate("[...document.querySelectorAll('.at-reading-word')].map(word=>getComputedStyle(word).opacity)");assert.ok(opacity.length>8);
await evaluate("window.scrollTo({top:0,behavior:'instant'})");await pause(200);const initialWords=await evaluate("getComputedStyle(document.querySelector('.at-reading-word')).opacity");
await evaluate("window.scrollTo({top:document.querySelector('.at-philosophy').offsetTop,behavior:'instant'})");await pause(400);const readWords=await evaluate("getComputedStyle(document.querySelector('.at-reading-word')).opacity");assert.ok(Number(readWords)>Number(initialWords),'Words should illuminate on scroll');
if(width===390){await evaluate("document.querySelector('.chi-menu-toggle').click()");assert.equal(await evaluate("document.querySelector('.chi-mobile-menu').hidden"),false);await evaluate("document.querySelector('.chi-menu-toggle').click()");}
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'reduce'}]});await evaluate("window.scrollTo({top:document.querySelector('.at-sculpture').getBoundingClientRect().top+scrollY-140,behavior:'instant'})");await pause(450);const reduced=await evaluate('window.__draws');await pause(300);assert.equal(await evaluate('window.__draws'),reduced);assert.equal(await evaluate("document.getElementById('sculpture-motion').hidden"),true);
}
// Context loss should leave a visible, static fallback rather than a blank section.
await evaluate("document.getElementById('care-sculpture').getContext('webgl').getExtension('WEBGL_lose_context').loseContext()");await pause(150);assert.equal(await evaluate("!!document.querySelector('.at-sculpture-fallback') && document.getElementById('care-sculpture').hidden"),true);
assert.deepEqual(errors,[]);console.log('PASS: continuous sculpture, word reveal, hero tilt, opening scene, stacking cards, pause control, reduced motion, gallery, mobile navigation and fallback');socket.close();
