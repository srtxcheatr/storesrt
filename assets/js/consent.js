// src by SRT X CHEATS. Copy right SRT X CHEATS
// Cookie / storage consent.  Choice is remembered in ONE first-party cookie: srtx_consent = accepted | denied (1 year).
//   Denied or not decided yet -> only what login needs (Firebase session) is kept. Nothing else is written to localStorage:
//                                theme choice, cached data, "seen" flags are held in memory for the current page only.
//   Accepted                  -> those preferences / caches are saved on this device.
// The site uses no advertising or analytics cookies.
(function () {
  'use strict';
  var COOKIE = 'srtx_consent', MAX_AGE = 31536000;
  var ls = null; try { ls = window.localStorage; } catch (e) {}

  function readCookie() {
    var m = (document.cookie || '').match(new RegExp('(?:^|;\\s*)' + COOKIE + '=(accepted|denied)(?:;|$)'));
    return m ? m[1] : null;
  }
  function writeCookie(v) {
    document.cookie = COOKIE + '=' + v + '; Max-Age=' + MAX_AGE + '; Path=/; SameSite=Lax' + (location.protocol === 'https:' ? '; Secure' : '');
  }
  var state = readCookie();                                  // 'accepted' | 'denied' | null (not decided)
  var allowed = function () { return state === 'accepted'; };

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

  function set(v) {
    state = v; writeCookie(v);
    if (v === 'denied') purge();
    try { window.dispatchEvent(new CustomEvent('srtx:consent', { detail: { consent: v } })); } catch (e) {}
    hide();
  }

  var box = null;
  function hide() { if (box) { box.remove(); box = null; } }
  function show() {
    if (box || !document.body) return;
    var css = document.createElement('style');
    css.textContent =
      '#srtxCookie{position:fixed;left:12px;right:12px;bottom:calc(12px + env(safe-area-inset-bottom,0px));z-index:99999;max-width:560px;margin:0 auto;' +
      'background:var(--glass-panel,rgba(26,23,53,.97));color:var(--text-primary,#f1f5f9);border:1px solid var(--glass-border,rgba(168,85,247,.35));' +
      'border-radius:14px;padding:14px 16px;box-shadow:0 10px 40px rgba(0,0,0,.45);font:13px/1.55 "Plus Jakarta Sans",system-ui,sans-serif;backdrop-filter:blur(10px)}' +
      '#srtxCookie.has-tabbar{bottom:calc(84px + env(safe-area-inset-bottom,0px))}' +
      '#srtxCookie b{display:block;font-size:14px;margin-bottom:4px}#srtxCookie p{margin:0 0 12px;color:var(--text-secondary,#94a3b8)}' +
      '#srtxCookie .row{display:flex;gap:8px}#srtxCookie button{flex:1;min-height:42px;border-radius:10px;font:700 13px inherit;font-family:inherit;cursor:pointer;border:1px solid var(--glass-border,#a855f7)}' +
      '#srtxCookie .acc{background:var(--neon-purple,#a855f7);color:#fff;border-color:transparent}#srtxCookie .den{background:transparent;color:var(--text-primary,#f1f5f9)}' +
      '#srtxCookie button:focus-visible{outline:2px solid var(--neon-blue,#22d3ee);outline-offset:2px}';
    box = document.createElement('div');
    box.id = 'srtxCookie'; box.setAttribute('role', 'dialog'); box.setAttribute('aria-label', 'Cookie consent');
    if (document.querySelector('.bottom-tabbar')) box.className = 'has-tabbar';
    box.innerHTML = '<b>\uD83C\uDF6A Cookies &amp; storage</b><p>We always keep what is needed to log you in. If you accept, we also save your theme, ' +
      'faster-loading data and "already seen" notices on this device. We use no advertising or analytics cookies. You can change this any time from "Cookie settings".</p>' +
      '<div class="row"><button type="button" class="den" id="srtxCookieDeny">Deny</button><button type="button" class="acc" id="srtxCookieAccept">Accept</button></div>';
    box.appendChild(css);
    document.body.appendChild(box);
    document.getElementById('srtxCookieAccept').addEventListener('click', function () { set('accepted'); });
    document.getElementById('srtxCookieDeny').addEventListener('click', function () { set('denied'); });
  }

  window.srtxConsent = { get: function () { return state; }, allowed: allowed, accept: function () { set('accepted'); }, deny: function () { set('denied'); }, open: show };

  if (state === null) {
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', show); else show();
  }
})();
