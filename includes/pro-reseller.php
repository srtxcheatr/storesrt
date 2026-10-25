<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$proCard = !empty($proCard);
?>
<style>
.pro-card{position:relative;margin-bottom:16px;border:1px solid rgba(212,175,55,.45);background:linear-gradient(135deg,rgba(212,175,55,.12),rgba(168,85,247,.14));overflow:hidden}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.pro-card .pro-title{display:flex;align-items:center;gap:8px;font-weight:800;letter-spacing:.5px;font-size:14px}
.pro-card .pro-sub{font-size:12px;color:var(--text-secondary);line-height:1.6;margin:8px 0 12px}
.pro-card .pro-pill{display:inline-block;font-size:10px;font-weight:800;padding:3px 9px;border-radius:20px;letter-spacing:.6px;margin-left:auto}
.pro-pill.pending{background:rgba(212,175,55,.18);color:var(--neon-amber)}
.pro-pill.approved{background:rgba(34,197,94,.18);color:var(--neon-green)}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.pro-pill.active{background:linear-gradient(135deg,#d4af37,#a855f7);color:#fff}
.pro-bar{height:8px;border-radius:8px;background:rgba(255,255,255,.08);overflow:hidden;margin:6px 0 4px}
.pro-bar>i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--neon-amber),var(--neon-purple));transition:width .5s}
.pro-modal-icon{font-size:38px;text-align:center;margin-bottom:6px}
.pro-note{background:rgba(212,175,55,.1);border:1px solid rgba(212,175,55,.35);border-radius:12px;padding:12px;font-size:12.5px;line-height:1.7;margin-top:10px}
</style>

<div id="proFormModal" class="modal-overlay hidden" style="z-index:1200">
  <div class="panel" style="max-width:420px;width:100%">
    <div class="prompt-header"><i class="fas fa-gem" style="color:var(--neon-amber)"></i> PRO RESELLER APPROVAL</div>
    <div class="dim" style="font-size:12px;margin-bottom:12px">Fill your details. Admin will verify them before unlocking PRO RESELLER.</div>
    <div class="field"><label><i class="fas fa-user"></i> Name</label><input type="text" id="proName" maxlength="60" placeholder="Your full name" autocomplete="name"></div>
    <div class="field"><label><i class="fab fa-whatsapp"></i> WhatsApp Business Number</label><input type="tel" id="proWa" maxlength="20" placeholder="+97798xxxxxxxx" inputmode="tel"></div>
    <div class="field"><label><i class="fas fa-phone"></i> Phone Number</label><input type="tel" id="proPhone" maxlength="20" placeholder="98xxxxxxxx" inputmode="tel" autocomplete="tel"></div>
    <div class="field"><label><i class="fab fa-tiktok"></i> TikTok ID</label><input type="text" id="proTiktok" maxlength="41" placeholder="@yourtiktok" autocapitalize="none"></div>
    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="button" class="btn" id="proFormCancel" style="flex:1">Cancel</button>
      <button type="button" class="btn btn-solid" id="proSubmit" style="flex:2"><i class="fas fa-paper-plane"></i> Submit</button>
    </div>
  </div>
</div>

<div id="proInfoModal" class="modal-overlay hidden" style="z-index:1250">
  <div class="panel" style="max-width:400px;width:100%;text-align:center">
    <div class="pro-modal-icon" id="proInfoIcon">💎</div>
    <div class="prompt-header" style="justify-content:center" id="proInfoTitle"></div>
    <div id="proInfoBody" style="font-size:13px;line-height:1.7"></div>
    <div id="proInfoBtns" style="display:flex;gap:10px;margin-top:14px"></div>
  </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { backendFetch, toast, cachePeek, cachePatch, refreshData } from '/assets/js/app.js?v=20261025-3';

const $ = (id) => document.getElementById(id);
const nrp = (n) => 'NRP ' + Number(n || 0).toLocaleString('en-US');
// src by SRT X CHEATS. Copy right SRT X CHEATS
const SEEN_KEY = 'srtx_pro_seen';
const seenMap = () => { try { return JSON.parse(localStorage.getItem(SEEN_KEY) || '{}'); } catch (_) { return {}; } };
const markSeen = (status, stamp) => { try { const m = seenMap(); m[status] = stamp; localStorage.setItem(SEEN_KEY, JSON.stringify(m)); } catch (_) {} };
const recent = (stamp, days) => { const t = Date.parse(stamp); return !t || (Date.now() - t) < days * 864e5; };

