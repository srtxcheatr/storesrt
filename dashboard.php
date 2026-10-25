<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Dashboard — SRT X CHEATS';
$currentPage = 'dashboard';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <?php require __DIR__ . '/includes/topup-warning.php'; ?>

        <div class="dash-hero tilt">
            <div class="dash-hero-top">
                <div>
                    <div class="dash-hero-label"><i class="fas fa-wallet" style="color:var(--neon-amber)"></i> BALANCE</div>
                    <div class="dash-hero-amount gold-text mono-num">NRP <span id="dashBalance">—</span></div>
                </div>
                <div class="dash-hero-status">
                    <div class="dim" style="font-size:11px"><i class="fas fa-signal" style="color:var(--neon-green)"></i> STATUS</div>
                    <div id="dashStatus" style="font-weight:700;font-size:13px;color:var(--neon-green)">—</div>
                </div>
            </div>
            <div class="dash-hero-actions">
                <a href="/admin/owner.php" class="btn btn-solid"><i class="fas fa-circle-plus"></i> Add Balance</a>
                <a href="/store.php" class="btn btn-ghost"><i class="fas fa-store"></i> Go to Store</a>
            </div>
        </div>

        <div class="panel reseller-card hidden" id="resellerCard">
            <div class="prompt-header"><i class="fas fa-crown" style="color:var(--neon-amber)"></i> <span id="rcTitle">UNLOCK RESELLER MODE</span></div>
            <div class="reseller-progress-row">
                <div class="reseller-progress-item hidden" id="rcKeysItem">
                    <div class="rp-label">
                        <span><i class="fas fa-key"></i> Keys Bought</span>
                        <span class="rp-status" id="rpKeysStatus"><i class="fas fa-circle-xmark"></i></span>
                    </div>
                    <div class="rp-bar-track"><div class="rp-bar-fill" id="rpKeysBar"></div></div>
                    <div class="rp-value mono-num" id="rpKeysValue">0 / 10</div>
                </div>
                <div class="reseller-progress-item">
                    <div class="rp-label">
                        <span><i class="fas fa-wallet"></i> Single Deposit</span>
                        <span class="rp-status"><i class="fas fa-bolt"></i></span>
                    </div>
                    <div class="rp-value mono-num" id="rpDepositValue">NRP 2000 in one deposit</div>
                </div>
            </div>

            <div class="rp-benefit">
                <div class="rp-benefit-label"><i class="fas fa-circle-question"></i> <span id="rcBenefitLabel">What's the benefit of Reseller Mode?</span></div>
                <div class="rp-benefit-answer" id="rcBenefit">
                    Resellers buy every product at a discounted price —
                    <span class="rp-benefit-price"><s>NRP 100</s> → <b>NRP 50</b></span>
                </div>
            </div>

            <a class="btn btn-solid reseller-shift-btn" id="resellerShiftBtn" href="/admin/owner.php" style="display:block;width:100%;margin-top:12px;text-align:center;text-decoration:none">
                <span class="btn-text"><i class="fas fa-coins"></i> <span id="rcBtnText">Deposit NRP 2000 to unlock</span></span>
            </a>
            <div class="dim" id="resellerHint" style="font-size:11px;margin-top:8px;text-align:center">Make ONE deposit of NRP 2000 or more. Small top-ups (100, 200 ...) are not added together.</div>
        </div>

        <div class="dash-stats-row">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-receipt"></i></div>
                <div class="stat-value gold-text mono-num" id="statSpent">NRP 0</div>
                <div class="stat-label">Total Spent</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <div class="stat-value mono-num" id="statOrders">0</div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>

        <div class="panel" id="noticePanel">
            <div class="prompt-header"><i class="fas fa-bullhorn"></i> ANNOUNCEMENT</div>
            <div id="noticeText" style="font-size:12px;color:var(--text-secondary)">Loading announcements...</div>
        </div>

        <div class="prompt-header"><i class="fas fa-trophy"></i> TOP 10 LEADERBOARD</div>
        <div class="panel" id="leaderboardPanel">
            <div id="leaderboardList" class="leaderboard-list">
                <div class="skeleton-row"></div>
                <div class="skeleton-row"></div>
                <div class="skeleton-row"></div>
            </div>
        </div>

        <div class="prompt-header"><i class="fas fa-bolt"></i> QUICK ACCESS</div>
        <div class="shortcut-grid">
            <a href="/store.php" class="shortcut-card tilt">
                <div class="shortcut-icon"><i class="fas fa-store"></i></div>
                Store
            </a>
            <a href="/glorybot.php" class="shortcut-card tilt" data-c="purple">
                <div class="shortcut-icon"><i class="fas fa-robot"></i></div>
                FF Glory Bot
            </a>
            <a href="/history.php" class="shortcut-card tilt" data-c="blue">
                <div class="shortcut-icon"><i class="fas fa-clock-rotate-left"></i></div>
                History
            </a>
            <a href="/rewards.php" class="shortcut-card tilt" data-c="green">
                <div class="shortcut-icon"><i class="fas fa-gift"></i></div>
                Reward Center
            </a>
            <a href="/admin/owner.php" class="shortcut-card tilt" data-c="amber">
                <div class="shortcut-icon"><i class="fas fa-coins"></i></div>
                Top Up
            </a>
            <a href="/profile.php" class="shortcut-card tilt" data-c="green">
                <div class="shortcut-icon"><i class="fas fa-user-gear"></i></div>
                Profile
            </a>
            <a href="/store.php#support" class="shortcut-card tilt" data-c="pink">
                <div class="shortcut-icon"><i class="fas fa-headset"></i></div>
                Support
            </a>
            <a href="<?= htmlspecialchars(DEVELOPER_URL) ?>" target="_blank" class="shortcut-card tilt" data-c="grey">
                <div class="shortcut-icon"><i class="fas fa-code"></i></div>
                Developer
            </a>
        </div>

    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.ann-card { max-width: 460px; width: 100%; text-align: center; position: relative; overflow: hidden; }
