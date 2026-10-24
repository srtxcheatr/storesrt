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
.sup-tk { background: var(--glass-panel); border: 1px solid var(--glass-border); border-radius: var(--radius-md); padding: 12px 14px; margin-bottom: 10px; }
.sup-tk-top { display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; }
.sup-id { font-family: 'JetBrains Mono', monospace; font-size: 12px; font-weight: 700; overflow-wrap: anywhere; }
.sup-badge { font-size: 10.5px; font-weight: 800; letter-spacing: .06em; padding: 3px 9px; border-radius: 999px; border: 1px solid; white-space: nowrap; }
.sup-badge.pending { color: #f5a623; border-color: rgba(245,166,35,.5); background: rgba(245,166,35,.12); }
.sup-badge.solved { color: var(--neon-green); border-color: rgba(34,197,94,.5); background: rgba(34,197,94,.12); }
.sup-type { font-size: 11.5px; color: var(--neon-blue); margin-top: 6px; font-weight: 700; }
.sup-desc { font-size: 13px; margin-top: 4px; line-height: 1.55; overflow-wrap: anywhere; white-space: pre-wrap; }
.sup-date { font-size: 10.5px; color: var(--text-muted); margin-top: 6px; }
.sup-reply { margin-top: 10px; border-left: 3px solid var(--neon-green); background: rgba(34,197,94,.07); border-radius: 0 var(--radius-sm) var(--radius-sm) 0; padding: 8px 10px; }
.sup-reply .who { font-size: 10.5px; font-weight: 800; color: var(--neon-green); letter-spacing: .06em; }
.sup-reply .txt { font-size: 13px; line-height: 1.55; margin-top: 3px; white-space: pre-wrap; overflow-wrap: anywhere; }
.sup-reply img { display: block; max-width: 100%; max-height: 320px; border-radius: var(--radius-sm); margin-top: 8px; border: 1px solid var(--glass-border); }
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
import { requireAuth, backendFetch, toast, esc } from '/assets/js/app.js?v=20261018-2';

const $ = (id) => document.getElementById(id);
const MIN = 10, MAX = 50;
let state = { tickets: [], pendingId: null };
let busy = false, pollTimer = null;

const len = (s) => [...s].length;
const clean = (s) => String(s || '').replace(/\s+/g, ' ').trim();
const fmt = (iso) => { const d = new Date(iso); return isNaN(d) ? '' : d.toLocaleString(undefined, { dateStyle: 'medium', timeStyle: 'short' }); };
// only https image links are ever put in <img src>
const safeImg = (u) => { try { const x = new URL(u); return x.protocol === 'https:' ? x.href : ''; } catch (_) { return ''; } };

function renderMe(me) {
    $('meUid').textContent = me.uid || '—';
    $('meName').textContent = me.name || '—';
    $('mePhone').textContent = me.phone || '—';
    $('meIp').textContent = me.ip || '—';
}

function renderTicket(t) {
    const status = t.status === 'Solved' ? 'solved' : 'pending';
    const replies = (t.replies || []).map((r) => {
        const img = r.photoUrl ? safeImg(r.photoUrl) : '';
        return `<div class="sup-reply">
            <div class="who"><i class="fas fa-user-shield"></i> ADMIN REPLY · ${esc(fmt(r.at))}</div>
            ${r.text ? `<div class="txt">${esc(r.text)}</div>` : ''}
            ${img ? `<a href="${esc(img)}" target="_blank" rel="noopener noreferrer"><img src="${esc(img)}" alt="Admin photo" loading="lazy" referrerpolicy="no-referrer"></a>` : ''}
        </div>`;
    }).join('');
    return `<div class="sup-tk">
        <div class="sup-tk-top"><span class="sup-id">${esc(t.ticketId)}</span><span class="sup-badge ${status}">${status === 'solved' ? 'SOLVED' : 'PENDING'}</span></div>
        <div class="sup-type">${esc(t.type)}</div>
        <div class="sup-desc">${esc(t.description)}</div>
        <div class="sup-date">${esc(fmt(t.createdAt))}${t.solvedAt ? ' · solved ' + esc(fmt(t.solvedAt)) : ''}</div>
        ${replies}
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
    schedulePoll();
}

function apply(d) {
    state.tickets = d.tickets || [];
    state.pendingId = d.pendingTicketId || (state.tickets.find((t) => t.status === 'Pending') || {}).ticketId || null;
    if (d.me) renderMe(d.me);
    render();
}

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
            if (d.ticket && d.ticket.status === 'Solved') return load(true);
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

$('supSubmit').addEventListener('click', async () => {
    if (busy) return;
    const type = $('supType').value;
    const description = clean($('supDesc').value);
    if (!type) return toast('Choose a bug type', 'error');
    if (len(description) < MIN || len(description) > MAX) return toast(`Description must be ${MIN}–${MAX} characters`, 'error');
    busy = true; $('supSubmit').disabled = true;
    try {
        await backendFetch('/api/support/tickets', { method: 'POST', body: JSON.stringify({ type, description }) });
        $('supType').value = ''; $('supDesc').value = ''; updateCount();
        toast('Report sent to admin', 'success');
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        busy = false; $('supSubmit').disabled = false;
        await load(true);            // also shows the pending banner if the server says one already exists
    }
});

$('supCancelBtn').addEventListener('click', async () => {
    if (busy || !state.pendingId) return;
    if (!confirm('Cancel your pending ticket? You can then send a new report.')) return;
    busy = true; $('supCancelBtn').disabled = true;
    try {
        await backendFetch('/api/support/tickets/' + encodeURIComponent(state.pendingId) + '/cancel', { method: 'POST' });
        toast('Ticket cancelled', 'success');
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        busy = false; $('supCancelBtn').disabled = false;
        await load(true);
    }
});

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
