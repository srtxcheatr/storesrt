<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'PI Key — SRT X CHEATS';
$currentPage = 'pikey';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>

<div class="term-window">
    <div class="term-content">
        <div id="apiRoot">
            <div class="dim" style="text-align:center;padding:40px 0" id="apiLoading">
                <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue);margin-bottom:8px"></i>
                <div>Loading PI Key...</div>
            </div>

            <div class="hidden" id="apiMain">
                <div class="api-banner hidden" id="offlineBanner"><i class="fas fa-power-off"></i> The API is temporarily switched off by the store. Your key is safe.</div>
                <div class="api-banner hidden" id="disabledBanner"><i class="fas fa-ban"></i> PI key access for your account has been disabled by an admin. Please contact support.</div>

                <div class="panel">
                    <div class="api-label">YOUR PI KEY <span class="dim" style="text-transform:none;letter-spacing:0">(sent as <code>pi_key</code> in the body, or the <code>x-pi-key</code> header)</span></div>
                    <div class="api-token" id="piKeyBox">
                        <span class="api-token-text" id="piKeyText"></span>
                        <button type="button" class="api-icon-btn" id="piKeyEye" title="Show / hide"><i class="fas fa-eye"></i></button>
                        <button type="button" class="api-icon-btn" id="piKeyCopy" title="Copy"><i class="fas fa-copy"></i></button>
                    </div>
                    <button type="button" class="btn btn-primary" id="regenBtn" style="margin-top:14px"><i class="fas fa-key"></i> <span id="regenLabel">GENERATE PI KEY</span></button>
                    <div class="dim" style="font-size:12px;margin-top:10px;line-height:1.6">
                        Read-only key for <b>quick add product</b>. It returns product <b>name, image, pid</b> and <b>all durations</b>.
                        Prices are your <span id="roleLabel">tier</span> price <b>+ <span id="markupLabel">30</span>%</b>. Works for user, reseller and pro reseller accounts. It cannot buy anything.
                    </div>
                </div>

                <div class="panel">
                    <div class="api-label">HOW TO USE (PHP)</div>
                    <div class="api-code-head"><button type="button" class="btn btn-ghost" id="copyCode"><i class="fas fa-copy"></i> COPY CODE</button></div>
                    <pre class="api-code" id="codeBox"></pre>
                    <div class="api-label" style="margin-top:14px">RESPONSE</div>
                    <pre class="api-code" id="respBox"></pre>
                    <ul class="dim" style="font-size:12px;line-height:1.8;margin-top:10px">
                        <li><b>price:</b> already includes the +<span class="markupLabel2">30</span>% for your role &mdash; use it directly as your selling price.</li>
                        <li><b>status:</b> <code>available</code>, <code>out_of_stock</code> or <code>maintenance</code>.</li>
                        <li><b>image:</b> direct https link, ready to save or hot-link.</li>
                        <li>For buying keys, live prices and balance use the Reseller API (<code>api_key</code> + <code>x-master-key</code>).</li>
                    </ul>
                </div>

                <div class="panel">
                    <div class="api-table-head" id="copyAllBar" title="Tap to copy the whole table"><i class="fas fa-table-list"></i><span>PRODUCT PREVIEW &mdash; tap to copy</span></div>
                    <input type="search" id="q" placeholder="Search name, pid or duration" style="width:100%;margin-bottom:12px">
                    <div id="tableBox"></div>
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
import { requireAuth, backendFetch, toast, esc } from '/assets/js/app.js?v=20261025-4';

const ENDPOINT = String(window.BACKEND_URL || '').trim().replace(/\/+$/, '') + '/api/pi/v1';
const DOTS = '\u2022'.repeat(32);
const $ = (id) => document.getElementById(id);
const PHP_OPEN = '<' + '?php';
let overview = null, key = null, show = false, hideTimer = null;

const ROLE = { user: 'USER', reseller: 'RESELLER', pro_reseller: 'PRO RESELLER' };

function buildCode(piKey) {
    return `${PHP_OPEN}
$ch = curl_init('${ENDPOINT}');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query([
        'pi_key' => '${piKey}',
        'action' => 'products'
    ]),
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2
]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
if (!empty($data['success'])) {
    foreach ($data['products'] as $p) {
        echo $p['name'] . ' (pid ' . $p['pid'] . ')' . PHP_EOL;
        echo 'image: ' . $p['image'] . PHP_EOL;
        foreach ($p['durations'] as $d) {
            echo '  ' . $d['duration'] . ' => NRP ' . $d['price'] . PHP_EOL;
        }
    }
} else {
    echo $data['code'] . ': ' . $data['error'];
}`;
}

const RESP = `// 200 OK
{
  "success": true,
  "currency": "NRP",
  "role": "reseller",
  "markup_percent": 30,
  "count": 1,
  "products": [
    {
      "name": "DRIP CLIENT",
      "image": "https://i.ibb.co/xxxx/drip.png",
      "pid": "1",
      "durations": [
        { "duration": "1 Day",  "price": 130,  "status": "available" },
        { "duration": "7 Days", "price": 520,  "status": "available" }
      ]
    }
  ]
}

// 401 { "success": false, "code": "INVALID_CREDENTIALS", "error": "Invalid pi_key." }`;

