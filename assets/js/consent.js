// src by SRT X CHEATS. Copy right SRT X CHEATS
// Cookie / storage consent.  The choice (accepted | denied) is remembered for 1 year in the first-party cookie srtx_consent,
// with a backup copy in localStorage / sessionStorage, so it survives browsers that drop the cookie (in-app browsers, strict privacy modes).
//   Denied or not decided yet -> only what login needs (Firebase session) is kept. Nothing else is written to localStorage:
//                                theme choice, cached data, "seen" flags are held in memory for the current page only.
//   Accepted                  -> those preferences / caches are saved on this device.
// The site uses no advertising or analytics cookies.
(function () {
  'use strict';
  var COOKIE = 'srtx_consent', MAX_AGE = 31536000;
  var ls = null, ss = null;
  try { ls = window.localStorage; } catch (e) {}
  try { ss = window.sessionStorage; } catch (e) {}

  function cookieValue() {
    var m = (document.cookie || '').match(new RegExp('(?:^|;\\s*)' + COOKIE + '=(accepted|denied)(?:;|$)'));
    return m ? m[1] : null;
  }
  function storeValue(s) {
    try { var v = s && s.getItem(COOKIE); return v === 'accepted' || v === 'denied' ? v : null; } catch (e) { return null; }
  }
  function writeCookie(v) {
    try { document.cookie = COOKIE + '=' + v + '; Max-Age=' + MAX_AGE + '; Path=/; SameSite=Lax' + (location.protocol === 'https:' ? '; Secure' : ''); } catch (e) {}
  }
  // cookie first, then the backups. Whatever we find is written back everywhere (self-healing).
  function readChoice() { return cookieValue() || storeValue(ls) || storeValue(ss); }
  function saveChoice(v) {
    writeCookie(v);
    try { if (ls) ls.setItem(COOKIE, v); } catch (e) {}      // srtx_consent is "essential", so the gate below lets it through
    try { if (ss) ss.setItem(COOKIE, v); } catch (e) {}
  }

  var state = readChoice();                                  // 'accepted' | 'denied' | null (not decided)
  var allowed = function () { return state === 'accepted'; };
  if (state && cookieValue() !== state) saveChoice(state);   // cookie was lost but a backup exists: restore it

  // Firebase keeps the login session itself (strictly necessary); everything else we write goes through the gate below.
  var isEssential = function (k) { return k === COOKIE || /^firebase/i.test(String(k)); };
  if (ls) {
    try {
      var rawSet = Storage.prototype.setItem;
      Storage.prototype.setItem = function (k, v) {
        if (this === ls && !allowed() && !isEssential(k)) return;     // silently skipped, callers already wrap in try/catch
        return rawSet.call(this, k, v);
      };
    } catch (e) {}
  }
  function purge() {
    if (!ls) return;
    try { Object.keys(ls).filter(function (k) { return !isEssential(k); }).forEach(function (k) { ls.removeItem(k); }); } catch (e) {}
  }
  if (state !== 'accepted') purge();                                  // clean up anything stored before the choice

  var box = null, closing = false;
  var later = function (fn, ms) { if (typeof setTimeout === 'function') setTimeout(fn, ms); else fn(); };

  function toast(msg) {
    try {
      var t = document.createElement('div');
      t.id = 'srtxCookieToast'; t.setAttribute('role', 'status'); t.textContent = msg;
      document.body.appendChild(t);
      later(function () { t.classList.add('out'); }, 1800);
      later(function () { t.remove(); }, 2300);
    } catch (e) {}
  }
  function hide(animate) {
    if (!box) return;
    var b = box; box = null;
    if (animate) { b.classList.add('out'); later(function () { b.remove(); }, 260); } else b.remove();
  }

  function set(v) {
    if (closing) return;
    closing = true;
    state = v; saveChoice(v);
    if (v === 'denied') purge();
    try { window.dispatchEvent(new CustomEvent('srtx:consent', { detail: { consent: v } })); } catch (e) {}
    // visible feedback: the pressed button turns into "Saved", then the banner slides away
    try {
      var btn = document.getElementById(v === 'accepted' ? 'srtxCookieAccept' : 'srtxCookieDeny');
      if (btn) btn.innerHTML = '\u2713 Saved';
      if (box) box.setAttribute('aria-busy', 'true');
    } catch (e) {}
    later(function () {
      hide(true); closing = false;
      toast(v === 'accepted' ? '\uD83C\uDF6A Cookies accepted' : '\uD83C\uDF6A Optional cookies rejected');
    }, 350);
  }

  var CSS =
    '#srtxCookie{position:fixed;left:12px;right:12px;bottom:calc(12px + env(safe-area-inset-bottom,0px));z-index:99999;max-width:880px;margin:0 auto;' +
    'display:flex;align-items:center;gap:16px;background:var(--glass-panel,rgba(20,18,44,.98));color:var(--text-primary,#f1f5f9);' +
    'border:1px solid var(--glass-border,rgba(168,85,247,.35));border-radius:16px;padding:14px 16px;box-shadow:0 12px 44px rgba(0,0,0,.5);' +
    'font-family:"Plus Jakarta Sans",system-ui,sans-serif;font-size:13px;line-height:1.55;backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);' +
    'animation:srtxCkIn .35s cubic-bezier(.2,.9,.3,1) both}' +
    '#srtxCookie.has-tabbar{bottom:calc(84px + env(safe-area-inset-bottom,0px))}' +
    '#srtxCookie.out{animation:srtxCkOut .26s ease-in both;pointer-events:none}' +
    '#srtxCookie .ic{font-size:30px;line-height:1;flex:none}' +
    '#srtxCookie .tx{flex:1;min-width:0}#srtxCookie b{display:block;font-size:14px;margin-bottom:2px}' +
    '#srtxCookie p{margin:0;color:var(--text-secondary,#94a3b8)}#srtxCookie a{color:var(--neon-blue,#22d3ee);text-decoration:underline;cursor:pointer}' +
    '#srtxCookie .row{display:flex;gap:8px;flex:none}' +
    '#srtxCookie button{min-height:42px;min-width:104px;padding:0 18px;border-radius:10px;font-weight:700;font-size:13px;font-family:inherit;cursor:pointer;' +
    'border:1px solid var(--glass-border,#a855f7);transition:transform .12s,filter .12s}#srtxCookie button:active{transform:scale(.97)}' +
    '#srtxCookie .acc{background:var(--neon-purple,#a855f7);color:#fff;border-color:transparent}#srtxCookie .acc:hover{filter:brightness(1.1)}' +
    '#srtxCookie .den{background:transparent;color:var(--text-primary,#f1f5f9)}#srtxCookie .den:hover{background:rgba(255,255,255,.07)}' +
    '#srtxCookie button:focus-visible{outline:2px solid var(--neon-blue,#22d3ee);outline-offset:2px}#srtxCookie[aria-busy] button{pointer-events:none}' +
    '@media (max-width:640px){#srtxCookie{flex-wrap:wrap;gap:10px;padding:14px}#srtxCookie .ic{font-size:26px}#srtxCookie .tx{flex:1 1 calc(100% - 44px)}' +
    '#srtxCookie .row{flex:1 1 100%}#srtxCookie button{flex:1}}' +
    '@keyframes srtxCkIn{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}' +
    '@keyframes srtxCkOut{to{opacity:0;transform:translateY(24px)}}' +
    '#srtxCookieToast{position:fixed;left:50%;bottom:calc(24px + env(safe-area-inset-bottom,0px));transform:translateX(-50%);z-index:99999;background:var(--glass-panel,rgba(20,18,44,.98));' +
    'color:var(--text-primary,#f1f5f9);border:1px solid var(--glass-border,rgba(168,85,247,.35));border-radius:999px;padding:9px 18px;font:600 13px "Plus Jakarta Sans",system-ui,sans-serif;' +
    'box-shadow:0 8px 30px rgba(0,0,0,.45);animation:srtxCkIn .3s both}#srtxCookieToast.out{opacity:0;transition:opacity .45s}' +
    '@media (prefers-reduced-motion:reduce){#srtxCookie,#srtxCookieToast{animation:none!important}}';

  function show() {
    if (box || !document.body) return;
    closing = false;
    if (!document.getElementById('srtxCookieCss')) {
      var css = document.createElement('style');
      css.id = 'srtxCookieCss'; css.textContent = CSS;
      document.head ? document.head.appendChild(css) : document.body.appendChild(css);
    }
    box = document.createElement('div');
    box.id = 'srtxCookie'; box.setAttribute('role', 'dialog'); box.setAttribute('aria-live', 'polite'); box.setAttribute('aria-label', 'Cookie consent');
    if (document.querySelector('.bottom-tabbar')) box.className = 'has-tabbar';
    var current = state ? '<br><span style="opacity:.8">Your current choice: <b style="display:inline;font-size:inherit">' + (state === 'accepted' ? 'Accepted' : 'Rejected') + '</b></span>' : '';
    box.innerHTML =
      '<div class="ic" aria-hidden="true">\uD83C\uDF6A</div>' +
      '<div class="tx"><b>We use cookies</b><p>We always keep what is needed to log you in. If you accept, we also save your theme, faster-loading data and ' +
      '"already seen" notices on this device. No advertising or analytics cookies. <a id="srtxCookieMore">Learn more</a>' + current + '</p></div>' +
      '<div class="row"><button type="button" class="den" id="srtxCookieDeny">Reject</button><button type="button" class="acc" id="srtxCookieAccept">Accept</button></div>';
    document.body.appendChild(box);
    document.getElementById('srtxCookieAccept').addEventListener('click', function () { set('accepted'); });
    document.getElementById('srtxCookieDeny').addEventListener('click', function () { set('denied'); });
    document.getElementById('srtxCookieMore').addEventListener('click', function () {
      if (typeof window.__openPolicyModal === 'function') window.__openPolicyModal('readonly');
    });
  }

  window.srtxConsent = { get: function () { return state; }, allowed: allowed, accept: function () { set('accepted'); }, deny: function () { set('denied'); }, open: show };

  if (state === null) {
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', show); else show();
  }
})();
