<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
?>
<div id="welcomeModal" class="modal-overlay hidden" style="z-index:9600">
    <div class="panel" style="max-width:440px;width:100%;text-align:center;position:relative">
        <button type="button" id="welcomeCloseBtn" aria-label="Close" title="Close"
                style="position:absolute;top:8px;right:8px;width:32px;height:32px;border-radius:50%;border:1px solid var(--border,rgba(255,255,255,.2));background:rgba(255,255,255,.06);color:var(--text-secondary,#cbd5e1);cursor:pointer;font-size:14px;line-height:1">
            <i class="fas fa-xmark"></i>
        </button>
        <div class="prompt-header" style="justify-content:center">
            <i class="fas fa-hand-sparkles" style="color:var(--neon-amber)"></i> Welcome to SRT X CHEATS
        </div>
        <div style="font-size:13.5px;line-height:1.7;color:var(--text-secondary);margin:6px 0 18px">
            First watch all guide videos, then use the admin panel.
        </div>
        <button class="btn btn-solid" id="welcomeRedirectBtn" style="width:100%">
            <i class="fas fa-arrow-up-right-from-square"></i> REDIRECT
        </button>
    </div>
</div>

<div id="welcomeRedirectBanner" class="hidden" role="status">
    <i class="fas fa-circle-notch fa-spin"></i> You are redirecting
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
#welcomeRedirectBanner {
    position: fixed; top: 0; left: 0; right: 0; z-index: 9700;
    padding: 12px 16px; text-align: center; font-weight: 700; font-size: 13px;
    background: var(--neon-green, #22c55e); color: #05140a;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    box-shadow: 0 4px 18px rgba(0,0,0,.45);
}
#welcomeRedirectBanner.hidden { display: none; }
</style>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { auth, backendFetch, cachePatch, getData, toast } from '/assets/js/app.js?v=20261025-3';

let busy = false;
const okUrl = (u) => /^https?:\/\//i.test(u || '');
// src by SRT X CHEATS. Copy right SRT X CHEATS
const doneKey = () => 'srtx_welcome_done_' + (auth.currentUser?.uid || '');
const localDone = () => { try { return localStorage.getItem(doneKey()) === '1'; } catch (_) { return false; } };
const dismissedThisSession = () => { try { return sessionStorage.getItem('srtx_welcome_closed') === '1'; } catch (_) { return false; } };

const modalEl  = document.getElementById('welcomeModal');
const bannerEl = document.getElementById('welcomeRedirectBanner');
const btnEl    = document.getElementById('welcomeRedirectBtn');

// Hide popup + green "You are redirecting" banner and reset the button
function closeWelcome() {
    modalEl.classList.add('hidden');
    bannerEl.classList.add('hidden');
    btnEl.disabled = false;
    busy = false;
}

window.__openWelcomeModal = async () => {
    if (localDone() || dismissedThisSession()) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    let url = '';
    try {
        const d = await backendFetch('/api/user/welcome-redirect');
        if (d && d.show === false) return;
        url = d && d.url;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        console.warn('welcome-redirect endpoint unavailable, using default link:', e.message);
    }
    if (!okUrl(url)) url = window.WELCOME_REDIRECT_URL;
    if (!okUrl(url)) { console.warn('Welcome popup: no redirect link set'); return; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    btnEl.dataset.url = url;
    modalEl.classList.remove('hidden');
};

// Close button (X) and tap on the dark background
document.getElementById('welcomeCloseBtn').addEventListener('click', () => {
    try { sessionStorage.setItem('srtx_welcome_closed', '1'); } catch (_) {}
    closeWelcome();
});
modalEl.addEventListener('click', (ev) => {
    if (ev.target === modalEl) {
        try { sessionStorage.setItem('srtx_welcome_closed', '1'); } catch (_) {}
        closeWelcome();
    }
});

btnEl.addEventListener('click', async (ev) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (busy) return;
    const url = ev.currentTarget.dataset.url;
    if (!okUrl(url)) return;
    busy = true;
    btnEl.disabled = true;

    // Open the link in a NEW tab right inside the click (so the popup blocker allows it);
    // this page stays here and the popup is removed automatically.
    let opened = null;
    try { opened = window.open(url, '_blank', 'noopener'); } catch (_) {}

    bannerEl.classList.remove('hidden');
    modalEl.classList.add('hidden');
    try { localStorage.setItem(doneKey(), '1'); } catch (_) {}

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!opened) {
        // popup blocked -> fall back to same-tab redirect
        setTimeout(() => { window.location.href = url; }, 900);
    } else {
        setTimeout(closeWelcome, 1500);
    }

    try {
        await backendFetch('/api/user/welcome-redirect', { method: 'POST' });
        cachePatch('profile', { welcomeRedirectDone: true });
    } catch (e) {
        console.warn('Could not save welcome flag on the server (browser flag still set):', e.message);
    }
});

// If the user comes back (back button / tab switch) make sure nothing is left on screen
window.addEventListener('pageshow', () => { if (localDone()) closeWelcome(); });
document.addEventListener('visibilitychange', () => { if (!document.hidden && localDone()) closeWelcome(); });
</script>
