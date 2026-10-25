<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'History — SRT X CHEATS';
$currentPage = 'history';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <div class="prompt-header"><i class="fas fa-receipt"></i> HISTORY</div>
        <div class="hs-tabs" id="hsTabs">
            <button type="button" class="hs-tab active" data-tab="keys" data-no-busy><i class="fas fa-key"></i> Keys <span id="tabN-keys"></span></button>
            <button type="button" class="hs-tab" data-tab="glory" data-no-busy><i class="fas fa-robot"></i> Glory Bot <span id="tabN-glory"></span></button>
            <button type="button" class="hs-tab" data-tab="pay" data-no-busy><i class="fas fa-wallet"></i> Payments <span id="tabN-pay"></span></button>
            <button type="button" class="hs-tab hidden" id="apiTabBtn" data-tab="api" data-no-busy><i class="fas fa-plug"></i> API <span id="tabN-api"></span></button>
        </div>
        <div class="hs-bar">
            <div class="hs-search">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" id="hsInput" inputmode="text" autocomplete="off" placeholder="Search date  yyyy/mm/dd  or product" aria-label="Search history">
                <button type="button" id="hsClear" class="hs-x hidden" aria-label="Clear search" data-no-busy><i class="fas fa-xmark"></i></button>
            </div>
            <div class="hs-chips" id="hsChips">
                <button type="button" class="hs-chip active" data-range="all" data-no-busy><i class="fas fa-layer-group"></i> All</button>
                <button type="button" class="hs-chip" data-range="7" data-no-busy><i class="fas fa-calendar-week"></i> Last 7 days</button>
                <button type="button" class="hs-chip" data-range="30" data-no-busy><i class="fas fa-calendar-days"></i> Last 30 days</button>
            </div>
            <div class="hs-count" id="hsCount"></div>
        </div>
        <div id="historyList">
            <div class="dim" style="text-align:center;padding:30px">
                <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue);margin-bottom:8px"></i>
                <div>Loading history...</div>
            </div>
        </div>

    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hs-tabs { display: grid; grid-auto-flow: column; grid-auto-columns: 1fr; gap: 6px; margin: 2px 0 12px; padding: 4px; border-radius: 14px; background: var(--surface-tint-strong, rgba(0,0,0,.3)); border: 1px solid var(--glass-border, rgba(255,255,255,.14)); }
