<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Support — SRT X CHEATS';
$currentPage = 'support';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<style>
.sup-grid { display: grid; gap: 14px; grid-template-columns: 1fr; }
@media (min-width: 900px) { .sup-grid { grid-template-columns: minmax(0, 5fr) minmax(0, 6fr); align-items: start; } }
.sup-me { display: grid; grid-template-columns: 1fr; gap: 6px; margin-bottom: 14px; }
@media (min-width: 480px) { .sup-me { grid-template-columns: 1fr 1fr; } }
.sup-me .it { background: var(--glass-panel); border: 1px solid var(--glass-border); border-radius: var(--radius-sm); padding: 8px 10px; min-width: 0; }
.sup-me .it .k { font-size: 10px; letter-spacing: .08em; color: var(--text-muted); text-transform: uppercase; }
.sup-me .it .v { font-size: 12.5px; color: var(--text-primary); font-family: 'JetBrains Mono', monospace; overflow-wrap: anywhere; }
.sup-count { font-size: 11px; color: var(--text-muted); text-align: right; margin-top: 4px; }
.sup-count.bad { color: var(--neon-red); }
.sup-banner { display: flex; gap: 10px; align-items: flex-start; border: 1px solid rgba(245,166,35,.45); background: rgba(245,166,35,.1); border-radius: var(--radius-md); padding: 10px 12px; margin-bottom: 12px; font-size: 12.5px; line-height: 1.5; }
.sup-banner i { color: #f5a623; margin-top: 2px; }
.sup-banner .btn { width: auto; padding: 6px 12px; font-size: 12px; margin-top: 8px; }
.sup-tk { background: var(--glass-panel); border: 1px solid var(--glass-border); border-radius: var(--radius-md); margin-bottom: 8px; overflow: hidden; }
.sup-tk.open { border-color: var(--neon-blue); }
.sup-row { display: grid; grid-template-columns: auto minmax(0, 1fr) auto auto; align-items: center; gap: 4px 10px; width: 100%; padding: 10px 12px; background: none; border: 0; color: inherit; font: inherit; text-align: left; cursor: pointer; }
.sup-row:focus-visible { outline: 2px solid var(--neon-blue); outline-offset: -2px; }
.sup-row .d { font-size: 10.5px; color: var(--text-muted); white-space: nowrap; }
.sup-row .sep { display: none; }
.sup-id { font-family: 'JetBrains Mono', monospace; font-size: 12px; font-weight: 700; overflow-wrap: anywhere; }
.sup-chev { font-size: 11px; color: var(--text-muted); transition: transform .2s; }
.sup-tk.open .sup-chev { transform: rotate(180deg); }
@media (max-width: 479px) { .sup-row { grid-template-columns: minmax(0, 1fr) auto auto; } .sup-row .d { grid-column: 1 / -1; } }
.sup-badge { font-size: 10.5px; font-weight: 800; letter-spacing: .06em; padding: 3px 9px; border-radius: 999px; border: 1px solid; white-space: nowrap; }
.sup-badge.pending { color: #f5a623; border-color: rgba(245,166,35,.5); background: rgba(245,166,35,.12); }
.sup-badge.solved { color: var(--neon-green); border-color: rgba(34,197,94,.5); background: rgba(34,197,94,.12); }
.sup-body { padding: 0 14px 12px; border-top: 1px solid var(--glass-border); }
.sup-type { font-size: 11.5px; color: var(--neon-blue); margin-top: 10px; font-weight: 700; }
.sup-desc { font-size: 13px; margin-top: 4px; line-height: 1.55; overflow-wrap: anywhere; white-space: pre-wrap; }
.sup-date { font-size: 10.5px; color: var(--text-muted); margin-top: 6px; }
.sup-wait { font-size: 12px; color: #f5a623; margin-top: 10px; }
.sup-thumbs { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 8px; }
.sup-thumbs img { width: 72px; height: 72px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--glass-border); display: block; }
.sup-reply { margin-top: 10px; border-left: 3px solid var(--neon-green); background: rgba(34,197,94,.07); border-radius: 0 var(--radius-sm) var(--radius-sm) 0; padding: 8px 10px; }
.sup-reply .who { font-size: 10.5px; font-weight: 800; color: var(--neon-green); letter-spacing: .06em; }
.sup-reply .txt { font-size: 13px; line-height: 1.55; margin-top: 3px; white-space: pre-wrap; overflow-wrap: anywhere; }
.sup-reply img { display: block; max-width: 100%; max-height: 220px; border-radius: var(--radius-sm); margin-top: 8px; border: 1px solid var(--glass-border); }
.sup-cancel { width: auto; padding: 6px 12px; font-size: 12px; margin-top: 10px; }
.sup-up-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 6px; }
.sup-up-add { width: 72px; height: 72px; border: 1.5px dashed var(--glass-border); border-radius: var(--radius-sm); background: var(--glass-panel); color: var(--text-muted); cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; font-size: 10.5px; }
.sup-up-add:hover { border-color: var(--neon-blue); color: var(--neon-blue); }
.sup-up-item { position: relative; width: 72px; height: 72px; }
.sup-up-item img { width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--glass-border); }
.sup-up-item button { position: absolute; top: -7px; right: -7px; width: 22px; height: 22px; border-radius: 50%; border: 0; background: var(--neon-red); color: #fff; font-size: 11px; cursor: pointer; line-height: 1; }
.sup-hint { font-size: 11px; color: var(--text-muted); margin-top: 6px; }
.sup-empty { text-align: center; padding: 26px 10px; color: var(--text-muted); font-size: 13px; }
.sup-tools { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; gap: 8px; }
.sup-tools .btn { width: auto; padding: 6px 12px; font-size: 12px; }
</style>

<div class="term-window">
    <div class="term-content">
        <div class="prompt-header"><i class="fas fa-headset"></i> SUPPORT</div>

        <div class="sup-grid">
            <!-- Report a problem -->
            <div class="panel">
                <div style="font-weight:800;font-size:14px;margin-bottom:10px"><i class="fas fa-bug"></i> Report a problem</div>

                <div class="sup-me" id="supMe">
                    <div class="it"><div class="k">UID</div><div class="v" id="meUid">—</div></div>
                    <div class="it"><div class="k">Name</div><div class="v" id="meName">—</div></div>
                    <div class="it"><div class="k">Phone</div><div class="v" id="mePhone">—</div></div>
                    <div class="it"><div class="k">IP address</div><div class="v" id="meIp">—</div></div>
                </div>

                <div class="sup-banner hidden" id="supPendingBanner" role="status">
                    <i class="fas fa-hourglass-half"></i>
                    <div>
                        You already have a pending ticket: <b class="sup-id" id="supPendingId"></b>.<br>
                        Wait for the admin's reply, or cancel it to send a new report.
                        <div><button type="button" class="btn btn-danger" id="supCancelBtn"><i class="fas fa-ban"></i> Cancel pending ticket</button></div>
                        <div class="sup-hint" id="supCancelLeft"></div>
                    </div>
                </div>

                <div id="supForm">
                    <div class="field">
                        <label for="supType"><i class="fas fa-list"></i> Bug type</label>
                        <select id="supType">
                            <option value="">Choose bug type</option>
                            <option value="Payment Issues">Payment Issues</option>
                            <option value="Product Problem">Product Problem</option>
                            <option value="APK Update Not Found">APK Update Not Found</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="supDesc"><i class="fas fa-comment-dots"></i> Describe your issue (10–50 characters)</label>
                        <textarea id="supDesc" rows="3" maxlength="50" placeholder="Describe your issue..." autocomplete="off"></textarea>
                        <div class="sup-count" id="supCount">0 / 50</div>
                    </div>
                    <div class="field">
                        <label><i class="fas fa-image"></i> Screenshots of the bug / glitch <span style="color:var(--text-muted)">(optional, up to 3)</span></label>
                        <div class="sup-up-row" id="supUpRow"></div>
                        <input type="file" id="supFile" accept="image/png,image/jpeg,image/webp" multiple hidden>
                        <div class="sup-hint">PNG, JPG or WebP. Photos are shrunk automatically before sending.</div>
                    </div>
                    <button type="button" class="btn btn-solid" id="supSubmit"><i class="fas fa-paper-plane"></i> Send Report</button>
                </div>
            </div>

            <!-- Ticket history -->
            <div class="panel">
                <div class="sup-tools">
                    <div style="font-weight:800;font-size:14px"><i class="fas fa-ticket"></i> Ticket history</div>
                    <button type="button" class="btn btn-ghost" id="supRefresh"><i class="fas fa-rotate"></i> Refresh</button>
                </div>
                <div id="supList">
                    <div class="sup-empty"><i class="fas fa-circle-notch fa-spin" style="font-size:22px;color:var(--neon-blue)"></i><div style="margin-top:8px">Loading tickets...</div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, toast, esc } from '/assets/js/app.js?v=20261025-4';

