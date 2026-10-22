// src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
    'use strict';
    if (window.srtxToast) return;

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var KINDS = {
        error:   { icon: 'fa-xmark',          color: '#ef4444', ms: 5200 },
        success: { icon: 'fa-check',          color: '#22c55e', ms: 3800 },
        warn:    { icon: 'fa-exclamation',    color: '#f59e0b', ms: 5000 },
        info:    { icon: 'fa-info',           color: '#38bdf8', ms: 4200 },
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    };

    function css() {
        if (document.getElementById('srtxToastCss')) return;
        var st = document.createElement('style');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        st.id = 'srtxToastCss';
        st.textContent =
            '#srtxToasts{position:fixed;top:max(12px,env(safe-area-inset-top));left:50%;transform:translateX(-50%);z-index:2147483000;' +
            'width:min(calc(100vw - 24px),480px);display:flex;flex-direction:column;gap:10px;pointer-events:none}' +
            '.srtx-t{--c:#ef4444;position:relative;display:flex;align-items:center;gap:14px;padding:14px 14px 16px 14px;border-radius:18px;overflow:hidden;' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            'pointer-events:auto;color:#f4f4f5;background:rgba(18,18,22,.97);border:1px solid rgba(255,255,255,.09);' +
            'box-shadow:0 14px 40px rgba(0,0,0,.55),0 0 0 1px color-mix(in srgb,var(--c) 18%,transparent);' +
            'animation:srtxIn .28s cubic-bezier(.2,.9,.3,1.2) both}' +
            '.srtx-t.out{animation:srtxOut .22s ease-in both}' +
            '.srtx-t .ti{flex:none;width:44px;height:44px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:18px;' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            'color:var(--c);background:color-mix(in srgb,var(--c) 16%,transparent);border:1px solid color-mix(in srgb,var(--c) 32%,transparent)}' +
            '.srtx-t .tm{flex:1;min-width:0;font-size:clamp(14px,3.9vw,16px);font-weight:500;line-height:1.4;word-break:break-word}' +
            '.srtx-t .tx{flex:none;width:34px;height:34px;border:0;border-radius:10px;background:transparent;color:rgba(255,255,255,.55);font-size:16px;cursor:pointer}' +
            '.srtx-t .tx:hover{color:#fff;background:rgba(255,255,255,.08)}' +
            '.srtx-t .tp{position:absolute;left:0;bottom:0;height:3px;width:100%;background:var(--c);transform-origin:left;animation:srtxBar linear both}' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            'html[data-theme="light"] .srtx-t{color:#18181b;background:rgba(255,255,255,.98);border-color:rgba(0,0,0,.1);box-shadow:0 14px 40px rgba(0,0,0,.18)}' +
            'html[data-theme="light"] .srtx-t .tx{color:rgba(0,0,0,.45)}' +
            '@keyframes srtxIn{from{opacity:0;transform:translateY(-18px) scale(.96)}to{opacity:1;transform:none}}' +
            '@keyframes srtxOut{to{opacity:0;transform:translateY(-14px) scale(.97)}}' +
            '@keyframes srtxBar{from{transform:scaleX(1)}to{transform:scaleX(0)}}';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.head.appendChild(st);
    }

    function close(el) {
        if (!el || el._gone) return;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el._gone = true;
        clearTimeout(el._t);
        el.classList.add('out');
        setTimeout(function () { if (el.parentNode) el.parentNode.removeChild(el); }, 230);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    window.srtxToast = function (message, kind) {
        message = String(message == null ? '' : message).trim();
        if (!message) return;
        var k = KINDS[kind] || KINDS.info;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (kind === 'danger') k = KINDS.error;
        css();
        var box = document.getElementById('srtxToasts');
        if (!box) { box = document.createElement('div'); box.id = 'srtxToasts'; box.setAttribute('aria-live', 'polite'); (document.body || document.documentElement).appendChild(box); }

        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var same = Array.prototype.find.call(box.children, function (e) { return e._msg === message && !e._gone; });
        if (same) close(same);
        while (box.children.length >= 3) close(box.children[0]);

        var el = document.createElement('div');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el.className = 'srtx-t';
        el.style.setProperty('--c', k.color);
        el.setAttribute('role', kind === 'error' ? 'alert' : 'status');
        el._msg = message;
        el.innerHTML = '<div class="ti"><i class="fas ' + k.icon + '"></i></div><div class="tm"></div>' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            '<button type="button" class="tx" aria-label="Close"><i class="fas fa-xmark"></i></button><div class="tp"></div>';
        el.querySelector('.tm').textContent = message;
        el.querySelector('.tp').style.animationDuration = k.ms + 'ms';
        el.querySelector('.tx').addEventListener('click', function () { close(el); });
        box.appendChild(el);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el._t = setTimeout(function () { close(el); }, k.ms);
    };
})();
