// Gentle desktop wheel inertia. Touch, keyboard, nested scrollers and reduced motion stay native.
export function initSmoothWheel(reduced) {
    const fine=matchMedia('(hover: hover) and (pointer: fine)');
    let frame=0,target=scrollY,current=scrollY,expected=scrollY,lastTime=0,limit=0,direction=0;
    const enabled=()=>fine.matches&&!reduced.matches&&innerWidth>900;
    const bound=value=>Math.max(0,Math.min(limit,value));
    function stop(){cancelAnimationFrame(frame);frame=0;current=target=expected=scrollY;direction=0;}
    function measure(){limit=Math.max(0,document.documentElement.scrollHeight-innerHeight);target=bound(target);}
    function tick(time){
        const dt=Math.min(40,time-lastTime||16.7);lastTime=time;
        current+=(target-current)*(1-Math.exp(-dt/115));
        if(Math.abs(target-current)<.4)current=target;
        expected=current;
        window.scrollTo({top:current,behavior:'instant'});
        expected=scrollY;
        if(Math.abs(target-current)>.4)frame=requestAnimationFrame(tick);
        else{frame=0;current=target=scrollY;}
    }
    function nestedScroll(event){
        for(const node of event.composedPath()){
            if(!(node instanceof HTMLElement)||node===document.body||node===document.documentElement)continue;
            if(node.matches('input,textarea,select,[contenteditable="true"],[data-native-scroll]'))return true;
            const style=getComputedStyle(node);
            if(/auto|scroll/.test(style.overflowY)&&node.scrollHeight>node.clientHeight+1)return true;
            if(/auto|scroll/.test(style.overflowX)&&node.scrollWidth>node.clientWidth+1)return true;
        }
        return false;
    }
    window.addEventListener('wheel',event=>{
        if(!enabled()||event.defaultPrevented||!event.cancelable||event.ctrlKey||event.metaKey||event.shiftKey||Math.abs(event.deltaX)>Math.abs(event.deltaY)||nestedScroll(event)){stop();return;}
        const delta=event.deltaY*(event.deltaMode===1?16:event.deltaMode===2?innerHeight:1);
        if(!delta)return;
        event.preventDefault();
        const nextDirection=Math.sign(delta);
        if(!frame||nextDirection!==direction){current=target=scrollY;direction=nextDirection;}
        target=bound(target+delta);
        if(!frame){lastTime=performance.now();frame=requestAnimationFrame(tick);}
    },{passive:false});
    // Stop immediately when the user takes control, or a link/programmatic scroll moves the page.
    window.addEventListener('pointerdown',stop,{passive:true});
    window.addEventListener('touchstart',stop,{passive:true});
    window.addEventListener('keydown',event=>{if(['ArrowUp','ArrowDown','PageUp','PageDown','Home','End',' ','Escape','Tab'].includes(event.key))stop();});
    window.addEventListener('click',stop,{capture:true,passive:true});
    window.addEventListener('scroll',()=>{if(frame&&Math.abs(scrollY-expected)>3)stop();},{passive:true});
    window.addEventListener('blur',stop);
    window.addEventListener('resize',()=>{stop();measure();},{passive:true});
    reduced.addEventListener('change',stop);fine.addEventListener('change',stop);
    new ResizeObserver(measure).observe(document.body);
    measure();
}