const $ = (id) => document.getElementById(id);
const MIN = 10, MAX = 50;
let state = { tickets: [], pendingId: null, cancels: { max: 2, left: 2 } };
let busy = false, pollTimer = null;
const openIds = new Set();            // tickets the user has expanded (survives refresh / polling)
let files = [];                       // [{ dataUrl }] screenshots waiting to be sent
const MAX_IMG = 3;

const len = (s) => [...s].length;
const clean = (s) => String(s || '').replace(/\s+/g, ' ').trim();
const fmt = (iso) => { const d = new Date(iso); return isNaN(d) ? '' : d.toLocaleString(undefined, { dateStyle: 'medium', timeStyle: 'short' }); };
// only https image links are ever put in <img src>
const safeImg = (u) => { try { const x = new URL(u); return x.protocol === 'https:' ? x.href : ''; } catch (_) { return ''; } };
const imgLink = (u, cls) => { const i = safeImg(u); return i ? `<a href="${esc(i)}" target="_blank" rel="noopener noreferrer"><img src="${esc(i)}" alt="Screenshot" loading="lazy" referrerpolicy="no-referrer"></a>` : ''; };

function renderMe(me) {
    $('meUid').textContent = me.uid || '—';
    $('meName').textContent = me.name || '—';
    $('mePhone').textContent = me.phone || '—';
    $('meIp').textContent = me.ip || '—';
}