.ann-card::before { content: ""; position: absolute; inset: 0 0 auto 0; height: 3px; background: linear-gradient(90deg, var(--neon-purple, #a855f7), var(--neon-blue, #22d3ee), var(--neon-amber, #d4af37)); }
.ann-badge { width: 54px; height: 54px; margin: 6px auto 10px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px;
    color: var(--neon-amber, #d4af37); background: rgba(212, 175, 55, .12); border: 1px solid rgba(212, 175, 55, .45); animation: annPulse 2.4s ease-in-out infinite; }
@keyframes annPulse { 0%, 100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, .35); } 50% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); } }
.ann-title { font-family: var(--font-heading, 'Orbitron', sans-serif); font-size: 15px; font-weight: 800; letter-spacing: .12em; }
.ann-sub { display: inline-block; margin-top: 6px; font-size: 10.5px; font-weight: 800; letter-spacing: .1em; color: var(--neon-blue, #22d3ee);
    border: 1px solid currentColor; border-radius: 999px; padding: 2px 10px; opacity: .9; }
/* the message itself: readable text on a soft gray card */
.ann-msg { margin: 16px 0; padding: 14px 16px; text-align: left; max-height: 46vh; overflow-y: auto;
    font: 500 14px/1.7 'Plus Jakarta Sans', system-ui, sans-serif; letter-spacing: normal; word-spacing: normal;
    white-space: pre-line; overflow-wrap: anywhere; color: #e5e7eb;
    background: rgba(148, 163, 184, .16); border: 1px solid rgba(148, 163, 184, .30); border-left: 4px solid var(--neon-amber, #d4af37); border-radius: 12px; }
[data-theme="light"] .ann-msg { color: #1f2937; background: #eceef2; border-color: #d3d7df; border-left-color: var(--neon-amber, #a8791f); }
.ann-msg::-webkit-scrollbar { width: 5px; } .ann-msg::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, .5); border-radius: 999px; }
.ann-gift { display: none; margin: 0 0 14px; padding: 12px; border-radius: 12px; border: 1px dashed rgba(212, 175, 55, .6); background: rgba(212, 175, 55, .08); }
.ann-card .btn { width: 100%; }
#noticeText { white-space: pre-line; overflow-wrap: anywhere; line-height: 1.65; padding: 10px 12px; border-radius: 10px; margin-top: 6px;
    background: rgba(148, 163, 184, .14); border: 1px solid rgba(148, 163, 184, .26); border-left: 3px solid var(--neon-amber, #d4af37); }
[data-theme="light"] #noticeText { background: #eceef2; border-color: #d3d7df; }
@media (prefers-reduced-motion: reduce) { .ann-badge { animation: none; } }
</style>

<div id="announceModal" class="modal-overlay hidden" role="dialog" aria-modal="true" aria-labelledby="annTitle">
    <div class="panel ann-card">
        <div class="ann-badge"><i class="fas fa-bullhorn"></i></div>
        <div class="ann-title" id="annTitle">ANNOUNCEMENT</div>
        <div class="ann-sub"><i class="fas fa-circle-info"></i> IMPORTANT NOTICE</div>
        <div id="announceMessage" class="ann-msg"></div>
        <div id="announceGiftBox" class="ann-gift">
            <div class="gold-text mono-num" id="announceGiftAmount" style="font-size:22px;font-weight:800"></div>
            <button class="btn btn-solid" id="announceClaimBtn" style="margin-top:8px;width:100%;position:relative">
                <span class="btn-text"><i class="fas fa-gift"></i> Claim Gift</span>
                <span class="btn-spinner hidden"><span class="spinner"></span></span>
            </button>
        </div>
        <button class="btn btn-ghost" onclick="dismissAnnouncement()"><i class="fas fa-check"></i> Got it</button>
    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import {
    requireAuth, backendFetch, toast, enableTilt, esc,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    getData, cachePeek, cachePatch, cacheInvalidate, applyBalanceChange, statsFromHistory,
} from '/assets/js/app.js?v=20261025-4';
import { avBadgeHtml, bannerClass, bannerInner, CROWNS } from '/assets/js/rewards-ui.js?v=20261026-1';

const MEDALS = [
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    '<i class="fas fa-medal" style="color:#f5b73b"></i>',
    '<i class="fas fa-medal" style="color:#cbd5e1"></i>',
    '<i class="fas fa-medal" style="color:#cd7f32"></i>',
];

// src by SRT X CHEATS. Copy right SRT X CHEATS
function paintFromCache() {
    const p = cachePeek('profile');
    if (p) { applyBalance(p.value); renderResellerProgress(p.value); }
    const h = cachePeek('history');
    if (h) applyStats(statsFromHistory(h.value));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const lb = cachePeek('leaderboard');
    if (lb) renderLeaderboard(lb.value.leaderboard || []);
}
try { paintFromCache(); } catch (e) { console.error('[cache-paint]', e); }

// src by SRT X CHEATS. Copy right SRT X CHEATS
window.addEventListener('srtx:data', (e) => {
    const { key, value } = e.detail || {};
    if (!value) return;
    if (key === 'profile') { applyBalance(value); renderResellerProgress(value); }
    else if (key === 'history') applyStats(statsFromHistory(value));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else if (key === 'leaderboard') renderLeaderboard(value.leaderboard || []);
});

requireAuth(async () => {
    await Promise.all([loadBalance(), loadStats(), loadLeaderboard()]);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    enableTilt();
    loadAnnouncement();
    checkPolicyAck();
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function checkPolicyAck() {
    try {
        const profile = await getData('profile');
        let acknowledged;
        if (profile.policyAcknowledged === undefined) {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            acknowledged = (await backendFetch('/api/user/policy-ack')).acknowledged;
        } else {
            acknowledged = profile.policyAcknowledged;
        }
        if (acknowledged) { checkWelcome(); return; }
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        for (let i = 0; i < 50 && typeof window.__openPolicyModal !== 'function'; i++) {
            await new Promise(r => setTimeout(r, 20));
        }
        if (typeof window.__openPolicyModal === 'function') window.__openPolicyModal('forced', checkWelcome);
        else checkWelcome();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        console.error('Could not check policy acknowledgement:', e);
        checkWelcome();
    }
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function checkWelcome() {
    try {
        const profile = await getData('profile');
        if (profile.welcomeRedirectDone) return;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        for (let i = 0; i < 150 && typeof window.__openWelcomeModal !== 'function'; i++) {
            await new Promise(r => setTimeout(r, 20));
        }
        if (typeof window.__openWelcomeModal === 'function') window.__openWelcomeModal();
    } catch (e) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        console.error('Could not check welcome popup:', e);
    }
}

let currentAnnouncement = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function loadAnnouncement() {
    try {
        const d = await getData('announcement');
        if (d.announcement) showAnnouncement(d.announcement);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {  }
}

function showAnnouncement(ann) {
    currentAnnouncement = ann;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('announceMessage').textContent = ann.message;
    const giftBox = document.getElementById('announceGiftBox');
    if (ann.giftCode) {
        giftBox.style.display = 'block';
        document.getElementById('announceGiftAmount').innerHTML = `<i class="fas fa-gift"></i> NRP ${esc(String(ann.giftAmount))} gift included`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } else {
        giftBox.style.display = 'none';
    }
    document.getElementById('announceModal').classList.remove('hidden');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

window.dismissAnnouncement = async () => {
    document.getElementById('announceModal').classList.add('hidden');
    if (currentAnnouncement) {
        cachePatch('announcement', { announcement: null });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        try {
            await backendFetch('/api/user/announcement/seen', { method: 'POST', body: JSON.stringify({ id: currentAnnouncement.id }) });
        } catch (e) {  }
    }
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('announceClaimBtn')?.addEventListener('click', async () => {
    if (!currentAnnouncement?.giftCode) return;
    const btn = document.getElementById('announceClaimBtn');
    btn.querySelector('.btn-text').classList.add('hidden');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    btn.querySelector('.btn-spinner').classList.remove('hidden');
    btn.disabled = true;
    try {
        const d = await backendFetch('/api/user/redeem', {
            method: 'POST',
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            body: JSON.stringify({ code: currentAnnouncement.giftCode }),
        });
        toast(`Claimed NRP ${d.amountCredited}!`, 'success');
        applyBalanceChange(d.newBalance);
        window.dismissAnnouncement();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        toast(e.message, 'error');
        btn.querySelector('.btn-text').classList.remove('hidden');
        btn.querySelector('.btn-spinner').classList.add('hidden');
        btn.disabled = false;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
});

async function loadBalance() {
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const d = await getData('profile', { onStale: applyBalance });
        applyBalance(d);
        renderResellerProgress(d);
    } catch (e) {
        if (!cachePeek('profile')) toast(e.message, 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

function applyBalance(d) {
        document.getElementById('dashBalance').textContent = d.balance;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const statusEl = document.getElementById('dashStatus');
        statusEl.textContent = d.requestStatus || 'Active';
        statusEl.style.color = d.requestStatus === 'Active' ? 'var(--neon-green)' :
                               d.requestStatus === 'Pending' ? 'var(--neon-amber)' : 'var(--neon-red)';
        document.getElementById('noticeText').textContent = d.adminMessage || 'Welcome to SRT X CHEATS.';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const drawerBal = document.getElementById('drawerBalance');
        if (drawerBal) drawerBal.textContent = 'NRP ' + d.balance;
        const drawerName = document.getElementById('drawerUserName');
        if (drawerName) drawerName.textContent = d.profileName || 'My Account';
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function loadStats() {
    try {
        const d = await getData('history', { onStale: (h) => applyStats(statsFromHistory(h)) });
        applyStats(statsFromHistory(d));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {  }
}

function applyStats(s) {
    document.getElementById('statSpent').textContent = 'NRP ' + (s.spent || 0);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('statOrders').textContent = s.orders || 0;
}

function renderResellerProgress(profile) {
    if (!profile) return;
    if (profile.resellerDeposit === undefined) {
        backendFetch('/api/user/reseller-progress').then(renderResellerProgress, () => {});
        return;
    }
    try {
        const role = profile.role || 'user';
        const card = document.getElementById('resellerCard');
        if (role === 'pro_reseller') { card.classList.add('hidden'); return; }
        card.classList.remove('hidden');
        const $ = (id) => document.getElementById(id);
        const resDep = Number(profile.resellerDeposit) || 2000;
        const proDep = Number(profile.proDeposit) || 3500;
        const minKeys = Number(profile.proMinKeys) || 10;
        const keys = Number(profile.totalKeysBought) || 0;

        if (role === 'user') {
            // RESELLER = ONE deposit of NRP 2000+
            $('rcTitle').textContent = 'UNLOCK RESELLER MODE';
            $('rcKeysItem').classList.add('hidden');
            $('rpDepositValue').textContent = `NRP ${resDep} in one deposit`;
            $('rcBtnText').textContent = `Deposit NRP ${resDep} to unlock`;
            $('resellerHint').textContent = `Make ONE deposit of NRP ${resDep} or more. Small top-ups (100, 200 ...) are not added together.`;
            $('rcBenefitLabel').textContent = "What's the benefit of Reseller Mode?";
            $('rcBenefit').innerHTML = 'Resellers buy every product at a discounted price — <span class="rp-benefit-price"><s>NRP 100</s> → <b>NRP 50</b></span>';
        } else {
            // PRO RESELLER = 10+ keys bought AND ONE new deposit of NRP 3500+
            const keysDone = keys >= minKeys;
            $('rcTitle').textContent = 'UNLOCK PRO RESELLER';
            $('rcKeysItem').classList.remove('hidden');
            $('rpKeysBar').style.width = Math.min(100, (keys / minKeys) * 100) + '%';
            $('rpKeysBar').classList.toggle('rp-bar-done', keysDone);
            $('rpKeysValue').textContent = `${keys} / ${minKeys}`;
            $('rpKeysStatus').innerHTML = keysDone ? '<i class="fas fa-circle-check"></i>' : '<i class="fas fa-circle-xmark"></i>';
            $('rpKeysStatus').classList.toggle('rp-status-done', keysDone);
            $('rpDepositValue').textContent = `NRP ${proDep} in one NEW deposit`;
            $('rcBtnText').textContent = `Deposit NRP ${proDep} to unlock`;
            $('resellerHint').textContent = keysDone
                ? `Make ONE new deposit of NRP ${proDep} or more. Small top-ups (100, 200 ...) are not added together and old balance does not count.`
                : `Buy ${minKeys - keys} more key${minKeys - keys === 1 ? '' : 's'} first, then make ONE new deposit of NRP ${proDep}+ (a deposit before ${minKeys} keys will not unlock PRO).`;
            $('rcBenefitLabel').textContent = "What's the benefit of Pro Reseller?";
            $('rcBenefit').textContent = 'PRO RESELLERS get the lowest prices on every product.';
        }
    } catch (e) {
    }
}

function renderLeaderboard(rows) {
    const list = document.getElementById('leaderboardList');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!rows.length) {
        list.innerHTML = '<div class="dim" style="font-size:12px;text-align:center;padding:10px">No purchases yet — be the first on the board!</div>';
        return;
    }
    list.innerHTML = rows.map((r, i) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const c = r.cosmetics || {};
        const crown = CROWNS[r.badge] ? `<i class="fas fa-crown lb-crown" style="color:${CROWNS[r.badge]}"></i>` : '';
        return `
        <div class="leaderboard-row${bannerClass(c.banner)}">${bannerInner(c.banner)}
            <div class="lb-rank">${MEDALS[i] || (i + 1)}</div>
            <div class="lb-av"><div class="lb-avatar">${r.avatarUrl ? `<img src="${esc(r.avatarUrl)}" alt="" loading="lazy" decoding="async" referrerpolicy="no-referrer">` : esc((r.name || '?').trim().charAt(0).toUpperCase() || '?')}</div>${avBadgeHtml(c.badge, 17)}</div>
            <div class="lb-name-wrap"><span class="lb-name">${esc(r.name)}</span>${crown}</div>
            <div class="lb-stats">
                <span class="lb-keys"><i class="fas fa-key"></i> ${r.totalKeysBought}</span>
                <span class="lb-spent gold-text">NRP ${r.totalSpent}</span>
            </div>
            <a href="/othersprofile.php?uid=${encodeURIComponent(r.uid)}" class="btn btn-ghost lb-view">View</a>
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function loadLeaderboard() {
    const list = document.getElementById('leaderboardList');
    try {
        const d = await getData('leaderboard');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderLeaderboard(d.leaderboard || []);
    } catch (e) {
        if (!cachePeek('leaderboard')) list.innerHTML = '<div class="dim" style="font-size:12px;text-align:center;padding:10px">Could not load leaderboard.</div>';
    }
}
</script>

<?php require __DIR__ . '/includes/policy-modal.php'; ?>
<?php require __DIR__ . '/includes/welcome-modal.php'; ?>

<?php require __DIR__ . '/includes/copyright.php'; ?>
</body>
</html>
