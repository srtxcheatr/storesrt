<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'SRT X CHEATS — Nepali Panel Seller | Trusted Nepal Panel & Glory Bot Seller';
$metaDescription = 'SRT X CHEATS is Nepal\'s trusted Nepali panel seller: Glory Bot and game panels for iOS, Android (Root & Non-Root) and PC. Browse the full catalog free and buy instantly.';
$canonicalPath = '/';
$indexable = true;
// src by SRT X CHEATS. Copy right SRT X CHEATS
$currentPage = 'home';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>

<div class="term-window">
    <div class="term-content">

        <?php if (!empty(BANNERS)): ?>
        <div class="banner-carousel">
            <div class="banner-track" id="bannerTrack">
                <?php foreach (BANNERS as $b): ?>
                <a class="banner-slide" href="/store.php">
                    <img src="<?= htmlspecialchars($b['image']) ?>" alt="Promo banner" loading="lazy">
                </a>
                <?php endforeach; ?>
            </div>
            <div class="banner-dots" id="bannerDots"></div>
        </div>
        <?php endif; ?>

        <div class="panel panel-premium tilt" style="text-align:center">
            <h1 style="font-family:var(--font-heading);font-weight:800;font-size:16px;margin:0 0 4px">
                <span class="neon-cyan">SRT X CHEATS</span> — Nepali Panel Seller
            </h1>
            <div class="dim" style="font-size:12px">Nepal's trusted panel seller &amp; Glory Bot seller. Browse the full catalog free — login only takes a tap when you're ready to buy.</div>
        </div>

        <div class="prompt-header"><i class="fas fa-gamepad"></i> PRODUCTS CATALOG</div>
        <div style="position:relative;margin-bottom:10px">
            <i class="fas fa-magnifying-glass" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted)"></i>
            <input type="text" id="catalogSearch" placeholder="Search product cheats..." style="padding-left:38px">
        </div>

        <div id="catFilters" style="display:flex;gap:8px;margin-bottom:14px;overflow-x:auto;padding-bottom:4px">
            <button class="cat-filter active" data-tag="ALL"><i class="fas fa-layer-group"></i> ALL</button>
            <button class="cat-filter" data-tag="ROOT"><i class="fas fa-mobile-screen-button"></i> ROOT</button>
            <button class="cat-filter" data-tag="NONROOT"><i class="fas fa-tablet-screen-button"></i> NONROOT</button>
            <button class="cat-filter" data-tag="PC"><i class="fas fa-desktop"></i> PC</button>
            <button class="cat-filter" data-tag="IOS"><i class="fab fa-apple"></i> IOS</button>
        </div>

        <div id="catalogList" class="product-grid">
            <div class="dim" style="text-align:center;padding:30px;grid-column:1/-1">
                <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue);margin-bottom:8px"></i>
                <div>Loading catalog...</div>
            </div>
        </div>

        <section class="panel" style="margin-top:14px">
            <h2 class="prompt-header"><i class="fas fa-circle-info"></i> ABOUT SRT X CHEATS</h2>
            <p class="dim" style="font-size:12px;line-height:1.7">
                SRT X CHEATS is a trusted Nepali panel seller offering Glory Bot and game panels for every device:
                <strong>iOS</strong>, <strong>Android (Root and Non-Root)</strong> and <strong>PC</strong>.
                Browse the full product catalog for free, then sign in with Google to purchase.
                Need help? Follow the how-to-buy guide or contact support from the store page.
            </p>
        </section>

    </div>
</div>

<div id="gateModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:380px;width:100%;text-align:center">
        <div class="gate-icon"><i class="fas fa-lock"></i></div>
        <div class="prompt-header" style="justify-content:center">Login to Purchase</div>
        <div class="dim" style="font-size:12px;margin-bottom:18px" id="gateProductName">Sign in with Google to buy — it only takes a second.</div>
        <button class="btn btn-google" id="gateGoogleBtn" style="margin-bottom:8px"><i class="fab fa-google"></i> Continue with Google</button>
        <button class="btn btn-ghost" onclick="closeModal('gateModal')"><i class="fas fa-xmark"></i> Not Now</button>
    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import {
    optionalAuth, fetchPublicCatalog, toast, esc, enableTilt,
    auth, googleProvider, signInWithPopup, backendFetch,
} from '/assets/js/app.js?v=20261025-4';

// src by SRT X CHEATS. Copy right SRT X CHEATS
window.openModal = (id) => document.getElementById(id)?.classList.remove('hidden');
window.closeModal = (id) => document.getElementById(id)?.classList.add('hidden');