// One compact row per ticket:  date | SRT_X_xxxxx | [STATUS] ▾   - click to show / hide the details
function renderTicket(t) {
    const solved = t.status === 'Solved';
    const open = openIds.has(t.ticketId);
    const c = state.cancels;
    let body = `<div class="sup-type">${esc(t.type)}</div><div class="sup-desc">${esc(t.description)}</div>`;
    if ((t.attachments || []).length) body += `<div class="sup-thumbs">${t.attachments.map((u) => imgLink(u)).join('')}</div>`;
    if (solved) {
        body += `<div class="sup-date">Solved ${esc(fmt(t.solvedAt))}</div>`;
        body += (t.replies || []).map((r) => `<div class="sup-reply">
            <div class="who"><i class="fas fa-user-shield"></i> ADMIN REPLY · ${esc(fmt(r.at))}</div>
            ${r.text ? `<div class="txt">${esc(r.text)}</div>` : ''}
            ${r.photoUrl ? imgLink(r.photoUrl) : ''}
        </div>`).join('');
    } else {
        body += `<div class="sup-wait"><i class="fas fa-hourglass-half"></i> Waiting for the admin's reply…</div>`;
        body += c.left > 0
            ? `<button type="button" class="btn btn-danger sup-cancel" data-cancel="${esc(t.ticketId)}"><i class="fas fa-ban"></i> Cancel (${c.left} of ${c.max} left)</button>`
            : `<div class="sup-hint">Cancel limit reached. The admin will reply soon.</div>`;
    }
    return `<div class="sup-tk${open ? ' open' : ''}">
        <button type="button" class="sup-row" data-toggle="${esc(t.ticketId)}" aria-expanded="${open}">
            <span class="d">${esc(fmt(t.createdAt))}</span>
            <span class="sup-id">${esc(t.ticketId)}</span>
            <span class="sup-badge ${solved ? 'solved' : 'pending'}">${solved ? 'SOLVED' : 'PENDING'}</span>
            <i class="fas fa-chevron-down sup-chev"></i>
        </button>
        ${open ? `<div class="sup-body">${body}</div>` : ''}
    </div>`;
}