.hs-tab { border: 0; border-radius: 10px; padding: 10px 4px; font-size: 12px; font-weight: 800; cursor: pointer; font-family: inherit; color: var(--text-secondary, #c9d3cc); background: transparent; display: flex; align-items: center; justify-content: center; gap: 6px; }
.hs-tab span { font-size: 10px; opacity: .75; }
.hs-tab.hidden { display: none; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hs-tab.active { color: #fff; background: linear-gradient(135deg, #8b5cf6, #6366f1); }
.log-entry-icon.pay { background: linear-gradient(135deg, #38bdf8, #2563eb); color: #fff; }
.pay-st { font-size: 10px; font-weight: 800; letter-spacing: .6px; text-transform: uppercase; border-radius: 99px; padding: 3px 9px; border: 1px solid currentColor; }
.pay-st.ok { color: #22c55e; } .pay-st.wait { color: #f59e0b; } .pay-st.bad { color: #ef4444; }
.log-entry .price.plus { color: var(--neon-green, #22c55e); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hs-bar { margin: 4px 0 14px; }
.hs-search { position: relative; display: flex; align-items: center; }
.hs-search > i.fa-magnifying-glass { position: absolute; left: 14px; color: var(--text-muted, #8a9a90); pointer-events: none; }
.hs-search input {
    width: 100%; box-sizing: border-box; padding: 13px 42px 13px 40px; font-size: 14px; border-radius: 14px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    color: var(--text-primary, #fff); background: var(--surface-tint-strong, rgba(0,0,0,.3));
    border: 1px solid var(--glass-border, rgba(255,255,255,.14)); outline: none; font-family: inherit;
}
.hs-search input:focus { border-color: var(--neon-blue, #00f0ff); box-shadow: 0 0 0 3px rgba(0,240,255,.15); }
.hs-x { position: absolute; right: 6px; width: 34px; height: 34px; border: 0; border-radius: 10px; background: transparent; color: var(--text-muted, #8a9a90); cursor: pointer; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hs-x.hidden { display: none; }
.hs-chips { display: flex; gap: 8px; margin-top: 10px; overflow-x: auto; padding-bottom: 2px; }
.hs-chip {
    flex: none; display: inline-flex; align-items: center; gap: 7px; padding: 9px 14px; border-radius: 999px; font-size: 12.5px; font-weight: 700; cursor: pointer;
    color: var(--text-secondary, #c9d3cc); background: transparent; border: 1px solid var(--glass-border, rgba(255,255,255,.14)); font-family: inherit;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.hs-chip.active { color: #fff; background: linear-gradient(135deg, #8b5cf6, #6366f1); border-color: transparent; }
.hs-count { margin-top: 10px; font-size: 12px; color: var(--text-muted, #8a9a90); min-height: 16px; }
.log-entry { display: flex; gap: 12px; align-items: flex-start; }
.log-entry-icon {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; margin-top: 2px;
    display: flex; align-items: center; justify-content: center; font-size: 14px;
    background: linear-gradient(135deg, var(--neon-amber, #ffb454), #a9822a); color: #1a1305;
}
.log-entry-body { flex: 1; min-width: 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.log-entry:hover { border-color: var(--neon-blue, #00f0ff); box-shadow: 0 4px 15px rgba(0, 240, 255, 0.15); }
.log-entry .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; gap: 8px; }
.log-entry .name { font-weight: 700; color: var(--text-primary, #fff); font-size: 13px; }
.log-entry .price { color: var(--neon-amber, #ffb454); font-weight: 800; font-family: var(--font-mono, monospace); white-space: nowrap; }
.log-entry .meta { color: var(--text-muted, #8a9a90); font-size: 11px; margin-bottom: 8px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.log-entry .key-wrap { display: flex !important; flex-direction: row !important; align-items: center !important; gap: 8px !important; width: 100% !important; margin-top: 6px; }
.log-entry .key-box, .log-entry .key {
    flex: 1 1 auto !important; min-width: 0 !important;
    background: var(--surface-tint-strong, rgba(0, 0, 0, 0.3));
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    border: 1px solid var(--glass-border, rgba(255,255,255,0.1));
    border-radius: var(--radius-sm, 6px);
    padding: 8px 10px;
    font-family: var(--font-mono, monospace);
    font-weight: 700;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    color: var(--neon-green, #10b981);
    font-size: 12px;
    white-space: nowrap !important;
    overflow-x: auto !important;
    word-break: keep-all !important;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.log-entry .key-wrap button, .copy-key-btn {
    flex: 0 0 auto !important; width: auto !important;
    padding: 8px 14px; font-size: 12px; white-space: nowrap; cursor: pointer;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.log-entry-icon.api { background: linear-gradient(135deg, #a78bfa, #6d28d9); color: #fff; }
.api-entry .api-line { font-family: var(--font-mono, monospace); font-size: 12px; line-height: 1.7; color: var(--text-secondary, #c9d3cc); word-break: break-word; }
.api-entry .api-line b { color: var(--text-primary, #fff); font-weight: 700; }
.api-entry .api-math { display: inline-block; margin-top: 6px; padding: 5px 11px; border-radius: 10px; font-family: var(--font-mono, monospace); font-size: 13px; font-weight: 800; color: var(--neon-green, #22c55e); background: var(--surface-tint-strong, rgba(0,0,0,.3)); border: 1px solid var(--glass-border, rgba(255,255,255,.12)); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-entry .api-math.bad { color: var(--text-muted, #8a9a90); }
.api-entry summary { cursor: pointer; font-size: 12px; font-weight: 700; color: var(--neon-blue, #00f0ff); margin-top: 8px; }
.api-entry .api-keys { max-height: 220px; overflow-y: auto; margin-top: 6px; display: flex; flex-direction: column; gap: 6px; }
.log-entry-icon.glory { background: linear-gradient(135deg, #34d399, #047857); color: #fff; }
.glory-entry .gl-st { font-size: 10px; font-weight: 800; letter-spacing: .6px; text-transform: uppercase; color: var(--text-muted, #8a9a90); border: 1px solid var(--glass-border, rgba(255,255,255,.12)); border-radius: 99px; padding: 3px 9px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.glory-entry .gl-line { font-family: var(--font-mono, monospace); font-size: 12px; line-height: 1.6; color: var(--text-secondary, #c9d3cc); word-break: break-word; }
</style>

<script type="module">
import { requireAuth, backendFetch, toast, fmtDate, esc, getData, cachePeek } from '/assets/js/app.js?v=20261025-4';
// src by SRT X CHEATS. Copy right SRT X CHEATS

requireAuth(async () => {
    await loadHistory();
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
let gloryItems = [];
let payItems = [];
let apiItems = [];
let tab = 'keys';
async function loadApi() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const k = 'srtx_api_hist';
    try {
        const c = JSON.parse(sessionStorage.getItem(k) || 'null');
        if (c && Date.now() - c.t < 60000) { apiItems = c.orders; return; }
    } catch (_) {}
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const r = await backendFetch('/api/user/api-history');
        apiItems = r.orders || [];
        try { sessionStorage.setItem(k, JSON.stringify({ t: Date.now(), orders: apiItems })); } catch (_) {}
    } catch (_) { apiItems = []; }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
function syncApiTab() {
    const btn = document.getElementById('apiTabBtn');
    const role = cachePeek('profile')?.value?.role;
    btn.classList.toggle('hidden', !(apiItems.length || role === 'reseller' || role === 'pro_reseller'));
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
async function loadPayments() {
    try { const r = await backendFetch('/api/user/topup-history'); payItems = r.payments || []; } catch (_) { payItems = []; }
}
async function loadGlory() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { const g = await backendFetch('/api/glory/history'); gloryItems = g.history || []; } catch (_) { gloryItems = []; }
}
async function loadHistory() {
    const cached = cachePeek('history');
    if (cached) renderHistory(cached.value.history || []);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const [d] = await Promise.all([getData('history'), loadGlory(), loadPayments(), loadApi()]);
        renderHistory(d.history || []);
    } catch (e) {
        if (cached) return;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('historyList').innerHTML = `
            <div style="color:var(--neon-red, #ff4d4d);font-size:12px;text-align:center;padding:20px">
                <i class="fas fa-triangle-exclamation"></i> Couldn't load history: ${esc(e.message)}
            </div>`;
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function ymd(v) {
    const d = new Date(v);
    if (isNaN(d)) return '—';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return `${d.getFullYear()}/${String(d.getMonth() + 1).padStart(2, '0')}/${String(d.getDate()).padStart(2, '0')}`;
}
function gloryRow(g, i) {
    const bots = g.botCount || 4;
    const st = g.status === 'deleted' ? 'Deleted' : g.status === 'refunded' ? 'Refunded' : 'Ended';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return `
        <div class="log-entry glory-entry" style="animation-delay:${Math.min(i * 50, 400)}ms">
            <div class="log-entry-icon glory"><i class="fas fa-robot"></i></div>
            <div class="log-entry-body">
                <div class="top">
                    <span class="name">FF Glory Bot</span>
                    <span class="gl-st">${st}</span>
                </div>
                <div class="gl-line">buy - ${ymd(g.createdAt)} [ paid - ${esc(String(g.price))} &nbsp;${esc(String(bots))}bot = 1sq ] guild client id - ${esc(String(g.clanId))}</div>
            </div>
        </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

const num = (v) => (v === null || v === undefined ? '?' : String(Math.round(Number(v) * 100) / 100));
function ymdhm(ms) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const d = new Date(ms);
    if (isNaN(d)) return '—';
    const p = (n) => String(n).padStart(2, '0');
    return `${d.getFullYear()}/${p(d.getMonth() + 1)}/${p(d.getDate())} ${p(d.getHours())}:${p(d.getMinutes())}`;
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
function apiRow(o, i) {
    const st = { completed: 'Completed', partial: 'Partial', failed: 'Failed', processing: 'Processing' }[o.status] || o.status;
    const known = o.balanceBefore !== null && o.balanceAfter !== null;
    const unitTxt = o.quantity > 1 ? ` <span class="dim">(Rs ${esc(num(o.unitPrice))} each)</span>` : '';
    const keysHtml = o.keys.length ? `
        <details>
            <summary>Keys (${o.keys.length})</summary>
            <div class="api-keys">
                ${o.keys.map((k) => `<div class="key-wrap"><div class="key-box" title="${esc(k)}">${esc(k)}</div></div>`).join('')}
            </div>
            <button type="button" class="btn btn-ghost copy-api-btn" data-i="${i}" style="margin-top:8px"><i class="fas fa-copy"></i> Copy all</button>
        </details>` : '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return `
        <div class="log-entry api-entry" style="animation-delay:${Math.min(i * 50, 400)}ms">
            <div class="log-entry-icon api"><i class="fas fa-plug"></i></div>
            <div class="log-entry-body">
                <div class="top">
                    <span class="name">API Order</span>
                    <span class="gl-st pay-st ${o.status === 'completed' ? 'ok' : o.status === 'failed' ? 'bad' : 'wait'}">${esc(st)}</span>
                </div>
                <div class="api-line">date - <b>${esc(ymdhm(o.at))}</b></div>
                <div class="api-line">product - <b>${esc(o.product)}</b>${o.duration ? ' · ' + esc(o.duration) : ''}${o.quantity > 1 ? ' × ' + esc(String(o.quantity)) : ''}</div>
                <div class="api-line">price - <b>Rs ${esc(num(o.paid))}</b>${unitTxt}${o.refunded ? ` <span class="dim">· refunded Rs ${esc(num(o.refunded))}</span>` : ''}</div>
                <div class="api-math ${known ? '' : 'bad'}">[ ${esc(num(o.balanceBefore))} - ${esc(num(o.paid))} = ${esc(num(o.balanceAfter))} ]</div>
                ${keysHtml}
            </div>
        </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function payRow(t, i) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const map = { APPROVED: ['Completed', 'ok'], PENDING: ['Pending', 'wait'], REJECTED: ['Rejected', 'bad'] };
    const [label, cls] = map[t.status] || [t.status, 'wait'];
    const how = t.method === 'QR' ? 'QR payment' : 'Top-up';
    const sign = t.status === 'APPROVED' ? '+' : '';
    return `
        <div class="log-entry" style="animation-delay:${Math.min(i * 50, 400)}ms">
            <div class="log-entry-icon pay"><i class="fas fa-wallet"></i></div>
            <div class="log-entry-body">
                <div class="top">
                    <span class="name">${how}</span>
                    <span class="price mono-num ${t.status === 'APPROVED' ? 'plus' : ''}">${sign}Rs ${esc(String(t.amount))}</span>
                </div>
                <div class="meta">${fmtDate(t.date)}${t.txCode ? ' · TX ' + esc(t.txCode) : ''}</div>
                <span class="pay-st ${cls}">${label}</span>
            </div>
        </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

let allPurchases = [];
let range = 'all';
// src by SRT X CHEATS. Copy right SRT X CHEATS
let query = '';

function parseDateQuery(q) {
    let m = q.match(/^(\d{4}|\d{2})\s*[\/\-.]\s*(\d{1,2})(?:\s*[\/\-.]\s*(\d{1,2}))?$/);
    if (m) return { y: m[1].length === 2 ? 2000 + +m[1] : +m[1], m: +m[2], d: m[3] ? +m[3] : null };
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    m = q.match(/^(\d{4})$/);
    return m ? { y: +m[1], m: null, d: null } : null;
}
function matches(row) {
    if (range !== 'all' && row.at < Date.now() - Number(range) * 86400000) return false;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const q = query.trim().toLowerCase();
    if (!q) return true;
    const dq = parseDateQuery(q);
    if (dq) {
        const d = new Date(row.at);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (d.getFullYear() !== dq.y) return false;
        if (dq.m !== null && d.getMonth() + 1 !== dq.m) return false;
        if (dq.d !== null && d.getDate() !== dq.d) return false;
        return true;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const hay = row.kind === 'api'
        ? `api ${row.o.product} ${row.o.duration} ${row.o.status} ${row.o.orderId || ''}`
        : row.kind === 'pay'
        ? `${row.t.txCode || ''} ${row.t.amount} ${row.t.status} ${row.t.method === 'QR' ? 'qr payment' : 'topup'}`
        : row.kind === 'glory'
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ? `glory bot ff ${row.g.clanId || ''} ${row.g.region || ''} ${row.g.status || ''}`
        : `${row.p.name || ''} ${row.p.duration || ''} ${Array.isArray(row.p.key) ? row.p.key.join('') : (row.p.key || '')}`;
    return hay.toLowerCase().includes(q);
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderHistory(purchases) {
    allPurchases = purchases;
    const el = document.getElementById('historyList');
    const all = {
        keys: purchases.map((p) => ({ kind: 'key', at: new Date(p.at).getTime() || 0, p })),
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        glory: gloryItems.map((g) => ({ kind: 'glory', at: new Date(g.createdAt).getTime() || 0, g })),
        pay: payItems.map((t) => ({ kind: 'pay', at: new Date(t.date).getTime() || 0, t })),
        api: apiItems.map((o) => ({ kind: 'api', at: Number(o.at) || 0, o })),
    };
    syncApiTab();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    Object.keys(all).forEach((k) => { const n = document.getElementById('tabN-' + k); if (n) n.textContent = all[k].length ? `(${all[k].length})` : ''; });
    const everything = all[tab].sort((a, b) => b.at - a.at);
    const items = everything.filter(matches);
    const filtered = !!query.trim() || range !== 'all';
    document.getElementById('hsCount').textContent = everything.length
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ? (filtered ? `${items.length} of ${everything.length} entr${everything.length === 1 ? 'y' : 'ies'}` : `${everything.length} entr${everything.length === 1 ? 'y' : 'ies'}`)
        : '';
    if (!items.length) {
        el.innerHTML = filtered && everything.length
            ? '<div class="dim" style="text-align:center;padding:30px"><i class="fas fa-magnifying-glass" style="font-size:20px;margin-bottom:8px;display:block"></i>Nothing found for this search.</div>'
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            : `<div class="dim" style="text-align:center;padding:30px"><i class="fas fa-box-open" style="font-size:20px;margin-bottom:8px;display:block"></i>${{ keys: 'No keys bought yet.', glory: 'No Glory Bot history yet.', pay: 'No payments yet.', api: 'No API orders yet.' }[tab]}</div>`;
        return;
    }

    el.innerHTML = items.map((row, i) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (row.kind === 'glory') return gloryRow(row.g, i);
        if (row.kind === 'pay') return payRow(row.t, i);
        if (row.kind === 'api') return apiRow(row.o, i);
        const it = row.p;
        let keyStr = '';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (it.key) {
            if (Array.isArray(it.key)) {
                keyStr = it.key.join('');
            } else if (typeof it.key === 'string') {
                keyStr = it.key.replace(/\s+/g, '');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            } else if (typeof it.key === 'number') {
                keyStr = String(it.key);
            }
        }

        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const keyHtml = keyStr ? `
            <div class="key-wrap">
                <div class="key-box" title="${esc(keyStr)}">${esc(keyStr)}</div>
                <button class="btn btn-ghost copy-key-btn" data-key="${esc(keyStr)}">
                    <i class="fas fa-copy"></i> Copy
                </button>
            </div>
        ` : '';
// src by SRT X CHEATS. Copy right SRT X CHEATS

        return `
            <div class="log-entry" style="animation-delay:${Math.min(i * 50, 400)}ms">
                <div class="log-entry-icon"><i class="fas fa-key"></i></div>
                <div class="log-entry-body">
                    <div class="top">
                        <span class="name">${esc(it.name || '—')}</span>
                        <span class="price mono-num">Rs ${it.price ?? '—'}</span>
                    </div>
                    <div class="meta">${esc(it.duration || 'Standard')} · ${fmtDate(it.at)}</div>
                    ${it.type === 'shopsrc' && it.orderId
                        ? `<a class="btn btn-ghost" style="display:inline-block;margin-top:8px;padding:6px 14px;font-size:12px" href="/registershopproject.php?order=${encodeURIComponent(it.orderId)}"><i class="fas fa-truck-fast"></i> Track order</a>`
                        : keyHtml}
                </div>
            </div>
        `;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');

    document.querySelectorAll('.copy-api-btn').forEach((btn) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        btn.onclick = () => {
            const o = items.filter((r) => r.kind === 'api')[Number(btn.dataset.i)]?.o;
            if (!o) return;
            navigator.clipboard.writeText(o.keys.join('\n'))
                .then(() => toast(`${o.keys.length} key${o.keys.length === 1 ? '' : 's'} copied`, 'success'))
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                .catch(() => toast('Failed to copy keys', 'error'));
        };
    });
    document.querySelectorAll('.copy-key-btn').forEach(btn => {
        btn.onclick = () => {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const keyText = btn.dataset.key;
            if (keyText) {
                navigator.clipboard.writeText(keyText)
                    .then(() => toast('Key copied to clipboard', 'success'))
                    .catch(() => toast('Failed to copy key', 'error'));
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            }
        };
    });
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('hsTabs').addEventListener('click', (e) => {
    const b = e.target.closest('.hs-tab');
    if (!b) return;
    tab = b.dataset.tab;
    document.querySelectorAll('.hs-tab').forEach((x) => x.classList.toggle('active', x === b));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    renderHistory(allPurchases);
});

const hsInput = document.getElementById('hsInput');
const hsClear = document.getElementById('hsClear');
// src by SRT X CHEATS. Copy right SRT X CHEATS
hsInput.addEventListener('input', () => {
    query = hsInput.value;
    hsClear.classList.toggle('hidden', !query);
    renderHistory(allPurchases);
});
// src by SRT X CHEATS. Copy right SRT X CHEATS
hsClear.addEventListener('click', () => { hsInput.value = ''; query = ''; hsClear.classList.add('hidden'); renderHistory(allPurchases); hsInput.focus(); });
document.getElementById('hsChips').addEventListener('click', (e) => {
    const chip = e.target.closest('.hs-chip');
    if (!chip) return;
    range = chip.dataset.range;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.querySelectorAll('.hs-chip').forEach((c) => c.classList.toggle('active', c === chip));
    renderHistory(allPurchases);
});
</script>
</body>
</html>
