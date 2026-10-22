// src by SRT X CHEATS. Copy right SRT X CHEATS
const SVG = {
    crown: '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M2.5 8.2l4.9 4.3L12 4.5l4.6 8 4.9-4.3-1.7 10.3H4.2z"/><rect fill="currentColor" x="4.4" y="19.4" width="15.2" height="2" rx="1"/></svg>',
    gem:   '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.2 3h11.6l4.2 6L12 21.5 2 9z"/><path fill="none" stroke="rgba(0,0,0,.35)" stroke-width="1" d="M2 9h20M9 3l-2 6 5 12.5M15 3l2 6-5 12.5"/></svg>',
};
// src by SRT X CHEATS. Copy right SRT X CHEATS
export const BADGES = {
    silver_crown: { label: 'Silver Crown', svg: 'crown' },
    gold_crown:   { label: 'Gold Crown',   svg: 'crown' },
    diamond:      { label: 'Diamond',      svg: 'gem' },
    T:            { label: '“T” Badge',    letter: 'T' },
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    R:            { label: '“R” Badge',    letter: 'R' },
    S:            { label: '★ “S” Star Badge', letter: 'S', spark: true },
};
export const THEME = { gold_flow:'silver', gold_aura:'silver', dark_flow:'gold', dark_aura:'gold', comet:'green', comet_aura:'green', star_royal:'bflame', star_aura:'bflame', inferno_flow:'orange', inferno_aura:'orange', aurora_flow:'ghost', aurora_aura:'ghost', neon_flow:'crimson', neon_aura:'crimson' };
export const BANNERS = {
    gold_flow: { label: 'Silver Shine', swatch: 'linear-gradient(90deg,#1a1d24,#dfe6f2,#1a1d24)' },
    dark_flow: { label: 'Golden Shine', swatch: 'linear-gradient(90deg,#2a1b03,#ffd45a,#2a1b03)' },
    comet: { label: 'Emerald Green', swatch: 'linear-gradient(90deg,#03160c,#3dff9a,#03160c)' },
    star_royal: { label: 'Blue Flame 🔥', swatch: 'linear-gradient(90deg,#020918,#2f8cff,#9be3ff,#020918)' },
    inferno_flow: { label: 'Orange Blaze', swatch: 'linear-gradient(90deg,#1d0900,#ff9632,#1d0900)' },
    aurora_flow: { label: 'Black Ghost 👻', swatch: 'linear-gradient(90deg,#020104,#9b7bff,#020104)' },
    neon_flow: { label: 'Red Aura PRO MAX', swatch: 'linear-gradient(90deg,#0a0102,#ff2b3a,#0a0102)' },
};
export const PROFILES = {
    gold_aura: { label: 'Silver Shine Profile', swatch: 'linear-gradient(135deg,#1a1d24,#dfe6f2,#1a1d24)' },
    dark_aura: { label: 'Golden Shine Profile', swatch: 'linear-gradient(135deg,#2a1b03,#ffd45a,#2a1b03)' },
    comet_aura: { label: 'Emerald Green Profile', swatch: 'linear-gradient(135deg,#03160c,#3dff9a,#03160c)' },
    star_aura: { label: 'Blue Flame 🔥 Profile', swatch: 'linear-gradient(135deg,#020918,#2f8cff,#9be3ff,#020918)' },
    inferno_aura: { label: 'Orange Blaze Profile', swatch: 'linear-gradient(135deg,#1d0900,#ff9632,#1d0900)' },
    aurora_aura: { label: 'Black Ghost 👻 Profile', swatch: 'linear-gradient(135deg,#020104,#9b7bff,#020104)' },
    neon_aura: { label: 'Red Aura PRO MAX Profile', swatch: 'linear-gradient(135deg,#0a0102,#ff2b3a,#0a0102)' },
};
export const CROWNS = { gold: '#f5b73b', silver: '#cbd5e1', bronze: '#cd7f32' };