function render() {
    const list = $('supList');
    list.innerHTML = state.tickets.length
        ? state.tickets.map(renderTicket).join('')
        : '<div class="sup-empty"><i class="fas fa-inbox" style="font-size:26px;margin-bottom:8px;display:block"></i>No tickets yet.</div>';
    const pending = !!state.pendingId;
    $('supPendingBanner').classList.toggle('hidden', !pending);
    $('supPendingId').textContent = state.pendingId || '';
    $('supForm').classList.toggle('hidden', pending);
    const c = state.cancels;
    $('supCancelBtn').disabled = c.left <= 0;
    $('supCancelLeft').textContent = c.left > 0 ? `Cancels left: ${c.left} of ${c.max}` : 'Cancel limit reached - please wait for the admin\'s reply.';
    schedulePoll();
}

function apply(d) {
    state.tickets = d.tickets || [];
    state.pendingId = d.pendingTicketId || (state.tickets.find((t) => t.status === 'Pending') || {}).ticketId || null;
    if (d.cancels) state.cancels = d.cancels;
    if (d.me) renderMe(d.me);
    render();
}

// expand / collapse a ticket (event delegation: survives re-render)
$('supList').addEventListener('click', (e) => {
    const cancel = e.target.closest('[data-cancel]');
    if (cancel) return doCancel();
    const row = e.target.closest('[data-toggle]');
    if (!row) return;
    const id = row.getAttribute('data-toggle');
    openIds.has(id) ? openIds.delete(id) : openIds.add(id);
    render();
});

async function load(quiet) {
    try { apply(await backendFetch('/api/support/overview')); }
    catch (e) { if (!quiet) toast(e.message, 'error'); if (!state.tickets.length) $('supList').innerHTML = '<div class="sup-empty">Could not load tickets. Tap Refresh.</div>'; }
}

// while a ticket is pending, check just that one ticket (1 read) so the admin's reply appears by itself
function schedulePoll() {
    clearTimeout(pollTimer);
    if (!state.pendingId) return;
    pollTimer = setTimeout(async () => {
        if (document.hidden) return schedulePoll();
        try {
            const d = await backendFetch('/api/support/tickets/' + encodeURIComponent(state.pendingId));
            if (d.ticket && d.ticket.status === 'Solved') { openIds.add(state.pendingId); return load(true); }
        } catch (e) { if (e.status === 404) return load(true); }
        schedulePoll();
    }, 45000);
}
document.addEventListener('visibilitychange', () => { if (!document.hidden && state.pendingId) load(true); });

function updateCount() {
    const n = len(clean($('supDesc').value));
    const c = $('supCount');
    c.textContent = `${n} / ${MAX}`;
    c.classList.toggle('bad', n > 0 && (n < MIN || n > MAX));
}
$('supDesc').addEventListener('input', updateCount);

