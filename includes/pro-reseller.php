<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$proCard = !empty($proCard);
?>
<style>
.pro-card{position:relative;margin-bottom:16px;border:1px solid rgba(212,175,55,.45);background:linear-gradient(135deg,rgba(212,175,55,.12),rgba(168,85,247,.14));overflow:hidden}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.pro-card .pro-title{display:flex;align-items:center;gap:8px;font-weight:800;letter-spacing:.5px;font-size:14px}
.pro-card .pro-sub{font-size:12px;color:var(--text-secondary);line-height:1.6;margin:8px 0 12px}
.pro-card .pro-pill{display:inline-block;font-size:10px;font-weight:800;padding:3px 9px;border-radius:20px;letter-spacing:.6px;margin-left:auto}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.pro-pill.active{background:linear-gradient(135deg,#d4af37,#a855f7);color:#fff}
.pro-bar{height:8px;border-radius:8px;background:rgba(255,255,255,.08);overflow:hidden;margin:6px 0 4px}
.pro-bar>i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--neon-amber),var(--neon-purple));transition:width .5s}
.pro-modal-icon{font-size:38px;text-align:center;margin-bottom:6px}
.pro-note{background:rgba(212,175,55,.1);border:1px solid rgba(212,175,55,.35);border-radius:12px;padding:12px;font-size:12.5px;line-height:1.7;margin-top:10px}
</style>

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
// PRO RESELLER unlocks automatically: 10+ keys bought AND ONE new deposit of NRP 3500+ (no form, no approval).
import { cachePeek } from '/assets/js/app.js?v=20261025-3';

const $ = (id) => document.getElementById(id);
const nrp = (n) => 'NRP ' + Number(n || 0).toLocaleString('en-US');
const SEEN_KEY = 'srtx_pro_seen';
const seenMap = () => { try { return JSON.parse(localStorage.getItem(SEEN_KEY) || '{}'); } catch (_) { return {}; } };
const markSeen = (status, stamp) => { try { const m = seenMap(); m[status] = stamp; localStorage.setItem(SEEN_KEY, JSON.stringify(m)); } catch (_) {} };
const recent = (stamp, days) => { const t = Date.parse(stamp); return !t || (Date.now() - t) < days * 864e5; };

function proOf(p) {
    const x = (p && p.proReseller) || {};
    return {
        role: (p && p.role) || 'user', status: x.status || 'none',
        required: Number(x.required) || 3500, minKeys: Number(x.minKeys) || 10,
        keys: Number((p && p.totalKeysBought) ?? x.keys) || 0, stamp: String(x.stamp || ''),
    };
}

function showInfo({ icon, title, body, buttons }) {
    $('proInfoIcon').textContent = icon;
    $('proInfoTitle').textContent = title;
    $('proInfoBody').innerHTML = body;
    const box = $('proInfoBtns'); box.innerHTML = '';
    for (const b of buttons) {
        const el = document.createElement(b.href ? 'a' : 'button');
        el.className = 'btn' + (b.solid ? ' btn-solid' : ''); el.style.cssText = 'flex:1;text-align:center;text-decoration:none';
        el.innerHTML = b.label;
        if (b.href) el.href = b.href; else el.type = 'button';
        el.addEventListener('click', () => $('proInfoModal').classList.add('hidden'));
        box.appendChild(el);
    }
    $('proInfoModal').classList.remove('hidden');
}
const showActive = () => showInfo({
    icon: '💎', title: 'PRO RESELLER UNLOCKED',
    body: 'Your deposit is received 🎉<br>Store prices are now <b>PRO RESELLER</b> prices. Buy low, sell high and earn! 🤑',
    buttons: [{ label: '<i class="fas fa-store"></i> Open Store', solid: true, href: '/store.php' }],
});
const showActiveInfo = () => showInfo({
    icon: '👑', title: 'PRO RESELLER',
    body: 'You are a <b>PRO RESELLER</b> — you buy keys at the lowest price. Sell them and earn 🤑',
    buttons: [{ label: '<i class="fas fa-store"></i> Open Store', solid: true, href: '/store.php' }],
});
const showHowTo = (s) => {
    const need = Math.max(0, s.minKeys - s.keys);
    showInfo({
        icon: '💎', title: 'UNLOCK PRO RESELLER',
        body: `To become <b>PRO RESELLER</b> you need:` +
              `<div class="pro-note">1️⃣ Buy <b>${s.minKeys}+ keys</b> (you have <b>${s.keys}</b>${need ? ` — ${need} more` : ' ✅'})<br>` +
              `2️⃣ Make <b>ONE new deposit of ${nrp(s.required)}</b> or more.<br>` +
              `Small top-ups (100, 200 ...) are <b>not</b> added together and your old balance does not count.</div>`,
        buttons: [{ label: 'Later' }, { label: `<i class="fas fa-coins"></i> Deposit ${nrp(s.required)}`, solid: true, href: '/admin/owner.php' }],
    });
};

function renderCard(s) {
    const btn = $('proCrownBtn'); if (!btn) return;
    btn.classList.remove('hidden', 'active', 'idle');
    btn.onclick = null;
    if (s.status === 'active' || s.role === 'pro_reseller') {
        btn.classList.add('active'); btn.title = 'PRO RESELLER — Active';
        btn.onclick = showActiveInfo;
    } else if (s.role === 'reseller') {
        btn.classList.add('idle'); btn.title = 'How to unlock PRO RESELLER';
        btn.onclick = () => showHowTo(s);
    } else {
        btn.classList.add('hidden');   // plain users: nothing in the top bar
    }
}

function onProfile(p) {
    if (!p) return;
    const s = proOf(p);
    renderCard(s);
    const seen = seenMap();
    if ((s.status === 'active' || s.role === 'pro_reseller') && seen.active !== s.stamp && recent(s.stamp, 2)) { markSeen('active', s.stamp); showActive(); }
}
window.addEventListener('srtx:balance', (e) => onProfile(e.detail));
window.addEventListener('srtx:data', (e) => { const { key, value } = e.detail || {}; if (key === 'profile') onProfile(value); });
onProfile((cachePeek('profile') || {}).value);
</script>
