import {writeFile} from 'node:fs/promises';
import {execFileSync} from 'node:child_process';
import {resolve} from 'node:path';
import {pathToFileURL} from 'node:url';
// Requires a headless browser with remote debugging on port 9555.
execFileSync('php', ['scripts/render-admin-review.php'], {stdio: 'inherit'});
const tabs=await(await fetch('http://127.0.0.1:9555/json')).json();
const socket=new WebSocket(tabs.find(t=>t.type==='page').webSocketDebuggerUrl);
await new Promise(r=>socket.addEventListener('open',r,{once:true}));
let id=0;const pending=new Map();
socket.addEventListener('message',e=>{const m=JSON.parse(e.data);if(pending.has(m.id)){pending.get(m.id)(m.result);pending.delete(m.id)}});
const send=(method,params={})=>new Promise(r=>{const n=++id;pending.set(n,r);socket.send(JSON.stringify({id:n,method,params}))});
const evaluate=async expression=>(await send('Runtime.evaluate',{expression,returnByValue:true})).result.value;
const pause=ms=>new Promise(r=>setTimeout(r,ms));
const check=(name,ok)=>{console.log(name,ok?'PASS':'FAIL');if(!ok)process.exitCode=1};
await send('Page.enable');
for (const width of [320,390,768,1440]) {
 await send('Emulation.setDeviceMetricsOverride',{width,height:844,deviceScaleFactor:1,mobile:width<900});
 for(const page of ['dashboard','appointments','doctor','settings','login']) {
  await send('Page.navigate',{url:pathToFileURL(resolve('storage/app/admin-review-'+page+'.html')).href});
  await pause(200);
  check(page+' '+width+' no overflow',await evaluate('document.documentElement.scrollWidth <= innerWidth'));
  if(width===390 && page!=='login'){
   await evaluate("document.querySelector('.menu-toggle').click()");
   check(page+' menu opens',await evaluate("document.querySelector('.side').classList.contains('is-open') && document.activeElement.matches('.menu-close') && document.querySelector('.main').inert"));
   await send('Input.dispatchKeyEvent',{type:'keyDown',key:'Tab',code:'Tab',modifiers:8});
   check(page+' focus trap',await evaluate("document.activeElement === [...document.querySelectorAll('.side a')].at(-1)"));
   await send('Input.dispatchKeyEvent',{type:'keyDown',key:'Escape',code:'Escape'});
   check(page+' closes and restores focus',await evaluate("!document.querySelector('.main').inert && document.activeElement.matches('.menu-toggle')"));
   await evaluate("document.querySelector('.menu-toggle').click(); document.querySelector('.menu-backdrop').click()");
   check(page+' backdrop closes',await evaluate("document.querySelector('.menu-toggle').getAttribute('aria-expanded')==='false'"));
  }
  if(width===390 && ['appointments','dashboard','doctor'].includes(page)){
   const r=await send('Page.captureScreenshot',{format:'png'});
   await writeFile('storage/app/admin-mobile-'+page+'.png',Buffer.from(r.data,'base64'));
  }
 }
}
socket.close();
