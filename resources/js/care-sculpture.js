// Upload one mesh once; the GPU handles rotation, depth and lighting.
export function initCareSculpture(reduced) {
    const canvas = document.getElementById('care-sculpture');
    if (!canvas) return;
    const button = document.getElementById('sculpture-motion');
    const gl = canvas.getContext('webgl', { alpha: true, antialias: true, powerPreference: 'low-power' });
    let animation = 0, visible = false, paused = false, lost = false;
    let width = 1, height = 1, angle = .65, lastTime = 0;
    let pointerX = 0, pointerY = 0, rotationX = 0, rotationY = 0;

    function fallback() {
        lost = true;
        cancelAnimationFrame(animation);
        canvas.hidden = true;
        button.hidden = true;
        if (!canvas.parentElement.querySelector('.at-sculpture-fallback')) {
            const sculpture = document.createElement('div');
            sculpture.className = 'at-sculpture-fallback';
            sculpture.setAttribute('role', 'img');
            sculpture.setAttribute('aria-label', 'Interconnected sculptural loops symbolising connected care');
            sculpture.innerHTML = '<span></span><span></span><span></span>';
            canvas.after(sculpture);
        }
    }
    if (!gl) { fallback(); return; }

    function shader(type, source) {
        const value = gl.createShader(type);
        gl.shaderSource(value, source);
        gl.compileShader(value);
        if (!gl.getShaderParameter(value, gl.COMPILE_STATUS)) { gl.deleteShader(value); return null; }
        return value;
    }
    const vertex = shader(gl.VERTEX_SHADER, `
        attribute vec3 position;
        attribute vec3 normal;
        uniform vec2 rotation;
        uniform vec2 aspect;
        varying vec3 surfaceNormal;
        vec3 turn(vec3 v) {
            float cy = cos(rotation.y), sy = sin(rotation.y);
            float cx = cos(rotation.x), sx = sin(rotation.x);
            vec3 p = vec3(v.x*cy+v.z*sy, v.y, -v.x*sy+v.z*cy);
            return vec3(p.x, p.y*cx-p.z*sx, p.y*sx+p.z*cx);
        }
        void main() {
            vec3 p = turn(position);
            float depth = 4.8-p.z;
            gl_Position = vec4(p.x*2.64*aspect.x, -p.y*2.64*aspect.y+.10*depth,
                1.01005*depth-.201005, depth);
            surfaceNormal = turn(normal);
        }
    `);
    const fragment = shader(gl.FRAGMENT_SHADER, `
        precision mediump float;
        varying vec3 surfaceNormal;
        void main() {
            vec3 n = normalize(surfaceNormal);
            vec3 light = normalize(vec3(-.4,-.65,1.0));
            float diffuse = max(0.0,dot(n,light));
            float highlight = pow(max(0.0,dot(n,normalize(vec3(-.2,-.5,.8)))),24.0);
            vec3 colour = vec3(.49,.68,.93)*(.42+.55*diffuse)+highlight*.23;
            gl_FragColor = vec4(colour,1.0);
        }
    `);
    if (!vertex || !fragment) { fallback(); return; }
    const program = gl.createProgram();
    gl.attachShader(program, vertex); gl.attachShader(program, fragment); gl.linkProgram(program);
    gl.deleteShader(vertex); gl.deleteShader(fragment);
    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) { fallback(); return; }
    gl.useProgram(program);
    const unit = v => { const length = Math.hypot(...v) || 1; return v.map(n => n/length); };
    const cross = (a,b) => [a[1]*b[2]-a[2]*b[1],a[2]*b[0]-a[0]*b[2],a[0]*b[1]-a[1]*b[0]];
    const centre = t => [(1+.34*Math.cos(3*t))*Math.cos(2*t),(1+.34*Math.cos(3*t))*Math.sin(2*t),.46*Math.sin(3*t)];
    const segments = 160, sides = 20, positions = [], normals = [], indices = [];
    for (let i=0; i<segments; i++) {
        const t=i/segments*Math.PI*2, c=centre(t), next=centre(t+.001);
        const tangent=unit(next.map((v,j)=>v-c[j]));
        const side=unit(cross(tangent,[0,0,1])), up=unit(cross(side,tangent));
        for (let j=0; j<sides; j++) {
            const a=j/sides*Math.PI*2;
            const n=side.map((v,k)=>v*Math.cos(a)+up[k]*Math.sin(a));
            positions.push(...c.map((v,k)=>v+n[k]*.19)); normals.push(...n);
            const first=i*sides+j, second=((i+1)%segments)*sides+j;
            const third=((i+1)%segments)*sides+(j+1)%sides, fourth=i*sides+(j+1)%sides;
            indices.push(first,second,third,first,third,fourth);
        }
    }
    function buffer(name, values) {
        gl.bindBuffer(gl.ARRAY_BUFFER, gl.createBuffer());
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(values), gl.STATIC_DRAW);
        const location=gl.getAttribLocation(program,name);
        gl.enableVertexAttribArray(location); gl.vertexAttribPointer(location,3,gl.FLOAT,false,0,0);
    }
    buffer('position',positions); buffer('normal',normals);
    gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, gl.createBuffer());
    gl.bufferData(gl.ELEMENT_ARRAY_BUFFER,new Uint16Array(indices),gl.STATIC_DRAW);
    gl.enable(gl.DEPTH_TEST); gl.clearColor(0,0,0,0);
    const rotationUniform=gl.getUniformLocation(program,'rotation');
    const aspectUniform=gl.getUniformLocation(program,'aspect');
    const indexCount=indices.length;

    function render(time) {
        animation=0;
        if (!visible || document.hidden || lost) return;
        const moving=!paused&&!reduced.matches;
        // 30 fps is enough for this slow sculpture; leave time for input and scrolling.
        if (moving && time-lastTime<32) { animation=requestAnimationFrame(render); return; }
        const dt=Math.min(time-lastTime,50); lastTime=time;
        if (moving) angle+=Math.max(0,dt)*.00017;
        rotationX+=(pointerY-rotationX)*.1; rotationY+=(pointerX-rotationY)*.1;
        gl.clear(gl.COLOR_BUFFER_BIT|gl.DEPTH_BUFFER_BIT);
        gl.uniform2f(rotationUniform,reduced.matches?.55:.55+rotationX,reduced.matches?.65:angle+rotationY);
        gl.drawElements(gl.TRIANGLES,indexCount,gl.UNSIGNED_SHORT,0);
        if (moving) animation=requestAnimationFrame(render);
    }
    function draw() { if (!animation && visible && !document.hidden && !lost) animation=requestAnimationFrame(render); }
    function stop() { cancelAnimationFrame(animation); animation=0; }
    function resize() {
        if (lost) return;
        width=canvas.clientWidth; height=canvas.clientHeight;
        const dpr=Math.min(devicePixelRatio||1,1.5);
        canvas.width=Math.round(width*dpr); canvas.height=Math.round(height*dpr);
        gl.viewport(0,0,canvas.width,canvas.height);
        gl.uniform2f(aspectUniform,Math.min(width,height)/width,Math.min(width,height)/height);
        draw();
    }
    const sizeObserver=new ResizeObserver(resize); sizeObserver.observe(canvas);
    const visibilityObserver=new IntersectionObserver(entries=>{
        visible=entries[0].isIntersecting;
        if (visible) { lastTime=performance.now(); draw(); } else stop();
    },{threshold:0}); visibilityObserver.observe(canvas);
    canvas.addEventListener('pointermove',event=>{
        if (reduced.matches || paused || event.pointerType==='touch') return;
        const rect=canvas.getBoundingClientRect();
        pointerX=((event.clientX-rect.left)/rect.width-.5)*.8;
        pointerY=((event.clientY-rect.top)/rect.height-.5)*.6;
    },{passive:true});
    canvas.addEventListener('pointerleave',()=>{pointerX=0;pointerY=0;});
    button.addEventListener('click',()=>{
        paused=!paused; button.setAttribute('aria-pressed',String(paused));
        button.setAttribute('aria-label',paused?'Play sculpture animation':'Pause sculpture animation');
        button.textContent=paused?'Play motion ↻':'Pause motion Ⅱ';
        stop(); draw();
    });
    function motionChange() { button.hidden=reduced.matches; stop(); draw(); }
    reduced.addEventListener('change',motionChange); motionChange();
    document.addEventListener('visibilitychange',()=>{if(document.hidden)stop();else{lastTime=performance.now();draw();}});
    canvas.addEventListener('webglcontextlost',()=>{sizeObserver.disconnect();visibilityObserver.disconnect();fallback();});
    resize();
}
