<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Reward Center — SRT X CHEATS';
$currentPage = 'rewards';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>

<div class="term-window">
    <div class="term-content">

        <div class="prompt-header"><i class="fas fa-gift"></i> REWARD CENTER</div>

        <div class="panel rw-summary">
            <div class="dim" style="font-size:11px;letter-spacing:.8px;font-weight:800">KEYS SOLD</div>
            <div class="rw-total"><span id="rwTotal">—</span><small>keys</small></div>
            <div class="rw-next" id="rwNext">Loading your progress…</div>
            <div class="rw-bar"><i id="rwBar" style="width:0%"></i></div>
            <div class="rw-note">Counts every key from your orders (store + reseller API). Claim each mission once.</div>
        </div>

        <div id="rwStar"></div>

        <div class="section-divider"><i class="fas fa-bullseye"></i> Missions</div>
        <div id="rwMissions">
            <div class="skeleton-row" style="height:96px"></div>
            <div class="skeleton-row" style="height:96px"></div>
            <div class="skeleton-row" style="height:96px"></div>
        </div>

        <div class="section-divider"><i class="fas fa-wand-magic-sparkles"></i> Customize</div>
        <div class="panel" id="rwCustom">
            <div class="dim" style="font-size:12px;margin-bottom:10px">Pick what other players see on the leaderboard and when they open your profile. Tap ANY style to test it live in the preview below — locked ones are try-on only and can be saved after you claim their mission.</div>

            <div class="rw-preview">
                <div class="rw-tryon" id="rwTryon"></div>
                <div class="leaderboard-row" id="pvRow">
                    <div class="lb-rank"><i class="fas fa-medal" style="color:#f5b73b"></i></div>
                    <div class="lb-av" id="pvRowAv"><div class="lb-avatar" id="pvRowAvatar">Y</div></div>
                    <div class="lb-name-wrap"><span class="lb-name">You</span></div>
                    <div class="lb-stats"><span class="lb-keys"><i class="fas fa-key"></i> <span id="pvRowKeys">0</span></span></div>
                </div>
                <div class="profile-hero" id="pvHero">
                    <div class="av-wrap" id="pvHeroAv"><div class="profile-avatar" id="pvHeroAvatar">Y</div></div>
                    <div class="profile-name">You</div>
                </div>
            </div>

            <div class="rw-pick-label"><i class="fas fa-shield-halved"></i> Avatar badge</div>
            <div class="rw-opts" id="optBadge"></div>

            <div class="rw-pick-label"><i class="fas fa-ranking-star"></i> Leaderboard banner effect</div>
            <div class="rw-opts" id="optBanner"></div>

            <div class="rw-pick-label"><i class="fas fa-id-badge"></i> Profile view effect</div>
            <div class="rw-opts" id="optProfile"></div>

            <button class="btn btn-solid" id="rwSave" style="width:100%;margin-top:16px" disabled>
                <span class="btn-text"><i class="fas fa-floppy-disk"></i> Save Style</span>
            </button>
        </div>

    </div>
</div>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { requireAuth, backendFetch, toast, esc, cachePeek, cacheInvalidate, applyBalanceChange, renderAvatar } from '/assets/js/app.js?v=20261025-3';
// src by SRT X CHEATS. Copy right SRT X CHEATS
import { BADGES, BANNERS, PROFILES, badgeHtml, avBadgeHtml, bannerClass, bannerInner, setAvatarBadge, applyProfileEffect, applyPageEffect } from '/assets/js/rewards-ui.js?v=20261026-1';

let S = null;
let draft = { badge: '', banner: '', profile: '' };

// src by SRT X CHEATS. Copy right SRT X CHEATS
const $ = (id) => document.getElementById(id);

