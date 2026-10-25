<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Customer Feedback — SRT X CHEATS';
$currentPage = 'feedback';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<style>
.fb-product-group { margin-bottom: 22px; }
.fb-product-heading { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 10px; flex-wrap: wrap; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.fb-product-heading h3 { font-size: 15px; font-weight: 800; margin: 0; }
.fb-product-avg { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--neon-amber, #d4af37); }
.fb-card { background: var(--glass-panel); border: 1px solid var(--glass-border); border-radius: var(--radius-md); padding: 12px 14px; margin-bottom: 8px; }
.fb-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
.fb-author { font-weight: 700; font-size: 13px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.fb-stars { color: var(--neon-amber, #d4af37); font-size: 12px; white-space: nowrap; }
.fb-comment { font-size: 12.5px; color: var(--text-secondary); line-height: 1.55; }
.fb-date { font-size: 10.5px; color: var(--text-muted); margin-top: 6px; }
.fb-result-btn {
    display: block; width: 100%; text-align: left; padding: 10px 12px; margin-top: 6px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background: var(--glass-panel); border: 1px solid var(--glass-border); border-radius: 10px;
    color: var(--text-primary); font-size: 13px; cursor: pointer;
}
.fb-result-btn:hover { border-color: var(--neon-blue); }
.feedback-star-picker { display: flex; justify-content: center; gap: 10px; font-size: 30px; padding: 6px 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.feedback-star-picker i { color: rgba(255,255,255,.25); cursor: pointer; transition: color .15s ease, transform .1s ease; }
.feedback-star-picker i:hover, .feedback-star-picker i.active { color: var(--neon-amber, #d4af37); }
.feedback-star-picker i:active { transform: scale(1.15); }
</style>

<div class="term-window">
    <div class="term-content">

        <div class="prompt-header"><i class="fas fa-comments"></i> CUSTOMER FEEDBACK</div>

        <div class="filter-tabs" style="margin-bottom:16px">
            <div class="tab active" id="fbTabRate" onclick="switchFbTab('rate')"><i class="fas fa-star"></i> RATE A PRODUCT</div>
            <div class="tab" id="fbTabAll" onclick="switchFbTab('all')"><i class="fas fa-comments"></i> ALL FEEDBACK</div>
        </div>

        <div id="fbRatePanel">
            <p class="dim" style="font-size:12px;margin-bottom:10px">Search a product you've bought, then rate it. Only verified buyers can leave a review.</p>
            <div class="search-box">
                <input type="text" id="fbProductSearch" placeholder="Search a product..." oninput="searchProducts()" />
            </div>
            <div id="fbProductResults"></div>

            <div id="fbRateForm" class="hidden" style="margin-top:16px">
                <div class="panel" style="text-align:center">
                    <div id="fbRateProductName" style="font-weight:700;margin-bottom:10px"></div>
                    <div class="feedback-star-picker" id="fbStarPicker">
                        <i class="far fa-star" data-star="1"></i><i class="far fa-star" data-star="2"></i><i class="far fa-star" data-star="3"></i><i class="far fa-star" data-star="4"></i><i class="far fa-star" data-star="5"></i>
                    </div>
                    <textarea id="fbComment" placeholder="Optional — tell others what you think..." style="margin-top:12px;min-height:70px;width:100%"></textarea>
                    <button class="btn btn-solid" id="fbSubmitBtn" style="margin-top:12px;width:100%"><i class="fas fa-paper-plane"></i> Submit Rating</button>
                </div>
            </div>
        </div>

        <div id="fbAllPanel" class="hidden">
            <div id="feedbackList">
                <div class="dim" style="text-align:center;padding:30px">
                    <i class="fas fa-circle-notch fa-spin" style="font-size:24px;color:var(--neon-blue);margin-bottom:8px"></i>
                    <div>Loading feedback...</div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, toast, esc, getData, cacheInvalidate } from '/assets/js/app.js?v=20261025-4';

let catalogCache = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
let allFeedbackLoaded = false;
let fbSelectedRow = null;
let fbStars = 0;

requireAuth(async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const d = await getData('catalog');
        catalogCache = d.catalog || {};
    } catch (e) {  }
});
// src by SRT X CHEATS. Copy right SRT X CHEATS

window.switchFbTab = (tab) => {
    document.getElementById('fbTabRate').classList.toggle('active', tab === 'rate');
    document.getElementById('fbTabAll').classList.toggle('active', tab === 'all');
    document.getElementById('fbRatePanel').classList.toggle('hidden', tab !== 'rate');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('fbAllPanel').classList.toggle('hidden', tab !== 'all');
    if (tab === 'all' && !allFeedbackLoaded) loadAllFeedback();
};

window.searchProducts = () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const q = document.getElementById('fbProductSearch').value.trim().toLowerCase();
    const resultsEl = document.getElementById('fbProductResults');
    if (!q || !catalogCache) { resultsEl.innerHTML = ''; return; }

    const seen = new Set();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const matches = [];
    for (const p of Object.values(catalogCache)) {
        if (!p.row || seen.has(p.row) || !p.row.toLowerCase().includes(q)) continue;
        seen.add(p.row);
        matches.push(p.row);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    resultsEl.innerHTML = matches.length
        ? matches.slice(0, 8).map(row => `<button type="button" class="fb-result-btn" onclick="window.selectProductToRate(${JSON.stringify(row)})">${esc(row)}</button>`).join('')
        : '<p class="dim" style="padding:10px;font-size:12px">No matching product.</p>';
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

window.selectProductToRate = (row) => {
    fbSelectedRow = row;
    fbStars = 0;
    document.getElementById('fbRateProductName').textContent = row;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('fbComment').value = '';
    document.querySelectorAll('#fbStarPicker i').forEach(s => { s.className = 'far fa-star'; });
    document.getElementById('fbRateForm').classList.remove('hidden');
    document.getElementById('fbProductResults').innerHTML = '';
    document.getElementById('fbProductSearch').value = row;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('fbRateForm').scrollIntoView({ behavior: 'smooth', block: 'center' });
};

document.getElementById('fbStarPicker').addEventListener('click', (e) => {
    const starEl = e.target.closest('[data-star]');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!starEl) return;
    fbStars = Number(starEl.dataset.star);
    document.querySelectorAll('#fbStarPicker i').forEach(s => {
        s.className = Number(s.dataset.star) <= fbStars ? 'fas fa-star active' : 'far fa-star';
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

function setBtnLoading(btn, loading, label) {
    btn.disabled = loading;
    btn.innerHTML = loading ? '<i class="fas fa-spinner fa-spin"></i> Submitting...' : label;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

document.getElementById('fbSubmitBtn').onclick = async () => {
    if (!fbSelectedRow) return toast('Search and pick a product first', 'error');
    if (!fbStars) return toast('Tap a star to rate it', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const btn = document.getElementById('fbSubmitBtn');
    const label = '<i class="fas fa-paper-plane"></i> Submit Rating';
    setBtnLoading(btn, true, label);
    try {
        await backendFetch('/api/user/feedback', {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            method: 'POST',
            body: JSON.stringify({ row: fbSelectedRow, stars: fbStars, comment: document.getElementById('fbComment').value.trim() }),
        });
        toast('Thanks for the feedback!', 'success');
        cacheInvalidate('feedback', 'catalog');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('fbRateForm').classList.add('hidden');
        document.getElementById('fbProductSearch').value = '';
        fbSelectedRow = null;
        allFeedbackLoaded = false;
    } catch (e) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        toast(e.message || 'Could not submit', 'error');
    } finally {
        setBtnLoading(btn, false, label);
    }
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function loadAllFeedback() {
    try {
        const d = await getData('feedback');
        allFeedbackLoaded = true;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderAllFeedback(d.feedback || []);
    } catch (e) {
        document.getElementById('feedbackList').innerHTML = `<div class="dim" style="text-align:center;padding:30px;color:var(--neon-red)"><i class="fas fa-triangle-exclamation"></i> Couldn't load feedback: ${esc(e.message)}</div>`;
    }
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function starsHtml(stars) {
    let html = '';
    for (let i = 1; i <= 5; i++) html += `<i class="${i <= stars ? 'fas' : 'far'} fa-star"></i>`;
    return html;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function fmtDate(ms) {
    try {
        return new Date(ms).toLocaleDateString('en-US', { timeZone: 'Asia/Kathmandu', year: 'numeric', month: 'short', day: 'numeric' });
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) { return ''; }
}

function renderAllFeedback(feedback) {
    const list = document.getElementById('feedbackList');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!feedback.length) {
        list.innerHTML = '<div class="dim" style="text-align:center;padding:30px"><i class="fas fa-comment-slash"></i> No feedback yet — be the first to review a product you\'ve bought!</div>';
        return;
    }

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const groups = {};
    for (const f of feedback) {
        if (!groups[f.row]) groups[f.row] = [];
        groups[f.row].push(f);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    const rows = Object.entries(groups).sort((a, b) => {
        const avgA = a[1].reduce((s, f) => s + f.stars, 0) / a[1].length;
        const avgB = b[1].reduce((s, f) => s + f.stars, 0) / b[1].length;
        return avgB - avgA || b[1].length - a[1].length;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    });

    list.innerHTML = rows.map(([row, items]) => {
        const avg = Math.round((items.reduce((s, f) => s + f.stars, 0) / items.length) * 10) / 10;
        return `
        <div class="fb-product-group">
            <div class="fb-product-heading">
                <h3>${esc(row)}</h3>
                <div class="fb-product-avg">${starsHtml(Math.round(avg))} <span>${avg.toFixed(1)} · ${items.length} review${items.length === 1 ? '' : 's'}</span></div>
            </div>
            ${items.map(f => `
                <div class="fb-card">
                    <div class="fb-card-top">
                        <span class="fb-author">${esc(f.authorName || 'Anonymous')}</span>
                        <span class="fb-stars">${starsHtml(f.stars)}</span>
                    </div>
                    ${f.comment ? `<div class="fb-comment">${esc(f.comment)}</div>` : ''}
                    <div class="fb-date"><i class="far fa-clock"></i> ${fmtDate(f.createdAt)}</div>
                </div>
            `).join('')}
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');
}
</script>
