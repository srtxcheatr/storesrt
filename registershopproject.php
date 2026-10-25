<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Register Shop Project — SRT X CHEATS';
$currentPage = 'store';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>

<style>
.rs-sub { display: flex; gap: 8px; }
.rs-sub input { flex: 1.2; min-width: 0; }
.rs-sub select { flex: 1; min-width: 0; }
.rs-sep { border: 0; border-top: 1px dashed var(--glass-border); margin: 16px 0; }
.rs-logo-box { display: flex; align-items: center; gap: 12px; }
.rs-logo-box img { width: 64px; height: 64px; object-fit: cover; border-radius: 12px; border: 1px solid var(--glass-border); background: rgba(255,255,255,.04); }
.rs-logo-url { font-family: var(--font-mono); font-size: 10.5px; color: var(--text-muted); word-break: break-all; margin-top: 4px; }
.rs-dl { text-align: center; }
.rs-note { font-size: 11.5px; color: var(--text-muted); margin-top: 8px; line-height: 1.5; }
.rs-track { position: relative; margin: 6px 0 0 6px; padding-left: 34px; }
.rs-step { position: relative; padding-bottom: 22px; }
.rs-step:last-child { padding-bottom: 0; }
.rs-step::before { content: ""; position: absolute; left: -23px; top: 22px; bottom: -2px; width: 2px; background: var(--glass-border); }
.rs-step:last-child::before { display: none; }
.rs-step.done::before { background: var(--neon-green, #22c55e); }
.rs-dot { position: absolute; left: -34px; top: 0; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; background: rgba(255,255,255,.06); border: 2px solid var(--glass-border); color: var(--text-muted); }
.rs-step.done .rs-dot { background: var(--neon-green, #22c55e); border-color: var(--neon-green, #22c55e); color: #04140a; }
.rs-step.current .rs-dot { border-color: var(--neon-blue); color: var(--neon-blue); animation: rsPulse 1.4s ease-in-out infinite; }
@keyframes rsPulse { 0%,100% { box-shadow: 0 0 0 0 rgba(0,200,255,.45); } 50% { box-shadow: 0 0 0 7px rgba(0,200,255,0); } }
.rs-step-title { font-weight: 700; font-size: 14px; }
.rs-step:not(.done):not(.current) .rs-step-title { color: var(--text-muted); font-weight: 600; }
.rs-step-time { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
.rs-deliver { display: grid; gap: 10px; }
.rs-drow { background: rgba(255,255,255,.04); border: 1px solid var(--glass-border); border-radius: 12px; padding: 10px 12px; }
.rs-drow b { display: block; font-size: 10.5px; letter-spacing: .6px; color: var(--text-muted); margin-bottom: 3px; }
.rs-drow span { font-family: var(--font-mono); font-size: 12.5px; word-break: break-all; }
.rs-drow .rs-copy { float: right; background: none; border: 0; color: var(--neon-blue); cursor: pointer; font-size: 13px; }
</style>

<div class="term-window">
    <div class="term-content">

        <div class="prompt-header"><i class="fas fa-store"></i> REGISTER YOUR SHOP PROJECT</div>

        <div id="rsLoading" class="dim" style="text-align:center;padding:30px">
            <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue)"></i>
            <div style="margin-top:8px">Loading your order...</div>
        </div>
        <div id="rsError" class="panel hidden" style="color:var(--neon-red);text-align:center"></div>

        <div id="rsTrackView" class="hidden">
            <div class="panel">
                <div style="font-weight:800" id="rsTProduct"></div>
                <div class="dim" style="font-size:12px;margin:3px 0 16px" id="rsTMeta"></div>
                <div class="rs-track" id="rsTimeline"></div>
                <button class="btn btn-ghost" id="rsRefreshBtn" style="width:100%;margin-top:18px"><i class="fas fa-rotate"></i> Refresh status</button>
            </div>
            <div class="panel hidden" id="rsDeliverBox" style="margin-top:14px">
                <div class="prompt-header"><i class="fas fa-circle-check"></i> YOUR PROJECT IS READY</div>
                <div class="rs-deliver" id="rsDeliver"></div>
            </div>
        </div>

        <div id="rsMain" class="hidden">
            <div class="panel rs-dl">
                <div style="font-weight:800" id="rsProduct"></div>
                <div class="dim" style="font-size:12px;margin:4px 0 12px">Paid ✅ — <span id="rsPrice"></span> deducted from your balance</div>
                <button class="btn btn-solid" id="rsDownloadBtn" style="width:100%"><i class="fas fa-download"></i> Download Source Code</button>
                <div class="rs-note" id="rsDlNote"></div>
            </div>

            <div class="panel" style="margin-top:14px">
                <div class="field"><label><i class="fas fa-user"></i> YOUR NAME</label><input type="text" id="rsName" maxlength="60" autocomplete="name"></div>
                <div class="field"><label><i class="fab fa-whatsapp"></i> YOUR NUMBER</label><input type="tel" id="rsNumber" maxlength="20" placeholder="98xxxxxxxx" autocomplete="tel"></div>
                <div class="field"><label><i class="fas fa-envelope"></i> YOUR EMAIL</label><input type="email" id="rsEmail" maxlength="100" autocomplete="email"></div>

                <hr class="rs-sep">

                <div class="field"><label><i class="fas fa-shop"></i> ADMIN PANEL SHOP NAME</label><input type="text" id="rsShopName" maxlength="40"></div>

                <div class="field"><label><i class="fas fa-globe"></i> SUBDOMAIN FOR SHOP</label>
                    <div class="rs-sub"><input type="text" id="rsShopSub" maxlength="30" placeholder="xxxxxx" autocapitalize="none"><select id="rsShopDom"></select></div>
                </div>

                <hr class="rs-sep">

                <div class="field"><label><i class="fas fa-user-shield"></i> SUBDOMAIN FOR ADMINPANEL CONTROL</label>
                    <div class="rs-sub"><input type="text" id="rsAdminSub" maxlength="30" placeholder="xxxxxx" autocapitalize="none"><select id="rsAdminDom"></select></div>
                </div>

                <hr class="rs-sep">

                <div class="field"><label><i class="fas fa-image"></i> LOGO</label>
                    <div class="rs-logo-box">
                        <img id="rsLogoPreview" alt="" class="hidden">
                        <div style="flex:1">
                            <button type="button" class="btn btn-ghost" id="rsLogoBtn" style="width:100%"><i class="fas fa-images"></i> Pick from gallery</button>
                            <div class="rs-logo-url" id="rsLogoUrl"></div>
                        </div>
                    </div>
                    <input type="file" id="rsLogoFile" accept="image/png,image/jpeg,image/webp" class="hidden">
                </div>

                <hr class="rs-sep">

                <div class="field"><label><i class="fas fa-plug"></i> YOUR RESELLER API</label><input type="text" id="rsApi" maxlength="300" autocomplete="off" autocapitalize="none"></div>
                <div class="field"><label><i class="fas fa-key"></i> YOUR RESELLER MASTER KEY</label><input type="text" id="rsMaster" maxlength="300" autocomplete="off" autocapitalize="none"></div>

                <button class="btn btn-solid" id="rsSubmitBtn" style="width:100%"><i class="fas fa-paper-plane"></i> SUBMIT</button>
                <div class="rs-note">After submit, the download and form are replaced by your live order tracker.</div>
            </div>
        </div>

    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, toast, esc } from '/assets/js/app.js?v=20261025-4';

const $ = (id) => document.getElementById(id);
const orderId = new URLSearchParams(location.search).get('order') || '';
let order = null;

function showError(msg) {
    $('rsLoading').classList.add('hidden');
    $('rsMain').classList.add('hidden');
    $('rsError').classList.remove('hidden');
    $('rsError').innerHTML = `<i class="fas fa-triangle-exclamation"></i> ${esc(msg)}<br><a href="/store.php" class="btn btn-ghost" style="display:inline-block;margin-top:12px">Back to store</a>`;
}

function fillDomains(sel, list, value) {
    sel.innerHTML = list.map(d => `<option value="${esc(d)}">.${esc(d)}</option>`).join('');
    if (value) sel.value = value;
}

function paint() {
    $('rsProduct').textContent = order.productName;
    $('rsPrice').textContent = `Rs ${order.price}`;
    $('rsDlNote').textContent = `Downloads left: ${order.downloadsLeft} of ${order.maxDownloads}. The link works only for you.`;
    $('rsDownloadBtn').disabled = order.downloadsLeft <= 0;
    const d = order.details || {};
    $('rsName').value = d.name || '';
    $('rsNumber').value = d.number || '';
    $('rsEmail').value = d.email || '';
    $('rsShopName').value = d.shopName || '';
    $('rsApi').value = d.resellerApi || '';
    $('rsMaster').value = d.resellerMasterKey || '';
    fillDomains($('rsShopDom'), order.domains, d.shopSub?.domain);
    fillDomains($('rsAdminDom'), order.domains, d.adminSub?.domain);
    $('rsShopSub').value = d.shopSub?.name || '';
    $('rsAdminSub').value = d.adminSub?.name || '';
    paintLogo(order.logoUrl);
}

function paintLogo(url) {
    const img = $('rsLogoPreview');
    if (url) { img.src = url; img.classList.remove('hidden'); $('rsLogoUrl').textContent = url; $('rsLogoBtn').innerHTML = '<i class="fas fa-images"></i> Change logo'; }
}

const fmtT = (t) => t ? new Date(t).toLocaleString([], { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' }) : '';
let pollTimer = null;

function paintTrack() {
    $('rsTProduct').textContent = order.productName;
    $('rsTMeta').textContent = `Order ${order.id.slice(-8).toUpperCase()} · Rs ${order.price} · placed ${fmtT(order.submittedAt || order.createdAt)}`;
    const placed = `<div class="rs-step done"><div class="rs-dot"><i class="fas fa-check"></i></div><div class="rs-step-title">Order placed &amp; details received</div><div class="rs-step-time">${esc(fmtT(order.submittedAt))}</div></div>`;
    $('rsTimeline').innerHTML = placed + order.timeline.map(st => `
        <div class="rs-step ${st.done ? 'done' : st.current ? 'current' : ''}">
            <div class="rs-dot">${st.done ? '<i class="fas fa-check"></i>' : st.current ? '<i class="fas fa-gear fa-spin"></i>' : ''}</div>
            <div class="rs-step-title">${esc(st.label)}</div>
            <div class="rs-step-time">${st.done ? esc(fmtT(st.at)) : st.current ? 'In progress...' : ''}</div>
        </div>`).join('');
    const d = order.delivery;
    $('rsDeliverBox').classList.toggle('hidden', !d);
    if (d) {
        const rows = [['STORE LINK', d.storeLink], ['ADMIN PANEL LINK', d.adminLink], ['ADMIN PANEL UNLOCK URL', d.unlockUrl], ['PASSWORD', d.password]];
        $('rsDeliver').innerHTML = rows.map(([k, v]) => `<div class="rs-drow"><button class="rs-copy" data-v="${esc(v)}" title="Copy"><i class="far fa-copy"></i></button><b>${k}</b><span>${esc(v)}</span></div>`).join('');
        $('rsDeliver').querySelectorAll('.rs-copy').forEach(b => b.onclick = () => navigator.clipboard.writeText(b.dataset.v).then(() => toast('Copied', 'success')).catch(() => toast('Copy failed', 'error')));
    }
}

function showView() {
    $('rsLoading').classList.add('hidden');
    const tracking = order.submitted;
    $('rsMain').classList.toggle('hidden', tracking);
    $('rsTrackView').classList.toggle('hidden', !tracking);
    if (tracking) {
        paintTrack();
        clearInterval(pollTimer);
        if (order.stageIndex < 6) pollTimer = setInterval(() => { if (!document.hidden) reload(); }, 45000);
    } else paint();
}

async function reload() {
    try { order = await backendFetch('/api/shopsrc/order/' + encodeURIComponent(orderId)); showView(); } catch (e) { /* keep the last view */ }
}
$('rsRefreshBtn').addEventListener('click', async (ev) => { ev.currentTarget.disabled = true; await reload(); toast('Status updated', 'success'); ev.currentTarget.disabled = false; });

requireAuth(async () => {
    if (!orderId) return showError('No order found. Buy the Shop Project from the store first.');
    try {
        order = await backendFetch('/api/shopsrc/order/' + encodeURIComponent(orderId));
    } catch (e) { return showError(e.message || 'Order not found.'); }
    showView();
});

// ---- protected download: ask for a short-lived link, then let the browser follow it
$('rsDownloadBtn').addEventListener('click', async (ev) => {
    const btn = ev.currentTarget;
    btn.disabled = true;
    try {
        const r = await backendFetch(`/api/shopsrc/order/${encodeURIComponent(orderId)}/download-link`, { method: 'POST' });
        const base = String(window.BACKEND_URL || '').trim().replace(/\/+$/, '');
        const a = document.createElement('a');
        a.href = base + r.url; a.rel = 'noopener';
        document.body.appendChild(a); a.click(); a.remove();
        toast('Download started', 'success');
        order.downloadsLeft = Math.max(0, order.downloadsLeft - 1);
        setTimeout(paint, 1500);
    } catch (e) { toast(e.message || 'Could not start the download', 'error'); }
    finally { setTimeout(() => { btn.disabled = order.downloadsLeft <= 0; }, 3000); }
});

// ---- logo: shrink in the browser, backend uploads it to imgbb
$('rsLogoBtn').addEventListener('click', () => $('rsLogoFile').click());
$('rsLogoFile').addEventListener('change', async (ev) => {
    const file = ev.target.files?.[0];
    ev.target.value = '';
    if (!file) return;
    if (!/^image\/(png|jpe?g|webp)$/.test(file.type)) return toast('Pick a PNG, JPG or WebP image', 'error');
    const btn = $('rsLogoBtn');
    btn.disabled = true; btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Uploading...';
    try {
        const dataUrl = await shrink(file, 800);
        const r = await backendFetch('/api/shopsrc/logo/' + encodeURIComponent(orderId), { method: 'POST', body: JSON.stringify({ image: dataUrl }) });
        order.logoUrl = r.logoUrl;
        paintLogo(r.logoUrl);
        toast('Logo uploaded', 'success');
    } catch (e) { toast(e.message || 'Logo upload failed', 'error'); btn.innerHTML = '<i class="fas fa-images"></i> Pick from gallery'; }
    finally { btn.disabled = false; }
});

function shrink(file, max) {
    return new Promise((resolve, reject) => {
        const url = URL.createObjectURL(file);
        const img = new Image();
        img.onload = () => {
            const k = Math.min(1, max / Math.max(img.width, img.height));
            const c = document.createElement('canvas');
            c.width = Math.round(img.width * k); c.height = Math.round(img.height * k);
            c.getContext('2d').drawImage(img, 0, 0, c.width, c.height);
            URL.revokeObjectURL(url);
            resolve(c.toDataURL('image/png').length > 1_400_000 ? c.toDataURL('image/jpeg', 0.85) : c.toDataURL('image/png'));
        };
        img.onerror = () => { URL.revokeObjectURL(url); reject(new Error('Could not read that image')); };
        img.src = url;
    });
}

// ---- submit
$('rsSubmitBtn').addEventListener('click', async (ev) => {
    const btn = ev.currentTarget;
    const body = {
        name: $('rsName').value, number: $('rsNumber').value, email: $('rsEmail').value, shopName: $('rsShopName').value,
        shopSub: { name: $('rsShopSub').value, domain: $('rsShopDom').value },
        adminSub: { name: $('rsAdminSub').value, domain: $('rsAdminDom').value },
        resellerApi: $('rsApi').value, resellerMasterKey: $('rsMaster').value,
    };
    if (!order.logoUrl) return toast('Pick your logo first', 'error');
    btn.disabled = true;
    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sending...';
    try {
        const r = await backendFetch(`/api/shopsrc/order/${encodeURIComponent(orderId)}/submit`, { method: 'POST', body: JSON.stringify(body) });
        toast('Submitted ✅ — we will start your build', 'success');
        await reload();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } catch (e) { toast(e.message || 'Submit failed', 'error'); }
    finally { btn.disabled = false; btn.innerHTML = orig; }
});
</script>