let catalog = {};
let searchQuery = '';
// src by SRT X CHEATS. Copy right SRT X CHEATS
let activeTag = 'ALL';
let lastGroups = [];

const tagOf = (row) => /root/i.test(row) && !/non ?root/i.test(row) ? 'ROOT'
    : /ios/i.test(row) ? 'IOS'
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    : /pc/i.test(row) ? 'PC'
    : 'NONROOT';

async function loadCatalog() {
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const d = await fetchPublicCatalog();
        catalog = d.catalog || {};
        renderCatalog();
    } catch (e) {
        document.getElementById('catalogList').innerHTML = `<div class="dim" style="text-align:center;padding:30px;grid-column:1/-1;color:var(--neon-red)"><i class="fas fa-exclamation-triangle"></i> Failed to load catalog</div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

function renderCatalog() {
    const groups = {};
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    for (const [sku, p] of Object.entries(catalog)) {
        if (!groups[p.row]) groups[p.row] = [];
        groups[p.row].push({ sku, ...p });
    }
    const q = searchQuery.trim().toLowerCase();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const filtered = Object.entries(groups).filter(([row, items]) => {
        if (activeTag !== 'ALL' && tagOf(row) !== activeTag) return false;
        if (!q) return true;
        return row.toLowerCase().includes(q) || items.some(it => it.name.toLowerCase().includes(q));
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS

    const container = document.getElementById('catalogList');
    if (!filtered.length) {
        container.innerHTML = '<div class="dim" style="text-align:center;padding:30px;grid-column:1/-1"><i class="fas fa-box-open"></i> No products match.</div>';
        return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }

    lastGroups = filtered.map(([row, items]) => ({ row, items }));

    container.innerHTML = lastGroups.map(({ row, items }, gi) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const prices = items.map(it => it.price);
        const minPrice = Math.min(...prices);
        const priceLabel = prices.every(p => p === minPrice) ? `Rs ${minPrice}` : `From Rs ${minPrice}`;
        return `
        <div class="product-card tilt">
            <div class="product-thumb">
                <img src="${items[0].image || ''}" alt="${esc(row)}" loading="lazy">
                <span class="product-tag">${tagOf(row)}</span>
                <span class="product-price-badge">${priceLabel}</span>
            </div>
            <div class="product-body">
                <div class="product-title">${esc(row)}</div>
                <div class="product-actions">
                    <button class="btn-buy" onclick="window.__gateBuy(${gi})"><i class="fas fa-lock"></i> Buy</button>
                    ${items[0].apkUrl ? `
                        <a href="${esc(items[0].apkUrl)}" target="_blank" class="btn-download" onclick="event.stopPropagation()">
                            <i class="fas fa-download"></i> Download
                        </a>
                    ` : ''}
                </div>
            </div>
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');

    enableTilt();
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

window.__gateBuy = (gi) => {
    const group = lastGroups[gi];
    if (!group) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('gateProductName').textContent = `Sign in with Google to buy "${group.row}" — it only takes a second.`;
    openModal('gateModal');
};

document.getElementById('gateGoogleBtn').onclick = async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        await signInWithPopup(auth, googleProvider);
        try { await backendFetch('/api/user/init', { method: 'POST' }); } catch (e) { console.error(e); }
        window.location.href = '/store.php';
    } catch (e) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (e.code !== 'auth/popup-closed-by-user') toast(e.message, 'error');
    }
};

document.getElementById('catalogSearch').addEventListener('input', (e) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    searchQuery = e.target.value;
    renderCatalog();
});
document.getElementById('catFilters').addEventListener('click', (e) => {
    const btn = e.target.closest('.cat-filter');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!btn) return;
    document.querySelectorAll('.cat-filter').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    activeTag = btn.dataset.tag;
    renderCatalog();
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

(function initBanners() {
    const track = document.getElementById('bannerTrack');
    if (!track) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const slides = track.children.length;
    if (!slides) return;
    const dotsWrap = document.getElementById('bannerDots');
    let idx = 0;
    for (let i = 0; i < slides; i++) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const dot = document.createElement('span');
        dot.className = 'banner-dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => go(i);
        dotsWrap.appendChild(dot);
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    function go(i) {
        idx = i;
        track.style.transform = `translateX(-${idx * 100}%)`;
        [...dotsWrap.children].forEach((d, di) => d.classList.toggle('active', di === idx));
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (slides > 1) setInterval(() => go((idx + 1) % slides), 4500);
})();

optionalAuth(() => {
    loadCatalog();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    enableTilt();
});
</script>
</body>
</html>
