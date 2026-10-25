<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
$pageTitle = 'FF Glory Bot — SRT X CHEATS';
$currentPage = 'glorybot';
require __DIR__ . '/includes/head.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
require __DIR__ . '/includes/nav.php';
?>

<div class="term-window">
    <div class="term-content">

        <div class="dash-hero tilt">
            <div class="dash-hero-top">
                <div>
                    <div class="dash-hero-label"><i class="fas fa-wallet" style="color:var(--neon-amber)"></i> BALANCE</div>
                    <div class="dash-hero-amount gold-text mono-num">NRP <span id="gbBalance">—</span></div>
                </div>
                <div class="dash-hero-status">
                    <div class="dim" style="font-size:11px"><i class="fas fa-robot" style="color:var(--neon-green)"></i> SERVICE</div>
                    <div style="font-weight:700;font-size:13px;color:var(--neon-green)">FF GLORY BOT</div>
                </div>
            </div>
            <div class="dash-hero-actions">
                <a href="/admin/owner.php" class="btn btn-solid"><i class="fas fa-circle-plus"></i> Add Balance</a>
                <a href="/dashboard.php" class="btn btn-ghost"><i class="fas fa-gauge-high"></i> Dashboard</a>
            </div>
        </div>

        <div class="panel gb-launch">
            <div class="gb-sec-head">
                <span class="gb-sec-icon green"><i class="fas fa-bolt"></i></span>
                <span class="gb-sec-title green">Launch New Group</span>
            </div>

            <div class="gb-stock hidden" id="gbStock"></div>

            <div class="gb-label"><i class="fas fa-earth-asia"></i> ACCOUNTS REGION</div>
            <button type="button" class="gb-select" id="gbSelect" disabled>
                <span class="gb-select-val" id="gbSelectVal">Loading servers…</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="gb-cost" id="gbCost">Cost: <b>—</b></div>

            <div class="gb-label" style="margin-top:18px"><i class="fas fa-people-group"></i> CLAN ID</div>
            <input id="gbClan" class="gb-input" type="text" inputmode="numeric" autocomplete="off" placeholder="e.g. 123456789" maxlength="15">

            <button class="gb-launch-btn" id="gbLaunchBtn" disabled>
                <span class="btn-text"><i class="fas fa-rocket"></i> Launch Glory Bot</span>
            </button>
            <div class="dim" id="gbMsg" style="font-size:11px;margin-top:8px;text-align:center"></div>
        </div>

        <div class="panel gb-groups">
            <div class="gb-sec-head" style="justify-content:space-between">
                <span style="display:flex;align-items:center;gap:12px">
                    <span class="gb-sec-icon blue"><i class="fas fa-robot"></i></span>
                    <span class="gb-sec-title blue">My Active Groups</span>
                    <span class="gb-count" id="gbCount">0</span>
                </span>
                <button class="gb-refresh" id="gbRefreshAll"><i class="fas fa-rotate"></i> Refresh</button>
            </div>

            <div class="gb-usage-head">
                <span class="dim">Groups Usage</span>
                <span class="mono-num" id="gbUsageText">0 / 0</span>
            </div>
            <div class="gb-usage-track"><div class="gb-usage-fill" id="gbUsageFill"></div></div>

            <div id="gbList" style="margin-top:16px">
                <div class="dim" style="text-align:center;padding:24px">
                    <i class="fas fa-circle-notch fa-spin" style="font-size:22px;color:var(--neon-blue)"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="gbSheetOv" class="gb-sheet-ov hidden">
    <div class="gb-sheet" id="gbSheet"></div>
</div>

<div id="gbLaunchOv" class="gl-ov hidden" role="dialog" aria-modal="true" aria-labelledby="glTitle">
    <div class="gl-box" id="glBox" data-state="warn">

        <div class="gl-view" data-view="warn">
            <div class="gl-icon warn"><i class="fas fa-triangle-exclamation"></i></div>
            <h3 class="gl-title" id="glTitle">Warning</h3>
            <p class="gl-sub">Do this in Free Fire before you launch:</p>
            <ol class="gl-steps">
                <li><span>1</span><div><b>Open the game</b></div></li>
                <li><span>2</span><div><b>Tap on Guild</b></div></li>
                <li><span>3</span><div><b>Go to Guild Settings</b></div></li>
                <li><span>4</span><div><b>Reset everything to default</b><small>CS Rank, BR Rank and Level &mdash; set all to default, and turn <u>Auto Approval OFF</u>.</small></div></li>
            </ol>
            <div class="gl-meta" id="glMeta"></div>
            <div class="gl-actions">
                <button type="button" class="gl-btn ghost" id="glCancel">Cancel</button>
                <button type="button" class="gl-btn go" id="glGo"><i class="fas fa-rocket"></i> Launch Bot</button>
            </div>
        </div>

        <div class="gl-view" data-view="busy">
            <div class="gl-rocket">
                <span class="gl-ring"></span><span class="gl-ring r2"></span>
                <i class="fas fa-rocket"></i>
            </div>
            <h3 class="gl-title">Launching your bot…</h3>
            <p class="gl-sub" id="glStatus">Contacting server…</p>
            <div class="gl-bar"><i></i></div>
            <p class="gl-hint">This can take up to 90 seconds. Please keep this page open.</p>
        </div>

        <div class="gl-view" data-view="ok">
            <div class="gl-icon ok">
                <svg viewBox="0 0 52 52" width="44" height="44"><path d="M14 27l8 8 16-17" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3 class="gl-title">Bot launched!</h3>
            <p class="gl-sub">Your glory bot is starting. Live info will appear in My Active Groups in a moment.</p>
            <div class="gl-actions"><button type="button" class="gl-btn go" id="glDone"><i class="fas fa-check"></i> Done</button></div>
        </div>

        <div class="gl-view" data-view="err">
            <div class="gl-icon err"><i class="fas fa-xmark"></i></div>
            <h3 class="gl-title">Couldn&rsquo;t launch</h3>
            <p class="gl-sub" id="glErr"></p>
            <div class="gl-actions"><button type="button" class="gl-btn ghost" id="glErrClose">Close</button></div>
        </div>
    </div>
</div>

<div id="gbRefundOv" class="gl-ov hidden" role="dialog" aria-modal="true" aria-labelledby="rfTitle">
    <div class="gl-box" id="rfBox" data-state="ask">
        <div class="gl-view" data-view="ask">
            <div class="gl-icon warn"><i class="fas fa-rotate-left"></i></div>
            <h3 class="gl-title" id="rfTitle">Refund this group?</h3>
            <p class="gl-sub">We will ask FF Glory to refund this bot. If it is approved, your NRP goes back to your balance. If it is not, you will see why and nothing changes.</p>
            <div class="gl-meta" id="rfMeta"></div>
            <div class="gl-actions">
                <button type="button" class="gl-btn ghost" id="rfCancel">Cancel</button>
                <button type="button" class="gl-btn go" id="rfGo"><i class="fas fa-rotate-left"></i> Request refund</button>
            </div>
        </div>
        <div class="gl-view" data-view="busy">
            <div class="gl-rocket"><span class="gl-ring"></span><span class="gl-ring r2"></span><i class="fas fa-rotate-left"></i></div>
            <h3 class="gl-title">Asking FF Glory…</h3>
            <p class="gl-sub">Waiting for the refund to be confirmed.</p>
            <div class="gl-bar"><i></i></div>
            <p class="gl-hint">This can take up to 90 seconds. Please keep this page open.</p>
        </div>
        <div class="gl-view" data-view="ok">
            <div class="gl-icon ok"><svg viewBox="0 0 52 52" width="44" height="44"><path d="M14 27l8 8 16-17" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
            <h3 class="gl-title">Refunded</h3>
            <p class="gl-sub" id="rfOk"></p>
            <div class="gl-actions"><button type="button" class="gl-btn go" id="rfDone"><i class="fas fa-check"></i> Done</button></div>
        </div>
        <div class="gl-view" data-view="err">
            <div class="gl-icon err"><i class="fas fa-xmark"></i></div>
            <h3 class="gl-title">Refund not possible</h3>
            <p class="gl-sub" id="rfErr"></p>
            <div class="gl-actions"><button type="button" class="gl-btn ghost" id="rfErrClose">Close</button></div>
        </div>
    </div>
</div>

<div id="gbModal" class="modal-overlay hidden">
    <div class="panel gb-modal">
        <div class="prompt-header" id="gbModalTitle" style="justify-content:center"></div>
        <div id="gbModalBody" class="gb-kv"></div>
        <div style="display:flex;gap:8px;margin-top:14px">
            <button class="btn btn-ghost" id="gbModalCopy" style="flex:1"><i class="fas fa-copy"></i> Copy</button>
            <button class="btn btn-solid" id="gbModalClose" style="flex:1"><i class="fas fa-xmark"></i> Close</button>
        </div>
    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-sec-head { display:flex; align-items:center; gap:14px; margin-bottom:18px; }
