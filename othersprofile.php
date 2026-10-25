<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Player Profile — SRT X CHEATS';
$currentPage = 'othersprofile';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <div id="opLoading" style="text-align:center;padding-top:60px">
            <i class="fas fa-circle-notch fa-spin" style="font-size:26px;color:var(--neon-blue)"></i>
        </div>

        <div id="opContent" class="hidden">

            <div class="profile-hero op-hero" id="opHero">
                <div class="av-wrap" id="opAvWrap"><div class="profile-avatar op-avatar" id="opAvatar">?</div></div>
                <div class="profile-name"><span id="opName">—</span></div>
                <div class="op-rank-badge" id="opRankBadge"></div>
            </div>

            <div class="dash-stats-row">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-key"></i></div>
                    <div class="stat-value mono-num" id="opKeys">0</div>
                    <div class="stat-label">Keys Bought</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-sack-dollar"></i></div>
                    <div class="stat-value gold-text mono-num" id="opSpent">Rs 0</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>

            <div class="section-divider"><i class="fas fa-id-card"></i> Contact Info</div>
            <div class="panel">
                <div class="op-info-row"><i class="fas fa-user-shield"></i> <span id="opRole">—</span></div>
                <div class="op-info-row"><i class="fas fa-envelope"></i> <span id="opEmail">—</span></div>
                <div class="op-info-row"><i class="fab fa-whatsapp"></i> <span id="opPhone">—</span></div>
                <div class="op-info-row hidden" id="opTiktokNameRow">
                    <i class="fab fa-tiktok"></i> <span><span class="dim">TikTok name:</span> <span id="opTiktokName">—</span></span>
                </div>
                <div class="op-info-row hidden" id="opTiktokUserRow">
                    <i class="fab fa-tiktok"></i> <span><span class="dim">TikTok username:</span> <a href="#" id="opTiktokUser" target="_blank" rel="noopener noreferrer">—</a></span>
                </div>
                <div class="op-info-row hidden" id="opPanelRow">
                    <i class="fas fa-link"></i> <span><span class="dim">Panel:</span> <a href="#" id="opPanel" target="_blank" rel="noopener noreferrer nofollow">—</a></span>
                </div>
            </div>

            <a href="/dashboard.php" class="btn btn-ghost" style="margin-top:6px"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>

        <div id="opError" class="panel hidden" style="text-align:center">
            <i class="fas fa-user-slash" style="font-size:26px;color:var(--neon-red);margin-bottom:8px;display:block"></i>
            <div style="font-size:13px;color:var(--text-secondary)">This player could not be found.</div>
            <a href="/dashboard.php" class="btn btn-ghost" style="margin-top:12px"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>

    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, esc, renderAvatar } from '/assets/js/app.js?v=20261025-4';
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { setAvatarBadge, applyProfileEffect, applyPageEffect } from '/assets/js/rewards-ui.js?v=20261026-1';

requireAuth(async () => {
    const uid = new URLSearchParams(location.search).get('uid');
    if (!uid) return showError();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const d = await backendFetch('/api/user/public-profile?uid=' + encodeURIComponent(uid));
        render(d);
    } catch (e) {
        showError();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
});

function showError() {
    document.getElementById('opLoading').classList.add('hidden');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('opError').classList.remove('hidden');
}

function render(d) {
    document.getElementById('opLoading').classList.add('hidden');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('opContent').classList.remove('hidden');

    document.getElementById('opName').textContent = d.name || 'Anonymous';
    const worn = d.cosmetics || {};
    setAvatarBadge(document.getElementById('opAvWrap'), worn.badge, 26);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    applyProfileEffect(document.getElementById('opHero'), worn.profile);
    applyPageEffect(worn.profile);
    renderAvatar(document.getElementById('opAvatar'), d.avatarUrl, d.name || '?');
    document.getElementById('opKeys').textContent = d.totalKeysBought || 0;
    document.getElementById('opSpent').textContent = 'Rs ' + (d.totalSpent || 0);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('opEmail').textContent = d.email || '—';
    document.getElementById('opPhone').textContent = d.phone || '—';
    document.getElementById('opRole').textContent = d.role === 'pro_reseller' ? 'Pro Reseller' : d.role === 'reseller' ? 'Reseller' : 'User';

    const nameRow = document.getElementById('opTiktokNameRow');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (d.tiktokName) { document.getElementById('opTiktokName').textContent = d.tiktokName; nameRow.classList.remove('hidden'); }
    const userRow = document.getElementById('opTiktokUserRow');
    if (d.tiktokUser && /^@[A-Za-z0-9._]{2,24}$/.test(d.tiktokUser)) {
        const a = document.getElementById('opTiktokUser');
        a.textContent = d.tiktokUser;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        a.href = 'https://www.tiktok.com/' + encodeURIComponent(d.tiktokUser).replace('%40', '@');
        userRow.classList.remove('hidden');
    }
    const panelRow = document.getElementById('opPanelRow');
    if (d.panelLink && /^https?:\/\//i.test(d.panelLink)) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const a = document.getElementById('opPanel');
        a.textContent = d.panelLink.replace(/^https?:\/\//i, '');
        a.href = d.panelLink;
        panelRow.classList.remove('hidden');
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    const badge = document.getElementById('opRankBadge');
    if (d.totalKeysBought >= 50) badge.innerHTML = '<i class="fas fa-trophy"></i> TOP BUYER';
    else if (d.totalKeysBought >= 10) badge.innerHTML = '<i class="fas fa-star"></i> REGULAR BUYER';
    else if (d.totalKeysBought > 0) badge.innerHTML = '<i class="fas fa-key"></i> BUYER';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else badge.textContent = '';
}
</script>
</body>
</html>
