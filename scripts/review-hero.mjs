import { writeFile } from 'node:fs/promises';
const tabs = await (await fetch('http://127.0.0.1:9555/json')).json();
const socket = new WebSocket(tabs.find(tab => tab.type === 'page').webSocketDebuggerUrl);
await new Promise(resolve => socket.addEventListener('open', resolve, { once: true }));
let id = 0;
const pending = new Map();
socket.addEventListener('message', event => {
  const message = JSON.parse(event.data);
  if (pending.has(message.id)) { const { resolve, reject } = pending.get(message.id); pending.delete(message.id); message.error ? reject(message.error) : resolve(message.result); }
});
function send(method, params = {}) { return new Promise((resolve, reject) => { const request = ++id; pending.set(request, { resolve, reject }); socket.send(JSON.stringify({ id: request, method, params })); }); }
const pause = ms => new Promise(resolve => setTimeout(resolve, ms));
const evaluate = async expression => (await send('Runtime.evaluate', { expression, returnByValue: true })).result.value;
await send('Page.enable');
await send('Emulation.setEmulatedMedia', { features: [{ name: 'prefers-reduced-motion', value: 'no-preference' }] });
for (const [width, height] of [[1920,916], [1440,900], [1366,768], [390,844], [768,1024]]) {
  await send('Emulation.setDeviceMetricsOverride', { width, height, deviceScaleFactor: 1, mobile: width < 600 });
  await send('Page.navigate', { url: 'http://127.0.0.1:8011/' });
  await pause(1800);
  console.log(JSON.stringify(await evaluate(`({width:innerWidth,height:innerHeight,scrollWidth:document.documentElement.scrollWidth,heroBottom:document.querySelector('.chi-hero').getBoundingClientRect().bottom,imageLoaded:document.querySelector('.chi-scene-frame img').naturalWidth,menuVisible:getComputedStyle(document.querySelector('.chi-menu-toggle')).display})`)));
  const screenshot = await send('Page.captureScreenshot', { format: 'png' });
  await writeFile(`storage/app/hero-${width}.png`, Buffer.from(screenshot.data, 'base64'));
  if (width === 390) {
    await evaluate(`document.querySelector('.chi-menu-toggle').click()`);
    console.log('menu opens:', await evaluate(`!document.querySelector('.chi-mobile-menu').hidden`));
    await evaluate(`document.querySelector('.chi-menu-toggle').click()`);
  }
  await evaluate(`window.scrollTo({top:900,behavior:'instant'})`);
  await pause(1000);
  console.log('scroll:', await evaluate(`({progress:document.documentElement.style.getPropertyValue('--scroll-progress'),revealed:document.querySelectorAll('.chi-reveal.is-visible').length})`));
  if (width === 1920) {
    for (const selector of ['#discover-care', '#care-team', '.chi-facilities-section']) {
      await evaluate(`window.scrollTo({top:document.querySelector('${selector}').getBoundingClientRect().top+scrollY-95,behavior:'instant'})`);
      await pause(1200);
      console.log('section:', await evaluate(`({section:'${selector}',height:document.querySelector('${selector}').offsetHeight})`));
      const shot = await send('Page.captureScreenshot', { format: 'png' });
      await writeFile(`storage/app/showcase-${selector.replace(/^[#.]/,'')}.png`, Buffer.from(shot.data, 'base64'));
    }
  }
  if (width === 1920 || width === 390) {
    const pageHeight = await evaluate('document.documentElement.scrollHeight');
    for (let top = 0; top < pageHeight; top += 650) {
      await evaluate(`window.scrollTo({top:${top},behavior:'instant'})`);
      await pause(130);
    }
    await pause(1100);
    await evaluate(`window.scrollTo({top:0,behavior:'instant'})`);
    await pause(500);
    const full = await send('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: { x: 0, y: 0, width, height: pageHeight, scale: 1 } });
    await writeFile(`storage/app/full-homepage-${width}.png`, Buffer.from(full.data, 'base64'));
    console.log('full page saved:', width, pageHeight);
  }
}
await send('Emulation.setEmulatedMedia', { features: [{ name: 'prefers-reduced-motion', value: 'reduce' }] });
console.log('reduced motion:', await evaluate(`getComputedStyle(document.querySelector('.chi-scene-frame')).transform`));
socket.close();
