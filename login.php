<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Login — SRT X CHEATS';
$bodyClass = 'auth-body';
require __DIR__ . '/includes/head.php';
?>

<div id="authChecking" style="text-align:center;padding-top:80px">
    <i class="fas fa-circle-notch fa-spin" style="font-size:26px;color:var(--neon-blue)"></i>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
#authBusy { position: fixed; inset: 0; z-index: 9400; display: flex; align-items: center; justify-content: center; padding: 16px;
    background: rgba(4, 3, 12, .78); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
#authBusy.hidden { display: none !important; }
#authBusy .box { max-width: 340px; width: 100%; text-align: center; padding: 26px 20px 20px; border-radius: 16px;
    background: var(--glass-panel, rgba(26, 23, 53, .96)); border: 1px solid var(--glass-border, rgba(168, 85, 247, .35)); box-shadow: 0 14px 50px rgba(0, 0, 0, .55); }
#authBusy .spin { font-size: 32px; color: var(--neon-blue, #22d3ee); }
#authBusy .t { margin-top: 14px; font-weight: 800; font-size: 15px; color: var(--text-primary, #f1f5f9); }
#authBusy .h { margin-top: 6px; min-height: 36px; font-size: 12.5px; line-height: 1.55; color: var(--text-secondary, #94a3b8); }
#authBusy .bar { margin: 12px 0 14px; height: 4px; border-radius: 999px; overflow: hidden; background: rgba(148, 163, 184, .25); }
#authBusy .bar i { display: block; height: 100%; width: 40%; border-radius: inherit; background: linear-gradient(90deg, var(--neon-purple, #a855f7), var(--neon-blue, #22d3ee)); animation: authBar 1.3s ease-in-out infinite; }
@keyframes authBar { 0% { transform: translateX(-100%); } 100% { transform: translateX(260%); } }
#authBusy .btn { width: 100%; }
@media (prefers-reduced-motion: reduce) { #authBusy .bar i { animation: none; width: 100%; } }
</style>
<div id="authBusy" class="hidden" role="alertdialog" aria-live="polite" aria-labelledby="authBusyT">
    <div class="box">
        <i class="fas fa-circle-notch fa-spin spin"></i>
        <div class="t" id="authBusyT">Signing in…</div>
        <div class="h" id="authBusyH"></div>
        <div class="bar"><i></i></div>
        <button type="button" class="btn btn-ghost" id="authBusyCancel"><i class="fas fa-xmark"></i> Cancel</button>
    </div>
</div>

<div class="auth-shell hidden" id="authShell">
    <div class="auth-brand">
        <div class="logo-img-wrap" style="margin:0 auto">
            <img src="/assets/img/logo.png?v=1" alt="Logo" class="site-logo">
        </div>
        <div class="auth-brand-title">SRT <span class="neon-cyan">X</span> CHEATS</div>
        <div class="auth-brand-sub" style="display:flex;align-items:center;justify-content:center;gap:8px">
            <span>Panels Hub</span>
            <button type="button" class="policy-info-btn" onclick="window.__openPolicyModal('readonly')" title="Terms &amp; Policy" aria-label="View Terms &amp; Policy">!</button>
        </div>
    </div>

    <div id="authError" class="auth-error hidden" role="alert" aria-live="assertive">
        <i class="fas fa-triangle-exclamation"></i>
        <span id="authErrorMsg"></span>
        <button type="button" id="authErrorClose" aria-label="Dismiss"><i class="fas fa-xmark"></i></button>
    </div>

    <div class="panel tilt form-pane" id="loginPane">
        <div class="prompt-header"><i class="fas fa-right-to-bracket"></i> ACCOUNT LOGIN</div>
        <div class="field">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="loginEmail" placeholder="you@example.com" autocomplete="username">
        </div>
        <div class="field">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="loginPass" placeholder="••••••••" autocomplete="current-password">
        </div>
        <button class="btn btn-solid" id="loginBtn" style="margin-bottom:10px"><i class="fas fa-arrow-right-to-bracket"></i> Login</button>

        <div class="auth-divider">or</div>

        <button class="btn btn-google" id="googleBtn" style="margin-bottom:8px"><i class="fab fa-google"></i> Continue with Google</button>
        <button class="btn btn-guest" id="guestBtn" style="margin-bottom:8px"><i class="fas fa-user-secret"></i> Continue as Guest</button>
        <?php $copyrightInline = true; require __DIR__ . '/includes/copyright.php'; ?>

        <div style="display:flex;justify-content:space-between;font-size:12px">
            <a href="/passfor.php" id="forgotLink"><i class="fas fa-key"></i> Forgot Password?</a>
            <a href="#" id="openSignup"><i class="fas fa-user-plus"></i> Register</a>
        </div>
    </div>

    <div class="panel tilt form-pane hidden" id="regPane">
        <div class="prompt-header"><i class="fas fa-user-plus"></i> REGISTER ACCOUNT</div>
        <div class="field">
            <label><i class="fas fa-user"></i> Username</label>
            <input type="text" id="regName" placeholder="Your name" autocomplete="name">
        </div>
        <div class="field">
            <label><i class="fab fa-whatsapp"></i> Number</label>
            <input type="text" id="regPhone" placeholder="98xxxxxxxx" autocomplete="tel" inputmode="tel">
        </div>
        <div class="field">
            <label><i class="fab fa-tiktok"></i> TikTok Name</label>
            <input type="text" id="regTiktokName" placeholder="SRT X CHEATS" autocomplete="off" maxlength="60">
        </div>
        <div class="field">
            <label><i class="fab fa-tiktok"></i> TikTok Username</label>
            <input type="text" id="regTiktokUser" placeholder="@srtxcheats" autocomplete="off" maxlength="25">
        </div>
        <div class="field">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="regEmail" placeholder="you@example.com" autocomplete="username">
        </div>
        <div class="field">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="regPass" placeholder="•••••••• (min 6 chars)" autocomplete="new-password">
        </div>
        <div class="field">
            <label><i class="fas fa-lock"></i> Confirm Password</label>
            <input type="password" id="regPassConfirm" placeholder="Repeat your password" autocomplete="new-password">
        </div>
        <button class="btn btn-solid" id="signupBtn" style="margin-bottom:12px"><i class="fas fa-user-check"></i> Create Account</button>
        <div style="text-align:center;font-size:12px">
            <a href="#" id="openLogin"><i class="fas fa-arrow-left"></i> Back to Login</a>
        </div>
    </div>

    <div class="panel" style="text-align:center;border-color:var(--neon-red)">
        <a href="https://youtube.com/shorts/-2dt10F2smM?si=yysjGONTDh5ComlY" target="_blank" style="color:var(--neon-red);font-weight:700;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:8px">
            <i class="fab fa-youtube" style="font-size:22px"></i>
            <span>Watch: How to buy or add balance <i class="fas fa-coins"></i></span>
        </a>
    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
body.auth-body{flex-direction:column}
.auth-shell{width:min(400px,100%);max-width:100%}
.auth-error{display:flex;align-items:flex-start;gap:10px;margin:0 0 12px;padding:12px 14px;border-radius:12px;font-size:13px;line-height:1.5;font-weight:600;
    color:#fecaca;background:rgba(239,68,68,.14);border:1px solid rgba(239,68,68,.55);box-shadow:0 6px 24px rgba(239,68,68,.18)}
.auth-error.hidden{display:none!important}
.auth-error>i:first-child{margin-top:2px;color:#f87171}
.auth-error span{flex:1}
.auth-error button{background:none;border:0;color:inherit;cursor:pointer;padding:2px 4px;font-size:14px;opacity:.8}
[data-theme="light"] .auth-error{color:#991b1b;background:rgba(239,68,68,.1)}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
</style>
<script type="module">
import {
    auth, checkAuthOnce, backendFetch, toast, setButtonLoading, enableTilt,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    googleProvider, signInWithPopup, signInWithEmailAndPassword,
    createUserWithEmailAndPassword, sendPasswordResetEmail, getAdditionalUserInfo,
} from '/assets/js/app.js?v=20261025-4';
// same Firebase module URL as app.js, so this is the very same instance (no app.js change = no cache problems)
import { onAuthStateChanged, signInWithRedirect, getRedirectResult } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js';

let bootError = null;
(async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    // coming back from a Google redirect (used when the popup is blocked): finish it here
    try {
        const rr = await getRedirectResult(auth);
        if (rr && rr.user) { googlePending = true; await finishGoogle(rr.user, !!getAdditionalUserInfo(rr)?.isNewUser); return; }
    } catch (e) { if (e && e.code && e.code !== 'auth/no-auth-event') bootError = friendlyAuthError(e); }
    const user = await checkAuthOnce();
    if (user) {
        window.location.href = '/dashboard.php';
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('authChecking').classList.add('hidden');
    document.getElementById('authShell').classList.remove('hidden');
    enableTilt();
    if (bootError) showAuthError(bootError);
    else if (!navigator.onLine) showAuthError('You are offline. Please check your internet connection.');
})();

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('openSignup').onclick = (e) => {
    e.preventDefault();
    document.getElementById('loginPane').classList.add('hidden');
    document.getElementById('regPane').classList.remove('hidden');
};
// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('openLogin').onclick = (e) => {
    e.preventDefault();
    document.getElementById('regPane').classList.add('hidden');
    document.getElementById('loginPane').classList.remove('hidden');
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function afterAuth(profileFields) {
    try { await backendFetch('/api/user/init', { method: 'POST', body: JSON.stringify(profileFields || {}) }); } catch (e) { console.error(e); }
    try { sessionStorage.setItem('srtx_session_inited', '1'); } catch (e) {}
    window.location.href = '/dashboard.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('loginBtn').onclick = async () => {
    const email = document.getElementById('loginEmail').value.trim();
    const pass = document.getElementById('loginPass').value;
    if (!email || !pass) return toast('Fill both fields', 'error');
    const btn = document.getElementById('loginBtn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    hideAuthError();
    if (!navigator.onLine) return showAuthError('You are offline. Please check your internet connection and try again.');
    setButtonLoading(btn, true);
    try {
        await withSlowGuard(signInWithEmailAndPassword(auth, email, pass), 'login');
        await afterAuth();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        if (auth.currentUser && e && e.code === 'auth/timeout') { await afterAuth(); return; }   // it did finish, just late
        showAuthError(friendlyAuthError(e));
        setButtonLoading(btn, false);
    }
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('signupBtn').onclick = async () => {
    const name = document.getElementById('regName').value.trim();
    const phone = document.getElementById('regPhone').value.trim();
    const tiktokName = document.getElementById('regTiktokName').value.trim();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const tiktokUser = document.getElementById('regTiktokUser').value.trim();
    const email = document.getElementById('regEmail').value.trim();
    const pass = document.getElementById('regPass').value;
    const passConfirm = document.getElementById('regPassConfirm').value;
    if (!name || !phone || !tiktokName || !tiktokUser || !email || !pass || !passConfirm) return toast('Fill all fields', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!/^@?[A-Za-z0-9._]{2,24}$/.test(tiktokUser)) return toast('TikTok username: letters, numbers, dots and underscores only (e.g. @srtxcheats)', 'error');
    if (pass.length < 6) return toast('Password must be at least 6 characters', 'error');
    if (pass !== passConfirm) return toast('Passwords do not match', 'error');
    const btn = document.getElementById('signupBtn');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    hideAuthError();
    if (!navigator.onLine) return showAuthError('You are offline. Please check your internet connection and try again.');
    setButtonLoading(btn, true);
    try {
        await withSlowGuard(createUserWithEmailAndPassword(auth, email, pass), 'signup');
        await afterAuth({ name, phone, tiktokName, tiktokUser });
    } catch (e) {
        if (auth.currentUser && e && e.code === 'auth/timeout') { await afterAuth({ name, phone, tiktokName, tiktokUser }); return; }
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        showAuthError(friendlyAuthError(e));
        setButtonLoading(btn, false);
    }
};

// src by SRT X CHEATS. Copy right SRT X CHEATS
// ---- Google sign-in, built for slow connections --------------------------------------------------------
// The Google popup closes as soon as the account is chosen, but Firebase still has to finish the sign-in over the network.
// On a slow line that can take many seconds, so we (1) show a progress screen at once, (2) wait for the session itself
// instead of trusting the popup's result alone, and (3) never swallow the outcome silently.
let googlePending = false, finishing = false, busyToken = 0, hintTimer = null;
const $ = (id) => document.getElementById(id);

const busy = {
    show(title, hint) {
        $('authBusyT').textContent = title; $('authBusyH').textContent = hint || '';
        $('authBusy').classList.remove('hidden');
        clearTimeout(hintTimer);
        hintTimer = setTimeout(() => { $('authBusyH').textContent = 'Slow connection detected. Please keep this page open, it can take up to a minute.'; }, 7000);
    },
    hide() { clearTimeout(hintTimer); $('authBusy').classList.add('hidden'); },
};
function friendlyAuthError(e) {
    const c = e && e.code;
    if (c === 'auth/network-request-failed') return 'Poor or no internet connection. Login failed, please check your network and try again.';
    if (c === 'auth/timeout') return 'Your network is too slow, login did not finish. Please try again.';
    if (c === 'auth/invalid-credential' || c === 'auth/wrong-password' || c === 'auth/user-not-found' || c === 'auth/invalid-login-credentials') return 'Login failed: wrong email or password.';
    if (c === 'auth/invalid-email') return 'Please enter a valid email address.';
    if (c === 'auth/email-already-in-use') return 'This email is already registered. Please log in instead.';
    if (c === 'auth/weak-password') return 'Password is too weak. Use at least 6 characters.';
    if (c === 'auth/user-disabled') return 'This account has been disabled. Contact support.';
    if (c === 'auth/unauthorized-domain') return 'This domain is not allowed for Google sign-in. Contact support.';
    if (c === 'auth/too-many-requests') return 'Too many attempts. Please wait a minute and try again.';
    if (c === 'auth/popup-closed-by-user' || c === 'auth/cancelled-popup-request') return 'Sign-in did not finish. The Google window was closed, or your network is slow. Please try again.';
    if (c === 'auth/popup-blocked') return 'The sign-in window was blocked by your browser. Please allow pop-ups and try again.';
    if (!navigator.onLine) return 'You are offline. Please check your internet connection.';
    return (e && e.message && !/^Firebase:/i.test(e.message) ? e.message : 'Login failed. Please try again.');
}
// Visible, persistent error (a toast alone disappears in a few seconds and is easy to miss on a slow connection)
function showAuthError(msg) {
    const box = $('authError');
    if (!box) { toast(msg, 'error'); return; }
    $('authErrorMsg').textContent = msg;
    box.classList.remove('hidden');
    try { box.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); } catch (_) {}
    toast(msg, 'error');
}
function hideAuthError() { const b = $('authError'); if (b) b.classList.add('hidden'); }
$('authErrorClose').onclick = hideAuthError;
// never let a request hang forever on a bad network: fail with a clear message after `ms`
function withSlowGuard(promise, _what, ms = 30000) {
    let t;
    const timeout = new Promise((_, rej) => { t = setTimeout(() => rej(Object.assign(new Error('timeout'), { code: 'auth/timeout' })), ms); });
    return Promise.race([promise, timeout]).finally(() => clearTimeout(t));
}
const isNewGoogleUser = (u) => {                                  // a brand-new account has creation time == first sign-in time
    const m = (u && u.metadata) || {}, c = Date.parse(m.creationTime), l = Date.parse(m.lastSignInTime);
    return !isNaN(c) && !isNaN(l) && Math.abs(l - c) < 15000;
};
async function finishGoogle(user, isNew) {
    if (finishing) return;
    finishing = true;
    busy.show('Signing you in…', 'Almost done, loading your account.');
    if (isNew) {
        try { await backendFetch('/api/user/init', { method: 'POST' }); } catch (e) { console.error(e); }
        window.location.href = '/profile.php?complete=1';
        return;
    }
    await afterAuth();
}
// resolves with the signed-in user as soon as Firebase has one (or null after `ms` / when the user cancels)
function waitForUser(ms, token) {
    return new Promise((resolve) => {
        const t0 = Date.now();
        const iv = setInterval(() => {
            if (auth.currentUser) { clearInterval(iv); resolve(auth.currentUser); }
            else if (token !== busyToken || Date.now() - t0 > ms) { clearInterval(iv); resolve(null); }
        }, 300);
    });
}
// safety net: if the session appears while a Google sign-in is pending (popup said "closed", promise never answered...), continue
onAuthStateChanged(auth, (u) => { if (u && googlePending && !finishing) finishGoogle(u, isNewGoogleUser(u)); });

$('authBusyCancel').onclick = () => { busyToken++; googlePending = false; finishing = false; busy.hide(); };
window.addEventListener('offline', () => { if (!$('authBusy').classList.contains('hidden')) $('authBusyH').textContent = 'You went offline. Reconnect and keep this page open, or tap Cancel.'; });

$('googleBtn').onclick = async () => {
    if (googlePending) return;
    hideAuthError();
    if (!navigator.onLine) return showAuthError('You are offline. Please check your internet connection and try again.');
    googlePending = true;
    const token = ++busyToken;
    busy.show('Connecting to Google…', 'Choose your account in the Google window.');
    try {
        const result = await signInWithPopup(auth, googleProvider);
        if (token !== busyToken) return;                          // user cancelled meanwhile
        await finishGoogle(result.user, !!getAdditionalUserInfo(result)?.isNewUser);
    } catch (e) {
        if (token !== busyToken) return;
        const code = e && e.code;
        if (code === 'auth/popup-blocked') {                      // pop-ups not allowed (in-app browsers): use a full-page redirect instead
            busy.show('Redirecting to Google…', '');
            try { await signInWithRedirect(auth, googleProvider); return; } catch (e2) { e = e2; }
        }
        if (code === 'auth/popup-closed-by-user' || code === 'auth/cancelled-popup-request' || code === 'auth/network-request-failed' || code === 'auth/timeout') {
            // On slow connections the popup often closes BEFORE Firebase has finished: give the session time to arrive.
            busy.show('Finishing sign-in…', 'If you closed the Google window on purpose, tap Cancel.');
            const u = await waitForUser(45000, token);
            if (token !== busyToken) return;                      // user tapped Cancel on purpose: stay quiet
            if (u) { await finishGoogle(u, isNewGoogleUser(u)); return; }
            // timed out: ALWAYS tell the user it failed (before, a closed popup just made the screen vanish)
            googlePending = false; finishing = false; busy.hide();
            showAuthError(code === 'auth/popup-closed-by-user' ? friendlyAuthError({ code: 'auth/timeout' }) : friendlyAuthError(e));
            return;
        } else {
            googlePending = false; finishing = false; busy.hide();
            showAuthError(friendlyAuthError(e));
            return;
        }
        googlePending = false; finishing = false; busy.hide();
    }
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('guestBtn').onclick = () => {
    window.location.href = '/home.php';
};

</script>

<?php require __DIR__ . '/includes/policy-modal.php'; ?>

</body>
</html>
