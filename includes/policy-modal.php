<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
?>
<div id="policyModal" class="modal-overlay hidden" style="z-index:9500">
    <div class="panel" style="max-width:480px;width:100%;max-height:85vh;display:flex;flex-direction:column">
        <div class="prompt-header" id="policyModalTitle"><i class="fas fa-shield-halved" style="color:var(--neon-amber)"></i> Terms &amp; Policy</div>

        <div id="policyModalBody" style="flex:1;overflow-y:auto;font-size:12.5px;line-height:1.7;color:var(--text-secondary);white-space:pre-wrap;margin:10px 0 16px;padding-right:4px">
            <div style="text-align:center;padding:30px 0;color:var(--text-muted)"><i class="fas fa-circle-notch fa-spin"></i> Loading policy...</div>
        </div>

        <div id="policyAckRow" class="hidden" style="display:flex;align-items:center;gap:8px;margin-bottom:14px;font-size:12px;color:var(--text-secondary)">
            <input type="checkbox" id="policyDontShowAgain" style="width:16px;height:16px;accent-color:var(--neon-green)">
            <label for="policyDontShowAgain" style="cursor:pointer">Don't show again</label>
        </div>

        <button class="btn btn-solid" id="policyModalCloseBtn"><i class="fas fa-check"></i> Close</button>
    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
#policyModalBody::-webkit-scrollbar { width: 5px; }
#policyModalBody::-webkit-scrollbar-thumb { background: var(--glass-border); border-radius: 999px; }

.policy-info-btn {
    display: inline-flex; align-items: center; justify-content: center;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    width: 26px; height: 26px; border-radius: 50%;
    border: 1px solid var(--neon-amber); color: var(--neon-amber);
    background: rgba(212, 175, 55, 0.08); font-weight: 800; font-size: 13px;
    cursor: pointer; font-family: var(--font-heading); line-height: 1;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.policy-info-btn:hover { background: rgba(212, 175, 55, 0.18); }
</style>

<script type="module">
import { backendFetch, getAuthToken, getData, cachePatch } from '/assets/js/app.js?v=20261025-3';
// src by SRT X CHEATS. Copy right SRT X CHEATS

let policyLoaded = false;
let onCloseCallback = null;

window.__openPolicyModal = async (mode = 'readonly', onClose = null) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    onCloseCallback = onClose;
    document.getElementById('policyAckRow').classList.toggle('hidden', mode !== 'forced');
    document.getElementById('policyModal').classList.remove('hidden');

    if (policyLoaded) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const data = await getData('policy');
        document.getElementById('policyModalTitle').innerHTML =
            `<i class="fas fa-shield-halved" style="color:var(--neon-amber)"></i> ${esc(data.title)}`;
        document.getElementById('policyModalBody').textContent = data.body;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        policyLoaded = true;
    } catch (e) {
        document.getElementById('policyModalBody').innerHTML =
            `<div style="color:var(--neon-red);text-align:center;padding:20px 0">Could not load the policy right now. Please try again later.</div>`;
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

function esc(s) {
    return String(s ?? '').replace(/[&<>"']/g, c => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c]));
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('policyModalCloseBtn').addEventListener('click', async () => {
    const ackRowVisible = !document.getElementById('policyAckRow').classList.contains('hidden');
    const dontShowAgain = document.getElementById('policyDontShowAgain').checked;

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (ackRowVisible && dontShowAgain) {
        try { await backendFetch('/api/user/policy-ack', { method: 'POST' }); cachePatch('profile', { policyAcknowledged: true }); }
        catch (e) { console.error('Could not save policy acknowledgement:', e); }
    }

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('policyModal').classList.add('hidden');
    if (typeof onCloseCallback === 'function') onCloseCallback();
});
</script>
