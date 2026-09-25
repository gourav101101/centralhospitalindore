import './bootstrap';
import '../css/premium.css';
import './atelier';

const navigationEntry = performance.getEntriesByType('navigation')[0];
if (document.body.classList.contains('chi-home') && navigationEntry?.type === 'reload' && !window.location.hash) {
    if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
    window.scrollTo(0, 0);
    window.addEventListener('load', () => window.scrollTo(0, 0), { once: true });
}

const menuButton = document.querySelector('.chi-menu-toggle');
const mobileMenu = document.getElementById('chi-mobile-menu');
function closeMenu() {
    if (!menuButton || !mobileMenu) return;
    mobileMenu.hidden = true;
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Open navigation');
    menuButton.textContent = '☰';
}
menuButton?.addEventListener('click', () => {
    const open = menuButton.getAttribute('aria-expanded') !== 'true';
    mobileMenu.hidden = !open;
    menuButton.setAttribute('aria-expanded', String(open));
    menuButton.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
    menuButton.textContent = open ? '×' : '☰';
});
document.addEventListener('keydown', event => { if (event.key === 'Escape' && menuButton?.getAttribute('aria-expanded') === 'true') { closeMenu(); menuButton.focus(); } });
window.addEventListener('resize', () => { if (window.innerWidth > 1200) closeMenu(); });
const header = document.getElementById('main-header');
if (header && 'ResizeObserver' in window) {
    new ResizeObserver(() => {
        document.documentElement.style.setProperty('--nav-height', `${header.getBoundingClientRect().height}px`);
    }).observe(header);
}
window.addEventListener('scroll', () => header?.classList.toggle('is-scrolled', window.scrollY > 15), { passive: true });
if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.documentElement.classList.add('chi-motion');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.v2-care-grid, .v2-team-grid, .v2-stories-grid, .v2-service-directory').forEach(grid => {
        grid.querySelectorAll('.chi-reveal').forEach((card, index) => card.style.setProperty('--reveal-delay', `${(index % 3) * 90}ms`));
    });
    document.querySelectorAll('.chi-reveal').forEach(element => observer.observe(element));
}

const motionPreference = window.matchMedia('(prefers-reduced-motion: reduce)');
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
const heroScene = document.querySelector('.chi-hero-scene');
const scrollProgress = document.querySelector('.chi-scroll-progress');
let scrollRange = 1;
function measureScrollRange() {
    scrollRange = Math.max(1, document.documentElement.scrollHeight - window.innerHeight);
    scheduleScrollEffects();
}
let scrollFrame = 0;
function updateScrollEffects() {
    scrollFrame = 0;
    if (scrollProgress) scrollProgress.style.transform = `scaleX(${Math.min(1, window.scrollY / scrollRange)})`;
    if (heroScene) heroScene.style.setProperty('--scene-scroll', !motionPreference.matches && window.innerWidth > 968 ? `${Math.min(window.scrollY * .06, 24)}px` : '0px');
}
function scheduleScrollEffects() {
    if (!scrollFrame) scrollFrame = requestAnimationFrame(updateScrollEffects);
}
window.addEventListener('scroll', scheduleScrollEffects, { passive: true });
window.addEventListener('resize', measureScrollRange, { passive: true });
window.addEventListener('load', measureScrollRange, { once: true });
new ResizeObserver(measureScrollRange).observe(document.body);
motionPreference.addEventListener('change', scheduleScrollEffects);
measureScrollRange();

mobileMenu?.addEventListener('click', event => {
    if (event.target.closest('a')) closeMenu();
});

const spaceImage = document.getElementById('elite-space-image');
document.querySelectorAll('[data-space]').forEach(button => {
    button.addEventListener('click', () => {
        if (!spaceImage) return;
        const diagnostics = button.dataset.space === '1';
        spaceImage.src = diagnostics ? spaceImage.dataset.diagnostics : spaceImage.dataset.arrival;
        spaceImage.alt = diagnostics ? 'Illustrative diagnostic imaging room; planned facilities subject to confirmation' : 'Architectural concept of the hospital entrance';
        document.getElementById('elite-space-caption').textContent = diagnostics ? 'Illustrative image · Planned facilities subject to confirmation' : 'Architectural concept · Hospital under construction';
        document.querySelectorAll('[data-space]').forEach(tab => {
            tab.classList.toggle('is-active', tab === button);
            tab.setAttribute('aria-pressed', String(tab === button));
        });
        if (!motionPreference.matches) spaceImage.animate([{ opacity: .3, transform: 'scale(1.035)' }, { opacity: 1, transform: 'scale(1)' }], { duration: 650, easing: 'ease-out' });
    });
});

document.querySelectorAll('[data-tilt], .v2-care-card, .v2-story-card').forEach(element => {
    element.addEventListener('pointermove', event => {
        if (motionPreference.matches || !finePointer.matches) return;
        const rect = element.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width;
        const y = (event.clientY - rect.top) / rect.height;
        if (element.hasAttribute('data-tilt')) {
            element.style.setProperty('--tilt-x', `${(0.5 - y) * 3}deg`);
            element.style.setProperty('--tilt-y', `${(x - 0.5) * 3}deg`);
        } else {
            element.style.setProperty('--glow-x', `${x * 100}%`);
            element.style.setProperty('--glow-y', `${y * 100}%`);
        }
    }, { passive: true });
    element.addEventListener('pointerleave', () => {
        element.style.removeProperty('--tilt-x');
        element.style.removeProperty('--tilt-y');
    });
});
