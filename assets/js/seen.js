// "Seen once" flags for popups (top-up completed, PRO RESELLER unlocked).
// WHY: consent.js silently drops localStorage writes until cookies are accepted and purges them on every page load,
// so the old flags were never remembered and the popups re-appeared on every page / route (the loop).
// sessionStorage is not gated, so it is always used; localStorage is added only when the user accepted storage.
(function () {
  if (window.srtxSeen) return;
  var K = 'srtx_seen_v2', MAX = 60, mem = {};
  function hash(s) { s = String(s); var x = 5381, i; for (i = 0; i < s.length; i++) x = ((x << 5) + x + s.charCodeAt(i)) | 0; return (x >>> 0).toString(36); }
  function consent() { try { return !!(window.srtxConsent && window.srtxConsent.allowed()); } catch (e) { return false; } }
  function stores() {
    var a = []; try { a.push(window.sessionStorage); } catch (e) {}
    if (consent()) { try { a.push(window.localStorage); } catch (e) {} }
    return a;
  }
  function read(st) { try { var v = JSON.parse(st.getItem(K) || '{}'); return v && typeof v === 'object' ? v : {}; } catch (e) { return {}; } }
  function write(st, o) {
    try {
      var ks = Object.keys(o);
      if (ks.length > MAX) { ks.sort(function (a, b) { return o[a] - o[b]; }).slice(0, ks.length - MAX).forEach(function (k) { delete o[k]; }); }
      st.setItem(K, JSON.stringify(o));
    } catch (e) {}
  }
  // "Do not show again": an explicit user choice, kept for 1 year in a cookie + localStorage + sessionStorage
  // (the cookie is not affected by the storage gate in consent.js, so it works on every page / route).
  var NC = 'srtx_never';
  function cookieList() { var m = (document.cookie || '').match(/(?:^|;\s*)srtx_never=([^;]*)/); return m && m[1] ? m[1].split('.') : []; }
  function nevers() {
    var l = cookieList();
    stores().forEach(function (st) { var o = read(st); Object.keys(o).forEach(function (k) { if (k.charAt(0) === 'n') l.push(k.slice(1)); }); });
    return l;
  }
  window.srtxNever = {
    is: function (key) { return nevers().indexOf(hash(key)) >= 0; },
    set: function (key) {
      var id = hash(key), l = cookieList();
      if (l.indexOf(id) < 0) l.push(id);
      try { document.cookie = NC + '=' + l.slice(-30).join('.') + '; Max-Age=31536000; Path=/; SameSite=Lax' + (location.protocol === 'https:' ? '; Secure' : ''); } catch (e) {}
      stores().forEach(function (st) { var o = read(st); o['n' + id] = Date.now(); write(st, o); });
    }
  };
  window.srtxSeen = {
    has: function (key) {
      var id = hash(key); if (mem[id]) return true;
      return stores().some(function (st) { return !!read(st)[id]; });
    },
    add: function (key) {
      var id = hash(key); mem[id] = Date.now();
      stores().forEach(function (st) { var o = read(st); o[id] = Date.now(); write(st, o); });
    },
    remove: function (key) {
      var id = hash(key); delete mem[id];
      stores().forEach(function (st) { var o = read(st); delete o[id]; write(st, o); });
    }
  };
})();
