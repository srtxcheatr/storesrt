<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$breadcrumb = $breadcrumb ?? $currentPage;
$pageTitles = ['dashboard' => 'Dashboard', 'store' => 'Store', 'history' => 'Order History', 'profile' => 'Profile', 'othersprofile' => 'Player Profile', 'apicontact' => 'Reseller API', 'glorybot' => 'FF Glory Bot', 'rewards' => 'Reward Center', 'support' => 'Support'];
$headerTitle = $pageTitles[$currentPage] ?? 'SRT X CHEATS';
$isGuestPage = $currentPage === 'home';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>
<style>
.order-status-btn { position: relative; width: 36px; height: 36px; border-radius: 50%; border: 1px solid rgba(0,200,255,.4); background: rgba(0,200,255,.12); color: var(--neon-blue, #00c8ff); display: flex; align-items: center; justify-content: center; font-size: 15px; text-decoration: none; transition: all .2s ease; }
.order-status-btn:hover { transform: scale(1.08); box-shadow: 0 0 12px rgba(0,200,255,.4); }
.order-status-btn.hidden { display: none; }
.order-status-dot { position: absolute; top: -2px; right: -2px; width: 11px; height: 11px; border-radius: 50%; background: #f5a623; border: 2px solid #0b0b1a; animation: osPulse 1.4s ease-in-out infinite; }
.order-status-dot.done { background: #22c55e; animation: none; }
.pro-crown-btn { position: relative; width: 36px; height: 36px; border-radius: 50%; border: 1px solid rgba(212,175,55,.5); background: rgba(212,175,55,.12); color: #d4af37; display: flex; align-items: center; justify-content: center; font-size: 15px; cursor: pointer; padding: 0; transition: all .2s ease; }
.pro-crown-btn:hover { transform: scale(1.08); }
.pro-crown-btn.hidden { display: none; }
.pro-crown-btn.active { background: linear-gradient(135deg,#f5dfa0,#d4af37 55%,#a9822a); color: #3a2a05; border-color: #f5dfa0; box-shadow: 0 0 14px rgba(212,175,55,.55); animation: crownGlow 2.4s ease-in-out infinite; }
.pro-crown-btn.pending { color: #f5a623; border-color: rgba(245,166,35,.5); }
.pro-crown-btn.approved { color: #22c55e; border-color: rgba(34,197,94,.55); background: rgba(34,197,94,.12); }
.pro-crown-btn.idle { opacity: .75; }
@keyframes crownGlow { 0%,100% { box-shadow: 0 0 8px rgba(212,175,55,.4); } 50% { box-shadow: 0 0 18px rgba(212,175,55,.8); } }
.fakepay-btn { position: relative; width: 36px; height: 36px; border-radius: 50%; border: 1px solid rgba(245,158,11,.55); background: rgba(245,158,11,.12); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 15px; cursor: pointer; padding: 0; }
.fakepay-btn.sev2 { color: #ef4444; border-color: rgba(239,68,68,.6); background: rgba(239,68,68,.12); }
.fakepay-btn.hidden { display: none; }
.fakepay-btn b { position: absolute; top: -4px; right: -4px; min-width: 15px; height: 15px; padding: 0 3px; border-radius: 8px; background: currentColor; font-size: 9px; line-height: 15px; text-align: center; }
.fakepay-btn b { color: #fff; mix-blend-mode: normal; }
[data-theme="light"] .pro-crown-btn { color: #8a6410; }
[data-theme="light"] .pro-crown-btn.active { color: #3a2a05; }
@keyframes osPulse { 0%,100% { box-shadow: 0 0 0 0 rgba(245,166,35,.6); } 50% { box-shadow: 0 0 0 6px rgba(245,166,35,0); } }
</style>
<header class="glass-nav-header">
    <div class="nav-container">
        <?php if (!$isGuestPage): ?>
        <button type="button" class="icon-btn" id="drawerToggle" title="Menu">
            <i class="fas fa-bars"></i>
        </button>
        <?php else: ?>
        <a href="/login.php" class="guest-login-btn"><i class="fas fa-right-to-bracket"></i> Login</a>
        <?php endif; ?>
        <div class="page-title"><?= htmlspecialchars($headerTitle) ?></div>
        <div class="nav-header-actions">
            <?php if (!$isGuestPage): ?>
            <button type="button" class="fakepay-btn hidden" id="fakePayBtn" title="Payment warning"><i class="fas fa-triangle-exclamation"></i><b></b></button>
            <button type="button" class="pro-crown-btn hidden" id="proCrownBtn" title="PRO RESELLER"><i class="fas fa-crown"></i></button>
            <?php endif; ?>
            <?php if (!$isGuestPage): ?>
            <a href="/registershopproject.php" class="order-status-btn hidden" id="orderStatusBtn" title="Shop order status">
                <i class="fas fa-truck-fast"></i><span class="order-status-dot" id="orderStatusDot"></span>
            </a>
            <?php endif; ?>
            <a href="https://chat.whatsapp.com/Fk0OvoMJg6C5PfyMx5lPhb" target="_blank"
               class="reseller-community-btn hidden" id="resellerCommunityBtn" title="Reseller Community">
                <i class="fab fa-whatsapp"></i>
            </a>
            <button type="button" class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light/Dark Theme">
                <i class="fas fa-moon moon-icon"></i>
                <i class="fas fa-sun sun-icon"></i>
            </button>
        </div>
    </div>
</header>

<?php if (!$isGuestPage): ?>
<div class="drawer-backdrop hidden" id="drawerBackdrop"></div>
<aside class="drawer-panel" id="drawerPanel">
    <div class="drawer-header">
        <div class="drawer-brand">
            <div class="logo-img-wrap" style="width:32px;height:32px">
                <img src="/assets/img/logo.png?v=1" alt="SRT X CHEATS Logo" class="site-logo">
            </div>
            <div class="brand-title" style="font-size:14px">SRT <span class="neon-cyan">X</span> CHEATS</div>
        </div>
        <button type="button" class="icon-btn" id="drawerClose" title="Close"><i class="fas fa-xmark"></i></button>
    </div>

    <div class="drawer-user">
        <div class="avatar-circle" id="drawerAvatar"><i class="fas fa-user"></i></div>
        <div class="drawer-user-name" id="drawerUserName">My Account</div>
    </div>

    <div class="drawer-balance-card">
        <div class="dbc-label"><i class="fas fa-wallet"></i> BALANCE</div>
        <div class="dbc-amount" id="drawerBalance">NRP —</div>
        <a href="/admin/owner.php" class="dbc-btn"><i class="fas fa-circle-plus"></i> Add Balance</a>
    </div>

    <div class="drawer-section-label">Menu</div>
    <a href="/dashboard.php" class="drawer-item <?= $currentPage === 'dashboard' ? 'active' : '' ?>"><i class="fas fa-gauge-high"></i> Dashboard</a>
    <a href="/store.php" class="drawer-item <?= $currentPage === 'store' ? 'active' : '' ?>"><i class="fas fa-store"></i> Store</a>
    <a href="/glorybot.php" class="drawer-item <?= $currentPage === 'glorybot' ? 'active' : '' ?>"><i class="fas fa-robot"></i> FF Glory Bot</a>
    <a href="/history.php" class="drawer-item <?= $currentPage === 'history' ? 'active' : '' ?>"><i class="fas fa-clock-rotate-left"></i> History</a>
    <a href="/rewards.php" class="drawer-item <?= $currentPage === 'rewards' ? 'active' : '' ?>"><i class="fas fa-gift"></i> Reward Center</a>
    <a href="/feedback.php" class="drawer-item <?= $currentPage === 'feedback' ? 'active' : '' ?>"><i class="fas fa-star"></i> Feedback</a>
    <a href="/apicontact.php" class="drawer-item hidden <?= $currentPage === 'apicontact' ? 'active' : '' ?>" id="resellerApiLink"><i class="fas fa-plug"></i> Reseller API</a>

    <div class="drawer-section-label">Account</div>
    <a href="/profile.php" class="drawer-item <?= $currentPage === 'profile' ? 'active' : '' ?>"><i class="fas fa-user-gear"></i> Profile</a>
    <a href="/support.php" class="drawer-item <?= $currentPage === 'support' ? 'active' : '' ?>"><i class="fas fa-headset"></i> Support</a>
    <a href="<?= htmlspecialchars(DEVELOPER_URL) ?>" target="_blank" class="drawer-item"><i class="fas fa-code"></i> About Developer</a>

    <button type="button" class="drawer-logout" id="drawerLogoutBtn">
        <i class="fas fa-right-from-bracket"></i> Logout
    </button>
</aside>

<nav class="bottom-tabbar">
    <a href="/dashboard.php" class="tab-item <?= $currentPage === 'dashboard' ? 'active' : '' ?>">
        <i class="fas fa-gauge-high"></i><span>Dashboard</span>
    </a>
    <a href="/store.php" class="tab-item <?= $currentPage === 'store' ? 'active' : '' ?>">
        <i class="fas fa-store"></i><span>Store</span>
    </a>
    <a href="/admin/owner.php" class="tab-fab" title="Add Balance"><i class="fas fa-coins"></i></a>
    <a href="/history.php" class="tab-item <?= $currentPage === 'history' ? 'active' : '' ?>">
        <i class="fas fa-clock-rotate-left"></i><span>History</span>
    </a>
    <button type="button" class="tab-item" id="drawerToggle2"><i class="fas fa-ellipsis"></i><span>More</span></button>
</nav>
<?php endif; ?>

<script>
// src by SRT X CHEATS. Copy right SRT X CHEATS
document.addEventListener('DOMContentLoaded', () => {
    const themeBtn = document.getElementById('themeToggleBtn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            localStorage.setItem('srtx_theme', newTheme);
        });
    }

    const drawerPanel = document.getElementById('drawerPanel');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const drawerBackdrop = document.getElementById('drawerBackdrop');
    if (drawerPanel && drawerBackdrop) {
        document.body.classList.add('has-sidebar');

        const openDrawer = () => { drawerPanel.classList.add('open'); drawerBackdrop.classList.remove('hidden'); drawerBackdrop.classList.add('show'); };
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const closeDrawer = () => { drawerPanel.classList.remove('open'); drawerBackdrop.classList.remove('show'); setTimeout(() => drawerBackdrop.classList.add('hidden'), 250); };
        window.openDrawer = openDrawer;
        window.closeDrawer = closeDrawer;
        document.getElementById('drawerToggle')?.addEventListener('click', openDrawer);
        document.getElementById('drawerToggle2')?.addEventListener('click', openDrawer);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('drawerClose')?.addEventListener('click', closeDrawer);
        drawerBackdrop.addEventListener('click', closeDrawer);
    }

    document.getElementById('drawerLogoutBtn')?.addEventListener('click', () => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (typeof window.doLogout === 'function') window.doLogout();
    });

    const communityBtn = document.getElementById('resellerCommunityBtn');
    const apiLink = document.getElementById('resellerApiLink');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (communityBtn || apiLink) {
        window.addEventListener('srtx:balance', (e) => {
            const isReseller = e.detail && (e.detail.role === 'reseller' || e.detail.role === 'pro_reseller');
            if (communityBtn) communityBtn.classList.toggle('hidden', !isReseller);
            if (apiLink) apiLink.classList.toggle('hidden', !isReseller);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        });
    }
});
</script>

<?php if (!$isGuestPage): ?>
<?php $proCard = false; require __DIR__ . '/pro-reseller.php'; ?>
<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
// Order-status icon: visible only when the user has a shop-project order; opens the live tracker.
import { backendFetch, toast } from '/assets/js/app.js?v=20261025-4';
if (typeof window.toast !== 'function') window.toast = toast;

const btn = document.getElementById('orderStatusBtn');
const dot = document.getElementById('orderStatusDot');
const CACHE_KEY = 'srtx_shop_orders';

function apply(orders) {
    if (!btn || !orders?.length) return;
    // open the newest unfinished order first, else the newest one
    const target = orders.find(o => o.stageIndex < 6) || orders[0];
    btn.href = '/registershopproject.php?order=' + encodeURIComponent(target.id);
    btn.title = target.stageIndex >= 6 ? 'Shop order — completed' : 'Shop order status';
    dot.classList.toggle('done', target.stageIndex >= 6);
    btn.classList.remove('hidden');
}

try {
    const c = JSON.parse(sessionStorage.getItem(CACHE_KEY) || 'null');
    if (c && Date.now() - c.t < 60000) apply(c.orders);   // instant paint while navigating
} catch (_) {}

async function load() {
    if (window.__shopOrdersLoaded) return;
    window.__shopOrdersLoaded = true;
    try {
        const r = await backendFetch('/api/shopsrc/my-orders');
        sessionStorage.setItem(CACHE_KEY, JSON.stringify({ t: Date.now(), orders: r.orders }));
        apply(r.orders);
    } catch (_) { window.__shopOrdersLoaded = false; }
}
load();                                          // do not depend on event timing
window.addEventListener('srtx:balance', load);   // retry once login has finished if the first try failed
</script>
<?php endif; ?>
