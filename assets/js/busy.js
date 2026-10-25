// src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
    'use strict';
    if (window.__srtxBusy) return;
    window.__srtxBusy = true;
// src by SRT X CHEATS. Copy right SRT X CHEATS

    var SEL = 'button,.btn,[role="button"],input[type="submit"],input[type="checkbox"],.switch,.toggle,label.sw';
    var START_WINDOW = 1200;
    var MIN_SHOW = 700;
    var GRACE = 350;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var RESULT_MS = 1100;

    var css = document.createElement('style');
    css.textContent =
        '@keyframes srtxSpin{to{transform:rotate(360deg)}}' +
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        '@keyframes srtxPulse{0%,100%{box-shadow:0 0 0 0 rgba(56,189,248,0)}50%{box-shadow:0 0 0 5px rgba(56,189,248,.35)}}' +
        '@keyframes srtxOk{0%{box-shadow:0 0 0 0 rgba(34,197,94,.7)}100%{box-shadow:0 0 0 14px rgba(34,197,94,0)}}' +
        '@keyframes srtxBad{0%{box-shadow:0 0 0 0 rgba(239,68,68,.7)}100%{box-shadow:0 0 0 14px rgba(239,68,68,0)}}' +
        '.srtx-busy{pointer-events:none;cursor:progress;animation:srtxPulse 1.1s ease-in-out infinite}' +
        '.srtx-busy>i:first-of-type{display:inline-block;animation:srtxSpin .8s linear infinite}' +
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        '.srtx-busy>i:first-of-type::before,.srtx-ok>i:first-of-type::before,.srtx-fail>i:first-of-type::before{font-family:"Font Awesome 6 Free";font-weight:900}' +
        '.srtx-busy>i:first-of-type::before{content:"\\f1ce"}' +
        'button.srtx-busy:not(:has(>i)):not(:has(.btn-spinner))::before,.btn.srtx-busy:not(:has(>i)):not(:has(.btn-spinner))::before{content:"";display:inline-block;width:1em;height:1em;margin-right:.55em;' +
        'vertical-align:-.15em;border:2px solid currentColor;border-right-color:transparent;border-radius:50%;animation:srtxSpin .7s linear infinite}' +
        '.srtx-ok{animation:srtxOk 1s ease-out;color:#22c55e!important;border-color:#22c55e!important}' +
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        '.srtx-fail{animation:srtxBad 1s ease-out;color:#ef4444!important;border-color:#ef4444!important}' +
        '.srtx-ok>i:first-of-type::before{content:"\\f00c"}.srtx-fail>i:first-of-type::before{content:"\\f00d"}' +
        '.srtx-ok>i:first-of-type,.srtx-fail>i:first-of-type{animation:none}';
    document.head.appendChild(css);

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    window.srtxBusyTouch = function (el) { if (el) last = { el: el, t: Date.now() }; };


    // ---- circle loader: a loading .btn shrinks into a round spinner (and grows back) ----
    var MORPH_SEL = '.btn:not([data-no-morph])';
    var morphTimers = new WeakMap();
    function morphOn(el) {
        if (el.classList.contains('is-morph')) return;
        var t = morphTimers.get(el); if (t) { clearTimeout(t); morphTimers.delete(el); }
        var fresh = el.__pinT && Date.now() - el.__pinT < 3000;
        var w = (fresh && el.__pinW) || el.offsetWidth, h = (fresh && el.__pinH) || el.offsetHeight;
        if (!w || !h) return;
        el.__origW = w;
        el.style.width = w + 'px';
        el.style.setProperty('--mh', Math.max(38, Math.min(h, 54)) + 'px');
        void el.offsetWidth;                       // commit the pinned width so the transition has a start
        el.classList.add('is-morph');
    }
    function morphOff(el) {
        if (!el.classList.contains('is-morph')) return;
        el.classList.remove('is-morph');
        if (el.__origW) el.style.width = el.__origW + 'px';
        var t = setTimeout(function () { el.style.width = ''; el.style.removeProperty('--mh'); el.__pinW = el.__pinH = 0; morphTimers.delete(el); }, 420);
        morphTimers.set(el, t);
    }
    window.srtxMorph = function (el, on) { if (!el) return; if (on) { el.__pinW = el.offsetWidth; el.__pinH = el.offsetHeight; el.__pinT = Date.now(); morphOn(el); } else morphOff(el); };
    if (window.MutationObserver) {
        new MutationObserver(function (list) {
            for (var i = 0; i < list.length; i++) {
                var el = list[i].target;
                if (!el.matches || !el.matches(MORPH_SEL)) continue;
                var on = el.classList.contains('loading') || el.classList.contains('srtx-busy');
                if (on) morphOn(el); else morphOff(el);
            }
        }).observe(document.documentElement, { subtree: true, attributes: true, attributeFilter: ['class'] });
    }

    var states = new WeakMap();
    var live = [];
    var last = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS

    document.addEventListener('click', function (e) {
        var el = e.target && e.target.closest ? e.target.closest(SEL) : null;
        if (!el || el.disabled || el.hasAttribute('data-no-busy') || el.closest('[data-no-busy]')) { last = null; return; }
        last = { el: el, t: Date.now() };
        if (el.matches && el.matches(MORPH_SEL)) { el.__pinW = el.offsetWidth; el.__pinH = el.offsetHeight; el.__pinT = Date.now(); }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }, true);

    function clearResult(el) { el.classList.remove('srtx-ok', 'srtx-fail'); }

    function begin(el) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var st = states.get(el);
        if (!st) { st = { n: 0, ok: true, start: Date.now(), timer: null }; states.set(el, st); live.push(el); }
        if (st.timer) { clearTimeout(st.timer); st.timer = null; }
        if (st.n === 0 && !el.classList.contains('srtx-busy')) {
            clearResult(el); st.ok = true; st.start = Date.now();
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            el.classList.add('srtx-busy'); el.setAttribute('aria-busy', 'true');
        }
        return st;
    }

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    function finish(el, st) {
        var wait = Math.max(0, MIN_SHOW - (Date.now() - st.start));
        setTimeout(function () {
            if (st.n > 0) return;
            el.classList.remove('srtx-busy'); el.removeAttribute('aria-busy');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            el.classList.add(st.ok ? 'srtx-ok' : 'srtx-fail');
            states.delete(el);
            var i = live.indexOf(el); if (i >= 0) live.splice(i, 1);
            setTimeout(function () { clearResult(el); }, RESULT_MS);
        }, wait);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }

    function track(el, p) {
        var st = begin(el);
        st.n++;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var done = function (ok) {
            if (!ok) st.ok = false;
            st.n--;
            if (st.n === 0) st.timer = setTimeout(function () { finish(el, st); }, GRACE);
        };
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        p.then(function (r) { done(!!(r && r.ok)); }, function () { done(false); });
    }

    var realFetch = window.fetch;
    if (!realFetch) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    window.fetch = function () {
        var p = realFetch.apply(this, arguments);
        try {
            if (last && Date.now() - last.t < START_WINDOW) { track(last.el, p); }
            else {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                live.slice().forEach(function (el) { var s = states.get(el); if (s && s.n === 0 && s.timer) track(el, p); });
            }
        } catch (e) {  }
        return p;
    };
// src by SRT X CHEATS. Copy right SRT X CHEATS
})();
