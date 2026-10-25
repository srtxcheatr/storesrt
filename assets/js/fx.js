// src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
  'use strict';
  if (window.__srtFx || window.SRT_FX_OFF) return;
  window.__srtFx = true;
// src by SRT X CHEATS. Copy right SRT X CHEATS

  var root = document.documentElement;
  var reduce = false, fine = false, low = false;
  try {
    reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    fine = matchMedia('(pointer:fine)').matches && matchMedia('(hover:hover)').matches;
  } catch (e) {}
  low = root.classList.contains('srt-low-fx');
  if (reduce) { root.classList.add('fx-noanim'); return; }

  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.addEventListener('visibilitychange', function () { root.classList.toggle('fx-hidden', document.hidden); });

  var MODE = fine ? 'pc' : 'touch';
  root.classList.add(fine ? 'fx-pc' : 'fx-touch', 'fx-on');

  // src by SRT X CHEATS. Copy right SRT X CHEATS
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var rand = function (a, b) { return a + Math.random() * (b - a); };
  var pick = function (arr) { return arr[(Math.random() * arr.length) | 0]; };
  var clamp = function (v, a, b) { return Math.max(a, Math.min(b, v)); };
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  var LEVEL = low ? 0.4 : 1;
  var COLORS = ['#a855f7', '#22d3ee', '#f5b73b', '#ec4899', '#22c55e', '#ffffff'];
  var haptic = function (p) { if (MODE === 'touch' && navigator.vibrate) { try { navigator.vibrate(p); } catch (e) {} } };

  var PAGE = window.SRT_FX_PAGE || '';
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  var LOGO = '/assets/img/logo.png?v=1';

  var GENERIC_STEPS = [['fa-shield-halved', 'Securing connection'], ['fa-database', 'Loading your data'], ['fa-circle-check', 'All set']];
  var PAGES = {
    store:         { icon: 'fa-store', title: 'Store', steps: [['fa-plug', 'Connecting to server'], ['fa-boxes-stacked', 'Loading catalog'], ['fa-circle-check', 'Store ready']], wTitle: 'Welcome to the Store', wSub: 'Fresh products are ready' },
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    dashboard:     { icon: 'fa-gauge-high', title: 'Dashboard', steps: [['fa-user-shield', 'Securing your session'], ['fa-wallet', 'Syncing balance'], ['fa-circle-check', 'Dashboard ready']], wTitle: 'Welcome back', wSub: 'Your dashboard is up to date' },
    history:       { icon: 'fa-clock-rotate-left', title: 'Order History', steps: [['fa-lock', 'Opening your vault'], ['fa-receipt', 'Fetching purchases'], ['fa-circle-check', 'History ready']], wTitle: 'Order History', wSub: 'Every key you bought, safe here' },
    glorybot:      { icon: 'fa-robot', title: 'FF Glory Bot', steps: [['fa-microchip', 'Starting bot engine'], ['fa-earth-asia', 'Checking regions'], ['fa-circle-check', 'Bot ready']], wTitle: 'Glory Bot online', wSub: 'Pick a region and launch' },
    profile:       { icon: 'fa-user-gear', title: 'Profile', steps: GENERIC_STEPS, wTitle: 'Your Profile', wSub: 'Manage your account' },
    feedback:      { icon: 'fa-star', title: 'Feedback', steps: GENERIC_STEPS, wTitle: 'Feedback', wSub: 'See what players are saying' },
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    apicontact:    { icon: 'fa-plug', title: 'Reseller API', steps: GENERIC_STEPS, wTitle: 'Reseller API', wSub: 'Your tools are ready' },
    othersprofile: { icon: 'fa-id-card', title: 'Player Profile', steps: GENERIC_STEPS, wTitle: 'Player Profile', wSub: 'Loaded' }
  };
  var CFG = PAGES[PAGE] || { icon: 'fa-bolt', title: 'SRT X CHEATS', steps: GENERIC_STEPS, wTitle: 'Welcome', wSub: 'Everything is ready' };

  // src by SRT X CHEATS. Copy right SRT X CHEATS
  function showWelcome() {
    var w = document.createElement('div');
    w.className = 'fxw';
    w.innerHTML = '<span class="ic"><i class="fas ' + CFG.icon + '"></i></span><div><b>' + CFG.wTitle + '</b><small>' + CFG.wSub + '</small></div>';
    document.body.appendChild(w);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setTimeout(function () { w.remove(); }, 3300);
  }

  function boot() {
    var cv = null, cx = null;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var W = innerWidth, H = innerHeight, DPR = Math.min(window.devicePixelRatio || 1, MODE === 'pc' ? 2 : 1.5);
    function size() { W = innerWidth; H = innerHeight; if (!cv) return; cv.width = W * DPR; cv.height = H * DPR; cx.setTransform(DPR, 0, 0, DPR, 0, 0); }
    function ensureCanvas() {
      if (cv) return;
      cv = document.createElement('canvas'); cv.className = 'fx-canvas';
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      document.body.appendChild(cv); cx = cv.getContext('2d'); size();
    }
    if (MODE === 'pc') ensureCanvas();
    addEventListener('resize', size);

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var parts = [], raf = 0, MAX = Math.round((MODE === 'pc' ? 150 : 150) * LEVEL) + 30;
    function add(p) { ensureCanvas(); if (parts.length < MAX) parts.push(p); if (!raf) raf = requestAnimationFrame(tick); }
    function tick() {
      cx.clearRect(0, 0, W, H);
      for (var i = parts.length - 1; i >= 0; i--) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var p = parts[i];
        p.vy += p.g; p.vx *= p.drag; p.vy *= p.drag;
        p.x += p.vx; p.y += p.vy; p.r += p.vr; p.life--;
        if (p.life <= 0 || p.y > H + 40 || p.x < -60 || p.x > W + 60) { parts.splice(i, 1); continue; }
        cx.save(); cx.globalAlpha = Math.min(1, p.life / p.fade); cx.translate(p.x, p.y); cx.rotate(p.r);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        cx.fillStyle = p.c;
        if (p.dot) { cx.beginPath(); cx.arc(0, 0, p.s, 0, 6.283); cx.fill(); } else cx.fillRect(-p.s, -p.s / 2, p.s * 2, p.s);
        cx.restore();
      }
      raf = parts.length ? requestAnimationFrame(tick) : (cx.clearRect(0, 0, W, H), MODE === 'pc' ? 0 : (cv.remove(), cv = cx = null, 0));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    function P(o) { return Object.assign({ x: 0, y: 0, vx: 0, vy: 0, g: 0.12, drag: 0.99, r: 0, vr: 0, s: 5, c: '#fff', life: 60, fade: 20 }, o); }
    function burst(x, y, n) {
      n = Math.round(n * LEVEL);
      for (var i = 0; i < n; i++) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var a = rand(0, 6.283), v = rand(2, 7.5);
        add(P({ x: x, y: y, vx: Math.cos(a) * v, vy: Math.sin(a) * v - 2, g: 0.16, s: rand(2.5, 5.5), c: pick(COLORS), dot: Math.random() < .5, vr: rand(-.3, .3), life: rand(34, 64) }));
      }
    }
    function confetti() {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var n = Math.round((MODE === 'pc' ? 130 : 90) * LEVEL), k;
      if (MODE === 'pc') {
        for (k = 0; k < n; k++) {
          var left = k % 2 === 0;
          add(P({ x: left ? 0 : W, y: H, vx: (left ? 1 : -1) * rand(5, 15), vy: -rand(11, 24), g: 0.3, drag: 0.985, s: rand(4, 8), c: pick(COLORS), vr: rand(-.4, .4), life: rand(90, 150), fade: 30 }));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        }
      } else {
        for (k = 0; k < n; k++) {
          add(P({ x: rand(0, W), y: -rand(10, 300), vx: rand(-1.2, 1.2), vy: rand(2, 5), g: 0.05, drag: 0.995, s: rand(4, 8), c: pick(COLORS), vr: rand(-.25, .25), life: rand(120, 200), fade: 40 }));
        }
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      }
      haptic([20, 40, 20, 40, 60]);
    }
    window.srtFxConfetti = confetti;

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var bar = document.createElement('div'); bar.className = 'fx-progress'; document.body.appendChild(bar);
    var sTick = false;
    addEventListener('scroll', function () {
      if (sTick) return; sTick = true;
      requestAnimationFrame(function () {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var h = document.documentElement.scrollHeight - innerHeight;
        bar.style.scale = (h > 0 ? Math.min(1, scrollY / h) : 0) + ' 1';
        sTick = false;
      });
    }, { passive: true });
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var orbs = ['a', 'b', 'c'].map(function (c) { var o = document.createElement('div'); o.className = 'fx-orb ' + c; document.body.prepend(o); return o; });
    function moveOrbs(nx, ny) { if (MODE !== 'pc') return; orbs.forEach(function (o, i) { var k = (i + 1) * 22; o.style.setProperty('--ox', (nx * k) + 'px'); o.style.setProperty('--oy', (ny * k) + 'px'); }); }

    var REVEAL = '.store-balance-chip, .how-to-buy-banner, .prompt-header, .fx-title, #catalogSearch, #catFilters, .product-card, .skeleton-card, ' +
      '.panel, .dash-hero, .shortcut-card, .leaderboard-row, .profile-hero, .fb-card, .gb-card, .update-group, .api-token, .op-info-row, .section-divider';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var io = 'IntersectionObserver' in window ? new IntersectionObserver(function (es) {
      var batch = 0;
      es.forEach(function (e) {
        if (!e.isIntersecting) return;
        var el = e.target; io.unobserve(el);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el.style.setProperty('--fx-d', (batch++ * 70) + 'ms');
        el.classList.add('fx-in');
        requestAnimationFrame(function () { el.classList.remove('fx-pre'); });
        setTimeout(function () { el.classList.remove('fx-in'); el.style.removeProperty('--fx-d'); }, 1300 + batch * 70);
      });
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }, { threshold: 0.08, rootMargin: '0px 0px -4% 0px' }) : null;
    var seen = new WeakSet(), flip = 0, revealOn = false, revealT0 = 0;
    function prep(scope, always) {
      if (!io || !revealOn) return;
      if (!always && scope !== document && Date.now() - revealT0 > 6000) return;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      $$(REVEAL, scope).forEach(function (el) {
        if (MODE === 'touch' && el.matches('.product-card, .skeleton-card')) return;
        if (seen.has(el) || el.closest('.modal-overlay, .drawer-panel')) return;
        seen.add(el);
        el.style.setProperty('--fx-from', (flip++ % 2 ? 50 : -50) + 'px');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el.classList.add('fx-pre'); io.observe(el);
      });
    }
    function startReveal() {
      revealOn = true; revealT0 = Date.now(); prep(document, true);
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var list = document.getElementById('catalogList');
      if (list) new MutationObserver(function () { prep(list, true); }).observe(list, { childList: true });
      var tc = $('.term-content');
      var qd = 0;
      if (tc) new MutationObserver(function () { if (qd) return; qd = requestAnimationFrame(function () { qd = 0; prep(tc); }); }).observe(tc, { childList: true, subtree: true });
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      setTimeout(function () { $$('.fx-pre').forEach(function (el) { el.classList.remove('fx-pre'); }); }, 7000);
    }
    startReveal();

    ['balAmount', 'dashBalance', 'statSpent', 'statOrders', 'drawerBalance'].forEach(function (id) {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var el = document.getElementById(id); if (!el) return;
      var busy = false, last = null;
      var num = function (t) { var m = String(t).replace(/,/g, '').match(/-?\d+(\.\d+)?/); return m ? parseFloat(m[0]) : null; };
      new MutationObserver(function () {
        if (busy) return;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var txt = el.textContent, to = num(txt);
        if (to === null) return;
        var from = last; last = to;
        if (from === null || from === to) return;
        busy = true;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var pre = String(txt).replace(/-?[\d,.]+.*$/, ''), start = performance.now(), dur = 900;
        var box = el.closest('.store-balance-chip, .dash-hero');
        if (box) { box.classList.remove('fx-flash'); void box.offsetWidth; box.classList.add('fx-flash'); }
        (function step(now) {
          var t = Math.min(1, (now - start) / dur), e = 1 - Math.pow(1 - t, 3);
          // src by SRT X CHEATS. Copy right SRT X CHEATS
          el.textContent = pre + Math.round(from + (to - from) * e);
          if (t < 1) requestAnimationFrame(step); else { el.textContent = txt; busy = false; }
        })(start);
      }).observe(el, { childList: true, characterData: true, subtree: true });
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS

    ['keyModal', 'successInfoModal'].forEach(function (id) {
      var m = document.getElementById(id); if (!m) return;
      var was = m.classList.contains('hidden');
      new MutationObserver(function () {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var hid = m.classList.contains('hidden');
        if (was && !hid) setTimeout(confetti, 250);
        was = hid;
      }).observe(m, { attributes: true, attributeFilter: ['class'] });
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS

    if (MODE === 'pc') document.addEventListener('click', function (e) {
      if (e.defaultPrevented || e.button || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      var a = e.target.closest && e.target.closest('a[href]');
      if (!a || (a.target && a.target !== '_self') || a.hasAttribute('download')) return;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var u; try { u = new URL(a.href, location.href); } catch (_) { return; }
      if (u.origin !== location.origin || /^(mailto|tel|javascript):/i.test(a.getAttribute('href'))) return;
      if (u.pathname === location.pathname && u.search === location.search) return;
      e.preventDefault();
      root.classList.add('fx-leaving');
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      setTimeout(function () { location.href = a.href; }, 210);
    });
    addEventListener('pageshow', function (e) { if (e.persisted) root.classList.remove('fx-leaving'); });

    var MAP = [
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      ['.btn-danger', 'push'],
      ['.btn-ghost, .gl-btn.ghost', 'pull', 12],
      ['.btn, .gl-btn, .btn-buy, .btn-download, .fb-result-btn, .dbc-btn, .guest-login-btn, .tab-fab', 'jelly'],
      ['.icon-btn, .theme-toggle-btn, .api-icon-btn, .reseller-community-btn', 'pop'],
      ['.cat-filter, .amount-chip, .tab', 'pop'],
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      ['.tab-item', 'tab'],
      ['.drawer-item, .update-link, .leaderboard-row, .log-entry, .op-info-row, .gb-opt', 'slide'],
      ['.dash-hero, .store-balance-chip, .drawer-balance-card, .profile-hero', 'bounce'],
      ['.stat-card, .gb-stat, .fb-card, .api-token', 'push'],
      ['.shortcut-card, .how-to-buy-banner', 'pull', 26],
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      ['.product-card', 'squish'],
      ['.panel', 'wobble']
    ];
    var REL = {
      bounce: { d: 800, kf: [{ scale: '.95 1.03', translate: '0 0' }, { scale: '1.07 .94', translate: '0 -9px', offset: .3 }, { scale: '.98 1.03', translate: '0 0', offset: .55 }, { scale: '1.02 .99', offset: .78 }, { scale: '1 1', translate: '0 0' }] },
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      jelly:  { d: 650, kf: [{ scale: '.92 .94' }, { scale: '1.1 .92', offset: .28 }, { scale: '.96 1.06', offset: .5 }, { scale: '1.03 .98', offset: .72 }, { scale: '1 1' }] },
      squish: { d: 600, kf: [{ scale: '1.025 .94' }, { scale: '.95 1.07', offset: .35 }, { scale: '1.02 .98', offset: .6 }, { scale: '1 1' }] },
      pop:    { d: 500, kf: [{ scale: '.86' }, { scale: '1.18', offset: .45 }, { scale: '.96', offset: .72 }, { scale: '1' }] },
      wobble: { d: 600, kf: [{ rotate: '0deg' }, { rotate: '-1.8deg', offset: .2 }, { rotate: '1.4deg', offset: .45 }, { rotate: '-.7deg', offset: .7 }, { rotate: '0deg' }] }
    };
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    var RIPPLE = { jelly: 1, pop: 1, slide: 1 };
    var INTERACTIVE = 'input, textarea, select, button, a, label, .modal-overlay';

    function match(t) {
      if (!t || !t.closest) return null;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      for (var i = 0; i < MAP.length; i++) {
        var el = t.closest(MAP[i][0]);
        if (!el) continue;
        if (MAP[i][1] === 'wobble' && (t.closest(INTERACTIVE) || el.closest('.modal-overlay'))) return null;
        return { el: el, type: MAP[i][1], k: MAP[i][2] || 18 };
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      }
      return null;
    }
    function prime(el, type) {
      if (el._fx) return;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      el._fx = 1; el.classList.add('fx-e'); el.dataset.fxe = type;
    }
    function ripple(el, x, y) {
      var r = el.getBoundingClientRect(), s = Math.max(r.width, r.height) * 2.2, cs = getComputedStyle(el);
      if (cs.position === 'static') el.classList.add('fx-rel');
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      if (cs.overflow === 'visible') { el.style.overflow = 'hidden'; el.dataset.fxOv = '1'; }
      var d = document.createElement('span'); d.className = 'fx-ripple';
      d.style.cssText = 'left:' + (x - r.left) + 'px;top:' + (y - r.top) + 'px;width:' + s + 'px;height:' + s + 'px';
      el.appendChild(d);
      setTimeout(function () { d.remove(); if (el.dataset.fxOv) { el.style.overflow = ''; delete el.dataset.fxOv; } }, 700);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    function tapRing(x, y) {
      var d = document.createElement('span'); d.className = 'fx-tap';
      d.style.left = x + 'px'; d.style.top = y + 'px';
      document.body.appendChild(d);
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      setTimeout(function () { d.remove(); }, 650);
    }

    var down = null, lastDrag = 0, lastDragEl = null, mag = null;

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.addEventListener('pointerdown', function (e) {
      if (e.pointerType === 'mouse' && e.button !== 0) return;
      if (MODE === 'pc') tapRing(e.clientX, e.clientY);
      var hit = match(e.target);
      if (!hit) return;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var el = hit.el;
      if (el.disabled || el.classList.contains('loading')) return;
      prime(el, hit.type);
      var r = el.getBoundingClientRect();
      var px = clamp(((e.clientX - r.left) / r.width - .5) * 2, -1, 1), py = clamp(((e.clientY - r.top) / r.height - .5) * 2, -1, 1);
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      el.style.setProperty('--px', px.toFixed(2)); el.style.setProperty('--py', py.toFixed(2));
      el.classList.add('fx-down');
      if (MODE === 'pc' && (RIPPLE[hit.type] || (hit.type === 'pull' && el.matches('.btn, .gl-btn')))) ripple(el, e.clientX, e.clientY);
      down = { el: el, type: hit.type, k: hit.k, x: e.clientX, y: e.clientY, moved: false };
      if (hit.type === 'pull') el.style.translate = (px * 5).toFixed(1) + 'px ' + (py * 5).toFixed(1) + 'px';
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      haptic(8);
    }, { passive: true });

    document.addEventListener('pointermove', function (e) {
      if (down && down.type === 'pull') {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var dx = e.clientX - down.x, dy = e.clientY - down.y;
        if (Math.abs(dx) + Math.abs(dy) > 6) down.moved = true;
        var tx = down.k * Math.tanh(dx / 90), ty = down.k * .6 * Math.tanh(dy / 90), d = Math.hypot(tx, ty);
        down.el.style.translate = tx.toFixed(1) + 'px ' + ty.toFixed(1) + 'px';
        down.el.style.rotate = (tx * .1).toFixed(2) + 'deg';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        down.el.style.scale = (1 + Math.min(.07, d * .003)).toFixed(3) + ' ' + (1 - Math.min(.04, d * .0015)).toFixed(3);
        return;
      }
      if (MODE === 'pc' && !down) {
        var nowM = performance.now(); if (nowM - (window.__fxLeanT || 0) < 32) return; window.__fxLeanT = nowM;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        var h = match(e.target);
        if (h && (h.type === 'pull' || h.type === 'jelly')) {
          prime(h.el, h.type);
          var r = h.el.getBoundingClientRect();
          h.el.style.translate = (((e.clientX - (r.left + r.width / 2)) / r.width) * 10).toFixed(1) + 'px ' + (((e.clientY - (r.top + r.height / 2)) / r.height) * 8).toFixed(1) + 'px';
          // src by SRT X CHEATS. Copy right SRT X CHEATS
          mag = h.el;
        }
      }
    }, { passive: true });
    document.addEventListener('pointerout', function (e) {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      if (mag && !(e.relatedTarget && mag.contains(e.relatedTarget))) { mag.style.translate = ''; mag = null; }
    }, { passive: true });

    function release(e) {
      if (!down) return;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      var d = down, el = d.el; down = null;
      el.classList.remove('fx-down');
      el.style.removeProperty('--px'); el.style.removeProperty('--py');
      if (d.type === 'pull') {
        el.style.translate = ''; el.style.rotate = ''; el.style.scale = '';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (d.moved) { lastDrag = performance.now(); lastDragEl = el; }
        return;
      }
      var R = REL[d.type];
      if (R && el.animate && e.type === 'pointerup') {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        el.animate(R.kf, { duration: R.d, easing: 'ease-in-out' });
        if (d.type === 'bounce' || d.type === 'jelly') {
          var ic = el.querySelector('i');
          if (ic && ic.animate) ic.animate([{ translate: '0 0' }, { translate: '0 -7px', offset: .4 }, { translate: '0 0' }], { duration: 520, easing: 'ease-out' });
        }
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      }
    }
    document.addEventListener('pointerup', release, { passive: true });
    document.addEventListener('pointercancel', release, { passive: true });
    document.addEventListener('dragstart', function (e) {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      if (e.target && e.target.closest && e.target.closest('.shortcut-card, .how-to-buy-banner, .btn-ghost, .gl-btn.ghost')) e.preventDefault();
    });
    document.addEventListener('click', function (e) {
      if (lastDragEl && performance.now() - lastDrag < 350 && lastDragEl.contains(e.target)) { e.preventDefault(); e.stopPropagation(); }
    }, true);
// src by SRT X CHEATS. Copy right SRT X CHEATS

    if (MODE === 'pc') {
      var spot = document.createElement('div'); spot.className = 'fx-spot'; document.body.appendChild(spot);
      var mx = 0, my = 0, tx = 0, ty = 0, trailT = 0, inited = false, mvRaf = 0, folRaf = 0, lastScrollT = 0;
      addEventListener('scroll', function () { lastScrollT = performance.now(); }, { passive: true });
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      function follow() {
        tx += (mx - tx) * .16; ty += (my - ty) * .16;
        spot.style.translate = tx.toFixed(1) + 'px ' + ty.toFixed(1) + 'px';
        folRaf = (Math.abs(mx - tx) + Math.abs(my - ty) > .6) ? requestAnimationFrame(follow) : 0;
      }
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      function onMove() {
        mvRaf = 0;
        if (document.hidden) return;
        if (!inited) { inited = true; spot.classList.add('on'); }
        if (!folRaf) folRaf = requestAnimationFrame(follow);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (!root.classList.contains('pgfx-on')) moveOrbs((mx / W - .5) * 2, (my / H - .5) * 2);
        var now = performance.now();
        if (now - trailT > 70 && now - lastScrollT > 200 && !root.classList.contains('pgfx-on')) {
          trailT = now;
          add(P({ x: mx + rand(-4, 4), y: my + rand(-4, 4), vx: rand(-.6, .6), vy: rand(-.6, .6), g: .02, s: rand(1.6, 3.2), dot: true, c: pick(COLORS), life: 22, fade: 22 }));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        }
      }
      addEventListener('mousemove', function (e) { mx = e.clientX; my = e.clientY; if (!mvRaf) mvRaf = requestAnimationFrame(onMove); }, { passive: true });
    }

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (PAGE === 'store' || PAGE === 'dashboard' || PAGE === 'glorybot' || PAGE === 'profile') setTimeout(showWelcome, 350);
  }

  if (document.body) boot(); else document.addEventListener('DOMContentLoaded', boot);
})();
// src by SRT X CHEATS. Copy right SRT X CHEATS
