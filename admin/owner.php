<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'SRT X CHEATS — BALANCE LOAD';
require_once __DIR__ . '/../includes/head.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.owner-wrap{max-width:620px;margin:0 auto;padding:22px 14px 90px}
.owner-card{padding:20px}
.owner-title{font-family:var(--font-display);font-size:18px;font-weight:900;letter-spacing:.5px;margin-bottom:6px}
.owner-sub{font-size:12px;color:var(--text-secondary);margin-bottom:14px}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.owner-balance-line{font-size:13px;color:var(--text-secondary);margin-bottom:16px}
.owner-balance-line strong{color:var(--neon-amber);font-family:var(--font-mono);font-weight:800}

.warning-banner{display:flex;gap:10px;align-items:flex-start;padding:13px 14px;border-radius:12px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.35);margin-bottom:12px;font-size:12px;color:var(--neon-red);line-height:1.55}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.warning-banner strong{color:#fff}

.contact-limited-banner{display:flex;gap:10px;align-items:flex-start;padding:13px 14px;border-radius:12px;background:rgba(255,176,32,.08);border:1px solid rgba(255,176,32,.3);margin-bottom:18px;font-size:12px;color:#ffb020;line-height:1.55}

.amt-section-label{font-size:12px;font-weight:700;color:var(--text-secondary);margin:4px 0 8px}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.amt-chip-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
.amt-chip{padding:11px 8px;border-radius:10px;border:1px solid var(--glass-border);background:var(--glass-panel);color:var(--text-primary);font-weight:700;font-size:13px;font-family:var(--font-mono);cursor:pointer;transition:border-color .15s ease,background .15s ease,color .15s ease}
.amt-chip:hover{border-color:var(--neon-purple)}
.amt-chip.active{border-color:var(--neon-purple);background:rgba(168,85,247,.14);color:var(--neon-purple)}

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.profile-missing-note{display:flex;gap:8px;align-items:flex-start;font-size:11.5px;color:var(--neon-amber);margin-top:10px;line-height:1.5}
.profile-missing-note a{color:var(--neon-amber);text-decoration:underline}

#depositBtn:disabled{opacity:.55;cursor:not-allowed}

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.clear-cache-btn{flex:none;display:inline-flex;align-items:center;gap:6px;padding:8px 12px;border-radius:10px;font-size:11px;font-weight:800;
  font-family:inherit;letter-spacing:.3px;cursor:pointer;color:#bfdbfe;background:#1e3a8a;border:1px solid #3b82f6}
.clear-cache-btn:active{transform:scale(.97)}
.clear-cache-btn:disabled{opacity:.6}
.pay-or{display:flex;align-items:center;gap:10px;margin:12px 0 2px;font-size:11px;color:var(--text-secondary)}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.pay-or:before,.pay-or:after{content:"";flex:1;height:1px;background:var(--glass-border)}
.qr-full{position:fixed;inset:0;z-index:1100;display:flex;flex-direction:column;background:#05060d;
  padding:max(10px,env(safe-area-inset-top)) 12px max(12px,env(safe-area-inset-bottom))}
.qr-full.hidden{display:none}
.qr-top{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:4px 2px 10px}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.qr-top .amt{font-family:var(--font-mono);font-weight:800;font-size:15px;color:var(--neon-amber)}
.qr-top .hint{font-size:11px;color:var(--text-secondary)}
.qr-close{width:38px;height:38px;border-radius:50%;border:1px solid var(--glass-border);background:var(--glass-panel);color:var(--text-primary);font-size:16px;cursor:pointer}
.qr-img-wrap{flex:1;min-height:0;display:flex;align-items:center;justify-content:center}
.qr-img-wrap img{max-width:100%;max-height:100%;object-fit:contain;border-radius:14px}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.qr-bottom{padding-top:10px}
.pending-note{background:rgba(156,163,175,.2);border:1px solid rgba(156,163,175,.4);border-radius:12px;padding:14px;
  font-size:13px;line-height:1.7;color:var(--text-primary);text-align:left}
</style>

<main class="page-shell">
<div class="owner-wrap">
  <?php require __DIR__ . '/../includes/topup-warning.php'; ?>
  <div class="panel owner-card">
    <div class="owner-title" style="display:flex;align-items:center;justify-content:space-between;gap:10px">
      <span><i class="fas fa-wallet" style="color:var(--neon-purple)"></i> BALANCE LOAD</span>
      <button type="button" id="clearCacheBtn" class="clear-cache-btn" data-no-busy><i class="fas fa-broom"></i> Clear cache</button>
    </div>
    <div class="owner-sub">Pay with QR, or deposit through our Telegram bot — your details are filled in for you.</div>

    <div class="owner-balance-line">Current balance: <strong id="ownerBalance">—</strong> NRP</div>

    <div class="warning-banner">
      <i class="fas fa-triangle-exclamation" style="margin-top:1px"></i>
      <span>Once a deposit is added to your balance it <strong>cannot be refunded</strong>. This is our policy — please confirm the amount before sending.</span>
    </div>


    <div class="amt-section-label">Choose an amount</div>
    <div class="amt-chip-grid" id="amountPresets"></div>

    <div class="field" style="margin-top:14px">
      <label><i class="fas fa-pen"></i> Or enter a custom amount</label>
      <input type="number" id="customAmount" placeholder="e.g. 750" min="50" step="1" inputmode="numeric">
    </div>

    <div class="profile-missing-note hidden" id="profileMissingNote">
      <i class="fas fa-circle-info"></i> Your name/number isn't set yet. <a href="/profile.php">Complete your profile</a> first so the owner can identify your deposit.
    </div>

    <button type="button" class="btn btn-solid" id="qrPayBtn" style="margin-top:16px;width:100%">
      <span class="btn-text"><i class="fas fa-qrcode"></i> Pay with QR (min NRP 100)</span>
    </button>
    <div class="pay-or">or</div>
    <button type="button" class="btn btn-ghost" id="depositBtn" style="margin-top:8px;width:100%">
      <i class="fab fa-telegram" style="color:#29a9eb"></i> Deposit via Telegram
    </button>
    <div class="dim" style="font-size:11.5px;text-align:center;margin-top:8px;line-height:1.5">The bot shows the store QR, asks the amount and your eSewa transaction code.</div>
  </div>
</div>

<div id="qrFull" class="qr-full hidden">
  <div class="qr-top">
    <div><div class="amt" id="qrAmt">NRP 0</div><div class="hint">Pay exactly this amount, then tap “I have paid”.</div></div>
    <button type="button" class="qr-close" id="qrClose" aria-label="Close"><i class="fas fa-xmark"></i></button>
  </div>
  <div class="qr-img-wrap"><img src="/assets/img/srtx-pay-qr.jpg?v=1" alt="Scan and pay"></div>
  <div class="qr-bottom"><button type="button" class="btn btn-solid" id="qrPaidBtn" style="width:100%"><i class="fas fa-check"></i> I have paid</button></div>
</div>

<div id="txModal" class="modal-overlay hidden">
  <div class="panel" style="max-width:400px;width:100%">
    <div class="prompt-header"><i class="fas fa-hashtag"></i> SEND TRANSACTION ID</div>
    <div class="dim" style="font-size:12px;margin-bottom:12px">Amount: <strong id="txAmt" style="color:var(--neon-amber)"></strong>. We check your payment with this ID.</div>
    <div class="field"><label><i class="fas fa-receipt"></i> Transaction ID</label>
      <input type="text" id="txCode" placeholder="Enter transaction ID" autocomplete="off" autocapitalize="characters" spellcheck="false" maxlength="20" inputmode="text" aria-describedby="txErr"></div>
    <div id="txErr" role="alert" style="display:none;margin:0 0 10px;padding:9px 11px;border-radius:10px;font-size:12.5px;line-height:1.45;color:#fecaca;background:rgba(239,68,68,.14);border:1px solid rgba(239,68,68,.55)"><i class="fas fa-triangle-exclamation"></i> <span id="txErrText"></span></div>
    <button class="btn btn-solid" id="txSendBtn" style="margin-bottom:8px;position:relative;width:100%">
      <span class="btn-text"><i class="fas fa-paper-plane"></i> Send</span>
      <span class="btn-spinner"><span class="spinner"></span></span>
    </button>
    <button class="btn btn-ghost" id="txBackBtn" style="width:100%"><i class="fas fa-arrow-left"></i> Back to QR</button>
  </div>
</div>

<div id="topupPendingModal" class="modal-overlay hidden">
  <div class="panel" style="max-width:400px;width:100%;text-align:center">
    <div class="prompt-header" style="justify-content:center"><i class="fas fa-hourglass-half" style="color:var(--neon-amber)"></i> ORDER PENDING</div>
    <div class="pending-note" id="pendingNote">
      Your order is pending (verifying order) ⏳<br>
      Please wait 10 min. After 10 min your order will be automatically completed ✅ if your payment is real! 🤣
    </div>
    <button class="btn btn-solid" id="pendingOk" style="margin-top:14px;width:100%"><i class="fas fa-check"></i> OK</button>
  </div>
</div>
</main>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, getData, toast, backendFetch, cacheClear } from '/assets/js/app.js?v=20261025-4';

const AMOUNT_PRESETS = [100, 300, 500, 1000, 2000, 5000];
// src by SRT X CHEATS. Copy right SRT X CHEATS
const MIN_AMOUNT = 50;
const QR_MIN_AMOUNT = 100;

const amountInput = document.getElementById('customAmount');
const chipGrid = document.getElementById('amountPresets');
// src by SRT X CHEATS. Copy right SRT X CHEATS
const depositBtn = document.getElementById('depositBtn');
const missingNote = document.getElementById('profileMissingNote');

let profileCache = null;

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderPresets() {
    chipGrid.innerHTML = AMOUNT_PRESETS.map(v =>
        `<button type="button" class="amt-chip" data-amt="${v}">NRP ${v}</button>`
    ).join('');
    chipGrid.querySelectorAll('.amt-chip').forEach(btn => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        btn.addEventListener('click', () => {
            amountInput.value = btn.dataset.amt;
            syncActiveChip();
        });
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function syncActiveChip() {
    const val = amountInput.value;
    chipGrid.querySelectorAll('.amt-chip').forEach(b => b.classList.toggle('active', b.dataset.amt === val));
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
amountInput.addEventListener('input', syncActiveChip);

document.getElementById('clearCacheBtn').addEventListener('click', async (e) => {
    const b = e.currentTarget; b.disabled = true;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { cacheClear(); } catch (_) {}
    try { if (window.caches) { const ks = await caches.keys(); await Promise.all(ks.map((k) => caches.delete(k))); } } catch (_) {}
    try { const regs = await (navigator.serviceWorker?.getRegistrations?.() || []); await Promise.all(regs.map((r) => r.unregister())); } catch (_) {}
    toast('Cache cleared ✅ reloading...', 'success');
    setTimeout(() => location.replace(location.pathname + '?c=' + Date.now()), 600);
// src by SRT X CHEATS. Copy right SRT X CHEATS
});
const $ = (id) => document.getElementById(id);
let qrAmount = 0;
const lockScroll = (on) => { document.documentElement.style.overflow = on ? 'hidden' : ''; };
const openOv = (id) => $(id).classList.remove('hidden');
// src by SRT X CHEATS. Copy right SRT X CHEATS
const closeOv = (id) => $(id).classList.add('hidden');
function setBusy(btn, on) { btn.classList.toggle('loading', on); btn.disabled = on; }

$('qrPayBtn').addEventListener('click', () => {
    const amount = parseInt(amountInput.value, 10);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!amount || amount < QR_MIN_AMOUNT) { toast(`Enter an amount of at least NRP ${QR_MIN_AMOUNT}`, 'error'); return; }
    qrAmount = amount;
    $('qrAmt').textContent = `NRP ${amount}`;
    $('txAmt').textContent = `NRP ${amount}`;
    openOv('qrFull'); lockScroll(true);
// src by SRT X CHEATS. Copy right SRT X CHEATS
});
$('qrClose').addEventListener('click', () => { closeOv('qrFull'); lockScroll(false); });
$('qrPaidBtn').addEventListener('click', () => { closeOv('qrFull'); openOv('txModal'); setTimeout(() => $('txCode').focus(), 50); });
$('txBackBtn').addEventListener('click', () => { closeOv('txModal'); openOv('qrFull'); });
// The transaction-code rules are NOT checked or described here on purpose: the server validates and rejects a bad code at once
// (see /api/user/topup-qr). Showing the format in the browser would only teach fakers how to build a code that passes.
function showTxErr(msg) {
    const box = $('txErr');
    if (!msg) { box.style.display = 'none'; return; }
    $('txErrText').textContent = msg; box.style.display = 'block';
}
$('txCode').addEventListener('input', () => showTxErr(''));
// src by SRT X CHEATS. Copy right SRT X CHEATS

$('txSendBtn').addEventListener('click', async () => {
    const txCode = $('txCode').value.trim();
    if (!txCode) { const m = 'Enter your eSewa transaction ID.'; showTxErr(m); toast(m, 'error'); $('txCode').focus(); return; }
    showTxErr('');
    const btn = $('txSendBtn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setBusy(btn, true);
    try {
        await backendFetch('/api/user/topup-qr', { method: 'POST', body: JSON.stringify({ amount: qrAmount, txCode }) });
        closeOv('txModal'); lockScroll(false);
        $('txCode').value = ''; amountInput.value = ''; syncActiveChip();
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        openOv('topupPendingModal');
        setTimeout(() => { try { window.srtFxConfetti && window.srtFxConfetti(); } catch (_) {} }, 250);
        // ~5 s after sending, re-read the account: if the payment was checked and found fake, the strike warning shows now
        // (same as when an admin presses Cancel). A real payment changes nothing here.
        setTimeout(async () => {
            const before = Number(profileCache?.fakePayment?.count || 0);
            try {
                profileCache = await getData('profile', { force: true, strict: true });
                if ($('ownerBalance')) $('ownerBalance').textContent = profileCache?.balance ?? 0;
                if (window.srtxRenderFakePay) window.srtxRenderFakePay(profileCache);
                const f = profileCache?.fakePayment;
                if (f && Number(f.count) > before) toast(f.text || 'Your payment was marked as fake.', 'error');
            } catch (_) {}
        }, 5000);
    } catch (e) {
        showTxErr(e.message || 'Could not send. Try again.');   // e.g. the server's "Payment rejected: ..." for a fake code
        toast(e.message || 'Could not send. Try again.', 'error');
        $('txCode').focus();
    } finally {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        setBusy(btn, false);
    }
});
$('pendingOk').addEventListener('click', () => closeOv('topupPendingModal'));

// src by SRT X CHEATS. Copy right SRT X CHEATS
requireAuth(async (user) => {
    renderPresets();

    try {
        profileCache = await getData('profile');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('ownerBalance').textContent = profileCache?.balance ?? 0;
        if (window.srtxRenderFakePay) window.srtxRenderFakePay(profileCache);
    } catch (e) {
        console.error('[owner] profile load failed', e);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    depositBtn.addEventListener('click', async () => {
        if (!profileCache?.profileName || !profileCache?.profilePhone) {
            toast('Add your name and number in Profile first', 'error');
            missingNote.classList.remove('hidden');
            return;
        }
        missingNote.classList.add('hidden');
        // open the tab right now (inside the tap) so pop-up blockers allow it, then point it at the bot
        const tab = window.open('', '_blank');
        depositBtn.disabled = true;
        try {
            const r = await backendFetch('/api/user/telegram-deposit-link', { method: 'POST' });
            if (tab) tab.location.href = r.url; else window.location.href = r.url;
        } catch (e) {
            if (tab) tab.close();
            toast(e.message || 'Could not open Telegram. Please try again.', 'error');
        } finally { depositBtn.disabled = false; }
    });
});
</script>
