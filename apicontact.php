<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Reseller API — SRT X CHEATS';
$currentPage = 'apicontact';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <div class="panel api-locked hidden" id="lockedBox">
            <div class="api-lock-icon"><i class="fas fa-lock"></i></div>
            <div class="api-lock-title">RESELLER ACCOUNTS ONLY</div>
            <div class="dim api-lock-text">The Reseller API lets your own website or bot buy keys from this store automatically. It is available to reseller accounts.</div>
            <a href="/dashboard.php" class="btn btn-ghost" style="margin-top:14px"><i class="fas fa-gauge-high"></i> Back to Dashboard</a>
        </div>

        <div id="apiRoot">
            <div class="dim" style="text-align:center;padding:40px 0" id="apiLoading">
                <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue);margin-bottom:8px"></i>
                <div>Loading Reseller API...</div>
            </div>

            <div class="hidden" id="apiMain">

                <div class="api-banner hidden" id="offlineBanner"><i class="fas fa-power-off"></i> The Reseller API is temporarily switched off by the store. Your keys are safe — it will work again when it is turned back on.</div>
                <div class="api-banner hidden" id="disabledBanner"><i class="fas fa-ban"></i> API access for your account has been disabled by an admin. Please contact support.</div>

                <div class="panel">
                    <div class="prompt-header"><i class="fas fa-key"></i> RESELLER API AUTHENTICATION</div>

                    <div class="api-label">ACTIVE API KEY</div>
                    <div class="api-token" id="apiKeyBox">
                        <span class="api-token-text" id="apiKeyText"></span>
                        <button type="button" class="api-icon-btn" id="apiKeyEye" title="Show / hide"><i class="fas fa-eye"></i></button>
                        <button type="button" class="api-icon-btn" id="apiKeyCopy" title="Copy"><i class="fas fa-copy"></i></button>
                    </div>

                    <div class="api-label" style="margin-top:14px">MASTER KEY <span class="dim" style="text-transform:none;letter-spacing:0">(sent in the <code>x-master-key</code> header)</span></div>
                    <div class="api-token" id="masterKeyBox">
                        <span class="api-token-text" id="masterKeyText"></span>
                        <button type="button" class="api-icon-btn" id="masterKeyEye" title="Show / hide"><i class="fas fa-eye"></i></button>
                        <button type="button" class="api-icon-btn" id="masterKeyCopy" title="Copy"><i class="fas fa-copy"></i></button>
                    </div>

                    <div class="api-meta" id="credMeta"></div>
                    <div class="api-note hidden" id="onceNote"><i class="fas fa-triangle-exclamation"></i> Copy both keys now. For security they cannot be shown again after you leave this page — you would need to re-generate.</div>

                    <button type="button" class="btn btn-ghost api-regen" id="regenBtn"><i class="fas fa-rotate"></i> <span id="regenLabel">GENERATE API KEYS</span></button>

                    <div class="api-label" style="margin-top:20px">QUICK INTEGRATION GUIDE:</div>
                    <div class="api-guide">
                        <span class="api-chip-tag">ENDPOINT</span>
                        <div class="api-endpoint">
                            <span id="endpointText" class="mono-num"></span>
                            <button type="button" class="api-icon-btn plain" id="endpointCopy" title="Copy endpoint"><i class="fas fa-copy"></i></button>
                        </div>
                        <p class="api-guide-text">
                            Send a <b>POST</b> request with <code>api_key</code>, <code>action</code>, <code>product_id</code>, <code>duration</code> and <code>quantity</code> (1&ndash;100),
                            plus your master key in the <code>x-master-key</code> header.
                            A successful response returns <code>keys[]</code>, <code>charged</code> and your new <code>balance</code>.
                            Device-bound products also need <code>android_id</code>.
                        </p>
                        <p class="api-guide-text">
                            Other actions: <code>action=balance</code> (your balance) and <code>action=products</code> (live product list).
                        </p>
                    </div>
                </div>

                <div class="panel">
                    <div class="api-code-head">
                        <div class="prompt-header" style="margin:0"><i class="fas fa-code"></i> RESELLER API CODE</div>
                        <div class="api-code-actions">
                            <button type="button" class="btn btn-ghost" id="showKeyBtn"><i class="fas fa-eye"></i> <span id="showKeyLabel">SHOW KEY</span></button>
                            <button type="button" class="btn btn-ghost" id="copyCodeBtn"><i class="fas fa-copy"></i> COPY CODE</button>
                        </div>
                    </div>
                    <pre class="api-code" id="codeBlock"></pre>

                    <div class="api-checklist">
                        <div class="api-checklist-title"><i class="fas fa-circle-info"></i> IMPORTANT CONFIGURATION CHECKLIST:</div>
                        <ol>
                            <li><b>PID verification:</b> take the exact <code>product_id</code> from the Product Reference Table below.</li>
                            <li><b>Duration:</b> use the duration exactly as listed (<code>1 Day</code>, <code>1_day</code> and <code>1 days</code> are all accepted).</li>
                            <li><b>Quantity:</b> 1 to 100 per request. Big orders can take up to ~80 seconds, so set your HTTP timeout to <b>90 seconds</b>.</li>
                            <li><b>android_id:</b> required only for products marked <span class="api-mini-badge">DEVICE</span> in the table.</li>
                            <li><b>request_id (recommended):</b> send a unique id per order. If your request times out, retry with the <b>same</b> id and you will never be charged twice.</li>
                            <li><b>Money safety:</b> your balance is charged first; any key that could not be delivered is refunded automatically.</li>
                            <li><b>Keep keys secret:</b> never put them in a website's public code or in an app. Call the API from your server. Re-generating replaces the old keys immediately.</li>
                        </ol>
                    </div>

                    <details class="api-details">
                        <summary>Example responses &amp; error codes</summary>
                        <pre class="api-code small" id="respBlock"></pre>
                        <div class="api-errors">
                            <div><code>401 INVALID_CREDENTIALS</code> wrong api_key or master key</div>
                            <div><code>402 INSUFFICIENT_BALANCE</code> add balance, then retry</div>
                            <div><code>404 PRODUCT_NOT_FOUND</code> check product_id + duration</div>
                            <div><code>409 OUT_OF_STOCK / PRODUCT_MAINTENANCE</code> try again later</div>
                            <div><code>429 RATE_LIMITED</code> slow down</div>
                            <div><code>502 PROVIDER_UNAVAILABLE</code> nothing was charged</div>
                        </div>
                    </details>
                </div>

                <div class="panel">
                    <div class="api-table-head" id="copyAllBar" title="Tap to copy the whole table">
                        <i class="fas fa-table-list"></i>
                        <span>PRODUCT REFERENCE TABLE (PIDS &amp; LIVE STATUS) &mdash; TAP TO COPY ALL</span>
                    </div>
                    <div class="api-search">
                        <i class="fas fa-magnifying-glass"></i>
                        <input type="text" id="prodSearch" placeholder="Type Product Name or PID to search..." autocomplete="off">
                    </div>
                    <div id="prodTable"></div>
                    <div class="dim" style="font-size:11px;margin-top:10px">Tap a <b>PID</b> or a <b>duration</b> to copy it. Prices are your reseller prices (NRP).</div>
                </div>

                <div class="panel">
                    <div class="prompt-header"><i class="fas fa-receipt"></i> RECENT API ORDERS</div>
                    <div id="ordersList"></div>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-label { font-size: 12px; letter-spacing: 1.5px; font-weight: 700; color: var(--neon-blue, #00f0ff); text-transform: uppercase; margin-bottom: 8px; }
.api-label code, .api-guide-text code, .api-checklist code, .api-errors code { font-family: var(--font-mono, monospace); background: var(--surface-tint-strong, rgba(0,0,0,.35)); padding: 1px 5px; border-radius: 4px; font-size: 11px; }

.api-token {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    display: flex; align-items: center; gap: 8px; padding: 10px 12px;
    border: 1px dashed var(--neon-blue, #00f0ff); border-radius: var(--radius-md, 10px);
    background: var(--surface-tint-strong, rgba(0,0,0,.35));
}
.api-token-text {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    flex: 1; min-width: 0; font-family: var(--font-mono, monospace); font-size: 13px; letter-spacing: 1px;
    color: var(--text-primary, #fff); overflow-x: auto; white-space: nowrap; scrollbar-width: none;
}
.api-token-text::-webkit-scrollbar { display: none; }
.api-icon-btn {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    flex: 0 0 auto; width: 40px; height: 36px; border-radius: 8px; border: none; cursor: pointer;
    background: rgba(255,255,255,.88); color: #1a1f2b; font-size: 15px; display: inline-flex; align-items: center; justify-content: center;
}
.api-icon-btn:active { transform: scale(.94); }
.api-icon-btn.plain { background: transparent; color: var(--neon-blue, #00f0ff); width: 32px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.api-meta { margin-top: 12px; font-size: 11px; color: var(--text-muted, #8a9a90); line-height: 1.7; }
.api-meta b { color: var(--text-primary, #fff); }
.api-pill { display: inline-block; padding: 2px 9px; border-radius: 999px; font-size: 10px; font-weight: 800; letter-spacing: 1px; }
.api-pill.on  { background: rgba(16,185,129,.15); color: var(--neon-green, #10b981); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-pill.off { background: rgba(255,77,77,.15);  color: var(--neon-red, #ff4d4d); }
.api-pill.none{ background: rgba(255,180,84,.15); color: var(--neon-amber, #ffb454); }

.api-note, .api-banner {
    margin-top: 12px; padding: 10px 12px; border-radius: var(--radius-md, 10px); font-size: 12px; line-height: 1.5;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background: rgba(255,180,84,.1); border: 1px solid rgba(255,180,84,.35); color: var(--neon-amber, #ffb454);
}
.api-banner { margin: 0 0 14px; }
.key-flash { animation: keyFlash 1.6s ease-out; }
@keyframes keyFlash { 0% { box-shadow: 0 0 0 0 rgba(34,197,94,.85); background: rgba(34,197,94,.22); } 100% { box-shadow: 0 0 0 16px rgba(34,197,94,0); } }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-regen { margin-top: 14px; border: 1px solid var(--neon-blue, #00f0ff); color: var(--neon-blue, #00f0ff); letter-spacing: 1.5px; }

.api-guide { border: 1px solid var(--glass-border, rgba(255,255,255,.12)); border-radius: var(--radius-md, 10px); padding: 14px; background: var(--surface-tint-strong, rgba(0,0,0,.3)); }
.api-chip-tag { display: inline-block; border: 1px solid var(--neon-blue, #00f0ff); color: var(--neon-blue, #00f0ff); border-radius: 6px; padding: 5px 11px; font-size: 11px; letter-spacing: 1px; margin-bottom: 10px; }
.api-endpoint { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-primary, #fff); word-break: break-all; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-endpoint span { flex: 1; min-width: 0; }
.api-guide-text { font-size: 12px; line-height: 1.65; color: var(--text-muted, #8a9a90); margin: 10px 0 0; }

.api-code-head { display: flex; flex-direction: column; gap: 12px; margin-bottom: 12px; }
.api-code-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-code-actions .btn { border: 1px solid var(--neon-blue, #00f0ff); color: var(--neon-blue, #00f0ff); letter-spacing: 1px; }
.api-code {
    margin: 0; padding: 14px; border-radius: var(--radius-md, 10px); background: #05070d; border: 1px solid var(--glass-border, rgba(255,255,255,.12));
    color: #e6edf3; font-family: var(--font-mono, monospace); font-size: 12px; line-height: 1.7; overflow-x: auto; white-space: pre; tab-size: 4;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-code.small { font-size: 11px; margin-top: 10px; }

.api-checklist { margin-top: 14px; border: 1px dashed var(--neon-blue, #00f0ff); border-radius: var(--radius-md, 10px); padding: 14px; }
.api-checklist-title { font-weight: 800; font-size: 12px; letter-spacing: 1px; margin-bottom: 8px; color: var(--text-primary, #fff); }
.api-checklist ol { margin: 0; padding-left: 20px; font-size: 12px; line-height: 1.65; color: var(--text-muted, #8a9a90); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-checklist li { margin-bottom: 6px; }
.api-checklist li b { color: var(--text-primary, #fff); }
.api-mini-badge { font-size: 9px; font-weight: 800; letter-spacing: .5px; padding: 1px 6px; border-radius: 4px; background: rgba(168,85,247,.2); color: #c9a0ff; border: 1px solid rgba(168,85,247,.45); }

.api-details { margin-top: 14px; font-size: 12px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-details summary { cursor: pointer; color: var(--neon-blue, #00f0ff); font-weight: 700; }
.api-errors { margin-top: 10px; font-size: 11px; line-height: 2; color: var(--text-muted, #8a9a90); }

.api-table-head { display: flex; gap: 12px; align-items: flex-start; cursor: pointer; font-family: var(--font-display, inherit); font-weight: 800; letter-spacing: 1.5px; font-size: 13px; line-height: 1.5; color: var(--text-primary, #fff); margin-bottom: 14px; }
.api-table-head i { margin-top: 3px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-search { display: flex; align-items: center; gap: 10px; padding: 11px 14px; border: 1px solid var(--glass-border, rgba(255,255,255,.18)); border-radius: var(--radius-md, 10px); background: var(--surface-tint-strong, rgba(0,0,0,.3)); margin-bottom: 14px; }
.api-search i { color: var(--text-muted, #8a9a90); }
.api-search input { flex: 1; min-width: 0; background: transparent; border: none; outline: none; color: var(--text-primary, #fff); font-size: 13px; font-family: inherit; }

.api-prod { border-top: 1px solid var(--glass-border, rgba(255,255,255,.1)); padding: 14px 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-prod:first-child { border-top: none; }
.api-prod-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 10px; }
.api-prod-name { font-weight: 800; font-size: 14px; letter-spacing: .5px; color: var(--text-primary, #fff); cursor: pointer; line-height: 1.4; }
.api-pid { flex: 0 0 auto; cursor: pointer; font-family: var(--font-mono, monospace); font-weight: 800; font-size: 15px; padding: 6px 14px; border-radius: 8px; border: 1px solid var(--neon-purple, #a855f7); background: rgba(124,58,237,.18); color: var(--text-primary, #fff); }
.api-prod { border: 1px solid var(--glass-border, rgba(255,255,255,.14)); border-radius: 14px; padding: 0; margin-bottom: 14px; overflow: hidden; background: rgba(0,0,0,.18); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-prod:first-child { border-top: 1px solid var(--glass-border, rgba(255,255,255,.14)); }
.api-sec { padding: 12px 14px; border-top: 1px solid var(--glass-border, rgba(255,255,255,.1)); }
.api-sec:first-child { border-top: none; }
.api-lbl { display: inline-flex; align-items: center; gap: 7px; font-size: 11px; font-weight: 800; letter-spacing: 1.6px; text-transform: uppercase; color: var(--text-muted, #8a9a90); margin-bottom: 8px; }
.api-lbl i { font-size: 11px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-sec.s-name .api-lbl i { color: var(--neon-amber, #ffb454); }
.api-sec.s-dur  .api-lbl i { color: var(--neon-blue, #00f0ff); }
.api-sec.s-pid  .api-lbl i { color: var(--neon-purple, #a855f7); }
.api-sec .api-prod-name { font-size: 16px; }
.api-sec .api-pid { display: inline-block; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-hint { font-weight: 600; letter-spacing: .3px; text-transform: none; opacity: .7; }
.api-durs { display: grid; grid-template-columns: repeat(auto-fill, minmax(128px, 1fr)); gap: 8px; }
.api-dur { cursor: pointer; text-align: left; padding: 9px 11px; border-radius: 8px; border: 1px solid var(--neon-blue, #00f0ff); background: rgba(0,240,255,.05); color: var(--text-primary, #fff); font-family: inherit; font-size: 12px; line-height: 1.45; }
.api-dur small { display: block; font-size: 11px; color: var(--text-muted, #8a9a90); }
.api-dur.out   { border-color: var(--neon-red, #ff4d4d); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-dur.out small   { color: var(--neon-red, #ff4d4d); }
.api-dur.maint { border-color: var(--neon-amber, #ffb454); }
.api-dur.maint small { color: var(--neon-amber, #ffb454); }

.api-order { border: 1px solid var(--glass-border, rgba(255,255,255,.12)); border-radius: var(--radius-md, 10px); padding: 12px; margin-bottom: 10px; background: var(--surface-tint-strong, rgba(0,0,0,.25)); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.api-order-top { display: flex; justify-content: space-between; gap: 8px; align-items: center; font-size: 13px; font-weight: 700; }
.api-order-meta { font-size: 11px; color: var(--text-muted, #8a9a90); margin: 4px 0 8px; }
.api-order details summary { cursor: pointer; font-size: 12px; color: var(--neon-blue, #00f0ff); }
.api-order-keys { margin-top: 8px; font-family: var(--font-mono, monospace); font-size: 11px; color: var(--neon-green, #10b981); word-break: break-all; line-height: 1.8; max-height: 160px; overflow-y: auto; }
.api-order .btn { margin-top: 8px; padding: 7px 12px; font-size: 11px; width: auto; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.api-locked { text-align: center; padding: 30px 18px; }
.api-lock-icon { font-size: 34px; color: var(--neon-amber, #ffb454); margin-bottom: 10px; }
.api-lock-title { font-weight: 800; letter-spacing: 2px; margin-bottom: 8px; }
.api-lock-text { font-size: 12px; line-height: 1.6; }
</style>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, toast, fmtDate, esc } from '/assets/js/app.js?v=20261025-4';

// src by SRT X CHEATS. Copy right SRT X CHEATS
const ENDPOINT_PATH = '/api/reseller/v1';
const ENDPOINT = String(window.BACKEND_URL || '').trim().replace(/\/+$/, '') + ENDPOINT_PATH;
const DOTS = '\u2022'.repeat(32);

function groupProducts(list) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const map = new Map();
    for (const p of list) {
        const k = `${p.name}\u0000${p.pid}`;
        if (!map.has(k)) map.set(k, { name: p.name, pid: p.pid, durations: [] });
        map.get(k).durations.push(p);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    return [...map.values()];
}

function productsAsText(groups) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return groups.map((g) =>
        `${g.name} (PID: ${g.pid})\n` + g.durations.map((d) =>
            `  - ${d.duration} | NRP ${d.price}` + (d.status !== 'available' ? ` | ${d.status}` : '') + (d.requiresAndroidId ? ' | android_id required' : '')
        ).join('\n')
    ).join('\n\n');
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function filterGroups(groups, q) {
    q = String(q || '').trim().toLowerCase();
    if (!q) return groups;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return groups.filter((g) => g.name.toLowerCase().includes(q) || String(g.pid).toLowerCase().includes(q)
        || g.durations.some((d) => String(d.duration).toLowerCase().includes(q)));
}

const PHP_OPEN = '<' + '?php';
// src by SRT X CHEATS. Copy right SRT X CHEATS

function buildCode({ apiKey, masterKey, pid, duration, endpoint }) {
    return `${PHP_OPEN}
$data = [
    'api_key'    => '${apiKey}',
    'action'     => 'buy',
    'product_id' => '${pid}',            // exact PID from the Product Reference Table
    'duration'   => '${duration}',       // duration exactly as listed in the table
    'quantity'   => 10,                  // bulk quantity: 1 to 100
    'android_id' => '0b9b969bc2e7997b',  // only for DEVICE products
    'request_id' => 'order-1001'         // unique per order; reuse the SAME id when retrying
];

$headers = [
    'Content-Type: application/x-www-form-urlencoded',
    'x-master-key: ${masterKey}'
];

$ch = curl_init('${endpoint}');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($data),
    CURLOPT_HTTPHEADER     => $headers,
    CURLOPT_TIMEOUT        => 90,        // big bulk orders can take a while
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2
]);
$response = curl_exec($ch);
curl_close($ch);
echo $response;`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

const RESPONSE_SAMPLE = `// 200 OK
{
  "success": true,
  "partial": false,
  "order_id": "rid_3f9a...",
  "status": "completed",
  "product": { "name": "DRIP CLIENT", "product_id": "1", "duration": "1 Day" },
  "quantity_requested": 2,
  "quantity_delivered": 2,
  "quantity_failed": 0,
  "unit_price": 100,
  "charged": 200,
  "refunded": 0,
  "balance": 800,
  "keys": ["KEY-AAAA", "KEY-BBBB"]
}

// 402 Payment required
{ "success": false, "code": "INSUFFICIENT_BALANCE",
  "error": "Not enough balance. This order costs NRP 200.",
  "balance": 50, "required": 200 }`;
// src by SRT X CHEATS. Copy right SRT X CHEATS

let overview = null;
let keys = null;
let showApi = false, showMaster = false, showCode = false;
let hideTimer = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
let groups = [];

const $ = (id) => document.getElementById(id);

async function copyText(text, okMsg = 'Copied') {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        await navigator.clipboard.writeText(text);
    } catch {
        const ta = document.createElement('textarea');
        ta.value = text; ta.style.position = 'fixed'; ta.style.opacity = '0';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.body.appendChild(ta); ta.select();
        let ok = false;
        try { ok = document.execCommand('copy'); } catch {}
        ta.remove();
        if (!ok) { toast('Could not copy — select and copy manually', 'error'); return false; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    toast(okMsg, 'success');
    return true;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function ensureKeys() {
    if (keys) return keys;
    if (!overview?.credentials?.exists) throw new Error('Generate your API keys first.');
    if (!overview.credentials.revealable) {
        throw new Error('Keys can only be shown right after generating. Tap Re-generate for a new pair.');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    const r = await backendFetch('/api/reseller-portal/credentials/reveal');
    keys = { apiKey: r.apiKey, masterKey: r.masterKey };
    return keys;
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function scheduleAutoHide() {
    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => { showApi = showMaster = showCode = false; renderAuth(); renderCode(); }, 60000);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function tokenText(real, shown, exists, prefix) {
    if (!exists) return 'No key yet';
    if (shown && real) return real;
    return (real || overview.credentials.revealable) ? DOTS : (prefix || DOTS);
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function renderAuth() {
    const c = overview.credentials;
    $('apiKeyText').textContent = tokenText(keys?.apiKey, showApi, c.exists, c.prefix);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('masterKeyText').textContent = tokenText(keys?.masterKey, showMaster, c.exists, '');
    $('apiKeyEye').firstElementChild.className = showApi ? 'fas fa-eye-slash' : 'fas fa-eye';
    $('masterKeyEye').firstElementChild.className = showMaster ? 'fas fa-eye-slash' : 'fas fa-eye';
    $('regenLabel').textContent = c.exists ? 'RE-GENERATE SECURE KEYS' : 'GENERATE API KEYS';

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    let meta;
    if (!c.exists) {
        meta = `Status: <span class="api-pill none">NOT CREATED</span> &mdash; tap the button below to create your personal keys.`;
    } else {
        meta = `Status: <span class="api-pill ${c.disabled ? 'off' : 'on'}">${c.disabled ? 'DISABLED' : 'ACTIVE'}</span>
            &nbsp;&middot;&nbsp; Key: <b>${esc(c.prefix || '')}</b><br>
            Created: <b>${esc(fmtDate(c.createdAt))}</b> &nbsp;&middot;&nbsp; Last used: <b>${c.lastUsedAt ? esc(fmtDate(c.lastUsedAt)) : 'never'}</b>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    $('credMeta').innerHTML = meta;
    $('onceNote').classList.toggle('hidden', !(keys && c.exists && !c.revealable));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('offlineBanner').classList.toggle('hidden', overview.api.enabled);
    $('disabledBanner').classList.toggle('hidden', !c.disabled);
    $('regenBtn').disabled = !!c.disabled;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderCode() {
    const c = overview.credentials;
    const first = groups.flatMap((g) => g.durations).find((d) => d.status === 'available') || groups[0]?.durations[0];
    let apiKey = 'YOUR_API_KEY', masterKey = 'YOUR_MASTER_KEY';
    if (c.exists) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        apiKey = showCode && keys ? keys.apiKey : DOTS;
        masterKey = showCode && keys ? keys.masterKey : DOTS;
    }
    $('codeBlock').textContent = buildCode({
        apiKey, masterKey, pid: first?.pid || '1', duration: first?.duration || '1 Day', endpoint: ENDPOINT,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    });
    $('showKeyLabel').textContent = showCode ? 'HIDE KEY' : 'SHOW KEY';
    $('showKeyBtn').firstElementChild.className = showCode ? 'fas fa-eye-slash' : 'fas fa-eye';
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderTable() {
    const el = $('prodTable');
    const shown = filterGroups(groups, $('prodSearch').value);
    if (!groups.length) { el.innerHTML = '<div class="dim" style="text-align:center;padding:20px">No products listed yet.</div>'; return; }
    if (!shown.length) { el.innerHTML = '<div class="dim" style="text-align:center;padding:20px">No product matches your search.</div>'; return; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    el.innerHTML = shown.map((g) => `
        <div class="api-prod">
            <div class="api-sec s-name">
                <div class="api-lbl"><i class="fas fa-tag"></i> Name</div>
                <div class="api-prod-name" data-copy-block="${esc(g.name)}|${esc(g.pid)}">${esc(g.name)}</div>
            </div>
            <div class="api-sec s-dur">
                <div class="api-lbl"><i class="fas fa-clock"></i> Duration <span class="api-hint">&middot; tap to copy</span></div>
                <div class="api-durs">
                    ${g.durations.map((d) => `
                    <button type="button" class="api-dur ${d.status === 'out_of_stock' ? 'out' : d.status === 'maintenance' ? 'maint' : ''}"
                            data-copy="${esc(d.duration)}" data-msg="Duration copied">
                        ${esc(d.duration)}${d.requiresAndroidId ? ' <span class="api-mini-badge">DEVICE</span>' : ''}
                        <small>NRP ${esc(d.price)} &middot; ${d.status === 'available' ? 'Available' : d.status === 'out_of_stock' ? 'Out of stock' : 'Maintenance'}</small>
                    </button>`).join('')}
                </div>
            </div>
            <div class="api-sec s-pid">
                <div class="api-lbl"><i class="fas fa-hashtag"></i> PID <span class="api-hint">&middot; tap to copy</span></div>
                <div class="api-pid" data-copy="${esc(g.pid)}" data-msg="PID ${esc(g.pid)} copied">${esc(g.pid)}</div>
            </div>
        </div>`).join('');
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function renderOrders() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const el = $('ordersList');
    const orders = overview.orders || [];
    if (!orders.length) {
        el.innerHTML = '<div class="dim" style="text-align:center;padding:24px"><i class="fas fa-box-open" style="display:block;font-size:20px;margin-bottom:8px"></i>No API orders yet. Orders placed through the API will appear here with their keys.</div>';
        return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    el.innerHTML = orders.map((o, i) => {
        const pill = o.status === 'completed' ? 'on' : o.status === 'partial' ? 'none' : 'off';
        return `
        <div class="api-order">
            <div class="api-order-top"><span>${esc(o.product)} &middot; ${esc(o.duration)}</span><span class="api-pill ${pill}">${esc(String(o.status).toUpperCase())}</span></div>
            <div class="api-order-meta">${o.delivered}/${o.quantity} keys &middot; NRP ${esc(o.charged)}${o.refunded ? ` (refunded ${esc(o.refunded)})` : ''} &middot; ${esc(fmtDate(o.createdAt))}</div>
            ${o.keys.length ? `<details><summary>Show ${o.keys.length} key${o.keys.length > 1 ? 's' : ''}</summary>
                <div class="api-order-keys">${o.keys.map(esc).join('<br>')}</div>
                <button type="button" class="btn btn-ghost" data-copy-order="${i}"><i class="fas fa-copy"></i> Copy all keys</button></details>` : ''}
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');
}

function renderAll() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    renderAuth(); renderCode(); renderTable(); renderOrders();
    $('endpointText').textContent = ENDPOINT;
    $('respBlock').textContent = RESPONSE_SAMPLE;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function load() {
    try {
        overview = await backendFetch('/api/reseller-portal/overview');
    } catch (e) {
        $('apiLoading').classList.add('hidden');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (e.code === 'NOT_RESELLER' || e.status === 403) { $('lockedBox').classList.remove('hidden'); return; }
        $('apiLoading').classList.remove('hidden');
        $('apiLoading').innerHTML = `<div style="color:var(--neon-red,#ff4d4d);font-size:12px"><i class="fas fa-triangle-exclamation"></i> Couldn't load: ${esc(e.message)}</div>`;
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    groups = groupProducts(overview.products || []);
    $('apiLoading').classList.add('hidden');
    $('apiMain').classList.remove('hidden');
    renderAll();
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function toggleEye(which) {
    try {
        await ensureKeys();
        if (which === 'api') showApi = !showApi; else showMaster = !showMaster;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderAuth(); scheduleAutoHide();
    } catch (e) { toast(e.message, 'error'); }
}
async function copyKey(which) {
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const k = await ensureKeys();
        await copyText(which === 'api' ? k.apiKey : k.masterKey, which === 'api' ? 'API key copied' : 'Master key copied');
    } catch (e) { toast(e.message, 'error'); }
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
$('apiKeyEye').onclick = () => toggleEye('api');
$('masterKeyEye').onclick = () => toggleEye('master');
$('apiKeyCopy').onclick = () => copyKey('api');
$('masterKeyCopy').onclick = () => copyKey('master');
$('endpointCopy').onclick = () => copyText(ENDPOINT, 'Endpoint copied');
// src by SRT X CHEATS. Copy right SRT X CHEATS

$('showKeyBtn').onclick = async () => {
    try {
        if (!showCode) await ensureKeys();
        showCode = !showCode;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderCode(); scheduleAutoHide();
    } catch (e) { toast(e.message, 'error'); }
};

$('copyCodeBtn').onclick = async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const c = overview.credentials;
    const first = groups.flatMap((g) => g.durations).find((d) => d.status === 'available') || groups[0]?.durations[0];
    let apiKey = 'YOUR_API_KEY', masterKey = 'YOUR_MASTER_KEY', note = '';
    if (c.exists) {
        try { const k = await ensureKeys(); apiKey = k.apiKey; masterKey = k.masterKey; }
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        catch (e) { note = ' (keys left as placeholders — ' + e.message + ')'; }
    }
    const ok = await copyText(buildCode({ apiKey, masterKey, pid: first?.pid || '1', duration: first?.duration || '1 Day', endpoint: ENDPOINT }), 'Code copied');
    if (ok && note) toast('Heads up' + note, 'error');
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

$('regenBtn').onclick = async () => {
    const c = overview.credentials;
    if (c.exists && !confirm('Re-generate your keys?\n\nYour current keys stop working IMMEDIATELY. Update your website/bot with the new keys.')) return;
    const btn = $('regenBtn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (window.srtxBusyTouch) window.srtxBusyTouch(btn);
    btn.disabled = true;
    $('regenLabel').textContent = 'GENERATING NEW KEYS...';
    try {
        const r = await backendFetch('/api/reseller-portal/credentials', { method: 'POST', body: JSON.stringify({}) });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        keys = { apiKey: r.apiKey, masterKey: r.masterKey };
        showApi = showMaster = showCode = true;
        overview = await backendFetch('/api/reseller-portal/overview');
        renderAll(); scheduleAutoHide();
        $('regenLabel').textContent = r.regenerated ? 'NEW KEYS GENERATED' : 'KEYS CREATED';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        setTimeout(() => { if (overview?.credentials) $('regenLabel').textContent = overview.credentials.exists ? 'RE-GENERATE SECURE KEYS' : 'GENERATE API KEYS'; }, 2500);
        ['apiKeyBox', 'masterKeyBox'].forEach((id) => { const el = $(id); if (!el) return; el.classList.remove('key-flash'); void el.offsetWidth; el.classList.add('key-flash'); });
        toast(r.regenerated ? 'New keys generated — old keys are now disabled' : 'API keys created', 'success');
    } catch (e) {
        if (overview?.credentials) $('regenLabel').textContent = overview.credentials.exists ? 'RE-GENERATE SECURE KEYS' : 'GENERATE API KEYS';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        toast(e.message, 'error');
    } finally {
        btn.disabled = !!overview?.credentials?.disabled;
    }
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

$('prodSearch').addEventListener('input', renderTable);
$('copyAllBar').onclick = () => copyText(productsAsText(groups), 'Product table copied');

document.addEventListener('click', (ev) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const copyEl = ev.target.closest('[data-copy]');
    if (copyEl) { copyText(copyEl.dataset.copy, copyEl.dataset.msg || 'Copied'); return; }

    const blockEl = ev.target.closest('[data-copy-block]');
    if (blockEl) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const [name, pid] = blockEl.dataset.copyBlock.split('|');
        const g = groups.filter((x) => x.name === name && String(x.pid) === pid);
        copyText(productsAsText(g), 'Product copied');
        return;
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    const orderEl = ev.target.closest('[data-copy-order]');
    if (orderEl) {
        const o = overview.orders[Number(orderEl.dataset.copyOrder)];
        if (o) copyText(o.keys.join('\n'), `${o.keys.length} key(s) copied`);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
});

requireAuth(load);
</script>
</body>
</html>