requireAuth(async () => {
    const p = cachePeek('profile')?.value;
    const name = p?.profileName || (p?.email || 'You').split('@')[0];
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('pvRow').querySelector('.lb-name').textContent = name;
    $('pvHero').querySelector('.profile-name').firstChild.textContent = name + ' ';
    renderAvatar($('pvRowAvatar'), p?.avatarUrl, name);
    renderAvatar($('pvHeroAvatar'), p?.avatarUrl, name);
    await load();
// src by SRT X CHEATS. Copy right SRT X CHEATS
});

async function load() {
    try {
        S = await backendFetch('/api/rewards');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        draft = { ...S.equipped };
        render();
    } catch (e) {
        $('rwMissions').innerHTML = `<div class="panel" style="color:var(--neon-red);font-size:12px;text-align:center">Couldn't load rewards: ${esc(e.message)}</div>`;
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function fmtDate(ms) { return new Date(ms).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', timeZone: 'Asia/Kathmandu' }); }

function renderStar() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const st = S.star; if (!st) { $('rwStar').innerHTML = ''; return; }
    const into = st.newKeys % st.every, pct = st.active ? (into / st.every) * 100 : 0;
    const date = fmtDate(st.from) + ' 2026, 12:00 AM';
    let btn;
    if (!st.active) btn = `<button class="btn btn-ghost" disabled><i class="fas fa-lock"></i> Unlocks ${date}</button>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else if (!st.member) btn = `<button class="btn btn-ghost" disabled><i class="fas fa-lock"></i> Claim the STAR mission (500 keys) first</button>`;
    else if (st.available > 0) btn = `<button class="btn btn-solid rw-claim-go" data-claim-star="1"><i class="fas fa-gift"></i> CLAIM Rs ${st.available * st.amount}</button>`;
    else btn = `<button class="btn btn-ghost" disabled><i class="fas fa-key"></i> ${st.every - into} more new key${st.every - into === 1 ? '' : 's'} to unlock</button>`;
    $('rwStar').innerHTML = `
    <div class="panel rw-star">
        <div class="rw-star-top">${badgeHtml('S', 30)}<div><div class="rw-star-title">STAR CASHBACK</div>
        <div class="dim" style="font-size:11px">Rs ${st.amount} for every ${st.every} NEW keys you buy from ${date}. Keys bought before that are never counted.</div></div></div>
        <div class="rw-bar" style="margin-top:12px"><i style="width:${pct}%"></i></div>
        <div class="rw-star-stats"><div><b>${st.active ? st.newKeys : 0}</b><span>new keys counted</span></div><div><b>Rs ${st.earned}</b><span>cashback earned</span></div></div>
        ${btn}
    </div>`;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function render() {
    renderStar();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    renderSummary();
    renderMissions();
    renderCustom();
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function renderSummary() {
    const t = S.totalKeysBought;
    $('rwTotal').textContent = t;
    $('pvRowKeys').textContent = t;
    const next = S.missions.find((m) => !m.cb && t < m.keys);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!next) {
        $('rwNext').textContent = 'Every mission is complete. Legend!';
        $('rwBar').style.width = '100%';
        return;
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const prev = [...S.missions].reverse().find((m) => !m.cb && m.keys <= t)?.keys || 0;
    $('rwNext').textContent = `${next.keys - t} more key${next.keys - t === 1 ? '' : 's'} to “${next.title}”`;
    $('rwBar').style.width = Math.max(2, Math.min(100, ((t - prev) / (next.keys - prev)) * 100)) + '%';
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function chips(m) {
    const out = [];
    if (m.cashback) out.push(`<span class="rw-chip cash"><i class="fas fa-money-bill-wave"></i> Cashback Rs ${m.cashback}</span>`);
    if (m.badge) out.push(`<span class="rw-chip">${badgeHtml(m.badge, 15)} ${esc(BADGES[m.badge]?.label || m.badge)}</span>`);
    if (m.banner) out.push(`<span class="rw-chip"><i class="fas fa-ranking-star"></i> ${esc(BANNERS[m.banner]?.label || '')} banner</span>`);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (m.profile) out.push(`<span class="rw-chip"><i class="fas fa-id-badge"></i> ${esc(PROFILES[m.profile]?.label || '')} profile</span>`);
    return out.join('');
}

function renderMissions() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const row = (m) => {
        const t = m.have;
        const pct = Math.min(100, (t / m.keys) * 100);
        const cls = m.claimed ? 'done' : m.ready ? 'ready' : '';
        const ico = m.claimed ? 'fa-check' : m.ready ? 'fa-gift' : 'fa-lock';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const when = fmtDate(m.opensAt) + ' 2026, 12:00 AM';
        const btn = m.claimed
            ? `<button class="btn btn-ghost" disabled><i class="fas fa-circle-check"></i> Claimed</button>`
            : m.locked
            ? `<button class="btn btn-ghost" disabled><i class="fas fa-lock"></i> Unlocks ${when}</button>`
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            : m.ready
            ? `<button class="btn btn-solid rw-claim-go" data-claim="${esc(m.id)}"><i class="fas fa-gift"></i> CLAIM${m.cashback ? ' Rs ' + m.cashback : ''}</button>`
            : `<button class="btn btn-ghost" disabled><i class="fas fa-lock"></i> ${m.keys - t} more ${m.cb ? 'new ' : ''}key${m.keys - t === 1 ? '' : 's'} to unlock</button>`;
        return `
        <div class="rw-mission ${cls}" id="mis-${esc(m.id)}">
            <div class="rw-m-top">
                <div class="rw-m-title"><span class="rw-ico"><i class="fas ${ico}"></i></span>${esc(m.title)}</div>
                <div class="rw-m-count">${Math.min(t, m.keys)}/${m.keys}</div>
            </div>
            <div class="rw-rewards">${chips(m)}</div>
            ${m.cb ? `<div class="dim" style="font-size:10.5px;margin-bottom:6px">Counts only keys you buy after ${when}. Old purchases are not counted.</div>` : ''}
            <div class="rw-bar"><i style="width:${pct}%"></i></div>
            ${btn}
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    };
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('rwMissions').innerHTML =
        S.missions.filter((m) => !m.cb).map(row).join('') +
        `<div class="section-divider"><i class="fas fa-money-bill-wave"></i> Cashback — new purchases only</div>` +
        S.missions.filter((m) => m.cb).map(row).join('');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function opt(kind, id, label, inner, unlockedList, lockKeys) {
    const open = id === '' || unlockedList.includes(id);
    const sel = draft[kind] === id ? ' sel' : '';
    return `<button type="button" class="rw-opt${sel}${open ? '' : ' locked'}" data-kind="${kind}" data-id="${esc(id)}" data-locked="${open ? 0 : 1}">
        ${inner}<span>${esc(label)}</span>${open ? '' : `<span class="rw-lock"><i class="fas fa-lock"></i> Try · ${lockKeys} keys</span>`}
    </button>`;
}
const keysFor = (field, id) => S.missions.find((m) => m[field] === id)?.keys || '';
const none = '<span class="rw-swatch" style="background:transparent;border:1px dashed var(--glass-border)"></span>';
// src by SRT X CHEATS. Copy right SRT X CHEATS

function renderCustom() {
    const u = S.unlocked;
    $('optBadge').innerHTML = opt('badge', '', 'None', '<span class="rbadge" style="--s:28px;visibility:hidden"></span>', [], '') +
        Object.keys(BADGES).map((id) => opt('badge', id, BADGES[id].label, badgeHtml(id, 28), u.badges, keysFor('badge', id))).join('');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    $('optBanner').innerHTML = opt('banner', '', 'None', none, [], '') +
        Object.keys(BANNERS).map((id) => opt('banner', id, BANNERS[id].label, `<span class="rw-swatch" style="background:${BANNERS[id].swatch}"></span>`, u.banners, keysFor('banner', id))).join('');
    $('optProfile').innerHTML = opt('profile', '', 'None', none, [], '') +
        Object.keys(PROFILES).map((id) => opt('profile', id, PROFILES[id].label, `<span class="rw-swatch" style="background:${PROFILES[id].swatch}"></span>`, u.profiles, keysFor('profile', id))).join('');
    renderPreview();
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function renderPreview() {
    const row = $('pvRow');
    row.className = 'leaderboard-row' + bannerClass(draft.banner);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    row.querySelectorAll(':scope > .fxl').forEach((n) => n.remove());
    if (bannerInner(draft.banner)) row.insertAdjacentHTML('afterbegin', bannerInner(draft.banner));
    applyProfileEffect($('pvHero'), draft.profile);
    applyPageEffect(draft.profile);
    setAvatarBadge($('pvRowAv'), draft.badge, 17);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setAvatarBadge($('pvHeroAv'), draft.badge, 26);
    const changed = ['badge', 'banner', 'profile'].some((k) => draft[k] !== S.equipped[k]);
    const U = { badge: S.unlocked.badges, banner: S.unlocked.banners, profile: S.unlocked.profiles };
    const lockedPicked = ['badge', 'banner', 'profile'].filter((k) => draft[k] && !U[k].includes(draft[k]));
    const tn = $('rwTryon');
    tn.classList.toggle('on', lockedPicked.length > 0);
    tn.innerHTML = lockedPicked.length ? '<i class="fas fa-flask"></i> Try-on mode — locked style, claim its mission to save it' : '';
    $('rwSave').disabled = !changed || lockedPicked.length > 0;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.addEventListener('click', async (e) => {
    const pv = e.target.closest('#pvRow, #pvHero');
    if (pv && !e.target.closest('.rw-opt')) {
        $(pv.id === 'pvRow' ? 'optBanner' : 'optProfile').scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    const o = e.target.closest('.rw-opt');
    if (o) {
        draft[o.dataset.kind] = o.dataset.id;
        document.querySelectorAll(`.rw-opt[data-kind="${o.dataset.kind}"]`).forEach((x) => x.classList.toggle('sel', x === o));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        renderPreview();
        return;
    }
    const cs = e.target.closest('[data-claim-star]');
    if (cs) return claimStar(cs);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const c = e.target.closest('[data-claim]');
    if (c) return claim(c);
    if (e.target.closest('#rwSave')) return save();
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function claim(btn) {
    const id = btn.dataset.claim;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Claiming…';
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const r = await backendFetch('/api/rewards/claim', { method: 'POST', body: JSON.stringify({ id }) });
        if (r.cashback) applyBalanceChange(r.newBalance);
        cacheInvalidate('leaderboard');
        toast(r.cashback ? `+Rs ${r.cashback} added to your balance 🎉` : 'Reward unlocked 🎉', 'success');
        if (id === 'm500') toast('★ STAR unlocked — welcome to the top tier!', 'success');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        await load();
        $('mis-' + id)?.classList.add('rw-pop');
    } catch (err) {
        toast(err.message || 'Could not claim right now.', 'error');
        await load();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

async function claimStar(btn) {
    btn.disabled = true;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Claiming…';
    try {
        const r = await backendFetch('/api/rewards/claim-star', { method: 'POST', body: '{}' });
        applyBalanceChange(r.newBalance);
        toast(`+Rs ${r.cashback} STAR cashback added 🎉`, 'success');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (err) {
        toast(err.message || 'Could not claim right now.', 'error');
    }
    await load();
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function save() {
    const b = $('rwSave');
    b.disabled = true;
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const r = await backendFetch('/api/rewards/equip', { method: 'POST', body: JSON.stringify(draft) });
        S.equipped = r.equipped; draft = { ...r.equipped };
        cacheInvalidate('leaderboard');
        toast('Style saved — it now shows on the leaderboard and your profile.', 'success');
        renderPreview();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (err) {
        toast(err.message || 'Could not save.', 'error');
        renderPreview();
    }
}
</script>

<?php require __DIR__ . '/includes/copyright.php'; ?>
</body>
</html>