.gb-sec-icon { width:46px; height:46px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; border:1px solid; }
.gb-sec-icon.green { color:#34d399; background:rgba(16,185,129,.12); border-color:rgba(16,185,129,.4); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-sec-icon.blue { color:#60a5fa; background:rgba(59,130,246,.12); border-color:rgba(59,130,246,.4); }
.gb-sec-title { font-size:21px; font-weight:800; letter-spacing:.2px; }
.gb-sec-title.green { color:#34d399; }
.gb-sec-title.blue { color:#60a5fa; }
.gb-count { font-size:12px; font-weight:800; padding:2px 8px; border-radius:6px; background:rgba(255,255,255,.12); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.gb-launch { border-color:rgba(52,211,153,.22); }
.gb-label { font-size:13px; letter-spacing:1.2px; font-weight:700; color:var(--text-muted); display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.gb-select {
    width:100%; display:flex; align-items:center; justify-content:space-between; gap:10px; cursor:pointer;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background:rgba(0,0,0,.35); color:var(--text-primary); font:inherit; font-size:16px;
    border:1.5px solid rgba(255,255,255,.85); border-radius:16px; padding:16px 18px;
}
.gb-select:disabled { opacity:.6; cursor:wait; }
.gb-select-val { display:flex; align-items:center; gap:10px; min-width:0; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-select i { color:var(--text-muted); }
.gb-cost { margin:12px 2px 0; font-size:15px; color:var(--text-muted); }
.gb-cost b { color:#60a5fa; font-weight:800; }
.gb-cost .gb-price { color:#4ade80; margin-left:6px; }
.gb-input {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    width:100%; background:rgba(0,0,0,.35); color:var(--text-primary); font:inherit; font-size:17px;
    border:1.5px solid var(--glass-border); border-radius:16px; padding:17px 18px; outline:none; box-sizing:border-box;
}
.gb-input:focus { border-color:#34d399; }
.gb-launch-btn {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    width:100%; margin-top:24px; border:0; cursor:pointer; font:inherit; font-weight:800; font-size:17px;
    padding:18px 16px; border-radius:99px; color:#fff; line-height:1.3;
    background:linear-gradient(135deg,#10b981,#047857); box-shadow:0 6px 22px rgba(16,185,129,.28);
    transition:transform .12s, opacity .12s;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-launch-btn:active { transform:scale(.98); }
.gb-launch-btn:disabled { opacity:.55; cursor:not-allowed; box-shadow:none; background:linear-gradient(135deg,#0f6b4e,#0a4d38); color:rgba(255,255,255,.75); }
.gb-launch-btn .fa-spin { margin-right:8px; }

.gb-flag { width:34px; height:24px; border-radius:4px; object-fit:cover; flex-shrink:0; display:inline-flex; align-items:center; justify-content:center; font-size:22px; line-height:1; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-miniflag { width:20px; height:14px; border-radius:3px; object-fit:cover; display:inline-flex; align-items:center; justify-content:center; font-size:14px; }
.gb-tier { font-weight:600; }

.gb-sheet-ov { position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.6); display:flex; align-items:flex-end; justify-content:center; }
.gb-sheet-ov.hidden { display:none !important; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-sheet { width:100%; max-width:520px; max-height:88vh; overflow-y:auto; background:#fafafa; color:#1a1a1a; border-radius:26px 26px 0 0; animation:gbUp .22s ease-out; }
@keyframes gbUp { from { transform:translateY(40px); opacity:.3; } to { transform:none; opacity:1; } }
.gb-opt { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:18px 20px; border:0; border-bottom:1px solid #e3e3e3; background:transparent; width:100%; font:inherit; font-size:18px; color:#1a1a1a; text-align:left; cursor:pointer; }
.gb-opt:last-child { border-bottom:0; }
.gb-opt-l { display:flex; align-items:center; gap:12px; min-width:0; flex-wrap:wrap; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-opt-price { font-size:12px; font-weight:700; color:#8a5a00; background:#fff1d6; padding:2px 8px; border-radius:99px; }
.gb-radio { width:26px; height:26px; border-radius:50%; border:2px solid #444; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
.gb-opt.sel .gb-radio { border-color:#16a34a; }
.gb-opt.sel .gb-radio::after { content:''; width:14px; height:14px; border-radius:50%; background:#16a34a; }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-usage-head { display:flex; justify-content:space-between; align-items:center; margin:0 2px 8px; font-size:15px; }
.gb-usage-track { height:8px; border-radius:99px; background:rgba(255,255,255,.08); overflow:hidden; }
.gb-usage-fill { height:100%; width:0; border-radius:99px; background:linear-gradient(90deg,#3b82f6,#60a5fa); transition:width .4s; min-width:6px; }
.gb-refresh { border:0; cursor:pointer; font:inherit; font-size:12px; font-weight:700; padding:9px 14px; border-radius:8px; background:linear-gradient(135deg,#f3e6cf,#d9c7a6); color:#2a2112; white-space:nowrap; }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-card {
    position:relative; border-radius:20px; padding:16px; margin-bottom:14px; overflow:hidden;
    background:linear-gradient(180deg,rgba(40,30,16,.92),rgba(22,18,12,.96));
    border:1px solid rgba(245,183,59,.22); box-shadow:0 8px 28px rgba(0,0,0,.35);
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-card::before { content:''; position:absolute; left:0; right:0; top:0; height:2px; background:linear-gradient(90deg,transparent,#f5b73b,transparent); opacity:.55; }
html[data-theme="light"] .gb-card { background:linear-gradient(180deg,#fff8ea,#fff3dc); border-color:rgba(201,133,18,.35); box-shadow:0 6px 20px rgba(120,80,10,.12); }
html[data-theme="light"] .gb-card, html[data-theme="light"] .gb-card .gb-v, html[data-theme="light"] .gb-card .gb-id b { color:#2a2112; }

.gb-clanbox { display:flex; gap:12px; align-items:center; margin-bottom:12px; padding-bottom:12px; border-bottom:1px solid rgba(245,183,59,.15); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-clan-badge { position:relative; width:54px; height:54px; border-radius:14px; border:2px solid #f5b73b; background:rgba(245,183,59,.1); display:flex; align-items:center; justify-content:center; font-size:24px; color:#f5b73b; flex-shrink:0; }
.gb-clan-lv { position:absolute; bottom:-2px; right:-2px; background:#f5b73b; color:#1a1305; font-size:9.5px; font-weight:900; padding:1px 5px; border-radius:6px 0 12px 0; }
.gb-clan-name { font-family:'Orbitron',var(--font-mono),sans-serif; font-weight:900; font-size:18px; letter-spacing:.5px; color:#f5b73b; line-height:1.1; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.gb-clan-sub { font-size:11px; color:var(--text-muted); margin-top:3px; }
.gb-mini { display:flex; justify-content:space-between; gap:8px; margin-bottom:12px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-mini > div { flex:1; min-width:0; }
.gb-mini .gb-k { font-size:9.5px; font-weight:800; letter-spacing:.5px; text-transform:uppercase; color:var(--text-muted); }
.gb-mini .gb-v { font-weight:800; font-size:15px; color:#f5b73b; font-family:var(--font-mono); margin-top:2px; overflow:hidden; text-overflow:ellipsis; }

.gb-head { display:flex; gap:12px; align-items:flex-start; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-shield { width:52px; height:52px; border-radius:14px; flex-shrink:0; background:rgba(245,183,59,.08); border:1px solid rgba(245,183,59,.2); display:flex; align-items:center; justify-content:center; font-size:22px; color:#d9a441; }
.gb-head-main { flex:1; min-width:0; }
.gb-idrow { display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap; }
.gb-id { font-size:11px; color:var(--text-muted); }
.gb-id b { font-family:var(--font-mono); font-size:17px; color:var(--text-primary); margin-left:4px; letter-spacing:.3px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-left:8px; vertical-align:middle; }
.gb-dot.on { background:#22c55e; box-shadow:0 0 0 0 rgba(34,197,94,.7); animation:gbBlink 1.2s ease-in-out infinite; }
.gb-dot.off { background:#ef4444; box-shadow:0 0 8px rgba(239,68,68,.6); }
@keyframes gbBlink { 0%,100% { opacity:1; box-shadow:0 0 0 0 rgba(34,197,94,.65); } 50% { opacity:.35; box-shadow:0 0 0 6px rgba(34,197,94,0); } }
.gb-pill { display:inline-flex; align-items:center; gap:7px; font-size:11px; font-weight:800; letter-spacing:.6px; text-transform:uppercase; padding:6px 12px; border-radius:99px; border:1px solid; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-pdot { width:8px; height:8px; border-radius:50%; background:currentColor; }
.gb-pill.running { color:#22c55e; border-color:rgba(34,197,94,.45); background:rgba(34,197,94,.1); }
.gb-pill.running .gb-pdot { animation:gbBlink 1.2s ease-in-out infinite; }
.gb-pill.stopped, .gb-pill.ended { color:#ef4444; border-color:rgba(239,68,68,.45); background:rgba(239,68,68,.1); }
.gb-pill.unknown { color:#94a3b8; border-color:rgba(148,163,184,.35); background:rgba(148,163,184,.08); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-by .gb-v { font-family:var(--font-heading); font-size:12px; letter-spacing:.8px; color:#f5b73b; line-height:1.3; }
@media (prefers-reduced-motion: reduce) { .gb-dot.on, .gb-pill.running .gb-pdot { animation:none; } }
.gb-updated { font-size:11px; color:var(--text-muted); text-align:right; margin-top:4px; }
.gb-sub { display:flex; gap:14px; flex-wrap:wrap; margin-top:6px; font-size:13px; color:var(--text-primary); align-items:center; }
.gb-sub span { display:inline-flex; align-items:center; gap:6px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-sub i { color:var(--text-muted); font-size:12px; }

.gb-note { font-size:11.5px; margin-top:12px; padding:8px 10px; border-radius:10px; background:rgba(245,183,59,.08); color:var(--text-muted); line-height:1.4; }
.gb-note.err { background:rgba(239,68,68,.1); color:#fca5a5; }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-stats { display:grid; grid-template-columns:1fr 1fr 1.3fr; gap:0; margin:16px 0 14px; }
.gb-stat { padding:0 10px; border-left:1px solid rgba(245,183,59,.15); display:flex; flex-direction:column; gap:3px; min-width:0; }
.gb-stat:first-child { border-left:0; padding-left:0; }
.gb-stat .gb-k { font-size:10.5px; color:var(--text-muted); display:flex; align-items:center; gap:5px; }
.gb-stat .gb-k i { color:#f5b73b; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-stat .gb-v { font-size:17px; font-weight:800; font-family:var(--font-mono); color:var(--text-primary); }
.gb-stat .gb-lm { font-size:14px; line-height:1.2; }
.gb-stat .gb-lm small { display:block; font-size:10.5px; font-weight:600; color:var(--text-muted); margin-top:2px; font-family:var(--font-body); }

.gb-goal-head { display:flex; justify-content:space-between; font-size:11.5px; letter-spacing:.8px; font-weight:700; color:var(--text-muted); margin-bottom:6px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-goal-head b { color:#f5b73b; }
.gb-goal-track { height:8px; border-radius:99px; background:rgba(255,255,255,.07); overflow:hidden; margin-bottom:14px; }
.gb-goal-fill { height:100%; border-radius:99px; background:linear-gradient(90deg,#f5b73b,#e0861a); min-width:5px; transition:width .5s; }

.gb-btns { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-b { border:0; cursor:pointer; font:inherit; font-weight:700; font-size:14px; padding:13px 10px; border-radius:99px; display:flex; align-items:center; justify-content:center; gap:8px; transition:transform .12s; }
.gb-b:active { transform:scale(.97); }
.gb-b:disabled { opacity:.45; cursor:not-allowed; }
.gb-b.restart { background:linear-gradient(135deg,#f0b232,#c98512); color:#1a1305; }
.gb-b.stop { background:transparent; border:1.5px solid rgba(245,183,59,.5); color:#f5b73b; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-b.details { background:linear-gradient(135deg,#f3e6cf,#d9c7a6); color:#2a2112; border-radius:6px; }
.gb-b.delete { background:linear-gradient(135deg,#d93a3a,#b32525); color:#fff; }
.gb-b.squad { grid-column:1 / -1; background:transparent; border:1.5px solid rgba(34,197,94,.4); color:#22c55e; }

.gl-ov { position:fixed; inset:0; z-index:10000; display:flex; align-items:center; justify-content:center; padding:18px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background:rgba(4,3,12,.72); -webkit-backdrop-filter:blur(8px); backdrop-filter:blur(8px); animation:glFade .2s ease both; }
.gl-ov.hidden { display:none !important; }
.gl-ov.closing { animation:glFadeOut .16s ease both; }
@keyframes glFade { from { opacity:0 } to { opacity:1 } }
@keyframes glFadeOut { to { opacity:0 } }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-box { width:100%; max-width:400px; max-height:92vh; overflow-y:auto; border-radius:24px; padding:26px 22px 22px; text-align:center;
    background:linear-gradient(180deg,#1b1630,#120f22); border:1px solid rgba(255,255,255,.1); box-shadow:0 24px 70px rgba(0,0,0,.6);
    animation:glPop .38s cubic-bezier(.2,1.2,.3,1) both; color:var(--text-primary); }
html[data-theme="light"] .gl-box { background:#fff; border-color:rgba(30,20,60,.1); }
@keyframes glPop { from { opacity:0; transform:translateY(24px) scale(.86); } to { opacity:1; transform:none; } }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-view { display:none; }
.gl-box[data-state="ask"] [data-view="ask"], .gl-box[data-state="warn"] [data-view="warn"], .gl-box[data-state="busy"] [data-view="busy"],
.gl-box[data-state="ok"] [data-view="ok"], .gl-box[data-state="err"] [data-view="err"] { display:block; animation:glView .28s ease both; }
@keyframes glView { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:none; } }
.gl-icon { width:68px; height:68px; margin:0 auto 14px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:30px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-icon.warn { color:#fbbf24; background:rgba(251,191,36,.14); box-shadow:0 0 0 8px rgba(251,191,36,.07); animation:glPulse 1.8s ease-in-out infinite; }
.gl-icon.ok { color:#22c55e; background:rgba(34,197,94,.14); box-shadow:0 0 0 8px rgba(34,197,94,.07); }
.gl-icon.ok path { stroke-dasharray:44; stroke-dashoffset:44; animation:glDraw .5s .15s ease forwards; }
.gl-icon.err { color:#f87171; background:rgba(248,113,113,.14); box-shadow:0 0 0 8px rgba(248,113,113,.07); animation:glShake .45s ease; }
@keyframes glPulse { 50% { transform:scale(1.07); box-shadow:0 0 0 12px rgba(251,191,36,.05); } }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes glDraw { to { stroke-dashoffset:0; } }
@keyframes glShake { 20%,60% { transform:translateX(-6px); } 40%,80% { transform:translateX(6px); } }
.gl-title { font-size:22px; font-weight:800; letter-spacing:.2px; margin:0 0 6px; }
.gl-sub { font-size:14px; color:var(--text-muted); line-height:1.5; margin:0; }
.gl-steps { list-style:none; margin:16px 0 0; padding:0; display:flex; flex-direction:column; gap:8px; text-align:left; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-steps li { display:flex; gap:12px; align-items:flex-start; padding:11px 12px; border-radius:14px; background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.07);
    opacity:0; animation:glView .35s ease forwards; }
html[data-theme="light"] .gl-steps li { background:rgba(30,20,60,.04); border-color:rgba(30,20,60,.08); }
.gl-steps li:nth-child(1) { animation-delay:.12s } .gl-steps li:nth-child(2) { animation-delay:.22s }
.gl-steps li:nth-child(3) { animation-delay:.32s } .gl-steps li:nth-child(4) { animation-delay:.42s }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-steps li > span { flex:0 0 26px; height:26px; border-radius:50%; background:#fbbf24; color:#1a1305; font-weight:800; font-size:13px; display:flex; align-items:center; justify-content:center; }
.gl-steps b { font-size:14.5px; font-weight:700; }
.gl-steps small { display:block; margin-top:3px; font-size:12.5px; line-height:1.45; color:var(--text-muted); }
.gl-steps u { color:#fbbf24; text-decoration:none; font-weight:700; }
.gl-meta { margin-top:14px; font-size:12.5px; color:var(--text-muted); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-meta b { color:var(--text-primary); }
.gl-actions { display:flex; gap:10px; margin-top:18px; }
.gl-btn { flex:1; border:0; cursor:pointer; font:inherit; font-weight:800; font-size:15px; padding:15px 14px; border-radius:99px; display:flex; align-items:center; justify-content:center; gap:8px; transition:transform .12s, filter .15s; }
.gl-btn:active { transform:scale(.97); }
.gl-btn:hover { filter:brightness(1.08); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-btn.go { color:#fff; background:linear-gradient(135deg,#10b981,#047857); box-shadow:0 6px 20px rgba(16,185,129,.3); flex:1.4; }
.gl-btn.ghost { color:var(--text-primary); background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.14); }
html[data-theme="light"] .gl-btn.ghost { background:rgba(30,20,60,.05); border-color:rgba(30,20,60,.14); }
.gl-rocket { position:relative; width:96px; height:96px; margin:2px auto 16px; display:flex; align-items:center; justify-content:center; font-size:34px; color:#34d399; }
.gl-rocket i { animation:glFly 1.3s ease-in-out infinite; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-ring { position:absolute; inset:0; border-radius:50%; border:2px solid rgba(52,211,153,.5); animation:glRing 1.8s ease-out infinite; }
.gl-ring.r2 { animation-delay:.9s; }
@keyframes glFly { 0%,100% { transform:translate(-2px,3px) rotate(-3deg); } 50% { transform:translate(3px,-4px) rotate(3deg); } }
@keyframes glRing { from { transform:scale(.45); opacity:.9; } to { transform:scale(1.15); opacity:0; } }
.gl-bar { height:6px; margin:18px 6px 0; border-radius:99px; background:rgba(255,255,255,.1); overflow:hidden; position:relative; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gl-bar i { position:absolute; top:0; bottom:0; width:40%; border-radius:99px; background:linear-gradient(90deg,#10b981,#34d399); animation:glBar 1.3s ease-in-out infinite; }
@keyframes glBar { from { left:-40%; } to { left:100%; } }
.gl-hint { margin:14px 0 0; font-size:12px; color:var(--text-muted); }
@media (prefers-reduced-motion: reduce) { .gl-box, .gl-view, .gl-steps li, .gl-icon, .gl-rocket i, .gl-ring, .gl-bar i { animation:none !important; opacity:1; } .gl-bar i { left:0; width:100%; } }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-modal { max-width:420px; width:100%; max-height:80vh; display:flex; flex-direction:column; }
.gb-kv { overflow-y:auto; margin-top:8px; font-size:12.5px; }
.gb-kv-row { display:flex; justify-content:space-between; gap:12px; padding:8px 2px; border-bottom:1px solid var(--glass-border); }
.gb-kv-row span:first-child { color:var(--text-muted); text-transform:capitalize; flex-shrink:0; }
.gb-kv-row span:last-child { font-family:var(--font-mono); font-weight:700; text-align:right; word-break:break-all; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-kv-h { margin:14px 0 2px; font-size:11px; letter-spacing:1px; font-weight:800; color:#f5b73b; }
.gb-kv-msg { text-align:center; padding:18px 6px; color:var(--text-muted); line-height:1.5; }
.gb-kv-msg.err { color:#fca5a5; }

@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap');
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.term-content .panel.gb-launch, .term-content .panel.gb-groups, .term-content .panel.gm-panel {
    background:#161616; border:1px solid #2a2a2a; border-radius:26px; padding:20px 18px; box-shadow:none;
}
.gb-sec-icon { background:#202020 !important; border:1px solid #2f2f2f !important; color:#e5e5e5 !important; border-radius:14px; }
.gb-sec-title, .gb-sec-title.green, .gb-sec-title.blue { color:#f4f4f4 !important; font-family:'Chakra Petch','Space Grotesk',sans-serif; font-size:22px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-count { background:#242424; color:#e5e5e5; border-radius:8px; }
.gb-label { color:#a3a3a3; font-family:'Chakra Petch',sans-serif; }
.gb-select { background:#0f0f0f; border:1px solid #333; border-radius:18px; }
.gb-input { background:#0f0f0f; border:1px solid #333; border-radius:18px; }
.gb-input:focus { border-color:#f5b73b; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-cost { font-size:15px; color:#a3a3a3; }
.gb-cost b { color:#e5e5e5; }
.gb-launch-btn { background:#f4f4f4; color:#111; box-shadow:none; border-radius:18px; font-family:'Chakra Petch',sans-serif; }
.gb-launch-btn:disabled { background:#1f1f1f; color:#8a8a8a; border:1px solid #2c2c2c; }
.gb-refresh { background:transparent; color:#e5e5e5; border:1px solid #333; border-radius:14px; padding:11px 18px; font-size:14px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-usage-fill { background:linear-gradient(90deg,#f5b73b,#e0861a); }
.gb-usage-track { background:#242424; }

.gb-card { background:#120f0d; border:1px solid #3a2c16; border-radius:24px; padding:20px 18px; box-shadow:none; }
.gb-card::before { display:none; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-top { display:flex; justify-content:space-between; align-items:flex-start; gap:12px; }
.gc-gl { color:#a3a3a3; font-size:14px; letter-spacing:.5px; font-family:'Chakra Petch',sans-serif; }
.gc-id { color:#f3deb0; font-size:17px; font-family:'Chakra Petch',sans-serif; margin-left:8px; letter-spacing:.5px; }
.gc-glory { text-align:right; }
.gc-glory span { display:block; color:#a3a3a3; font-size:12px; letter-spacing:1.5px; font-family:'Chakra Petch',sans-serif; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-glory span i { color:#d4d4d4; margin-right:6px; }
.gc-glory b { display:block; color:#a7f3d0; font-size:30px; line-height:1.05; font-family:'Chakra Petch',sans-serif; letter-spacing:.5px; }
.gc-pillrow { margin-top:-6px; }
.gb-pill { font-size:13px; padding:7px 14px; letter-spacing:.8px; }
.gb-pill.running { color:#22c55e; background:rgba(34,197,94,.1); border-color:rgba(34,197,94,.35); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-upd { margin-top:8px; font-size:14px; color:#8a8a8a; }
.gc-grid { display:grid; grid-template-columns:1fr 1fr; gap:22px 14px; margin:22px 0 20px; }
.gc-cell .k { display:flex; align-items:center; gap:8px; font-size:14px; color:#a3a3a3; font-family:'Chakra Petch',sans-serif; }
.gc-cell .k i { color:#cfcfcf; width:20px; text-align:center; }
.gc-cell .v { margin-top:6px; font-size:19px; color:#f4f4f4; font-family:'Chakra Petch',sans-serif; line-height:1.25; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-cell .v small { display:block; font-size:inherit; }
.gb-goal-head { font-size:15px; color:#8a8a8a; font-family:'Chakra Petch',sans-serif; margin-bottom:10px; }
.gb-goal-head b { color:#f5b73b; font-size:16px; }
.gb-goal-track { height:10px; background:#0b0b0b; margin-bottom:22px; }
.gb-goal-fill { background:linear-gradient(90deg,#e0861a,#fbbf24); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-btns { gap:12px; }
.gb-b { border-radius:99px; padding:14px 8px; font-size:15px; font-family:'Chakra Petch',sans-serif; background:transparent; color:#f4f4f4; border:1.5px solid #3a3a3a; }
.gb-b.restart, .gb-b.stop { background:transparent; color:#f4f4f4; border:1.5px solid #3a3a3a; }
.gb-b.details { background:#f5f5f5; color:#111; border:1.5px solid #f5f5f5; border-radius:99px; }
.gb-b.delete { background:transparent; color:#f87171; border:1.5px solid #3f2a2a; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-b.squad { background:transparent; color:#f4f4f4; border:1.5px solid #3a3a3a; }
.gb-b.refund { grid-column:1 / -1; background:transparent; color:#fbbf24; border:1.5px solid rgba(251,191,36,.45); }
.gb-note { background:#1c1914; }

.gm-panel.hidden { display:none !important; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-head { display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:18px; }
.gm-title { font-family:'Chakra Petch',sans-serif; font-weight:600; letter-spacing:1.5px; font-size:13px; color:#cfcfcf; }
.gm-run { font-size:13px; color:#6ee7b7; font-family:'Chakra Petch',sans-serif; text-align:right; }
.gm-clan { position:relative; background:#14110d; border:1.5px solid #c8922a; border-radius:26px; padding:22px 18px 20px; overflow:hidden; margin-bottom:16px; }
.gm-ribbon { position:absolute; top:0; right:0; padding:7px 14px; border-radius:0 0 0 18px; background:linear-gradient(135deg,#fbbf24,#e0861a); color:#2a1a05; font-weight:800; font-size:13px; letter-spacing:.5px; font-family:'Chakra Petch',sans-serif; box-shadow:0 6px 24px rgba(251,191,36,.35); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-clan-top { display:flex; gap:14px; align-items:flex-start; margin-top:30px; }
.gm-badge { position:relative; flex:0 0 74px; width:74px; height:74px; border-radius:18px; background:#241a0c; border:1.5px solid #4a3714; display:flex; align-items:center; justify-content:center; font-size:30px; color:#f5b73b; margin-top:30px; }
.gm-lv { position:absolute; bottom:-3px; left:50%; transform:translateX(-50%); background:#e7d9bd; color:#2a1a05; font-size:13px; font-weight:800; padding:2px 8px; border-radius:6px; font-family:'Chakra Petch',sans-serif; white-space:nowrap; }
.gm-info { min-width:0; flex:1; }
.gm-name { font-family:'Chakra Petch',sans-serif; font-weight:700; font-size:26px; letter-spacing:1.5px; color:#e7d3a8; line-height:1.1; padding-right:4px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-sub { margin-top:6px; font-size:12px; color:#7d8696; letter-spacing:1px; font-family:'Chakra Petch',sans-serif; }
.gm-sub i { opacity:.5; margin:0 8px; font-style:normal; }
.gm-lbl { margin-top:12px; font-size:16px; color:#a3a3a3; }
.gm-big { font-family:'Chakra Petch',sans-serif; font-size:34px; font-weight:600; color:#f4f4f4; line-height:1.15; }
.gm-week { margin-top:10px; font-size:15px; color:#a3a3a3; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-stats { display:grid; grid-template-columns:auto minmax(0,1fr) auto; gap:12px; align-items:end; margin-top:24px; }
.gm-stat { min-width:0; }
.gm-stat .k { font-family:'Chakra Petch',sans-serif; letter-spacing:.8px; font-size:13px; color:#b0a58c; display:flex; align-items:center; gap:8px; font-weight:600; }
.gm-stat .v { margin-top:6px; font-size:20px; white-space:nowrap; color:#e5e5e5; font-family:'Chakra Petch',sans-serif; text-align:right; }
.gm-stat.cap .v { color:#9a9a9a; text-align:left; overflow:hidden; text-overflow:ellipsis; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-stat.gg .k { line-height:1.15; white-space:normal; }
.gm-stat.gg .v { color:#a7f3d0; font-size:34px; font-weight:700; line-height:1; }

.gm-tree { position:relative; display:flex; align-items:center; justify-content:space-between; gap:30px; border:1px solid #2a2a2a; border-radius:26px; padding:16px 12px; background:#131313; }
.gm-svg { position:absolute; inset:0; width:100%; height:100%; pointer-events:none; overflow:visible; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-root { position:relative; z-index:1; flex:0 0 36%; min-width:0; border:1px solid #3a3a3a; border-radius:18px; padding:18px 16px; background:#171717; }
.gm-root .t { font-size:15px; letter-spacing:1px; color:#a3a3a3; font-family:'Chakra Petch',sans-serif; }
.gm-root .n { margin-top:8px; font-size:16px; font-weight:700; color:#e7e2d3; font-family:'Chakra Petch',sans-serif; letter-spacing:1px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.gm-root .w { margin-top:16px; font-size:14px; color:#a3a3a3; }
.gm-root .g { margin-top:4px; font-size:21px; white-space:nowrap; font-weight:700; color:#a7f3d0; font-family:'Chakra Petch',sans-serif; line-height:1.1; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-leaves { position:relative; z-index:1; flex:1; display:flex; flex-direction:column; gap:14px; min-width:0; }
.gm-leaf { display:block; width:100%; text-align:left; font:inherit; cursor:pointer; border:1px solid #2f4a3c; border-radius:18px; padding:12px; background:#151a17; color:inherit; }
.gm-leaf.off { border-color:#3a3a3a; background:#171717; }
.gm-leaf .t { display:flex; align-items:center; gap:8px; font-size:12px; letter-spacing:1px; color:#b4c4ba; font-family:'Chakra Petch',sans-serif; }
.gm-leaf .t .d { width:10px; height:10px; border-radius:50%; background:#22c55e; animation:gbBlink 1.2s ease-in-out infinite; flex-shrink:0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-leaf.off .t .d { background:#ef4444; animation:none; }
.gm-leaf .i { margin-top:10px; font-size:15px; white-space:nowrap; font-weight:700; color:#f4f4f4; font-family:'Chakra Petch',sans-serif; }
.gm-leaf .g { margin-top:8px; font-size:21px; font-weight:700; color:#a7f3d0; font-family:'Chakra Petch',sans-serif; line-height:1.1; }
.gm-leaf .g small { font-size:inherit; }
.gm-leaf .v { margin-top:10px; font-size:14px; color:#cfcfcf; font-family:'Chakra Petch',sans-serif; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-foot { font-size:14px; color:#8a8a8a; padding:18px 4px 4px; border-top:1px solid #2a2a2a; margin-top:18px; line-height:1.5; }
.gm-clan + .gm-tree { margin-top:-4px; }
.gm-block + .gm-block { margin-top:26px; }
@media (max-width:420px) {
    .gm-name { font-size:22px; } .gm-big { font-size:30px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
@media (prefers-reduced-motion: reduce) { .gm-leaf .t .d { animation:none; } }

.gm-block + .gm-block { margin-top:34px; }
.gm-cards { margin:16px 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-cards .gb-card { margin-bottom:14px; }
.gm-clan { margin-bottom:16px; }
.gm-sub { display:flex; flex-wrap:wrap; gap:2px 0; font-size:11.5px; letter-spacing:.6px; }
.gm-sub span { white-space:nowrap; }
.gm-sub i { opacity:.5; margin:0 7px; font-style:normal; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-stat .k { white-space:nowrap; font-size:12px; }
.gm-stat .k i { color:#f5b73b; margin-right:5px; }
.gm-stat.gg .k { white-space:nowrap; }
.gm-stat.gg .v { font-size:30px; }
.gm-root { flex-basis:40%; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-root .w { white-space:nowrap; }
.gm-wk { color:#d4d4d4; }

@keyframes gxUp { from { opacity:0; transform:translateY(22px) scale(.97); } to { opacity:1; transform:none; } }
.gx-in { animation:gxUp .6s cubic-bezier(.2,.9,.3,1) both; animation-delay:var(--d,0s); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes gxGrow { from { width:0; } }
.gx-in .gb-goal-fill { animation:gxGrow 1.2s .35s cubic-bezier(.2,.8,.2,1) both; }
@keyframes gxDash { to { stroke-dashoffset:22; } }
.gm-flow { animation:gxDash 1s linear infinite; }
@keyframes gxFlash { 0% { text-shadow:0 0 0 rgba(110,231,183,0); } 35% { text-shadow:0 0 22px rgba(110,231,183,.95); transform:scale(1.07); } 100% { text-shadow:0 0 0 rgba(110,231,183,0); transform:none; } }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gx-flash { display:inline-block; animation:gxFlash 1.3s ease; }
@keyframes gxShine { from { background-position:0% 50%; } to { background-position:200% 50%; } }
.gm-ribbon { background:linear-gradient(110deg,#fbbf24 20%,#fff1b8 45%,#fbbf24 60%,#e0861a 100%); background-size:200% 100%; animation:gxShine 3.2s linear infinite; }
@keyframes gxGlow { 0%,100% { box-shadow:0 0 0 rgba(251,191,36,0); } 50% { box-shadow:0 0 26px rgba(251,191,36,.22); } }
.gm-clan.super { animation:gxGlow 3.2s ease-in-out infinite; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-clan.super.gx-in { animation:gxUp .6s cubic-bezier(.2,.9,.3,1) both, gxGlow 3.2s 1s ease-in-out infinite; animation-delay:var(--d,0s), 1s; }
@keyframes gxHub { 0%,100% { r:6; opacity:1; } 50% { r:9; opacity:.55; } }
.gm-hub { animation:gxHub 1.6s ease-in-out infinite; }
.gb-card, .gm-leaf, .gm-clan, .gb-b { transition:transform .22s ease, box-shadow .22s ease, border-color .22s ease, filter .2s ease; }
.gb-card:hover { border-color:#6b4d1c; box-shadow:0 12px 34px rgba(245,183,59,.08); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-leaf:hover { transform:translateY(-3px); border-color:#4ade80; box-shadow:0 10px 26px rgba(74,222,128,.14); }
.gm-leaf:active { transform:scale(.98); }
.gb-b:hover { filter:brightness(1.15); transform:translateY(-1px); }
.gb-b:active { transform:scale(.96); }
.gb-launch-btn:not(:disabled):hover { box-shadow:0 8px 30px rgba(255,255,255,.18); transform:translateY(-1px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes gxPulseDot { 0%,100% { box-shadow:0 0 0 0 rgba(34,197,94,.6); } 50% { box-shadow:0 0 0 7px rgba(34,197,94,0); } }
.gb-pill.running .gb-pdot { animation:gxPulseDot 1.3s ease-in-out infinite; }
@media (prefers-reduced-motion: reduce) { .gx-in, .gm-flow, .gm-ribbon, .gm-hub, .gm-clan.super, .gx-flash, .gx-in .gb-goal-fill { animation:none !important; } }

html { -webkit-text-size-adjust:100%; text-size-adjust:100%; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-block { container-type:inline-size; }
.gm-block { max-width:620px; margin-left:auto; margin-right:auto; }
.term-content .panel.gb-launch, .term-content .panel.gb-groups { padding:clamp(14px,4.2vw,22px) clamp(12px,3.6vw,20px); border-radius:clamp(18px,6vw,26px); }
.gb-sec-title, .gb-sec-title.green, .gb-sec-title.blue { font-size:clamp(17px,5.2vw,22px); line-height:1.15; white-space:nowrap; }
.gb-sec-icon { width:clamp(38px,11vw,46px); height:clamp(38px,11vw,46px); font-size:clamp(16px,4.6vw,20px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-select, .gb-input { font-size:clamp(14px,4.2vw,16px); padding:clamp(12px,3.6vw,16px) clamp(13px,4vw,18px); border-radius:clamp(14px,4.4vw,18px); }
.gb-launch-btn { font-size:clamp(14px,4.2vw,17px); padding:clamp(13px,3.8vw,17px) 14px; border-radius:clamp(14px,4.4vw,18px); }
.gb-label { font-size:clamp(11px,3.2vw,13px); }
.gb-cost { font-size:clamp(12.5px,3.7vw,15px); }
.gb-refresh { font-size:clamp(12px,3.5vw,14px); padding:clamp(8px,2.4vw,11px) clamp(12px,3.6vw,18px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-usage-head { font-size:clamp(12px,3.6vw,15px); }

.gm-clan { padding:clamp(14px,4.6cqw,22px) clamp(12px,4.2cqw,20px) clamp(14px,4.4cqw,20px); border-radius:clamp(18px,6.4cqw,26px); }
.gm-ribbon { padding:clamp(5px,1.7cqw,8px) clamp(10px,3.4cqw,16px); font-size:clamp(10.5px,3.1cqw,13px); border-radius:0 0 0 clamp(12px,4cqw,18px); }
.gm-clan-top { gap:clamp(10px,3.4cqw,16px); margin-top:clamp(20px,6.4cqw,30px); align-items:center; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-badge { flex:0 0 clamp(50px,16cqw,72px); width:clamp(50px,16cqw,72px); height:clamp(50px,16cqw,72px); border-radius:clamp(13px,4.2cqw,18px); font-size:clamp(22px,7cqw,32px); margin-top:0; }
.gm-lv { font-size:clamp(9.5px,2.9cqw,12.5px); padding:1px clamp(5px,1.6cqw,8px); }
.gm-name { font-size:clamp(17px,6.2cqw,30px); letter-spacing:.07em; }
.gm-sub { font-size:clamp(9.5px,2.9cqw,13px); margin-top:clamp(3px,1cqw,6px); }
.gm-sub i { margin:0 clamp(4px,1.6cqw,7px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-lbl { font-size:clamp(12px,3.7cqw,17px); margin-top:clamp(7px,2.4cqw,12px); }
.gm-big { font-size:clamp(24px,8.6cqw,40px); }
.gm-week { font-size:clamp(11px,3.3cqw,15px); margin-top:clamp(5px,1.8cqw,9px); }
.gm-stats { margin-top:clamp(14px,4.6cqw,24px); gap:clamp(8px,2.6cqw,12px); }
.gm-stat .k { font-size:clamp(9px,2.7cqw,12px); letter-spacing:.06em; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-stat .v { font-size:clamp(14px,4.8cqw,22px); margin-top:clamp(3px,1cqw,6px); }
.gm-stat.gg .v { font-size:clamp(21px,7.6cqw,34px); }

.gm-tree { --gutter:clamp(34px,13cqw,64px); gap:var(--gutter); padding:clamp(12px,3.8cqw,18px) clamp(10px,3.2cqw,16px); border-radius:clamp(18px,6.4cqw,26px); }
.gm-svg { z-index:0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-root, .gm-leaf { position:relative; z-index:1; }
.gm-root { flex:0 0 33%; padding:clamp(10px,3.2cqw,16px) clamp(9px,3cqw,14px); border-radius:clamp(13px,4cqw,18px); background:#171717; }
.gm-root .t { font-size:clamp(9.5px,2.8cqw,13px); }
.gm-root .n { font-size:clamp(12px,4cqw,17px); margin-top:clamp(5px,1.6cqw,8px); }
.gm-root .w { font-size:clamp(10.5px,3.1cqw,14px); margin-top:clamp(9px,3cqw,14px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-root .g { font-size:clamp(16px,5.8cqw,26px); margin-top:2px; }
.gm-leaves { gap:clamp(8px,2.8cqw,14px); }
.gm-leaf { padding:clamp(9px,3cqw,14px) clamp(9px,3.2cqw,14px); border-radius:clamp(13px,4cqw,18px); background:#141a16; }
.gm-leaf.off { background:#171717; }
.gm-leaf .t { font-size:clamp(9px,2.6cqw,12px); gap:clamp(5px,1.6cqw,8px); letter-spacing:.06em; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-leaf .t .d { width:clamp(7px,2.1cqw,9px); height:clamp(7px,2.1cqw,9px); }
.gm-leaf .i { font-size:clamp(11.5px,3.7cqw,15px); margin-top:clamp(5px,1.8cqw,9px); overflow:hidden; text-overflow:ellipsis; }
.gm-leaf .g { font-size:clamp(15px,5.2cqw,22px); margin-top:clamp(4px,1.4cqw,7px); white-space:nowrap; }
.gm-leaf .v { font-size:clamp(10.5px,3.1cqw,14px); margin-top:clamp(5px,1.8cqw,9px); }
.gm-foot { font-size:clamp(11px,3.3cqw,14px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-spark { filter:drop-shadow(0 0 4px #4ade80); }

.gb-card { padding:clamp(14px,4.6cqw,20px) clamp(12px,4.2cqw,18px); border-radius:clamp(18px,6.2cqw,24px); }
.gc-gl { font-size:clamp(12px,3.6cqw,15px); }
.gc-id { font-size:clamp(14px,4.7cqw,19px); margin-left:clamp(4px,1.6cqw,8px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-glory span { font-size:clamp(10px,3cqw,13px); }
.gc-glory b { font-size:clamp(22px,8.2cqw,34px); }
.gb-pill { font-size:clamp(10.5px,3.2cqw,14px); padding:clamp(5px,1.6cqw,8px) clamp(10px,3.4cqw,15px); }
.gc-upd { font-size:clamp(11px,3.3cqw,14px); }
.gc-grid { gap:clamp(14px,4.6cqw,22px) clamp(8px,3cqw,14px); margin:clamp(14px,4.8cqw,22px) 0 clamp(14px,4.4cqw,20px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-cell .k { font-size:clamp(11px,3.5cqw,15px); gap:clamp(5px,1.8cqw,8px); }
.gc-cell .v { font-size:clamp(15px,5cqw,21px); margin-top:clamp(3px,1.2cqw,6px); }
.gb-goal-head { font-size:clamp(10.5px,3.2cqw,14px); }
.gb-goal-track { height:clamp(7px,2.2cqw,10px); margin-bottom:clamp(14px,4.6cqw,20px); }
.gb-btns { gap:clamp(8px,2.6cqw,12px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-b { font-size:clamp(13px,4.1cqw,17px); padding:clamp(10px,3.2cqw,15px) 8px; gap:clamp(5px,1.8cqw,8px); }
.gm-block + .gm-block { margin-top:clamp(22px,7cqw,34px); }
.gm-cards { margin:clamp(10px,3.4cqw,16px) 0; }
@media (max-width:340px) { .gm-root { flex-basis:36%; } .gm-tree { --gutter:30px; } }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-block { width:100%; max-width:640px; }
.gm-block, .gm-cards, .gm-clanwrap, .gm-treewrap { min-width:0; }
#gbList { display:block !important; }

@media (min-width:1000px) {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    .term-content { display:grid; grid-template-columns:minmax(300px,380px) minmax(0,1fr); gap:20px; align-items:start; }
    .term-content > .dash-hero { grid-column:1 / -1; }
    .term-content > .gb-launch { position:sticky; top:84px; margin:0; }
    .term-content > .gb-groups { margin:0; min-height:260px; }
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@media (min-width:1500px) { .term-content { grid-template-columns:minmax(320px,400px) minmax(0,1fr); } .gm-block { max-width:680px; } }

.gb-groups .gb-sec-head { flex-wrap:nowrap; gap:10px; }
.gb-groups .gb-sec-head > span:first-child { min-width:0; flex:1 1 auto; gap:clamp(8px,2.6vw,12px) !important; }
.gb-groups .gb-sec-title { font-size:clamp(15px,4.6vw,21px); overflow:hidden; text-overflow:ellipsis; min-width:0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-groups .gb-count { flex:0 0 auto; }
.gb-refresh { flex:0 0 auto; display:inline-flex; align-items:center; gap:7px; font-size:clamp(11.5px,3.3vw,14px); padding:clamp(8px,2.3vw,11px) clamp(11px,3.2vw,16px); }
@media (max-width:360px) { .gb-groups .gb-sec-icon { display:none; } }

.gm-clan-top { align-items:flex-start; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-badge { margin-top:clamp(2px,1cqw,6px); padding:0; background:none; border:0; overflow:visible; }
.gm-badge-in { position:absolute; inset:0; border-radius:inherit; display:flex; align-items:center; justify-content:center;
    background:radial-gradient(120% 120% at 30% 15%, #6b4a12 0%, #2b1d08 55%, #170f05 100%);
    border:1.5px solid #e0a93a; box-shadow:inset 0 0 14px rgba(245,183,59,.28), 0 6px 18px rgba(0,0,0,.45), 0 0 0 4px rgba(245,183,59,.07); }
.gm-badge-in i { font-size:clamp(24px,7.6cqw,34px); background:linear-gradient(180deg,#ffe08a,#e0861a); -webkit-background-clip:text; background-clip:text; color:transparent; -webkit-text-fill-color:transparent; filter:drop-shadow(0 2px 6px rgba(245,183,59,.45)); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gm-lv { z-index:2; bottom:-9px; border:1.5px solid #14110d; background:linear-gradient(180deg,#f3e6cf,#d9c7a6); box-shadow:0 3px 8px rgba(0,0,0,.4); }
.gm-info { padding-top:2px; }

.gm-badge-in { overflow:hidden; }
.gm-badge-in .gm-logo { width:84%; height:84%; object-fit:contain; border-radius:12px; filter:drop-shadow(0 2px 6px rgba(245,183,59,.35)); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-cell.brand .k .gc-logo { width:18px; height:18px; object-fit:contain; border-radius:5px; vertical-align:-4px; margin-right:2px; }

.gc-grid { gap:clamp(8px,2.8cqw,12px); margin:clamp(14px,4.4cqw,20px) 0 clamp(10px,3.2cqw,14px); }
.gc-box { background:#0d0b09; border:1px solid #2e2415; border-radius:clamp(12px,4cqw,16px); padding:clamp(10px,3.2cqw,14px) clamp(10px,3.4cqw,14px); min-width:0; }
.gc-cell .k { font-size:clamp(10.5px,3.2cqw,14px); }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-cell .v { font-size:clamp(14px,4.6cqw,20px); margin-top:clamp(5px,1.6cqw,8px); overflow-wrap:anywhere; }
.gc-cell.brand { border-color:#4a3714; background:linear-gradient(135deg,#1c1407,#0d0b09); }
.gc-cell.brand .k { color:#f5b73b; letter-spacing:.14em; font-weight:700; }
.gc-cell.brand .k i { color:#f5b73b; }
.gc-cell.brand .v { color:#f3deb0; letter-spacing:.08em; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gc-goal { margin-bottom:clamp(12px,3.8cqw,18px); }
.gc-goal .gb-goal-head { margin-bottom:clamp(7px,2.2cqw,10px); }
.gc-goal .gb-goal-track { margin-bottom:0; background:#050403; }

.gm-hub-ring { fill:none; stroke:#4ade80; stroke-width:1.5; opacity:.6; animation:gxRing 1.6s ease-out infinite; transform-box:fill-box; transform-origin:center; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes gxRing { from { transform:scale(.6); opacity:.8; } to { transform:scale(2.2); opacity:0; } }
@media (prefers-reduced-motion: reduce) { .gm-hub-ring { animation:none; } }

.gb-stock { display:flex; align-items:center; gap:10px; margin:-4px 0 16px; padding:10px 14px; border-radius:14px; font-size:clamp(12px,3.5vw,14px); font-weight:600; border:1px solid rgba(52,211,153,.35); background:rgba(16,185,129,.08); color:#a7f3d0; }
.gb-stock.hidden { display:none; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-stock b { font-family:'Chakra Petch',sans-serif; font-size:1.25em; color:#fff; }
.gb-stock .gb-stock-n { margin-left:auto; font-size:.85em; opacity:.8; font-weight:500; }
.gb-stock.low { border-color:rgba(251,191,36,.4); background:rgba(251,191,36,.08); color:#fde68a; }
.gb-stock.out { border-color:rgba(239,68,68,.4); background:rgba(239,68,68,.08); color:#fca5a5; }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.gb-empty { text-align:center; padding:clamp(22px,7vw,36px) 12px; }
.gb-empty-ic { width:clamp(54px,16vw,68px); height:clamp(54px,16vw,68px); margin:0 auto 14px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:clamp(22px,6.4vw,28px); color:#8a8a8a; background:#1d1d1d; border:1px dashed #3a3a3a; }
.gb-empty-t { font-family:'Chakra Petch',sans-serif; font-weight:700; font-size:clamp(17px,5vw,21px); color:#e5e5e5; }
.gb-empty-s { margin-top:8px; font-size:clamp(12px,3.5vw,14px); color:#8a8a8a; line-height:1.55; }
.gb-empty-s a { color:#f5b73b; text-decoration:none; font-weight:600; }
</style>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, getAuthToken, toast, esc, fmtDate, getData, cachePeek, applyBalanceChange } from '/assets/js/app.js?v=20261025-4';

// src by SRT X CHEATS. Copy right SRT X CHEATS
const $ = (id) => document.getElementById(id);

async function gfetch(path, { method = 'GET', body, timeout = 30000 } = {}) {
    const base = String(window.BACKEND_URL || '').trim().replace(/\/+$/, '');
    if (!base) throw new Error('Backend URL is not configured.');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const call = async (tok) => {
        const c = new AbortController();
        const t = setTimeout(() => c.abort(), timeout);
        try {
            return await fetch(base + path, {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                method, cache: 'no-store', signal: c.signal,
                headers: { Accept: 'application/json', ...(body ? { 'Content-Type': 'application/json' } : {}), Authorization: `Bearer ${tok}` },
                body: body ? JSON.stringify(body) : undefined,
            });
        } catch (e) {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            throw new Error(e && e.name === 'AbortError' ? 'Request timed out. Please try again.' : (e && e.message) || 'Network error.');
        } finally { clearTimeout(t); }
    };
    const tries = method === 'GET' ? 3 : 1;
    let r, lastErr;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    for (let i = 1; i <= tries; i++) {
        try {
            r = await call(await getAuthToken(false));
            if (r.status === 401) r = await call(await getAuthToken(true));
            if (![502, 503, 504].includes(r.status) || i === tries) break;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        } catch (e) {
            lastErr = e;
            if (i === tries) throw e;
        }
        await new Promise((res) => setTimeout(res, 1200 * i));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    if (!r) throw lastErr || new Error('Network error.');
    const text = await r.text();
    let d = {};
    try { d = text ? JSON.parse(text) : {}; } catch { throw new Error(r.status >= 500 ? 'The server is waking up or busy. Please try again in a few seconds.' : `Backend returned an invalid reply (HTTP ${r.status}).`); }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!r.ok || d.success === false) {
        if (window.srtxHandleBan) window.srtxHandleBan(r.status, d);
        const err = new Error(d.error || `Request failed (HTTP ${r.status}).`);
        err.code = d.code; err.status = r.status;
        throw err;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    return d;
}

let regions = [];
// src by SRT X CHEATS. Copy right SRT X CHEATS
let selected = '';
let maxGroups = 5;
let balance = null;
let launching = false;
let stock = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
let groupsCache = [];
const D = new Map();
let timer = null;

const NAME_ICON = [['south america', 'fa-earth-americas'], ['sac', 'fa-earth-americas'], ['global', 'fa-globe']];
// src by SRT X CHEATS. Copy right SRT X CHEATS
const NAME_FLAGS = [
    ['bangladesh', 'bd'], ['brasil', 'br'], ['brazil', 'br'], ['europe', 'eu'], ['indonesia', 'id'], ['india', 'in'],
    ['middle east', 'sa'], ['saudi', 'sa'], ['north america', 'us'], ['united states', 'us'], ['pakistan', 'pk'],
    ['russia', 'ru'], ['singapore', 'sg'], ['thailand', 'th'], ['vietnam', 'vn'], ['vietname', 'vn'], ['taiwan', 'tw'],
    ['nepal', 'np'], ['malaysia', 'my'], ['philippines', 'ph'], ['mexico', 'mx'], ['turkey', 'tr'], ['egypt', 'eg'],
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    ['nigeria', 'ng'], ['south africa', 'za'], ['uae', 'ae'], ['arab', 'ae'],
];
function flagHtml(r, cls = 'gb-flag') {
    const name = String(r.name || r.region || '').toLowerCase();
    const ico = NAME_ICON.find(([k]) => name.includes(k));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (ico) return `<span class="${cls}"><i class="fas ${ico[1]}"></i></span>`;
    const hit = NAME_FLAGS.find(([k]) => name.includes(k));
    if (hit) {
        return `<img class="${cls}" src="https://flagcdn.com/w40/${hit[1]}.png" alt="" loading="lazy" onerror="this.outerHTML='<span class=&quot;${cls}&quot;><i class=&quot;fas fa-globe&quot;></i></span>'">`;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return `<span class="${cls}"><i class="fas fa-globe"></i></span>`;
}
function regionByName(name) {
    const n = String(name || '').toLowerCase();
    return regions.find((r) => r.name.toLowerCase() === n || r.code.toLowerCase() === n || r.id.toLowerCase() === n);
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function paintBalance(v) {
    balance = (v === undefined || v === null) ? null : Number(v);
    $('gbBalance').textContent = (balance === null || isNaN(balance)) ? '—' : balance;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    updateLaunch();
}
const cached = cachePeek('profile');
if (cached) paintBalance(cached.value.balance);
window.addEventListener('srtx:data', (e) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const { key, value } = e.detail || {};
    if (key === 'profile' && value) paintBalance(value.balance);
});

function paintStock() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const el = $('gbStock');
    if (!stock || !stock.enabled) { el.classList.add('hidden'); return; }
    const out = stock.available <= 0;
    el.className = 'gb-stock' + (out ? ' out' : stock.available <= 1 ? ' low' : '');
    el.innerHTML = out
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ? '<i class="fas fa-box-open"></i> <span><b>Out of stock</b> &mdash; check back soon</span>'
        : `<i class="fas fa-box"></i> <span><b>${stock.available}</b> squad${stock.available === 1 ? '' : 's'} available</span>`;
}
async function refreshStock() {
    try { const d = await gfetch('/api/glory/regions'); stock = d.stock || null; } catch (_) {  }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    paintStock(); updateLaunch();
}

function selectedRegion() { return regions.find((x) => x.id === selected); }

// src by SRT X CHEATS. Copy right SRT X CHEATS
function updateLaunch() {
    const r = selectedRegion();
    const btn = $('gbLaunchBtn');
    if (launching) return;
    if (!r) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        $('gbCost').innerHTML = 'Cost: <b>—</b>';
        btn.disabled = true;
        btn.innerHTML = '<span class="btn-text"><i class="fas fa-rocket"></i> Launch Glory Bot</span>';
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('gbCost').innerHTML = `Cost: <b>1 Bot squad</b> <span style="opacity:.5">•</span> <span class="gb-price mono-num">NRP ${r.priceNrp}</span>`;
    if (stock && stock.enabled && stock.available <= 0) {
        btn.disabled = true;
        btn.innerHTML = '<span class="btn-text"><i class="fas fa-box-open"></i> Out of stock</span>';
    } else if (balance !== null && balance < r.priceNrp) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        btn.disabled = true;
        btn.innerHTML = `<span class="btn-text">Insufficient balance (Need NRP ${r.priceNrp}, Have NRP ${balance})</span>`;
    } else {
        btn.disabled = false;
        btn.innerHTML = '<span class="btn-text"><i class="fas fa-rocket"></i> Launch Glory Bot</span>';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

function paintSelect() {
    const r = selectedRegion();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('gbSelectVal').innerHTML = r ? `${flagHtml(r)} <span>${esc(r.name)}</span>` : 'Select region';
}

async function loadRegions() {
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const d = await gfetch('/api/glory/regions');
        regions = (d.regions || []).slice().sort((a, b) => a.name.localeCompare(b.name));
        maxGroups = d.maxGroups || maxGroups;
        stock = d.stock || null; paintStock();
        if (!d.configured || !regions.length) {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            $('gbSelectVal').textContent = 'Service unavailable';
            $('gbMsg').textContent = 'FF Glory Bot is not available right now. Please try again later.';
            return;
        }
        if (!selected) selected = regions[0].id;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        $('gbSelect').disabled = false;
        paintSelect();
    } catch (e) {
        $('gbSelectVal').textContent = 'Failed to load servers';
        toast(e.message, 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    updateLaunch();
    paintUsage();
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function openSheet() {
    $('gbSheet').innerHTML = regions.map((r) => `
        <button type="button" class="gb-opt ${r.id === selected ? 'sel' : ''}" data-id="${esc(r.id)}">
            <span class="gb-opt-l">${flagHtml(r)} <span>${esc(r.name)}</span> <span class="gb-opt-price">NRP ${r.priceNrp}</span></span>
            <span class="gb-radio"></span>
        </button>`).join('');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('gbSheetOv').classList.remove('hidden');
}
const closeSheet = () => $('gbSheetOv').classList.add('hidden');
$('gbSelect').addEventListener('click', openSheet);
// src by SRT X CHEATS. Copy right SRT X CHEATS
$('gbSheetOv').addEventListener('click', (e) => {
    if (e.target === $('gbSheetOv')) return closeSheet();
    const b = e.target.closest('.gb-opt');
    if (!b) return;
    selected = b.dataset.id;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    paintSelect(); updateLaunch(); closeSheet();
});

$('gbClan').addEventListener('input', (e) => { e.target.value = e.target.value.replace(/\D/g, ''); });

// src by SRT X CHEATS. Copy right SRT X CHEATS
const glOv = $('gbLaunchOv'), glBox = $('glBox');
let glBusy = false, glMsgTimer = null, glPending = null;
const BUSY_MSGS = ['Contacting server…', 'Reserving a slot…', 'Starting your bots…', 'Joining your clan…', 'Almost there…'];
function glState(st) { glBox.dataset.state = st; }
function glOpen() { glOv.classList.remove('closing', 'hidden'); document.body.style.overflow = 'hidden'; }
// src by SRT X CHEATS. Copy right SRT X CHEATS
function glClose() {
    if (glBusy) return;
    glOv.classList.add('closing');
    setTimeout(() => { glOv.classList.add('hidden'); glOv.classList.remove('closing'); document.body.style.overflow = ''; }, 160);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
function glStartMsgs() {
    let i = 0; $('glStatus').textContent = BUSY_MSGS[0];
    clearInterval(glMsgTimer);
    glMsgTimer = setInterval(() => { i = Math.min(i + 1, BUSY_MSGS.length - 1); $('glStatus').textContent = BUSY_MSGS[i]; }, 7000);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

$('gbLaunchBtn').addEventListener('click', () => {
    const clan = $('gbClan').value.trim();
    const r = selectedRegion();
    if (!r) return toast('Select a region', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (stock && stock.enabled && stock.available <= 0) return toast('FF Glory Bot is out of stock right now', 'error');
    if (!/^\d{5,15}$/.test(clan)) { $('gbClan').focus(); return toast('Enter a valid Clan ID', 'error'); }
    glPending = { clan, r };
    $('glMeta').innerHTML = `Clan <b>${esc(clan)}</b> &middot; ${esc(r.name)} &middot; <b>NRP ${esc(String(r.priceNrp))}</b>`;
    glState('warn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    glOpen();
});
$('glCancel').addEventListener('click', glClose);
$('glErrClose').addEventListener('click', glClose);
$('glDone').addEventListener('click', glClose);
// src by SRT X CHEATS. Copy right SRT X CHEATS
glOv.addEventListener('click', (e) => { if (e.target === glOv && glBox.dataset.state !== 'busy') glClose(); });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !glOv.classList.contains('hidden')) glClose(); });

$('glGo').addEventListener('click', async () => {
    if (!glPending || glBusy) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const { clan, r } = glPending;
    glBusy = true; launching = true;
    $('gbLaunchBtn').disabled = true;
    glState('busy'); glStartMsgs();
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const d = await gfetch('/api/glory/launch', { method: 'POST', body: { region: r.id, clan_id: clan }, timeout: 100000 });
        applyBalanceChange(d.newBalance);
        paintBalance(d.newBalance);
        $('gbClan').value = '';
        glState('ok');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        loadGroups();
    } catch (e) {
        $('glErr').textContent = e.message || 'Something went wrong. Please try again.';
        if (e.code === 'OUT_OF_STOCK') refreshStock();
        glState('err');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } finally {
        clearInterval(glMsgTimer);
        glBusy = false; launching = false; glPending = null;
        updateLaunch();
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

function paintUsage() {
    const active = groupsCache.filter((g) => g.status === 'running').length;
    $('gbUsageText').textContent = `${active} / ${maxGroups}`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('gbUsageFill').style.width = Math.min(100, (active / maxGroups) * 100) + '%';
    $('gbCount').textContent = groupsCache.length;
}
function uptimeMinutes(str) {
    if (!str) return 0;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const m = String(str).match(/(?:(\d+)\s*d)?\s*(?:(\d+)\s*h)?\s*(?:(\d+)\s*m)?/i) || [];
    return (+m[1] || 0) * 1440 + (+m[2] || 0) * 60 + (+m[3] || 0);
}
const goalPct = (g) => Math.max(0, Math.min(100, Math.floor((uptimeMinutes(g.uptime) / 480) * 100)));
function hhmm(v) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (v === undefined || v === null || v === '') return '';
    const d = new Date(typeof v === 'number' && v < 1e12 ? v * 1000 : v);
    if (isNaN(d)) return String(v);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false });
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
const stamp = (t) => new Date(t || Date.now()).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', second: '2-digit' });
const has = (v) => v !== undefined && v !== null && v !== '';

const LOGO_URL = '/assets/img/logo.png?v=1';
const logoImg = (cls) => `<img class="${cls}" src="${LOGO_URL}" alt="SRT X CHEATS" loading="lazy" decoding="async">`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
function ago(t) {
    const ms = Date.now() - new Date(t).getTime();
    if (!isFinite(ms)) return '';
    const m = Math.max(0, Math.floor(ms / 60000));
    if (m < 1) return 'just now';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (m < 60) return m + 'm ago';
    const h = Math.floor(m / 60);
    if (h < 24) return h + 'h ' + (m % 60) + 'm ago';
    return Math.floor(h / 24) + 'd ago';
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function groupCard(g, anim) {
    const st = ['running', 'stopped', 'ended'].includes(g.status) ? g.status : 'unknown';
    const running = st === 'running';
    const s = D.get(g.groupId) || {};
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const d = s.data || {};
    if (d.raw && !s.logged) { console.log('[glory details]', g.groupId, d.raw); s.logged = true; }
    const reg = regionByName(g.region) || { id: g.region, code: g.region, name: g.region };
    const glory = has(d.glory) ? d.glory : 0;
    const bots = g.botCount || 0;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const pct = goalPct(g);
    const lm = d.lastMatchAt ? hhmm(d.lastMatchAt) : '';
    const lastMatch = has(d.games) ? `${d.games} games${lm ? ` · since ${lm}` : ''}`
        : (lm ? `since ${lm}` : (running ? 'Waiting for match…' : '—'));

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    let note = '';
    if (running && s.loading && !s.data) note = '<div class="gb-note"><i class="fas fa-circle-notch fa-spin"></i> Loading live info…</div>';
    else if (running && s.error && !s.data) note = `<div class="gb-note err">${esc(s.error)} — tap Refresh to retry.</div>`;

    return `
    <div class="gb-card${anim ? ' gx-in' : ''}" data-gid="${esc(g.groupId)}" style="--d:${anim || 0}s">
        <div class="gc-top">
            <div><span class="gc-gl">Group</span><b class="gc-id">${esc(g.groupId)}</b></div>
            <div class="gc-glory"><span><i class="fas fa-star"></i>GLORY</span><b data-count="${Number(glory) || 0}" data-key="g-${esc(g.groupId)}">${esc(String(glory))}</b></div>
        </div>
        <div class="gc-pillrow"><span class="gb-pill ${st}"><span class="gb-pdot"></span>${running ? 'running' : st}</span></div>
        <div class="gc-upd">updated ${esc(stamp(s.at))}</div>
        ${note}
        <div class="gc-grid">
            <div class="gc-cell gc-box"><div class="k"><i class="fas fa-location-dot"></i> Region</div><div class="v">${esc(reg.code || g.region || '—')}</div></div>
            <div class="gc-cell gc-box"><div class="k"><i class="fas fa-user-group"></i> Accounts</div><div class="v">${bots}</div></div>
            <div class="gc-cell gc-box brand"><div class="k">${logoImg('gc-logo')} SRT X CHEATS</div><div class="v">ENJOY</div></div>
            <div class="gc-cell gc-box"><div class="k"><i class="fas fa-bolt"></i> Last match</div><div class="v">${esc(lastMatch)}</div></div>
        </div>

        <div class="gc-box gc-goal">
            <div class="gb-goal-head"><span>8H GOAL</span><b>${pct}%</b></div>
            <div class="gb-goal-track"><div class="gb-goal-fill" style="width:${pct}%"></div></div>
        </div>

        <div class="gb-btns">
            <button class="gb-b restart" data-act="restart"><i class="fas fa-rotate"></i> Restart</button>
            <button class="gb-b stop" data-act="stop" ${running ? '' : 'disabled'}><i class="far fa-circle-stop"></i> Stop</button>
            <button class="gb-b details" data-act="details"><i class="fas fa-circle-info"></i> Details</button>
            <button class="gb-b delete" data-act="delete"><i class="fas fa-trash-can"></i> Delete</button>
            <button class="gb-b squad" data-act="squad"><i class="fas fa-download"></i> Squad Info</button>
            <button class="gb-b refund" data-act="refund"><i class="fas fa-rotate-left"></i> Refund</button>
        </div>
    </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

const WEEK_END = { day: 0, hour: 22 };
function weekEndsIn() {
    const now = new Date();
    const t = new Date(Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), WEEK_END.hour, 0, 0));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    t.setUTCDate(t.getUTCDate() + ((WEEK_END.day - t.getUTCDay() + 7) % 7));
    if (t <= now) t.setUTCDate(t.getUTCDate() + 7);
    const mins = Math.floor((t - now) / 60000);
    const dd = Math.floor(mins / 1440), hh = Math.floor((mins % 1440) / 60), mm = mins % 60;
    return `${dd ? dd + 'd ' : ''}${hh}h ${mm}m`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
const fmtN = (n) => Number(n).toLocaleString('en-US');
const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
const gloryOf = (g) => Number(((D.get(g.groupId) || {}).data || {}).glory) || 0;

// src by SRT X CHEATS. Copy right SRT X CHEATS
function clanInfo(clanId, list) {
    const withData = list.map((g) => (D.get(g.groupId) || {}).data).find((x) => x && (x.clanName || has(x.members))) || {};
    const sum = list.reduce((a, g) => a + gloryOf(g), 0);
    const total = has(withData.totalGlory) ? Number(withData.totalGlory) : sum;
    const weekly = has(withData.weeklyGlory) ? Number(withData.weeklyGlory) : sum;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return {
        id: clanId, list, sum, total, weekly,
        live: list.filter((g) => g.status === 'running'),
        name: withData.clanName || ('Clan ' + clanId),
        level: withData.level,
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        members: has(withData.members) ? (withData.capacity ? `${withData.members}/${withData.capacity}` : withData.members) : '—',
        captain: has(withData.captain) ? withData.captain : '—',
        reg: (regionByName(list[0].region) || { code: list[0].region }).code || '',
    };
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function clanCardHtml(c, anim) {
    return `
    <div class="gm-clan${c.live.length >= 2 ? ' super' : ''}${anim ? ' gx-in' : ''}" style="--d:${anim || 0}s">
        ${c.live.length >= 2 ? '<div class="gm-ribbon"><i class="fas fa-star"></i> SUPER SQUAD!</div>' : ''}
        <div class="gm-clan-top">
            <div class="gm-badge"><span class="gm-badge-in">${logoImg('gm-logo')}</span>${c.level ? `<span class="gm-lv">LV.${esc(String(c.level))}</span>` : ''}</div>
            <div class="gm-info">
                <div class="gm-name">${esc(c.name)}</div>
                <div class="gm-sub"><span>ID: ${esc(c.id)}</span><i>|</i><span>${esc(c.reg)}</span><i>|</i><span>${c.list.length} ${c.list.length === 1 ? 'GROUP' : 'GROUPS'}</span></div>
                <div class="gm-lbl">Clan total glory</div>
                <div class="gm-big" data-count="${c.total}" data-fmt="n" data-key="ct-${esc(c.id)}">${esc(fmtN(c.total))}</div>
                <div class="gm-week">Week ends in <span class="gm-wk">${esc(weekEndsIn())}</span></div>
            </div>
        </div>
        <div class="gm-stats">
            <div class="gm-stat"><div class="k"><i class="fas fa-users"></i> MEMBERS</div><div class="v">${esc(String(c.members))}</div></div>
            <div class="gm-stat cap"><div class="k"><i class="fas fa-crown"></i> CAPTAIN</div><div class="v">${c.captain === '—' ? '—' : 'UID ' + esc(String(c.captain))}</div></div>
            <div class="gm-stat gg"><div class="k"><i class="fas fa-crown"></i> GROUP GLORY</div><div class="v" data-count="${c.sum}" data-fmt="n" data-key="gs-${esc(c.id)}">${esc(fmtN(c.sum))}</div></div>
        </div>
    </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function treeHtml(c, anim) {
    return `
    <div class="gm-tree${anim ? ' gx-in' : ''}" style="--d:${anim || 0}s">
        <svg class="gm-svg" aria-hidden="true"></svg>
        <div class="gm-root">
            <div class="t">CLAN</div>
            <div class="n">${esc(c.name)}</div>
            <div class="w">Weekly glory</div>
            <div class="g" data-count="${c.weekly}" data-fmt="n" data-key="gw-${esc(c.id)}">${esc(fmtN(c.weekly))}</div>
        </div>
        <div class="gm-leaves">
            ${c.list.map((g) => {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                const on = g.status === 'running';
                const gl = gloryOf(g);
                return `<button type="button" class="gm-leaf ${on ? '' : 'off'}" data-goto="${esc(g.groupId)}">
                    <div class="t"><span class="d"></span>${on ? 'RUNNING GROUP' : esc(String(g.status).toUpperCase() + ' GROUP')}</div>
                    <div class="i">#${esc(g.groupId)}</div>
                    <div class="g"><span data-count="${gl}" data-key="gl-${esc(g.groupId)}">${esc(String(gl))}</span> glory</div>
                    <div class="v">View group <i class="fas fa-arrow-down"></i></div>
                </button>`;
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            }).join('')}
        </div>
    </div>
    <div class="gm-foot">${c.live.length} running ${c.live.length === 1 ? 'group' : 'groups'} <span style="opacity:.6">&rarr;</span> Clan ${esc(c.id)} &middot; Glory updates on refresh</div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function groupsByClan() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const m = new Map();
    for (const g of groupsCache) { if (!m.has(g.clanId)) m.set(g.clanId, []); m.get(g.clanId).push(g); }
    return m;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderBlocks() {
    const box = $('gbList');
    if (!groupsCache.length) {
        box.innerHTML = `<div class="gb-empty">
            <div class="gb-empty-ic"><i class="fas fa-robot"></i></div>
            <div class="gb-empty-t">No group launched</div>
            <div class="gb-empty-s">Launch a Glory Bot above. Finished groups are saved in your <a href="/history.php">History</a>.</div>
        </div>`;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    let i = 0, html = '';
    for (const [clanId, list] of groupsByClan()) {
        const c = clanInfo(clanId, list);
        const d = () => (i++ * 0.09).toFixed(2);
        html += `<div class="gm-block" data-clan="${esc(clanId)}">
            <div class="gm-clanwrap">${clanCardHtml(c, d())}</div>
            <div class="gm-cards">${list.map((g) => groupCard(g, d())).join('')}</div>
            <div class="gm-treewrap">${treeHtml(c, d())}</div>
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    box.innerHTML = html;
    requestAnimationFrame(() => { drawLines(); animateNumbers(); });
    setTimeout(drawLines, 120); setTimeout(drawLines, 900);
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderParts(clanId) {
    const blk = document.querySelector(`.gm-block[data-clan="${CSS.escape(clanId)}"]`);
    const list = groupsByClan().get(clanId);
    if (!blk || !list) return;
    const c = clanInfo(clanId, list);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    blk.querySelector('.gm-clanwrap').innerHTML = clanCardHtml(c, 0);
    blk.querySelector('.gm-treewrap').innerHTML = treeHtml(c, 0);
    drawLines(); animateNumbers();
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
const counts = new Map();
function animateNumbers() {
    document.querySelectorAll('[data-count]').forEach((el) => {
        const to = Number(el.dataset.count), key = el.dataset.key;
        const from = counts.has(key) ? counts.get(key) : 0;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        counts.set(key, to);
        const fmt = (n) => (el.dataset.fmt === 'n' ? fmtN(n) : String(n));
        if (from === to || reduceMotion) { el.textContent = fmt(to); return; }
        if (to > from && from > 0) { el.classList.remove('gx-flash'); void el.offsetWidth; el.classList.add('gx-flash'); }
        const t0 = performance.now(), dur = Math.abs(to - from) > 5000 ? 1100 : 750;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const step = (t) => {
            const p = Math.min(1, (t - t0) / dur), e = 1 - Math.pow(1 - p, 3);
            el.textContent = fmt(Math.round(from + (to - from) * e));
            if (p < 1) requestAnimationFrame(step);
        };
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        requestAnimationFrame(step);
    });
}

let pathSeq = 0;
// src by SRT X CHEATS. Copy right SRT X CHEATS
function relPos(el, anc) {
    let x = 0, y = 0, n = el;
    while (n && n !== anc) { x += n.offsetLeft; y += n.offsetTop; n = n.offsetParent; }
    return { x, y, w: el.offsetWidth, h: el.offsetHeight };
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
function drawLines() {
    document.querySelectorAll('.gm-tree').forEach((tree) => {
        const svg = tree.querySelector('.gm-svg');
        const root = tree.querySelector('.gm-root');
        const leaves = [...tree.querySelectorAll('.gm-leaf')];
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!svg || !root || !leaves.length || !tree.offsetWidth) return;
        svg.setAttribute('viewBox', `0 0 ${tree.offsetWidth} ${tree.offsetHeight}`);
        const r = relPos(root, tree);
        const x0 = r.x + r.w, y0 = r.y + r.h / 2;
        const lp = leaves.map((l) => relPos(l, tree));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const xl = Math.min(...lp.map((p) => p.x));
        const xm = x0 + (xl - x0) / 2;
        let out = '';
        leaves.forEach((l, i) => {
            const p = lp[i];
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const x1 = p.x, y1 = p.y + p.h / 2;
            const on = !l.classList.contains('off');
            const id = 'gmp' + (++pathSeq);
            const d = `M${x0} ${y0} C ${xm} ${y0}, ${xm} ${y1}, ${x1} ${y1}`;
            out += `<path id="${id}" class="${on ? 'gm-flow' : ''}" d="${d}" fill="none" stroke="${on ? '#4ade80' : '#555'}" stroke-width="2" stroke-dasharray="5 6" stroke-linecap="round" opacity=".85"/>`;
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            if (on && !reduceMotion) out += `<circle r="3.6" fill="#bbf7d0" class="gm-spark"><animateMotion dur="2.2s" begin="${(i * 0.55).toFixed(2)}s" repeatCount="indefinite" keyPoints="1;0" keyTimes="0;1" calcMode="linear"><mpath href="#${id}"/></animateMotion></circle>`;
        });
        out += `<circle class="gm-hub-ring" cx="${x0}" cy="${y0}" r="5"/><circle cx="${x0}" cy="${y0}" r="4.5" fill="#4ade80"/>`;
        svg.innerHTML = out;
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
if ('ResizeObserver' in window) new ResizeObserver(() => requestAnimationFrame(drawLines)).observe($('gbList'));
if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => requestAnimationFrame(drawLines));
window.addEventListener('resize', () => requestAnimationFrame(drawLines));
setInterval(() => { document.querySelectorAll('.gm-wk').forEach((e) => { e.textContent = weekEndsIn(); }); }, 20000);
// src by SRT X CHEATS. Copy right SRT X CHEATS
$('gbList').addEventListener('click', (e) => {
    const b = e.target.closest('[data-goto]');
    if (!b) return;
    const card = document.querySelector(`.gb-card[data-gid="${CSS.escape(b.dataset.goto)}"]`);
    if (card) card.scrollIntoView({ behavior: 'smooth', block: 'center' });
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

function rerender(gid) {
    const g = groupsCache.find((x) => x.groupId === gid);
    const el = document.querySelector(`.gb-card[data-gid="${CSS.escape(gid)}"]`);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (g && el) el.outerHTML = groupCard(g, 0);
    if (g) renderParts(g.clanId);
    animateNumbers();
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function loadGroups() {
    refreshStock();
    try {
        const d = await gfetch('/api/glory/groups');
        groupsCache = (d.groups || []).filter((g) => g.status !== 'ended' && !(g.status === 'stopped' && goalPct(g) >= 100));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderBlocks();
    } catch (e) {
        if (groupsCache.length) toast(e.message + ' (showing last known data)', 'error');
        else $('gbList').innerHTML = `<div class="gb-empty"><div class="gb-empty-ic"><i class="fas fa-plug-circle-exclamation"></i></div><div class="gb-empty-t">Couldn&rsquo;t load your groups</div><div class="gb-empty-s">${esc(e.message)}<br>They refresh automatically &mdash; or tap Refresh.</div></div>`;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    paintUsage();
    hydrate(false);
}

let hydrating = false;
// src by SRT X CHEATS. Copy right SRT X CHEATS
async function hydrate(force) {
    if (hydrating) return;
    hydrating = true;
    try {
        for (const g of groupsCache.filter((x) => x.status === 'running')) {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const prev = D.get(g.groupId) || {};
            if (!force && prev.data && Date.now() - prev.at < 40000) continue;
            D.set(g.groupId, { ...prev, loading: true, error: '' });
            rerender(g.groupId);
            try {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                const r = await gfetch(`/api/glory/details?group_id=${encodeURIComponent(g.groupId)}${force ? '&fresh=1' : ''}`, { timeout: 70000 });
                D.set(g.groupId, { data: r.details, at: Date.now() });
            } catch (e) {
                D.set(g.groupId, { data: prev.data, at: prev.at, error: e.message });
            }
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            rerender(g.groupId);
        }
    } finally { hydrating = false; }
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
let modalText = '';
const pretty = (k) => String(k).replace(/[._]+/g, ' ').replace(/([a-z])([A-Z])/g, '$1 $2');
const kv = (rows) => rows.filter(([, v]) => has(v)).map(([k, v]) => `<div class="gb-kv-row"><span>${esc(pretty(k))}</span><span>${esc(String(v))}</span></div>`).join('');
const plain = (rows) => rows.filter(([, v]) => has(v)).map(([k, v]) => `${pretty(k)}: ${v}`).join('\n');
function setModal(title, html, text) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('gbModalTitle').innerHTML = title;
    $('gbModalBody').innerHTML = html;
    modalText = text || '';
    $('gbModal').classList.remove('hidden');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
$('gbModalClose').onclick = () => $('gbModal').classList.add('hidden');
$('gbModal').addEventListener('click', (e) => { if (e.target === $('gbModal')) $('gbModal').classList.add('hidden'); });
$('gbModalCopy').onclick = () => navigator.clipboard.writeText(modalText).then(() => toast('Copied', 'success')).catch(() => toast('Copy failed', 'error'));

async function showSquad(g) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const title = '<i class="fas fa-download"></i> SQUAD INFO';
    setModal(title, '<div class="gb-kv-msg"><i class="fas fa-circle-notch fa-spin"></i> Loading squad info…<br><small>This can take up to a minute.</small></div>', '');
    try {
        const r = await gfetch(`/api/glory/details?group_id=${encodeURIComponent(g.groupId)}&fresh=1`, { timeout: 90000 });
        D.set(g.groupId, { data: r.details, at: Date.now() });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        rerender(g.groupId);
        const rows = Object.entries(r.details.clan || {});
        if (!rows.length) {
            const why = r.details.errors && r.details.errors.clan ? ` (${esc(r.details.errors.clan)})` : '';
            setModal(title, `<div class="gb-kv-msg">No squad info was returned for this group yet${why}. Try again in a minute.</div>`, '');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        } else {
            setModal(title, kv(rows), plain(rows));
        }
    } catch (e) {
        setModal(title, `<div class="gb-kv-msg err">${esc(e.message)}</div>`, '');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

async function showDetails(g) {
    const title = '<i class="fas fa-circle-info"></i> DETAILS';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const s = D.get(g.groupId) || {};
    const d = s.data || {};
    const base = [
        ['Group ID', g.groupId], ['Clan ID', g.clanId], ['Server', g.region], ['Status', g.status],
        ['Bots', g.botCount], ['Running bots', g.running || undefined], ['Uptime', g.uptime],
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ['Glory', d.glory], ['Launched', fmtDate(g.createdAt)], ['Paid (NRP)', g.price],
        ...Object.entries(d.gloryInfo || {}),
    ];
    const head = kv(base);
    let text = plain(base);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setModal(title, head + '<div class="gb-kv-h">GLORY HISTORY</div><div class="gb-kv-msg"><i class="fas fa-circle-notch fa-spin"></i> Loading…</div>', text);
    try {
        const r = await gfetch(`/api/glory/progress?group_id=${encodeURIComponent(g.groupId)}`, { timeout: 40000 });
        const rows = (r.snapshots || []).map((x) => [hhmm(x.at) || x.at, `${x.glory} glory${has(x.hours) ? ` · ${x.hours}h` : ''}`]);
        const extra = [['Total farmed', r.gloryFarmed]];
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const html = head + kv(extra) + '<div class="gb-kv-h">GLORY HISTORY</div>' + (rows.length ? kv(rows) : '<div class="gb-kv-msg">No history yet — snapshots appear after the group has been running for a while.</div>');
        setModal(title, html, text + '\n' + plain(extra) + '\n' + plain(rows));
    } catch (e) {
        setModal(title, head + '<div class="gb-kv-h">GLORY HISTORY</div><div class="gb-kv-msg err">' + esc(e.message) + '</div>', text);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

$('gbRefreshAll').addEventListener('click', async () => {
    await loadGroups();
    hydrate(true);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    toast('Refreshing…', 'success');
});

const rfOv = $('gbRefundOv'), rfBox = $('rfBox');
let rfBusy = false, rfGroup = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
function rfState(st) { rfBox.dataset.state = st; }
function rfClose() {
    if (rfBusy) return;
    rfOv.classList.add('closing');
    setTimeout(() => { rfOv.classList.add('hidden'); rfOv.classList.remove('closing'); document.body.style.overflow = ''; }, 160);
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
function openRefund(g) {
    rfGroup = g;
    $('rfMeta').innerHTML = `Group <b>#${esc(g.groupId)}</b> &middot; Clan ${esc(g.clanId)} &middot; <b>NRP ${esc(String(g.price ?? '—'))}</b>`;
    rfState('ask');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    rfOv.classList.remove('closing', 'hidden'); document.body.style.overflow = 'hidden';
}
$('rfCancel').addEventListener('click', rfClose);
$('rfErrClose').addEventListener('click', rfClose);
$('rfDone').addEventListener('click', rfClose);
// src by SRT X CHEATS. Copy right SRT X CHEATS
rfOv.addEventListener('click', (e) => { if (e.target === rfOv) rfClose(); });
$('rfGo').addEventListener('click', async () => {
    if (!rfGroup || rfBusy) return;
    const g = rfGroup;
    rfBusy = true; rfState('busy');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const d = await gfetch('/api/glory/refund', { method: 'POST', body: { group_id: g.groupId }, timeout: 70000 });
        applyBalanceChange(d.newBalance);
        paintBalance(d.newBalance);
        D.delete(g.groupId);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        $('rfOk').textContent = `NRP ${d.refunded} was added back to your balance.`;
        rfState('ok');
        loadGroups();
    } catch (e) {
        $('rfErr').textContent = e.message || 'Refund failed. Please try again.';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        rfState('err');
    } finally { rfBusy = false; rfGroup = null; }
});

$('gbList').addEventListener('click', async (e) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const btn = e.target.closest('button[data-act]');
    if (!btn) return;
    const gid = btn.closest('.gb-card').dataset.gid;
    const act = btn.dataset.act;
    const g = groupsCache.find((x) => x.groupId === gid);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!g) return;
    if (act === 'details') return showDetails(g);
    if (act === 'squad') return showSquad(g);
    if (act === 'refund') return openRefund(g);
    if (act === 'delete' && !confirm('Delete this glory bot permanently? No refund.')) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    btn.disabled = true;
    try {
        await gfetch('/api/glory/action', { method: 'POST', body: { group_id: gid, action: act }, timeout: 60000 });
        toast(act === 'delete' ? 'Deleted' : act === 'stop' ? 'Stopped' : 'Restarted', 'success');
        if (act === 'delete') D.delete(gid);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        await loadGroups();
    } catch (err) {
        toast(err.message, 'error');
        btn.disabled = false;
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

requireAuth(async () => {
    try { paintBalance((await getData('profile')).balance); } catch (_) {}
    await Promise.all([loadRegions(), loadGroups()]);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    clearInterval(timer);
    timer = setInterval(() => { if (!document.hidden) loadGroups(); }, 60000);
});
</script>
<?php require __DIR__ . '/includes/copyright.php'; ?>
</body>
</html>
