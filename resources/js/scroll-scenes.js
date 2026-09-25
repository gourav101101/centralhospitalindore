// Cache layout once, then update only transforms and opacity during scrolling.
export function initScrollScenes(reduced) {
    const root=document.documentElement;
    const hero=document.querySelector('.at-arrival');
    const heroStage=document.querySelector('.at-arrival-stage');
    const heroSection=document.querySelector('.at-signature-hero');
    const heroCopy=document.querySelector('.at-hero-heading');
    const heroVeil=document.querySelector('.at-hero-veil');
    const heroCaption=document.querySelector('.at-signature-hero .at-image-caption');
    const family=document.querySelector('.at-family');
    const familySection=document.querySelector('.at-life');
    const breathe=document.querySelector('.at-breathe');
    const photo=breathe?.querySelector('img');
    const shutters=breathe ? [...breathe.querySelectorAll('.at-breathe-shutter')] : [];
    const breatheCopy=breathe?.querySelector('.at-breathe-copy');
    const reading=[...document.querySelectorAll('[data-word-reveal]')].map(heading=>{
        const walker=document.createTreeWalker(heading,NodeFilter.SHOW_TEXT),nodes=[];
        while(walker.nextNode()) nodes.push(walker.currentNode);
        nodes.forEach(node=>{
            const fragment=document.createDocumentFragment();
            node.textContent.split(/(\s+)/).forEach(text=>{
                if(!text.trim())fragment.append(document.createTextNode(text));
                else{const word=document.createElement('span');word.className='at-reading-word';word.textContent=text;fragment.append(word);}
            });
            node.replaceWith(fragment);
        });
        return {heading,words:[...heading.querySelectorAll('.at-reading-word')],top:0,height:0,last:null};
    });
    const clamp=n=>Math.min(1,Math.max(0,n));
    let heroTop=0,heroHeight=1,heroRange=1,familyTop=0,familyHeight=1,breatheTop=0,breatheRange=1,viewport=innerHeight;
    let wide=false,heroLast=null,familyLast=null,breatheLast=null;
    function position(element){return element.getBoundingClientRect().top+scrollY;}
    function measure(){
        viewport=innerHeight;wide=innerWidth>600;
        root.classList.toggle('at-motion-scenes',!reduced.matches);
        if(heroStage){heroTop=position(heroStage);heroHeight=heroStage.offsetHeight;}
        if(heroSection){heroTop=position(heroSection)-document.getElementById('main-header').offsetHeight;heroRange=Math.max(1,heroSection.offsetHeight-heroSection.querySelector('.at-hero-stage').offsetHeight);}
        if(familySection){familyTop=position(familySection);familyHeight=familySection.offsetHeight;}
        if(breathe){breatheTop=position(breathe);breatheRange=Math.max(1,breathe.offsetHeight-viewport+document.getElementById('main-header').offsetHeight);}
        reading.forEach(record=>{record.top=position(record.heading);record.height=record.heading.offsetHeight;record.last=null;});
        heroLast=familyLast=breatheLast=null;
    }
    function update(){
        const y=scrollY;
        if(reduced.matches){
            hero?.style.removeProperty('transform');family?.style.removeProperty('transform');photo?.style.removeProperty('transform');breatheCopy?.style.removeProperty('transform');
            if(heroCopy){heroCopy.style.removeProperty('transform');heroCopy.style.removeProperty('opacity');heroCopy.inert=false;}
            heroVeil?.style.removeProperty('opacity');heroCaption?.style.removeProperty('opacity');
            shutters.forEach(shutter=>shutter.style.removeProperty('transform'));
            reading.forEach(record=>record.words.forEach(word=>word.style.removeProperty('opacity')));
            return;
        }
        if(hero){
            const p=Math.round(clamp(heroSection?(y-heroTop)/heroRange:(y+viewport-heroTop)/(viewport+heroHeight*.12))*1000)/1000;
            if(p!==heroLast){
                if(heroSection&&wide){
                    hero.style.transform=`translate3d(${(1-p)*22}%,0,0) rotateY(${(1-p)*-6}deg) scale(${1.06-.06*p})`;
                    const opacity=1-clamp((p-.16)/.32);
                    heroCopy.style.transform=`translate3d(${-40*p}px,${-100*p}px,0)`;
                    heroCopy.style.opacity=opacity.toFixed(3);heroCopy.inert=opacity<.03;
                    heroVeil.style.opacity=(1-.75*p).toFixed(3);
                    heroCaption.style.opacity=clamp((p-.5)/.32).toFixed(3);
                    heroCaption.style.transform=`translate3d(0,${(1-p)*55}px,0)`;
                }else{
                    hero.style.removeProperty('transform');heroCopy?.style.removeProperty('transform');heroCopy?.style.removeProperty('opacity');
                    if(heroCopy)heroCopy.inert=false;
                    heroVeil?.style.removeProperty('opacity');heroCaption?.style.removeProperty('opacity');
                }
                heroLast=p;
            }
        }
        if(family){
            const p=Math.round(clamp((y+viewport-familyTop)/(viewport+familyHeight))*1000)/1000;
            if(p!==familyLast){family.style.transform=`translate3d(0,${(p-.5)*-35}px,0) rotate(${(p-.5)*-3}deg)`;familyLast=p;}
        }
        reading.forEach(record=>{
            const p=Math.round(clamp((y+viewport*.86-record.top)/(viewport*.55))*1000)/1000;
            if(p===record.last)return;
            record.words.forEach((word,index)=>word.style.opacity=(.28+.72*clamp(p*1.6-index/record.words.length)).toFixed(3));
            record.last=p;
        });
        if(breathe){
            const p=Math.round(clamp((y-breatheTop+viewport*.4)/(breatheRange+viewport*.4))*1000)/1000;
            if(p!==breatheLast){
                shutters.forEach((shutter,index)=>shutter.style.transform=`translate3d(${(index?1:-1)*clamp(p*1.6)*102}%,0,0)`);
                photo.style.transform=`scale(${1.13-.13*p})`;
                breatheCopy.style.transform=`translate3d(0,${(1-p)*35}px,0)`;
                breatheLast=p;
            }
        }
    }
    return {measure,update};
}
