<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
 ?>
<style>
.fakepay-warn{display:flex;gap:12px;align-items:flex-start;padding:13px 14px;margin:0 0 14px;border-radius:14px;
  background:rgba(245,158,11,.10);border:1px solid rgba(245,158,11,.45);color:#fbbf24;font-size:12.5px;line-height:1.55}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.fakepay-warn.sev2{background:rgba(239,68,68,.10);border-color:rgba(239,68,68,.5);color:#fca5a5}
.fakepay-warn .fp-ic{font-size:20px;line-height:1.2}
.fakepay-warn b{color:#fff}
.fakepay-warn .fp-dots{display:flex;gap:5px;margin-top:8px}
.fakepay-warn .fp-dots i{width:26px;height:6px;border-radius:4px;background:rgba(255,255,255,.18)}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.fakepay-warn .fp-dots i.on{background:currentColor}
.fakepay-warn.hidden{display:none}
</style>
<?php if (empty($fpHideBanner)): ?>
<div id="fakePayWarn" class="fakepay-warn hidden" role="alert">
  <div class="fp-ic">⚠️</div>
  <div>
    <div><b id="fpTitle">Payment verification warning</b></div>
    <div id="fpText"></div>
    <div class="fp-dots" id="fpDots"><i></i><i></i><i></i></div>
  </div>
</div>
<?php endif; ?>

<div id="topupDoneModal" class="modal-overlay hidden" style="z-index:1200">
  <div class="panel" style="max-width:400px;width:100%;text-align:center">
    <div class="prompt-header" style="justify-content:center"><i class="fas fa-circle-check" style="color:var(--neon-green)"></i> ORDER COMPLETED</div>
    <div style="background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.4);border-radius:12px;padding:14px;font-size:13px;line-height:1.7">
      Your order has been completed ✅<br><b id="topupDoneAmt"></b> added to your balance. Thank you! 🎉
    </div>
    <button class="btn btn-solid" id="topupDoneOk" style="margin-top:14px;width:100%"><i class="fas fa-check"></i> OK</button>
  </div>
</div>
<script>
// src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
  var box = document.getElementById('fakePayWarn');
  var topBtn = document.getElementById('fakePayBtn');
  // The strike warning (banner + the triangle button in the nav) is shown for exactly 1 hour, counted from the moment
  // this browser FIRST displays it, then it disappears for good. The strike itself stays on the account (3-strike ladder).
  var SHOW_MS = 3600000;
  function firstShown(f) {
    var key = 'srtx_fp_seen:' + (f.lastAt || ('c' + f.count)) + ':' + (f.lastTx || '');   // a NEW strike gets a new key -> a new hour
    try {
      var v = Number(localStorage.getItem(key));
      if (v > 0) return v;
      v = Date.now(); localStorage.setItem(key, String(v)); return v;
    } catch (_) {
      // storage blocked: fall back to counting from when the strike was given
      var t = f.lastAt ? new Date(f.lastAt).getTime() : NaN;
      return isNaN(t) ? Date.now() : t;
    }
  }
  function render(d) {
    var f = d && d.fakePayment;
    var n = 0, left = 0;
    if (f && Number(f.count) > 0) {
      left = SHOW_MS - (Date.now() - firstShown(f));
      if (left > 0) n = Math.min(Number(f.count), 3);
    }
    clearTimeout(window.__fpTimer);
    if (n) window.__fpTimer = setTimeout(function () { render(d); }, Math.max(1000, left + 300));   // hides itself when the hour is up
    var text = n ? (f.text || 'A payment you submitted was marked as fake.') : '';
    var title = 'Payment verification — fake payment warning ' + n + '/3';
    if (topBtn) {
      topBtn.classList.toggle('hidden', !n);
      topBtn.classList.toggle('sev2', n >= 2);
      topBtn.title = title;
      topBtn.dataset.msg = title + '. ' + text;
      var b = topBtn.querySelector('b'); if (b) b.textContent = n || '';
    }
    if (!box) return;
    if (!n) { box.classList.add('hidden'); return; }
    document.getElementById('fpTitle').textContent = title;
    document.getElementById('fpText').textContent = text;
    document.querySelectorAll('#fpDots i').forEach(function (el, i) { el.classList.toggle('on', i < n); });
    box.classList.toggle('sev2', n >= 2);
    box.classList.remove('hidden');
  }
  if (topBtn) topBtn.addEventListener('click', function () {
    if (typeof window.toast === 'function') window.toast(topBtn.dataset.msg || '', 'error'); else alert(topBtn.dataset.msg || '');
  });
  window.addEventListener('srtx:balance', function (e) { render(e.detail); });
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  window.srtxRenderFakePay = render;

  function showDone(d) {
    var q = d && d.qrApproved;
    if (!q || !q.reqId) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (Date.now() - new Date(q.at).getTime() > 24 * 3600 * 1000) return;
    var seen = [];
    try { seen = JSON.parse(localStorage.getItem('srtx_qr_done') || '[]'); } catch (_) {}
    if (seen.indexOf(q.reqId) >= 0) return;
    seen.push(q.reqId);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { localStorage.setItem('srtx_qr_done', JSON.stringify(seen.slice(-30))); } catch (_) {}
    document.getElementById('topupDoneAmt').textContent = 'NRP ' + q.amount;
    document.getElementById('topupDoneModal').classList.remove('hidden');
    setTimeout(function () { try { window.srtFxConfetti && window.srtFxConfetti(); } catch (_) {} }, 250);
  }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.getElementById('topupDoneOk').addEventListener('click', function () {
    document.getElementById('topupDoneModal').classList.add('hidden');
  });
  window.addEventListener('srtx:balance', function (e) { showDone(e.detail); });
  var _r = window.srtxRenderFakePay;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  window.srtxRenderFakePay = function (d) { _r(d); showDone(d); };
})();
</script>
