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
for(const width of [1440,390,768]) {
await send('Emulation.setDeviceMetricsOverride',{width,height:950,deviceScaleFactor:1,mobile:width<600});
await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'no-preference'}]});
await send('Page.navigate',{url:'http://127.0.0.1:8011/'});await pause(2300);
console.log('layout',await evaluate(`({width:innerWidth,scrollWidth:document.documentElement.scrollWidth,title:document.title,numberedLabels:/0[1-5] \\/ /.test(document.querySelector('main').innerText),topBar:!!document.querySelector('.elite-nav-top'),heroImage:document.querySelector('.at-arrival img').naturalWidth,headingSize:getComputedStyle(document.querySelector('h1')).fontSize})`));await shot('hero-'+width);
if(width===390){await evaluate(`document.querySelector('.chi-menu-toggle').click()`);console.log('menu',await evaluate(`!document.querySelector('.chi-mobile-menu').hidden`));await send('Input.dispatchKeyEvent',{type:'keyDown',key:'Escape',code:'Escape',windowsVirtualKeyCode:27});console.log('menuClosed',await evaluate(`document.querySelector('.chi-mobile-menu').hidden`));}
for(const [name,selector] of [['sculpture','.at-philosophy'],['life','.at-life'],['expertise','.at-expertise'],['spaces','.at-journey'],['doctors','.at-doctors']]){
await evaluate(`window.scrollTo({top:document.querySelector('${selector}').getBoundingClientRect().top+scrollY-100,behavior:'instant'})`);await pause(900);
if(width!==768)await shot(name+'-'+width);
if(name==='sculpture'){
console.log('canvas',await evaluate(`({width:document.querySelector('canvas').width,hasPixels:document.querySelector('canvas').getContext('2d').getImageData(0,0,document.querySelector('canvas').width,document.querySelector('canvas').height).data.some((v,i)=>i%4===3&&v>0)})`));
await evaluate(`document.getElementById('sculpture-motion').click()`);console.log('paused',await evaluate(`document.getElementById('sculpture-motion').getAttribute('aria-pressed')`));await evaluate(`document.getElementById('sculpture-motion').click()`);
}
if(name==='expertise'){await evaluate(`document.querySelectorAll('.at-speciality summary')[1].click()`);console.log('accordion',await evaluate(`document.querySelectorAll('.at-speciality')[1].open`));}
if(name==='spaces'){await evaluate(`document.querySelector('[data-gallery-step="1"]').click()`);await pause(1700);console.log('gallery',await evaluate(`({enhanced:document.documentElement.classList.contains('at-scroll-gallery'),transform:getComputedStyle(document.querySelector('.at-gallery-track')).transform,scroll:document.querySelector('.at-gallery-window').scrollLeft})`));if(width===1440)await shot('spaces-next');}
}
console.log('images',await evaluate(`({broken:[...document.images].filter(i=>i.complete&&!i.naturalWidth).map(i=>i.src),overflow:document.documentElement.scrollWidth>innerWidth})`));
}
await send('Emulation.setDeviceMetricsOverride',{width:1440,height:950,deviceScaleFactor:1,mobile:false});await send('Emulation.setEmulatedMedia',{features:[{name:'prefers-reduced-motion',value:'reduce'}]});await pause(200);
console.log('reduced',await evaluate(`({enhanced:document.documentElement.classList.contains('at-scroll-gallery'),arrival:getComputedStyle(document.querySelector('.at-arrival')).transform,motionButtonHidden:document.getElementById('sculpture-motion').hidden,words:[...document.querySelectorAll('.at-reading-word')].every(w=>getComputedStyle(w).opacity==='1')})`));
console.log('errors',errors);socket.close();
