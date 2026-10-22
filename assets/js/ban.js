// src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
    'use strict';
    var MESSAGE = 'Your account has been banned by admin. Unknown activity was detected that is out of our KIMS terms and policy.';

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var shown = false;

    function pad(n) { return (n < 10 ? '0' : '') + n; }
    function fmt(ms) {
        var s = Math.max(0, Math.floor(ms / 1000));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var d = Math.floor(s / 86400); s -= d * 86400;
        var h = Math.floor(s / 3600); s -= h * 3600;
        var m = Math.floor(s / 60); s -= m * 60;
        return (d ? d + 'd ' : '') + pad(h) + ':' + pad(m) + ':' + pad(s);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    function css() {
        var st = document.createElement('style');
        st.textContent =
            '#srtxBan{position:fixed;inset:0;z-index:2147483647;display:flex;align-items:center;justify-content:center;padding:0;' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            'background:radial-gradient(circle at 50% 0%,#3a0f18 0%,#12060b 55%,#050204 100%);color:#fff;font-family:inherit;overflow:auto}' +
            '#srtxBan .bn-card{width:100%;min-height:100%;max-width:680px;box-sizing:border-box;display:flex;flex-direction:column;align-items:center;justify-content:center;' +
            'text-align:center;padding:44px 22px calc(44px + env(safe-area-inset-bottom))}' +
            '@media(min-width:700px){#srtxBan .bn-card{min-height:0;margin:auto;border-radius:28px;border:1px solid rgba(239,68,68,.45);' +
            'background:rgba(20,8,12,.88);box-shadow:0 0 90px rgba(239,68,68,.22);padding:56px 48px}}' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            '#srtxBan .bn-ico{width:120px;height:120px;margin:0 auto 26px;border-radius:50%;display:flex;align-items:center;justify-content:center;' +
            'font-size:54px;color:#f87171;background:rgba(239,68,68,.13);border:2px solid rgba(239,68,68,.5);box-shadow:0 0 50px rgba(239,68,68,.3)}' +
            '#srtxBan h1{margin:0 0 16px;font-size:clamp(28px,8.5vw,40px);letter-spacing:3px;color:#fca5a5;line-height:1.15}' +
            '#srtxBan p{margin:0 0 28px;line-height:1.7;font-size:clamp(16px,4.6vw,19px);color:rgba(255,255,255,.9);max-width:520px}' +
            '#srtxBan .bn-dur{display:inline-flex;align-items:center;gap:10px;padding:13px 26px;border-radius:999px;font-weight:800;' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            'font-size:clamp(17px,5vw,21px);color:#fecaca;background:rgba(239,68,68,.16);border:1.5px solid rgba(239,68,68,.55)}' +
            '#srtxBan .bn-id{width:100%;max-width:520px;margin:26px 0 0;text-align:left;border-radius:16px;padding:8px 18px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12)}' +
            '#srtxBan .bn-id div{display:flex;gap:14px;justify-content:space-between;align-items:baseline;padding:12px 0;font-size:clamp(14px,4vw,16px)}' +
            '#srtxBan .bn-id div+div{border-top:1px solid rgba(255,255,255,.09)}' +
            '#srtxBan .bn-id span{color:rgba(255,255,255,.55);flex:none}' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            '#srtxBan .bn-id b{font-weight:600;color:#fff;word-break:break-all;text-align:right}' +
            '#srtxBan .bn-left{margin-top:26px;font-size:clamp(14px,4vw,16px);color:rgba(255,255,255,.65)}' +
            '#srtxBan .bn-left b{display:block;margin-top:6px;font-size:clamp(34px,11vw,52px);letter-spacing:3px;color:#fff;font-variant-numeric:tabular-nums}' +
            '#srtxBan button{margin-top:32px;padding:15px 34px;border-radius:14px;border:1px solid rgba(255,255,255,.3);background:transparent;' +
            'color:#fff;font-weight:700;font-size:16px;cursor:pointer}' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            '#srtxBan button:hover{background:rgba(255,255,255,.09)}';
        document.head.appendChild(st);
    }

    window.srtxShowBan = function (ban, user) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (shown) return;
        shown = true;
        ban = ban || {};
        user = user || {};
        var permanent = !!ban.permanent;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var skew = ban.serverNow ? (Date.now() - Number(ban.serverNow)) : 0;
        var until = Number(ban.until || 0);

        css();
        var box = document.createElement('div');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        box.id = 'srtxBan';
        box.setAttribute('role', 'alertdialog');
        box.setAttribute('aria-modal', 'true');
        box.innerHTML =
            '<div class="bn-card">' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            '<div class="bn-ico"><i class="fas fa-ban"></i></div>' +
            '<h1>ACCOUNT BANNED</h1>' +
            '<p></p>' +
            '<div class="bn-dur"><i class="fas fa-gavel"></i><span class="bn-label"></span></div>' +
            '<div class="bn-id"></div>' +
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            (permanent ? '' : '<div class="bn-left">Time remaining<b class="bn-count">--:--:--</b></div>') +
            '<button type="button" class="bn-out"><i class="fas fa-right-from-bracket"></i> Log out</button>' +
            '</div>';
        box.querySelector('p').textContent = MESSAGE;
        box.querySelector('.bn-label').textContent = 'Ban - ' + (ban.label || (permanent ? 'Permanent' : ''));
// src by SRT X CHEATS. Copy right SRT X CHEATS

        var idBox = box.querySelector('.bn-id');
        [['Name', user.name], ['UID', user.uid], ['Gmail', user.email]].forEach(function (r) {
            if (!r[1]) return;
            var row = document.createElement('div');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            var k = document.createElement('span'); k.textContent = r[0];
            var v = document.createElement('b'); v.textContent = r[1];
            row.appendChild(k); row.appendChild(v); idBox.appendChild(row);
        });

        // src by SRT X CHEATS. Copy right SRT X CHEATS
        Array.prototype.forEach.call(document.body.children, function (el) {
            try { el.setAttribute('inert', ''); el.setAttribute('aria-hidden', 'true'); } catch (e) {}
        });
        document.body.appendChild(box);
        document.documentElement.style.overflow = 'hidden';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.body.style.overflow = 'hidden';

        box.querySelector('.bn-out').addEventListener('click', function () {
            if (typeof window.doLogout === 'function') window.doLogout();
            else { try { localStorage.clear(); sessionStorage.clear(); } catch (e) {} location.replace('/login.php'); }
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        });

        if (!permanent && until) {
            var out = box.querySelector('.bn-count');
            var tick = function () {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                var left = until - (Date.now() - skew);
                if (left <= 0) { out.textContent = '00:00:00'; location.reload(); return; }
                out.textContent = fmt(left);
                setTimeout(tick, 1000);
            };
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            tick();
        }
    };

    if (window.fetch && !window.__srtxBanFetch) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        window.__srtxBanFetch = true;
        var realFetch = window.fetch;
        window.fetch = function () {
            return realFetch.apply(this, arguments).then(function (r) {
                if (r && r.status === 403) {
                    // src by SRT X CHEATS. Copy right SRT X CHEATS
                    try { r.clone().json().then(function (b) { if (b && b.code === 'BANNED') window.srtxShowBan(b.ban, b.user); }).catch(function () {}); } catch (e) {}
                }
                return r;
            });
        };
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }

    window.srtxHandleBan = function (status, body) {
        if (status === 403 && body && body.code === 'BANNED') { window.srtxShowBan(body.ban, body.user); return true; }
        return false;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    };
})();