// src by SRT X CHEATS. Copy right SRT X CHEATS
function proOf(p) {
    const x = (p && p.proReseller) || {};
    return { role: (p && p.role) || 'user', status: x.status || 'none', required: Number(x.required) || 1500, deposited: Number(x.deposited) || 0, stamp: String(x.stamp || '') };
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function showInfo({ icon, title, body, buttons }) {
    $('proInfoIcon').textContent = icon;
    $('proInfoTitle').textContent = title;
    $('proInfoBody').innerHTML = body;
    const box = $('proInfoBtns'); box.innerHTML = '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    for (const b of buttons) {
        const el = document.createElement(b.href ? 'a' : 'button');
        el.className = 'btn' + (b.solid ? ' btn-solid' : ''); el.style.cssText = 'flex:1;text-align:center;text-decoration:none';
        el.innerHTML = b.label;
        if (b.href) el.href = b.href; else el.type = 'button';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el.addEventListener('click', () => $('proInfoModal').classList.add('hidden'));
        box.appendChild(el);
    }
    $('proInfoModal').classList.remove('hidden');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
const showVerifying = () => showInfo({
    icon: '⏳', title: 'VERIFYING',
    body: 'Your details is verifying by admin.<br><span class="dim" style="font-size:12px">You will see a popup here as soon as admin approves.</span>',
    buttons: [{ label: '<i class="fas fa-check"></i> OK', solid: true }],
});
// src by SRT X CHEATS. Copy right SRT X CHEATS
const showApproved = (s) => showInfo({
    icon: '✅', title: 'PRO RESELLER VERIFIED',
    body: `Your account is verified for <b>PRO RESELLER</b>.<br>Now you're official <b>PRO RESELLER</b>! 🎉` +
          `<div class="pro-note">But you need to top up <b>${nrp(s.required)}</b> to buy and sell keys.<br>` +
          `Your old balance does not count — make a <b>new top-up</b>. After it, store prices change to PRO RESELLER prices.</div>`,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    buttons: [{ label: 'Later' }, { label: `<i class="fas fa-coins"></i> Top up ${nrp(s.required)}`, solid: true, href: '/admin/owner.php' }],
});
const showActive = () => showInfo({
    icon: '💎', title: 'PRO RESELLER ACTIVE',
    body: 'Your top-up is received 🎉<br>Store prices are now <b>PRO RESELLER</b> prices. Buy low, sell high and earn! 🤑',
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    buttons: [{ label: '<i class="fas fa-store"></i> Open Store', solid: true, href: '/store.php' }],
});
const showActiveInfo = () => showInfo({
    icon: '👑', title: 'PRO RESELLER',
    body: 'You are a <b>PRO RESELLER</b> — you buy keys at the lowest price. Sell them and earn 🤑',
    buttons: [{ label: '<i class="fas fa-store"></i> Open Store', solid: true, href: '/store.php' }],
});
const showRejected = () => showInfo({
    icon: '❌', title: 'NOT APPROVED',
    body: 'Admin could not approve your PRO RESELLER details.<br>You can send a new request with correct details.',
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    buttons: [{ label: '<i class="fas fa-check"></i> OK', solid: true }],
});

function renderCard(s) {
    const btn = $('proCrownBtn'); if (!btn) return;
    btn.classList.remove('hidden', 'active', 'pending', 'approved', 'idle');
    btn.onclick = null;
    if (s.status === 'active' || s.role === 'pro_reseller') {
        btn.classList.add('active'); btn.title = 'PRO RESELLER — Active';
        btn.onclick = showActiveInfo;
    } else if (s.status === 'pending') {
        btn.classList.add('pending'); btn.title = 'PRO RESELLER — Verifying';
        btn.onclick = showVerifying;
    } else if (s.status === 'approved') {
        btn.classList.add('approved'); btn.title = 'PRO RESELLER — Top up to unlock';
        btn.onclick = () => showApproved(s);
    } else if (s.role === 'reseller') {
        btn.classList.add('idle'); btn.title = 'Apply for PRO RESELLER';
        btn.onclick = openForm;
    } else {
        btn.classList.add('hidden');   // plain users: nothing in the top bar
    }
}

function openForm() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (proOf((cachePeek('profile') || {}).value).role !== 'reseller') return toast('Unlock RESELLER mode first', 'error');
    const p = (cachePeek('profile') || {}).value || {};
    if (!$('proName').value) $('proName').value = p.profileName || '';
    if (!$('proPhone').value) $('proPhone').value = p.profilePhone || '';
    if (!$('proTiktok').value) $('proTiktok').value = p.tiktokUser || '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('proFormModal').classList.remove('hidden');
}
$('proFormCancel').addEventListener('click', () => $('proFormModal').classList.add('hidden'));
$('proSubmit').addEventListener('click', async () => {
    const body = { name: $('proName').value.trim(), whatsapp: $('proWa').value.trim(), phone: $('proPhone').value.trim(), tiktok: $('proTiktok').value.trim() };
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!body.name || !body.whatsapp || !body.phone || !body.tiktok) return toast('Please fill all 4 fields', 'error');
    const btn = $('proSubmit'); btn.disabled = true;
    try {
        await backendFetch('/api/user/pro-reseller/apply', { method: 'POST', body: JSON.stringify(body) });
        $('proFormModal').classList.add('hidden');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const cur = proOf((cachePeek('profile') || {}).value);
        cachePatch('profile', { proReseller: { status: 'pending', required: cur.required, deposited: 0, stamp: new Date().toISOString() } });
        showVerifying();
        refreshData('profile').catch(() => {});
    } catch (e) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        toast(e.message || 'Could not send. Try again.', 'error');
    } finally { btn.disabled = false; }
});

function onProfile(p) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!p) return;
    const s = proOf(p);
    renderCard(s);
    const seen = seenMap();
    if (s.status === 'approved' && seen.approved !== s.stamp) { markSeen('approved', s.stamp); showApproved(s); }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else if (s.status === 'active' && seen.active !== s.stamp && recent(s.stamp, 2)) { markSeen('active', s.stamp); showActive(); }
    else if (s.status === 'rejected' && seen.rejected !== s.stamp && recent(s.stamp, 7)) { markSeen('rejected', s.stamp); showRejected(); }
}
window.addEventListener('srtx:balance', (e) => onProfile(e.detail));
window.addEventListener('srtx:data', (e) => { const { key, value } = e.detail || {}; if (key === 'profile') onProfile(value); });
// src by SRT X CHEATS. Copy right SRT X CHEATS
onProfile((cachePeek('profile') || {}).value);
</script>
