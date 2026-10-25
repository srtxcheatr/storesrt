<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Profile — SRT X CHEATS';
$currentPage = 'profile';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <div class="profile-hero" id="profHero">
            <div class="avatar-wrap">
                <div class="profile-avatar" id="profAvatar">?</div>
                <button type="button" class="avatar-edit-btn" id="avatarEditBtn" title="Change profile photo"><i class="fas fa-camera"></i></button>
            </div>
            <div class="profile-name"><span id="profDisplayName">—</span></div>
            <div class="profile-email" id="profDisplayEmail">—</div>
        </div>

        <div class="section-divider"><i class="fas fa-id-card"></i> Account Details</div>
        <div class="panel tilt">
            <div class="field"><label><i class="fas fa-user"></i> Name</label><input type="text" id="profName" placeholder="Your Full Name" maxlength="60">
                <div class="field-hint lock-hint" id="hintName" data-field="name" data-every="7 days"></div></div>
            <div class="field"><label><i class="fab fa-whatsapp"></i> Phone / WhatsApp Number</label><input type="text" id="profPhone" placeholder="98xxxxxxxx" maxlength="30">
                <div class="field-hint lock-hint" id="hintPhone" data-field="phone" data-every="2 days"></div></div>
            <div class="field"><label><i class="fab fa-tiktok"></i> TikTok Name</label><input type="text" id="profTiktokName" placeholder="SRT X CHEATS" maxlength="60"></div>
            <div class="field"><label><i class="fab fa-tiktok"></i> TikTok Username</label><input type="text" id="profTiktokUser" placeholder="@srtxcheats" maxlength="25" autocapitalize="none"></div>
            <div class="field hidden" id="panelLinkField"><label><i class="fas fa-link"></i> Your Own Panel Link <span class="dim">(reseller)</span></label><input type="text" id="profPanelLink" placeholder="xxxxxxx.com" maxlength="200" autocapitalize="none">
                <div class="field-hint lock-hint" id="hintPanel" data-field="panelLink" data-every="1 day"></div></div>
            <button class="btn btn-solid" id="saveProfile" style="margin-bottom:14px;position:relative">
                <span class="btn-text"><i class="fas fa-floppy-disk"></i> Save Details</span>
                <span class="btn-spinner hidden"><span class="spinner"></span></span>
            </button>
            <div class="field"><label><i class="fas fa-envelope"></i> Email</label><input type="text" id="profEmail" readonly style="opacity:0.7"></div>
            <div class="field" style="margin-bottom:0">
                <label><i class="fas fa-fingerprint" style="color:var(--neon-amber)"></i> User ID (UID)</label>
                <div style="display:flex;gap:6px">
                    <input type="text" id="profUid" readonly style="opacity:0.8;font-family:var(--font-mono);font-size:12px;letter-spacing:0.5px">
                    <button type="button" class="btn btn-ghost" id="copyUidBtn" style="padding:0 12px" title="Copy UID"><i class="fas fa-copy"></i></button>
                </div>
            </div>
        </div>

        <div class="section-divider"><i class="fas fa-shield-halved"></i> Security</div>
        <div class="panel tilt">
            <div class="field"><label>Current Password</label><input type="password" id="curPass" autocomplete="current-password"></div>
            <div class="field"><label>New Password (min 6 chars)</label><input type="password" id="newPass" autocomplete="new-password"></div>
            <button class="btn btn-solid" id="savePassword" style="margin-bottom:8px;position:relative">
                <span class="btn-text"><i class="fas fa-key"></i> Update Password</span>
                <span class="btn-spinner hidden"><span class="spinner"></span></span>
            </button>
            <div class="field-hint">Forgot your current password? Use the Gmail OTP recovery flow.</div>
            <a class="btn btn-ghost profile-forgot-link" href="/passfor.php">
                <i class="fas fa-key"></i> Forgot Password?
            </a>
        </div>

    </div>
</div>