// ---- screenshots: pick up to 3, shrink in the browser (max 1280 px JPEG) so uploads stay small and fast
function renderFiles() {
    $('supUpRow').innerHTML = files.map((f, i) => `<div class="sup-up-item"><img src="${f.dataUrl}" alt="Screenshot ${i + 1}"><button type="button" data-rm="${i}" aria-label="Remove image ${i + 1}"><i class="fas fa-xmark"></i></button></div>`).join('')
        + (files.length < MAX_IMG ? '<button type="button" class="sup-up-add" id="supUpAdd"><i class="fas fa-plus" style="font-size:16px"></i>Add</button>' : '');
}
function shrink(file) {
    return new Promise((resolve, reject) => {
        if (!/^image\/(png|jpe?g|webp)$/i.test(file.type)) return reject(new Error('Only PNG, JPG or WebP images are allowed.'));
        const url = URL.createObjectURL(file);
        const img = new Image();
        img.onload = () => {
            URL.revokeObjectURL(url);
            let scale = Math.min(1, 1280 / Math.max(img.width, img.height)), q = 0.82, out = '';
            for (let i = 0; i < 6; i++) {
                const c = document.createElement('canvas');
                c.width = Math.max(1, Math.round(img.width * scale)); c.height = Math.max(1, Math.round(img.height * scale));
                const x = c.getContext('2d'); x.fillStyle = '#fff'; x.fillRect(0, 0, c.width, c.height); x.drawImage(img, 0, 0, c.width, c.height);
                out = c.toDataURL('image/jpeg', q);
                if (out.length < 1_100_000) return resolve(out);
                scale *= 0.8; q = Math.max(0.55, q - 0.07);
            }
            reject(new Error('Image is too large. Pick a smaller one.'));
        };
        img.onerror = () => { URL.revokeObjectURL(url); reject(new Error('Could not read that image.')); };
        img.src = url;
    });
}
$('supUpRow').addEventListener('click', (e) => {
    if (e.target.closest('#supUpAdd')) return $('supFile').click();
    const rm = e.target.closest('[data-rm]');
    if (rm) { files.splice(Number(rm.getAttribute('data-rm')), 1); renderFiles(); }
});
$('supFile').addEventListener('change', async (e) => {
    const picked = [...e.target.files].slice(0, MAX_IMG - files.length);
    if (e.target.files.length > picked.length) toast(`Only ${MAX_IMG} images allowed`, 'error');
    e.target.value = '';
    for (const f of picked) {
        try { files.push({ dataUrl: await shrink(f) }); } catch (err) { toast(err.message, 'error'); }
    }
    renderFiles();
});
renderFiles();

$('supSubmit').addEventListener('click', async () => {
    if (busy) return;
    const type = $('supType').value;
    const description = clean($('supDesc').value);
    if (!type) return toast('Choose a bug type', 'error');
    if (len(description) < MIN || len(description) > MAX) return toast(`Description must be ${MIN}–${MAX} characters`, 'error');
    busy = true; $('supSubmit').disabled = true;
    const label = $('supSubmit').innerHTML;
    if (files.length) $('supSubmit').innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Uploading…';
    try {
        await backendFetch('/api/support/tickets', { method: 'POST', body: JSON.stringify({ type, description, images: files.map((f) => f.dataUrl) }) });
        $('supType').value = ''; $('supDesc').value = ''; files = []; renderFiles(); updateCount();
        toast('Report sent to admin', 'success');
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        busy = false; $('supSubmit').disabled = false; $('supSubmit').innerHTML = label;
        await load(true);            // also shows the pending banner if the server says one already exists
    }
});

async function doCancel() {
    if (busy || !state.pendingId) return;
    const c = state.cancels;
    if (c.left <= 0) return toast('Cancel limit reached', 'error');
    if (!confirm(`Cancel your pending ticket? You have ${c.left} of ${c.max} cancels left. Then you can send a new report.`)) return;
    busy = true;
    try {
        const d = await backendFetch('/api/support/tickets/' + encodeURIComponent(state.pendingId) + '/cancel', { method: 'POST' });
        if (d && d.cancels) state.cancels = d.cancels;
        toast('Ticket cancelled', 'success');
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        busy = false;
        await load(true);
    }
}
$('supCancelBtn').addEventListener('click', doCancel);

$('supRefresh').addEventListener('click', () => load(false));

requireAuth(async (user) => {
    $('meUid').textContent = user.uid;      // shown at once from the verified login; the rest comes from the server
    await load(false);
});
</script>

<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
if (is_readable(__DIR__ . '/includes/copyright.php')) { include __DIR__ . '/includes/copyright.php'; }
?>
</body>
</html>