async function ensureKey() {
    if (key) return key;
    const c = overview.credentials;
    if (!c?.exists) throw new Error('Generate your PI key first.');
    if (!c.revealable) throw new Error('Key cannot be shown. Re-generate to get a new one.');
    key = (await backendFetch('/api/reseller-portal/pi/credentials/reveal')).piKey;
    return key;
}

function scheduleHide() { clearTimeout(hideTimer); hideTimer = setTimeout(() => { show = false; renderKey(); }, 30000); }

function renderKey() {
    const c = overview.credentials;
    $('piKeyText').textContent = show && key ? key : (c.exists ? (c.revealable ? DOTS : (c.prefix || DOTS)) : 'No key yet');
    $('piKeyEye').firstElementChild.className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    $('regenLabel').textContent = c.exists ? 'RE-GENERATE PI KEY' : 'GENERATE PI KEY';
    $('regenBtn').disabled = !!c.disabled;
    $('disabledBanner').classList.toggle('hidden', !c.disabled);
    $('offlineBanner').classList.toggle('hidden', overview.api.enabled);
    $('codeBox').textContent = buildCode(show && key ? key : 'YOUR_PI_KEY');
}

function groupsText(list) {
    return list.map((g) => `${g.name} (PID: ${g.pid})\n` + g.durations.map((d) => `  - ${d.duration} | NRP ${d.price}` + (d.status !== 'available' ? ` | ${d.status}` : '')).join('\n')).join('\n\n');
}

function renderTable() {
    const q = $('q').value.trim().toLowerCase();
    const list = (overview.products || []).filter((g) => !q || g.name.toLowerCase().includes(q) || String(g.pid).toLowerCase().includes(q) || g.durations.some((d) => String(d.duration).toLowerCase().includes(q)));
    $('tableBox').innerHTML = list.length ? list.map((g) => `
        <div style="display:flex;gap:12px;align-items:flex-start;margin-bottom:14px">
            ${g.image ? `<img src="${esc(g.image)}" alt="" style="width:48px;height:48px;border-radius:8px;object-fit:cover" loading="lazy">` : ''}
            <div><b>${esc(g.name)}</b> <span class="dim">PID ${esc(g.pid)}</span>
                <div class="dim" style="font-size:12px;line-height:1.7">${g.durations.map((d) => `${esc(d.duration)} &mdash; NRP ${esc(d.price)}`).join('<br>')}</div>
            </div>
        </div>`).join('') : '<div class="dim">No products found.</div>';
}

async function copyText(t, msg) { try { await navigator.clipboard.writeText(t); toast(msg || 'Copied', 'success'); } catch { toast('Copy failed', 'error'); } }

async function load() {
    try { overview = await backendFetch('/api/reseller-portal/pi/overview'); }
    catch (e) { $('apiLoading').innerHTML = `<div style="color:var(--neon-red,#ff4d4d);font-size:12px"><i class="fas fa-triangle-exclamation"></i> Couldn't load: ${esc(e.message)}</div>`; return; }
    $('roleLabel').textContent = ROLE[overview.role] || 'tier';
    $('markupLabel').textContent = overview.api.markupPercent;
    document.querySelectorAll('.markupLabel2').forEach((el) => { el.textContent = overview.api.markupPercent; });
    $('respBox').textContent = RESP;
    $('apiLoading').classList.add('hidden');
    $('apiMain').classList.remove('hidden');
    renderKey(); renderTable();
}

$('piKeyEye').onclick = async () => { if (!show) { try { await ensureKey(); } catch (e) { toast(e.message, 'error'); return; } scheduleHide(); } show = !show; renderKey(); };
$('piKeyCopy').onclick = async () => { try { copyText(await ensureKey(), 'PI key copied'); } catch (e) { toast(e.message, 'error'); } };
$('copyCode').onclick = async () => { let k = 'YOUR_PI_KEY'; try { k = await ensureKey(); } catch {} copyText(buildCode(k), 'Code copied'); };
$('copyAllBar').onclick = () => copyText(groupsText(overview.products || []), 'Product table copied');
$('q').oninput = renderTable;
$('regenBtn').onclick = async () => {
    if (overview.credentials.exists && !confirm('Re-generating will stop your old pi_key. Continue?')) return;
    $('regenBtn').disabled = true;
    try {
        const r = await backendFetch('/api/reseller-portal/pi/credentials', { method: 'POST', body: JSON.stringify({}) });
        key = r.piKey; show = true; scheduleHide();
        overview = await backendFetch('/api/reseller-portal/pi/overview');
        renderKey(); toast('PI key ready — copy it now', 'success');
    } catch (e) { toast(e.message || 'Failed', 'error'); }
    $('regenBtn').disabled = false;
};

requireAuth(load);
</script>
</body>
</html>