<div class="modal-overlay hidden" id="avatarModal">
    <div class="panel avatar-editor">
        <div class="prompt-header" style="text-align:center"><i class="fas fa-camera" style="color:var(--neon-blue)"></i> PROFILE PHOTO</div>
        <div class="field-hint" style="text-align:center;margin:6px 0 12px">Drag to position · use the slider to zoom. Shown as a circle. You can change your photo once every 7 days.</div>

        <div class="avatar-stage" id="avatarStage">
            <canvas id="avatarCanvas" width="260" height="260"></canvas>
            <div class="avatar-stage-empty" id="avatarEmpty"><i class="fas fa-image"></i><span>Choose a photo to start</span></div>
        </div>

        <input type="file" id="avatarFile" accept="image/png,image/jpeg,image/webp" hidden>
        <button type="button" class="btn btn-ghost" id="avatarPickBtn" style="width:100%;margin:12px 0 4px"><i class="fas fa-folder-open"></i> Choose photo</button>

        <div class="field" style="text-align:left;margin-top:10px"><label><i class="fas fa-magnifying-glass-plus"></i> Zoom</label>
            <input type="range" id="avatarZoom" min="1" max="4" step="0.01" value="1" disabled>
        </div>
        <div class="field" style="text-align:left"><label><i class="fas fa-expand"></i> Photo size</label>
            <select id="avatarSize">
                <option value="256">Standard — 256 × 256</option>
                <option value="512">HD — 512 × 512</option>
                <option value="1024" selected>Ultra HD — 1024 × 1024 (sharpest, recommended)</option>
            </select>
        </div>

        <div style="display:flex;gap:8px">
            <button type="button" class="btn btn-ghost" id="avatarCancelBtn" style="flex:1">Cancel</button>
            <button type="button" class="btn btn-solid" id="avatarSaveBtn" style="flex:2;position:relative" disabled>
                <span class="btn-text"><i class="fas fa-cloud-arrow-up"></i> Save photo</span>
                <span class="btn-spinner hidden"><span class="spinner"></span></span>
            </button>
        </div>
        <button type="button" class="btn btn-ghost" id="avatarRemoveBtn" style="width:100%;margin-top:8px;color:var(--neon-red);display:none"><i class="fas fa-trash"></i> Remove current photo</button>
    </div>
</div>

<div class="modal-overlay hidden" id="completeProfileModal">
    <div class="panel" style="max-width:400px;width:100%;text-align:center">
        <i class="fas fa-user-pen" style="font-size:28px;color:var(--neon-blue);margin-bottom:10px;display:block"></i>
        <div class="prompt-header" style="text-align:center">COMPLETE YOUR PROFILE</div>
        <div class="field-hint" style="margin-bottom:14px">Your name and number are required. Please fill your details.</div>
        <div class="field" style="text-align:left"><label><i class="fas fa-user"></i> Name</label><input type="text" id="cpName" placeholder="Your Full Name"></div>
        <div class="field" style="text-align:left"><label><i class="fab fa-whatsapp"></i> Number</label><input type="text" id="cpPhone" placeholder="98xxxxxxxx"></div>
        <button class="btn btn-solid" id="completeProfileBtn" style="position:relative">
            <span class="btn-text"><i class="fas fa-check"></i> Save & Continue</span>
            <span class="btn-spinner hidden"><span class="spinner"></span></span>
        </button>
    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import {
    requireAuth, backendFetch, toast, setButtonLoading, enableTilt,
    getData, cachePeek, cacheInvalidate, applyProfileChange, renderAvatar,
    auth, EmailAuthProvider, reauthenticateWithCredential, updatePassword,
} from '/assets/js/app.js?v=20261025-4';
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { setAvatarBadge, applyProfileEffect, applyPageEffect } from '/assets/js/rewards-ui.js?v=20261026-1';

let currentUid = '';

async function paintRewards() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const r = await backendFetch('/api/rewards');
        setAvatarBadge(document.querySelector('#profHero .avatar-wrap'), r.equipped?.badge, 26);
        applyProfileEffect(document.getElementById('profHero'), r.equipped?.profile);
        applyPageEffect(r.equipped?.profile);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (_) {  }
}

