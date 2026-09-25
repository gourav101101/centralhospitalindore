import { initCareSculpture } from './care-sculpture';
import { initScrollScenes } from './scroll-scenes';
import { initSmoothWheel } from './smooth-wheel';

// Native scrolling with cached geometry and compositor-friendly visual effects.
if (document.body.classList.contains('chi-home')) {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    const root = document.documentElement;
    const journey = document.querySelector('.at-journey');
    const track = document.querySelector('.at-gallery-track');
    const gallery = document.querySelector('.at-gallery-window');
    const nav = document.getElementById('main-header');
    const buttons = [...document.querySelectorAll('[data-gallery-step]')];
    const scenes = initScrollScenes(reduced);
    const clamp = n => Math.min(1, Math.max(0, n));
    let enhanced = false, frame = 0, progress = 0, travel = 0, range = 1, start = 0, step = 0;
    let lastX = null;

    function update() {
        frame = 0;
        scenes.update();
        if (!gallery) return;
        if (enhanced) {
            progress = clamp((scrollY-start)/range);
            const x = Math.round(-progress*travel*10)/10;
            if (x !== lastX) { track.style.transform=`translate3d(${x}px,0,0)`; lastX=x; }
        } else progress=gallery.scrollLeft/Math.max(1,gallery.scrollWidth-gallery.clientWidth);
        buttons.forEach(button=>{
            const disabled=Number(button.dataset.galleryStep)<0 ? progress<=.005 : progress>=.995;
            if (button.disabled!==disabled) button.disabled=disabled;
        });
    }
    function schedule() { if (!frame) frame=requestAnimationFrame(update); }
    function measure() {
        scenes.measure();
        if (!journey) return;
        const navHeight=nav.offsetHeight;
        start=journey.getBoundingClientRect().top+scrollY-navHeight;
        range=Math.max(1,journey.offsetHeight-innerHeight+navHeight);
        travel=Math.max(0,track.scrollWidth-gallery.clientWidth);
        const card=track.querySelector('.at-space-card');
        step=card.offsetWidth+parseFloat(getComputedStyle(track).gap);
        lastX=null;
        schedule();
    }
    function configure() {
        root.classList.toggle('at-motion',!reduced.matches);
        enhanced=innerWidth>1000&&innerHeight>650&&!reduced.matches;
        root.classList.toggle('at-scroll-gallery',enhanced);
        if (!enhanced) track?.style.removeProperty('transform');
        else if (gallery) gallery.scrollLeft=0;
        measure();
    }
    buttons.forEach(button=>button.addEventListener('click',()=>{
        const direction=Number(button.dataset.galleryStep);
        if (enhanced && travel>0) {
            const next=clamp((progress*travel+direction*step)/travel);
            window.scrollTo({top:start+next*range,behavior:reduced.matches?'instant':'smooth'});
        } else gallery.scrollBy({left:direction*step,behavior:reduced.matches?'instant':'smooth'});
    }));
    gallery?.addEventListener('scroll',schedule,{passive:true});
    addEventListener('scroll',schedule,{passive:true});
    addEventListener('resize',configure,{passive:true});
    addEventListener('load',measure,{once:true});
    reduced.addEventListener('change',configure);
    // Accordion and responsive text reflow can move the gallery's start position.
    const layoutObserver=new ResizeObserver(measure);
    document.querySelectorAll('main > section,#main-header').forEach(section=>layoutObserver.observe(section));
    document.fonts?.ready.then(measure);
    configure();
    const targets=document.querySelectorAll('.at-life-copy,.at-section-heading,.at-conversation-grid,.at-story-grid article');
    if ('IntersectionObserver' in window) {
        const reveal=new IntersectionObserver(entries=>entries.forEach(entry=>{
            if (entry.isIntersecting) { entry.target.classList.add('is-seen'); reveal.unobserve(entry.target); }
        }),{threshold:.08});
        targets.forEach(target=>{target.classList.add('at-inview');reveal.observe(target);});
    }
    initCareSculpture(reduced);
    initSmoothWheel(reduced);
}

if (document.body.classList.contains('chi-inner')) {
    initSmoothWheel(matchMedia('(prefers-reduced-motion: reduce)'));
}
