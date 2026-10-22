<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Login — SRT X CHEATS';
$bodyClass = 'auth-body';
require __DIR__ . '/includes/head.php';
?>

<div id="authChecking" style="text-align:center;padding-top:80px">
    <i class="fas fa-circle-notch fa-spin" style="font-size:26px;color:var(--neon-blue)"></i>
</div>

<div class="auth-shell hidden" id="authShell">
    <div class="auth-brand">
        <div class="logo-img-wrap" style="margin:0 auto">
            <img src="https://i.postimg.cc/qqYtBD3k/file-00000000470c8208bd1a0215abff7977.png" alt="Logo" class="site-logo">
        </div>
        <div class="auth-brand-title">SRT <span class="neon-cyan">X</span> CHEATS</div>
        <div class="auth-brand-sub" style="display:flex;align-items:center;justify-content:center;gap:8px">
            <span>Panels Hub</span>
            <button type="button" class="policy-info-btn" onclick="window.__openPolicyModal('readonly')" title="Terms &amp; Policy" aria-label="View Terms &amp; Policy">!</button>
        </div>
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
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
</style>
<script type="module">
import {
    auth, checkAuthOnce, backendFetch, toast, setButtonLoading, enableTilt,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    googleProvider, signInWithPopup, signInWithEmailAndPassword,
    createUserWithEmailAndPassword, sendPasswordResetEmail, getAdditionalUserInfo,
} from '/assets/js/app.js?v=20261018-2';

(async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const user = await checkAuthOnce();
    if (user) {
        window.location.href = '/dashboard.php';
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('authChecking').classList.add('hidden');
    document.getElementById('authShell').classList.remove('hidden');
    enableTilt();
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
    setButtonLoading(btn, true);
    try {
        await signInWithEmailAndPassword(auth, email, pass);
        await afterAuth();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        toast(e.message, 'error');
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
    setButtonLoading(btn, true);
    try {
        await createUserWithEmailAndPassword(auth, email, pass);
        await afterAuth({ name, phone, tiktokName, tiktokUser });
    } catch (e) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        toast(e.message, 'error');
        setButtonLoading(btn, false);
    }
};

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('googleBtn').onclick = async () => {
    try {
        const result = await signInWithPopup(auth, googleProvider);
        const isNewUser = !!getAdditionalUserInfo(result)?.isNewUser;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (isNewUser) {
            try { await backendFetch('/api/user/init', { method: 'POST' }); } catch (e) { console.error(e); }
            window.location.href = '/profile.php?complete=1';
            return;
        }
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        await afterAuth();
    } catch (e) {
        if (e.code !== 'auth/popup-closed-by-user') toast(e.message, 'error');
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