requireAuth(async (user) => {
    currentUid = user.uid;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    await loadProfile();
    enableTilt();
    paintRewards();
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
let currentLocks = {};
const fmtWait = (ms) => {
    const m = Math.ceil(ms / 60000), d = Math.floor(m / 1440), h = Math.floor((m % 1440) / 60), mm = m % 60;
    return d ? `${d}d ${h}h` : h ? `${h}h ${mm}m` : `${Math.max(1, mm)}m`;
};
// src by SRT X CHEATS. Copy right SRT X CHEATS
function lockLeft(field) {
    const next = Number(currentLocks[field] || 0);
    return next > Date.now() ? next - Date.now() : 0;
}
function paintLocks() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const map = { name: 'profName', phone: 'profPhone', panelLink: 'profPanelLink' };
    document.querySelectorAll('.lock-hint').forEach((hint) => {
        const field = hint.dataset.field, input = document.getElementById(map[field]);
        const left = lockLeft(field);
        input.readOnly = left > 0;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        input.style.opacity = left > 0 ? '0.65' : '1';
        hint.innerHTML = left > 0
            ? `<i class="fas fa-lock"></i> Locked — you can change this again in <b>${fmtWait(left)}</b>`
            : `You can change this once every ${hint.dataset.every}.`;
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
setInterval(paintLocks, 30000);

function applyProfile(d) {
    if (!d) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    currentLocks = d.profileLocks || currentLocks || {};
    const set = (id, v) => { const el = document.getElementById(id); if (el !== document.activeElement) el.value = v || ''; };
    set('profName', d.profileName);
    set('profPhone', d.profilePhone);
    set('profTiktokName', d.tiktokName);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    set('profTiktokUser', d.tiktokUser);
    set('profPanelLink', d.panelLink ? d.panelLink.replace(/^https?:\/\//i, '') : '');
    document.getElementById('panelLinkField').classList.toggle('hidden', d.role !== 'reseller' && d.role !== 'pro_reseller');
    document.getElementById('profEmail').value = d.email || auth.currentUser?.email || '';
    document.getElementById('profUid').value = currentUid;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const label = d.profileName || d.email || auth.currentUser?.email || 'Account';
    document.getElementById('profDisplayName').textContent = label;
    document.getElementById('profDisplayEmail').textContent = d.email || auth.currentUser?.email || '';
    renderAvatar(document.getElementById('profAvatar'), d.avatarUrl, label);
    document.getElementById('avatarRemoveBtn').style.display = d.avatarUrl ? 'block' : 'none';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    paintLocks();
}

window.addEventListener('srtx:data', (e) => { if (e.detail?.key === 'profile' && e.detail.value) applyProfile(e.detail.value); });

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function loadProfile(force = false) {
    const cached = cachePeek('profile');
    if (cached) applyProfile(cached.value);
    try {
        const d = await getData('profile', { force });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        applyProfile(d);
        maybeShowCompleteProfile(d);
    } catch (e) {
        if (!cached) toast(e.message, 'error');
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

async function afterProfileSaved(fields) {
    const next = applyProfileChange(fields);
    if (next) applyProfile(next);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else await loadProfile(true);
}

function setLoading(btn, loading) {
    if (!btn) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const text = btn.querySelector('.btn-text');
    const spinner = btn.querySelector('.btn-spinner');
    btn.classList.toggle('loading', loading);
    btn.disabled = loading;
    if (text) text.classList.toggle('hidden', loading);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (spinner) spinner.classList.toggle('hidden', !loading);
}

document.getElementById('saveProfile').onclick = async () => {
    const btn = document.getElementById('saveProfile');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const cached = cachePeek('profile')?.value || {};
    const name = lockLeft('name') ? (cached.profileName || '') : document.getElementById('profName').value.trim();
    const phone = lockLeft('phone') ? (cached.profilePhone || '') : document.getElementById('profPhone').value.trim();
    const tiktokName = document.getElementById('profTiktokName').value.trim();
    const tiktokUser = document.getElementById('profTiktokUser').value.trim();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const payload = { name, phone, tiktokName, tiktokUser };
    if (cached.role === 'reseller' || cached.role === 'pro_reseller') {
        payload.panelLink = lockLeft('panelLink') ? (cached.panelLink || '') : document.getElementById('profPanelLink').value.trim();
    }
    setLoading(btn, true);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const r = await backendFetch('/api/user/profile', { method: 'POST', body: JSON.stringify(payload) });
        toast('Profile saved', 'success');
        await afterProfileSaved({ ...r.fields, profileLocks: r.locks });
        if (name !== (cached.profileName || '')) cacheInvalidate('leaderboard');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        if (e.body?.nextAt && e.body?.field) { currentLocks[e.body.field] = e.body.nextAt; paintLocks(); }
        toast(e.message, 'error');
    } finally {
        setLoading(btn, false);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
};

document.getElementById('copyUidBtn').addEventListener('click', () => {
    const uid = document.getElementById('profUid').value;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (uid) {
        navigator.clipboard.writeText(uid);
        toast('UID copied!', 'success');
    }
});
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('savePassword').onclick = async () => {
    const btn = document.getElementById('savePassword');
    const curPass = document.getElementById('curPass').value;
    const newPass = document.getElementById('newPass').value;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!curPass || !newPass) return toast('Fill both fields', 'error');
    if (newPass.length < 6) return toast('New password must be at least 6 characters', 'error');
    setLoading(btn, true);
    try {
        const cred = EmailAuthProvider.credential(auth.currentUser.email, curPass);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        await reauthenticateWithCredential(auth.currentUser, cred);
        await updatePassword(auth.currentUser, newPass);
        toast('Password updated', 'success');
        document.getElementById('curPass').value = '';
        document.getElementById('newPass').value = '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        toast(e.code === 'auth/wrong-password' ? 'Current password is incorrect' : e.message, 'error');
    } finally {
        setLoading(btn, false);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

function maybeShowCompleteProfile(d) {
    const wantsComplete = new URLSearchParams(location.search).get('complete') === '1';
    const missing = !d?.profileName || !d?.profilePhone;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!wantsComplete && !missing) return;
    document.getElementById('cpName').value = d?.profileName || '';
    document.getElementById('cpPhone').value = d?.profilePhone || '';
    document.getElementById('completeProfileModal').classList.remove('hidden');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('completeProfileBtn').onclick = async () => {
    const btn = document.getElementById('completeProfileBtn');
    const name = document.getElementById('cpName').value.trim();
    const phone = document.getElementById('cpPhone').value.trim();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!name || !phone) return toast('Name and number are required', 'error');
    setLoading(btn, true);
    try {
        const r2 = await backendFetch('/api/user/profile', { method: 'POST', body: JSON.stringify({ name, phone }) });
        toast('Profile saved', 'success');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('completeProfileModal').classList.add('hidden');
        history.replaceState(null, '', location.pathname);
        await afterProfileSaved({ profileName: name, profilePhone: phone, ...(r2?.fields || {}), ...(r2 ? { profileLocks: r2.locks } : {}) });
    } catch (e) {
        toast(e.message, 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } finally {
        setLoading(btn, false);
    }
};

// src by SRT X CHEATS. Copy right SRT X CHEATS
(() => {
    const modal = document.getElementById('avatarModal');
    const stage = document.getElementById('avatarStage');
    const canvas = document.getElementById('avatarCanvas');
    const ctx = canvas.getContext('2d');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const fileInput = document.getElementById('avatarFile');
    const zoomEl = document.getElementById('avatarZoom');
    const sizeEl = document.getElementById('avatarSize');
    const saveBtn = document.getElementById('avatarSaveBtn');
    const emptyEl = document.getElementById('avatarEmpty');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const VIEW = canvas.width;
    const MAX_FILE_BYTES = 8 * 1024 * 1024;
    const MAX_UPLOAD_CHARS = 1300000;

    let img = null;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    let baseScale = 1;
    let zoom = 1;
    let offX = 0, offY = 0;

    function clampOffsets() {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const w = img.width * baseScale * zoom, h = img.height * baseScale * zoom;
        const maxX = Math.max(0, (w - VIEW) / 2), maxY = Math.max(0, (h - VIEW) / 2);
        offX = Math.min(maxX, Math.max(-maxX, offX));
        offY = Math.min(maxY, Math.max(-maxY, offY));
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    function drawTo(c, size, circle) {
        const k = size / VIEW;
        c.clearRect(0, 0, size, size);
        c.imageSmoothingEnabled = true; c.imageSmoothingQuality = 'high';
        c.save();
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (circle) { c.beginPath(); c.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2); c.closePath(); c.clip(); }
        const w = img.width * baseScale * zoom * k, h = img.height * baseScale * zoom * k;
        c.drawImage(img, size / 2 + offX * k - w / 2, size / 2 + offY * k - h / 2, w, h);
        c.restore();
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    function render() {
        ctx.clearRect(0, 0, VIEW, VIEW);
        if (!img) return;
        clampOffsets();
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ctx.save(); ctx.globalAlpha = 0.35;
        const w = img.width * baseScale * zoom, h = img.height * baseScale * zoom;
        ctx.drawImage(img, VIEW / 2 + offX - w / 2, VIEW / 2 + offY - h / 2, w, h);
        ctx.restore();
        drawTo(ctx, VIEW, true);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ctx.save(); ctx.beginPath(); ctx.arc(VIEW / 2, VIEW / 2, VIEW / 2 - 1, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(255,255,255,.85)'; ctx.lineWidth = 2; ctx.stroke(); ctx.restore();
    }

    function open() {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (lockLeft('avatar')) { toast(`You can change your photo again in ${fmtWait(lockLeft('avatar'))}`, 'error'); return; }
        img = null; zoom = 1; offX = offY = 0; zoomEl.value = 1; zoomEl.disabled = true; saveBtn.disabled = true;
        fileInput.value = ''; emptyEl.style.display = 'flex'; render();
        modal.classList.remove('hidden');
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const close = () => modal.classList.add('hidden');

    document.getElementById('avatarEditBtn').addEventListener('click', open);
    document.getElementById('profAvatar').addEventListener('click', open);
    document.getElementById('avatarCancelBtn').addEventListener('click', close);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('avatarPickBtn').addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', async () => {
        const f = fileInput.files && fileInput.files[0];
        if (!f) return;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!/^image\/(png|jpe?g|webp)$/i.test(f.type)) return toast('Please choose a PNG, JPG or WebP image', 'error');
        if (f.size > MAX_FILE_BYTES) return toast('That photo is over 8 MB — choose a smaller one', 'error');
        const url = URL.createObjectURL(f);
        const el = new Image();
        el.onload = () => {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            URL.revokeObjectURL(url);
            img = el;
            baseScale = Math.max(VIEW / el.width, VIEW / el.height);
            zoom = 1; offX = offY = 0; zoomEl.value = 1; zoomEl.disabled = false; saveBtn.disabled = false;
            emptyEl.style.display = 'none';
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            render();
        };
        el.onerror = () => { URL.revokeObjectURL(url); toast('Could not read that image', 'error'); };
        el.src = url;
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS

    zoomEl.addEventListener('input', () => { zoom = Number(zoomEl.value); render(); });

    let drag = null;
    canvas.addEventListener('pointerdown', (e) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!img) return;
        drag = { x: e.clientX, y: e.clientY, ox: offX, oy: offY };
        canvas.setPointerCapture(e.pointerId);
    });
    canvas.addEventListener('pointermove', (e) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!drag) return;
        const scale = VIEW / canvas.getBoundingClientRect().width;
        offX = drag.ox + (e.clientX - drag.x) * scale;
        offY = drag.oy + (e.clientY - drag.y) * scale;
        render();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    });
    const endDrag = () => { drag = null; };
    canvas.addEventListener('pointerup', endDrag);
    canvas.addEventListener('pointercancel', endDrag);
    canvas.addEventListener('wheel', (e) => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!img) return;
        e.preventDefault();
        zoom = Math.min(4, Math.max(1, zoom + (e.deltaY < 0 ? 0.08 : -0.08)));
        zoomEl.value = zoom; render();
    }, { passive: false });
// src by SRT X CHEATS. Copy right SRT X CHEATS

    async function exportCrop() {
        let size = Number(sizeEl.value) || 512;
        const toBlob = (c, type, q) => new Promise((res) => c.toBlob(res, type, q));
        const toDataUrl = (blob) => new Promise((res, rej) => { const r = new FileReader(); r.onload = () => res(r.result); r.onerror = rej; r.readAsDataURL(blob); });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        for (let shrink = 0; shrink < 4; shrink++) {
            const out = document.createElement('canvas');
            out.width = out.height = size;
            drawTo(out.getContext('2d'), size, true);
            for (const [type, q] of [['image/webp', 0.95], ['image/webp', 0.88], ['image/webp', 0.75], ['image/png', undefined]]) {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                const blob = await toBlob(out, type, q);
                if (!blob || blob.type !== type) continue;
                const dataUrl = await toDataUrl(blob);
                if (dataUrl.length <= MAX_UPLOAD_CHARS) return dataUrl;
            }
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            size = Math.round(size * 0.75);
        }
        throw new Error('Photo is too large to upload — try a smaller size');
    }

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    saveBtn.addEventListener('click', async () => {
        if (!img) return;
        setLoading(saveBtn, true);
        try {
            const image = await exportCrop();
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const r = await backendFetch('/api/user/avatar', { method: 'POST', body: JSON.stringify({ image }) });
            const next = applyProfileChange({ avatarUrl: r.avatarUrl, profileLocks: { ...currentLocks, ...(r.locks || {}) } });
            cacheInvalidate('leaderboard');
            if (next) applyProfile(next); else await loadProfile(true);
            toast('Profile photo updated', 'success');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            close();
        } catch (e) {
            if (e.body?.nextAt) { currentLocks.avatar = e.body.nextAt; paintLocks(); }
            toast(e.message || 'Upload failed', 'error');
        } finally {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            setLoading(saveBtn, false);
        }
    });

    document.getElementById('avatarRemoveBtn').addEventListener('click', async () => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!confirm('Remove your profile photo?')) return;
        try {
            const r = await backendFetch('/api/user/avatar', { method: 'DELETE' });
            const next = applyProfileChange({ avatarUrl: '', profileLocks: { ...currentLocks, ...(r.locks || {}) } });
            cacheInvalidate('leaderboard');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            if (next) applyProfile(next); else await loadProfile(true);
            toast('Profile photo removed', 'success');
            close();
        } catch (e) { toast(e.message || 'Could not remove photo', 'error'); }
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
})();

</script>
</body>
</html>
