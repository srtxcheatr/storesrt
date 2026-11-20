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