export function badgeHtml(id, size = 22) {
    const b = BADGES[id];
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!b) return '';
    const inner = b.letter ? `<b>${b.letter}</b>` : SVG[b.svg];
    return `<span class="rbadge rbadge-${id}" style="--s:${Number(size) || 22}px" title="${b.label}"><i class="rb-glow"></i><span class="rb-body">${inner}</span><i class="rb-shine"></i>${b.spark ? '<i class="rb-spark"></i>' : ''}</span>`;
}
export const avBadgeHtml = (id, size = 20) => (BADGES[id] ? `<span class="av-badge">${badgeHtml(id, size)}</span>` : '');
// src by SRT X CHEATS. Copy right SRT X CHEATS
export function setAvatarBadge(wrap, id, size = 22) {
    if (!wrap) return;
    wrap.querySelectorAll(':scope > .av-badge').forEach((n) => n.remove());
    if (BADGES[id]) wrap.insertAdjacentHTML('beforeend', avBadgeHtml(id, size));
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
export const bannerClass = (id) => (BANNERS[id] ? ` fxb fx-t-${THEME[id]}` : '');
const LAYERS = '<i></i><i></i><i></i><i></i><i></i>';
const FXL = `<span class="fxl" aria-hidden="true">${LAYERS}</span>`;
export const bannerInner = (id) => (BANNERS[id] ? FXL : '');
export const profileClass = (id) => (PROFILES[id] ? ` fxp fx-t-${THEME[id]}` : '');
export function applyProfileEffect(el, id) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!el) return;
    [...el.classList].filter((c) => c === 'fxp' || c === 'fxp-flat' || c.startsWith('fx-t-')).forEach((c) => el.classList.remove(c));
    el.querySelectorAll(':scope > .fxl').forEach((n) => n.remove());
    if (PROFILES[id]) {
        // banner = the original bright effect box; applyPageEffect adds a calmer copy behind the whole page
        el.classList.add('fxp', 'fx-t-' + THEME[id]);
        el.insertAdjacentHTML('afterbegin', FXL);
    }
}

const root = document.documentElement;
const safe = (fn, d) => { try { return fn(); } catch (e) { return d; } };
function detectTier() {
    const n = navigator, cores = n.hardwareConcurrency || 4, mem = typeof n.deviceMemory === 'number' ? n.deviceMemory : 4;
    const forced = safe(() => new URLSearchParams(location.search).get('rfx'), null);
    if (forced === 'lite' || forced === 'high' || forced === 'still') return forced;
    if (safe(() => matchMedia('(prefers-reduced-motion: reduce)').matches, false)) return 'still';
    if (safe(() => n.connection && n.connection.saveData, false) || cores <= 2 || mem <= 1) return 'lite';
    if (root.classList.contains('srt-low-fx')) return 'mid';
    return 'high';
}
root.setAttribute('data-rfx', detectTier());
export const fxTier = () => root.getAttribute('data-rfx');
/* FULL-PAGE profile effect: one fixed layer behind the header, content and tab bar. */
export function applyPageEffect(id) {
    const cur = document.getElementById('pgfx');
    if (!PROFILES[id]) { cur?.remove(); root.classList.remove('pgfx-on'); return; }
    if (cur && cur.dataset.id === id) return;
    cur?.remove();
    const d = document.createElement('div');
    d.id = 'pgfx';
    d.dataset.id = id;
    d.className = 'fxp-page fx-t-' + THEME[id];
    d.setAttribute('aria-hidden', 'true');
    d.innerHTML = FXL;
    (document.body || root).appendChild(d);
    root.classList.add('pgfx-on');
}

/* Pause banner/profile animations that are off-screen (saves GPU/CPU on laptops and weak phones). */
(function watchFx() {
    if (typeof IntersectionObserver === 'undefined' || typeof MutationObserver === 'undefined') return;
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => e.target.classList.toggle('rfx-off', !e.isIntersecting));
    }, { rootMargin: '80px' });
    const seen = new WeakSet();
    const scan = (node) => {
        if (!node || node.nodeType !== 1) return;
        const list = node.matches && node.matches('.fxb, .fxp') ? [node] : [];
        if (node.querySelectorAll) node.querySelectorAll('.fxb, .fxp').forEach((n) => list.push(n));
        list.forEach((n) => { if (!seen.has(n)) { seen.add(n); io.observe(n); } });
    };
    const start = () => {
        scan(document.body);
        new MutationObserver((muts) => {
            for (const m of muts) {
                m.addedNodes.forEach(scan);
            }
        }).observe(document.body, { childList: true, subtree: true });
    };
    if (document.body) start(); else document.addEventListener('DOMContentLoaded', start);
})();
