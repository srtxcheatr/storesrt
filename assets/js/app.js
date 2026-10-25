// src by SRT X CHEATS. Copy right SRT X CHEATS
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js';
import {
  initializeAuth, browserSessionPersistence, browserPopupRedirectResolver, onAuthStateChanged, signOut,
  signInWithEmailAndPassword, createUserWithEmailAndPassword,
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  GoogleAuthProvider, signInWithPopup, sendPasswordResetEmail,
  EmailAuthProvider, reauthenticateWithCredential, updatePassword,
  getAdditionalUserInfo,
} from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js';

// src by SRT X CHEATS. Copy right SRT X CHEATS
export const app = initializeApp(window.FIREBASE_CONFIG);
// Session-only login: closing the tab/browser logs the user out; nothing persists in localStorage/IndexedDB
// The popup/redirect resolver makes Firebase load an extra auth iframe + gapi on EVERY page (slow on phones).
// Only the login/home pages sign in with Google, so only they get it.
const NEEDS_POPUP = /^\/(?:(?:login|home|index)(?:\.php)?)?$/.test(location.pathname);
export const auth = initializeAuth(app, NEEDS_POPUP ? { persistence: browserSessionPersistence, popupRedirectResolver: browserPopupRedirectResolver } : { persistence: browserSessionPersistence });
export const googleProvider = new GoogleAuthProvider();
export { onAuthStateChanged, signOut, signInWithEmailAndPassword, createUserWithEmailAndPassword,
  signInWithPopup, sendPasswordResetEmail, EmailAuthProvider, reauthenticateWithCredential, updatePassword,
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  getAdditionalUserInfo };

const LOGIN_PATH='/login.php', DASHBOARD_PATH='/dashboard.php';
const API_TIMEOUT_MS=12000;

// src by SRT X CHEATS. Copy right SRT X CHEATS
export async function getAuthToken(forceRefresh=false){
  const user=auth.currentUser;
  if(!user) throw new Error('Not logged in. Please refresh.');
  return user.getIdToken(forceRefresh);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function request(url, options={}, timeout=API_TIMEOUT_MS){
  const c=new AbortController(); const t=setTimeout(()=>c.abort(),timeout);
  try{return await fetch(url,{...options,signal:c.signal,cache:'no-store'});}
  catch(e){if(e?.name==='AbortError') throw new Error('Backend timeout. Please refresh and try again.'); throw new Error(e?.message||'Network error.');}
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  finally{clearTimeout(t);}
}

async function parseResponse(r){
  const text=await r.text();
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let d={};
  try{d=text?JSON.parse(text):{};}catch{throw new Error(`Backend returned invalid JSON (HTTP ${r.status}).`);}
  if(!r.ok || d.success===false){
    try{ if(window.srtxHandleBan) window.srtxHandleBan(r.status,d); }catch(_){}
    const err=new Error(d.error||`Request failed (HTTP ${r.status}).`);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    err.code=d.code; err.status=r.status; err.body=d;
    throw err;
  }
  return d;
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

export async function backendFetch(path, options={}){
  const base=String(window.BACKEND_URL||'').trim().replace(/\/+$/,'');
  if(!base) throw new Error('Backend URL is not configured.');
  let token=await getAuthToken(false);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const make=(tok)=>request(`${base}${path}`,{
    ...options,
    headers:{Accept:'application/json',...(options.body?{'Content-Type':'application/json'}:{}),...(options.headers||{}),Authorization:`Bearer ${tok}`}
  });
  let r=await make(token);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if(r.status===401){token=await getAuthToken(true);r=await make(token);}
  const data=await parseResponse(r);
  if(path.startsWith('/api/user/balance')){
    try{window.dispatchEvent(new CustomEvent('srtx:balance',{detail:data}));}catch(_){}
  }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  return data;
}

export async function fetchPublicCatalog(){
  const base=String(window.BACKEND_URL||'').trim().replace(/\/+$/,'');
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if(!base) throw new Error('Backend URL is not configured.');
  return parseResponse(await request(`${base}/api/catalog`,{headers:{Accept:'application/json'}}));
}

export function requireAuth(onReady){
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const unsubscribe=onAuthStateChanged(auth,async user=>{
    if(!user){unsubscribe();if(location.pathname!==LOGIN_PATH) location.replace(LOGIN_PATH);return;}
    bindUid(user.uid);
    startSync();
    const cachedProfile=cachePeek('profile'); if(cachedProfile) announce('profile',cachedProfile.value);
    // Make sure every page loads the profile (balance + name) in the background, even pages that never ask for it themselves.
    // Deduplicated with the page's own getData('profile') call, so it costs no extra request.
    ensureSession().then(()=>getData('profile').catch(()=>{}));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    await ensureSession();
    try{await onReady(user);}catch(e){console.error('[page-init]',e);toast(e.message||'Failed to load page data','error');}
    warmCache();
  });
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

let sessionPromise=null;
function ensureSession(){
  let done=false;
  try{done=sessionStorage.getItem('srtx_session_inited')==='1';}catch(_){}
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if(done) return Promise.resolve();
  if(!sessionPromise){
    sessionPromise=backendFetch('/api/user/init',{method:'POST'})
      .then(()=>{try{sessionStorage.setItem('srtx_session_inited','1');}catch(_){}})
      .catch(()=>{})
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      .finally(()=>{sessionPromise=null;});
  }
  return sessionPromise;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function warmCache(){
  const idle=window.requestIdleCallback||((f)=>setTimeout(f,1200));
  idle(()=>{ ['catalog'].forEach(k=>{ try{ getData(k).catch(()=>{}); }catch(_){} }); });
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
export function checkAuthOnce(){
  return new Promise(resolve=>{
    const unsubscribe=onAuthStateChanged(auth,user=>{unsubscribe();if(user)bindUid(user.uid);resolve(user);});
    setTimeout(()=>{try{unsubscribe();}catch{} resolve(null);},10000);
  });
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

export function optionalAuth(onChange){onAuthStateChanged(auth,user=>{if(user&&location.pathname==='/home.php'){location.replace(DASHBOARD_PATH);return;}onChange(user);});}

const MIN = 60 * 1000;
// src by SRT X CHEATS. Copy right SRT X CHEATS
export const DATA_TTL = {
  profile: 6 * 60 * MIN,
  catalog: 12 * 60 * MIN,
  history: 6 * 60 * MIN,
  leaderboard: 15 * MIN,
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  announcement: 12 * 60 * MIN,
  feedback: 6 * 60 * MIN,
  policy: 24 * 60 * MIN,
};
const DEFAULT_TTL = 6 * 60 * MIN;
// src by SRT X CHEATS. Copy right SRT X CHEATS
const STORE_PREFIX = 'srtx_data_v2:';
const UID_KEY = 'srtx_data_uid';
const VERSIONS_KEY = 'srtx_versions';
const memFallback = new Map();

// src by SRT X CHEATS. Copy right SRT X CHEATS
function box(key) {
  // without cookie/storage consent the cache lives in memory only (see /assets/js/consent.js)
  try { return (window.srtxConsent && !window.srtxConsent.allowed()) ? null : localStorage; } catch (_) { return null; }
}
function knownUid() {
  if (auth.currentUser?.uid) return auth.currentUser.uid;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  try { return localStorage.getItem(UID_KEY) || null; } catch (_) { return null; }
}
function readRaw(key) {
  const uid = knownUid();
  if (!uid) return null;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let item = null;
  try {
    const b = box(key);
    const raw = b ? b.getItem(STORE_PREFIX + key) : null;
    item = raw ? JSON.parse(raw) : memFallback.get(key) || null;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  } catch (_) { item = memFallback.get(key) || null; }
  if (!item || typeof item.t !== 'number' || item.u !== uid) return null;
  return item;
}
function writeRaw(key, item) {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  try {
    const b = box(key);
    if (!b) throw new Error('no storage');
    b.setItem(STORE_PREFIX + key, JSON.stringify(item));
    memFallback.delete(key);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  } catch (_) { memFallback.set(key, item); }
}
function announce(key, value) {
  try { window.dispatchEvent(new CustomEvent('srtx:data', { detail: { key, value } })); } catch (_) {}
  if (key === 'profile' && value) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { window.dispatchEvent(new CustomEvent('srtx:balance', { detail: value })); } catch (_) {}
  }
}

function bindUid(uid) {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  try {
    const prev = localStorage.getItem(UID_KEY);
    if (prev && prev !== uid) cacheClear();
    localStorage.setItem(UID_KEY, uid);
  } catch (_) {}
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

export function cachePeek(key) {
  const it = readRaw(key);
  return it ? { value: it.v, age: Date.now() - it.t } : null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

export function cacheWrite(key, value) {
  const uid = knownUid();
  if (!uid) return;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  writeRaw(key, { t: Date.now(), u: uid, v: value });
  announce(key, value);
}

export function cachePatch(key, patch) {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const it = readRaw(key);
  if (!it) return null;
  const next = typeof patch === 'function' ? patch(it.v) : { ...(it.v || {}), ...patch };
  writeRaw(key, { ...it, v: next });
  announce(key, next);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  return next;
}

export function cacheInvalidate(...keys) {
  keys.forEach((key) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { box(key)?.removeItem(STORE_PREFIX + key); } catch (_) {}
    memFallback.delete(key);
  });
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
export function cacheClear() {
  [localStorage, sessionStorage].forEach((st) => {
    try { Object.keys(st).filter((k) => k.startsWith(STORE_PREFIX) || k === 'srtx_session_inited' || k === VERSIONS_KEY).forEach((k) => st.removeItem(k)); } catch (_) {}
  });
  memFallback.clear();
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

window.addEventListener('storage', (e) => {
  if (!e.key || !e.key.startsWith(STORE_PREFIX)) return;
  const key = e.key.slice(STORE_PREFIX.length);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let value = null;
  try { value = e.newValue ? JSON.parse(e.newValue).v : null; } catch (_) {}
  if (value) announce(key, value);
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
(function sweepExpired() {
  try {
    [localStorage, sessionStorage].forEach((st) => {
      Object.keys(st).filter((k) => k.startsWith(STORE_PREFIX)).forEach((k) => {
        const name = k.slice(STORE_PREFIX.length);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const t = JSON.parse(st.getItem(k) || '{}').t;
        if (typeof t !== 'number' || Date.now() - t > 2 * (DATA_TTL[name] ?? DEFAULT_TTL)) st.removeItem(k);
      });
    });
  } catch (_) {}
// src by SRT X CHEATS. Copy right SRT X CHEATS
})();

const LOADERS = {
  profile: () => backendFetch('/api/user/balance'),
  catalog: () => backendFetch('/api/user/catalog'),
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  history: () => backendFetch('/api/user/history'),
  leaderboard: async () => ({ leaderboard: (await backendFetch('/api/user/leaderboard')).leaderboard || [] }),
  announcement: () => backendFetch('/api/user/announcement'),
  feedback: () => backendFetch('/api/user/feedback'),
  policy: async () => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const base = String(window.BACKEND_URL || '').trim().replace(/\/+$/, '');
    return parseResponse(await request(`${base}/api/policy`, { headers: { Accept: 'application/json' } }));
  },
};
const inflight = new Map();
// src by SRT X CHEATS. Copy right SRT X CHEATS

export async function getData(key, { ttl, force = false, onStale, strict = false } = {}) {
  const limit = ttl ?? DATA_TTL[key] ?? DEFAULT_TTL;
  const hit = cachePeek(key);
  if (hit && !force && hit.age < limit) return hit.value;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if (hit && onStale) { try { onStale(hit.value); } catch (_) {} }
  if (inflight.has(key)) return inflight.get(key);

  const p = (async () => {
    try {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      const value = await LOADERS[key]();
      cacheWrite(key, value);
      return value;
    } catch (e) {
      if (hit && !strict) return hit.value;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      throw e;
    } finally {
      inflight.delete(key);
    }
  })();
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  inflight.set(key, p);
  return p;
}

export const refreshData = (key) => getData(key, { force: true });
// src by SRT X CHEATS. Copy right SRT X CHEATS

export function applyBalanceChange(newBalance) {
  if (newBalance === undefined || newBalance === null) return;
  cachePatch('profile', { balance: Number(newBalance) });
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

export function applyProfileChange(fields) {
  return cachePatch('profile', fields);
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
export function recordPurchase({ entry, newBalance }) {
  cachePatch('profile', (p) => ({
    ...(p || {}),
    ...(newBalance !== undefined ? { balance: Number(newBalance) } : {}),
    totalKeysBought: Number(p?.totalKeysBought || 0) + 1,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    totalSpent: Number(p?.totalSpent || 0) + Number(entry?.price || 0),
  }));
  if (entry) cachePatch('history', (h) => ({ ...(h || {}), history: [entry, ...((h && h.history) || [])] }));
  cacheInvalidate('leaderboard');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

export function statsFromHistory(historyData) {
  const items = historyData?.history || [];
  return { spent: items.reduce((sum, it) => sum + (Number(it.price) || 0), 0), orders: items.length };
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

export function renderAvatar(el, url, fallbackText = '?') {
  if (!el) return;
  const initial = String(fallbackText || '?').trim().charAt(0).toUpperCase() || '?';
  if (!url) { el.textContent = initial; return; }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const img = new Image();
  img.alt = '';
  img.decoding = 'async';
  img.referrerPolicy = 'no-referrer';
  img.onerror = () => { el.textContent = initial; };
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  img.src = url;
  el.textContent = '';
  el.appendChild(img);
}

// Sidebar balance on EVERY page (dashboard/store used to be the only ones that painted it)
export function paintDrawerBalance(balance) {
  const el = document.getElementById('drawerBalance');
  if (!el || balance === undefined || balance === null || balance === '' || isNaN(Number(balance))) return;
  el.textContent = 'NRP ' + balance;
}
function paintDrawerFromCache() {
  const c = cachePeek('profile');
  if (c && c.value) paintDrawerBalance(c.value.balance);
}
if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', paintDrawerFromCache, { once: true });
else paintDrawerFromCache();

window.addEventListener('srtx:balance', (e) => {
  const p = e.detail || {};
  paintDrawerBalance(p.balance);
  const label = p.profileName || p.email || 'My Account';
  const name = document.getElementById('drawerUserName');
  if (name && p.profileName) name.textContent = p.profileName;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const av = document.getElementById('drawerAvatar');
  if (av) {
    if (p.avatarUrl) renderAvatar(av, p.avatarUrl, label);
    else if (!av.querySelector('i,img') || av.dataset.custom === '1') { av.innerHTML = '<i class="fas fa-user"></i>'; av.dataset.custom = ''; }
    if (p.avatarUrl) av.dataset.custom = '1';
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  }
});

const SYNC_EVERY_MS = 15 * 1000;
const VERSION_TARGETS = {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  user: ['profile'],
  history: ['history'],
  catalog: ['catalog'],
  leaderboard: ['leaderboard'],
  announcement: ['announcement'],
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  feedback: ['feedback', 'catalog'],
  policy: ['policy'],
};
let syncing = false, syncTimer = null;

// src by SRT X CHEATS. Copy right SRT X CHEATS
function loadVersions() {
  try {
    const o = JSON.parse(localStorage.getItem(VERSIONS_KEY) || 'null');
    return o && o.u === knownUid() ? o.v : null;
  } catch (_) { return null; }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
function saveVersions(v) {
  try { localStorage.setItem(VERSIONS_KEY, JSON.stringify({ u: knownUid(), v })); } catch (_) {}
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function refreshDataset(name) {
  const before = cachePeek(name)?.value;
  const fresh = await getData(name, { force: true, strict: true });
  if (name === 'profile' && before && before.role !== fresh.role && cachePeek('catalog')) {
    await getData('catalog', { force: true, strict: true }).catch(() => {});
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  }
}

let lastServer = null;

// src by SRT X CHEATS. Copy right SRT X CHEATS
export async function syncNow() {
  if (syncing || !auth.currentUser) return;
  syncing = true;
  try {
    const server = (await backendFetch('/api/user/sync')).versions || {};
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    lastServer = server;
    const bp = server.balancePatch;
    const prev = loadVersions();
    const next = { ...(prev || {}) };
    for (const key of Object.keys(server)) {
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      if (key === 'balancePatch') continue;
      if (prev && prev[key] === server[key]) continue;

      if (key === 'user' && bp && prev && prev.user === bp.prev && bp.stamp === server.user && cachePeek('profile')) {
        applyBalanceChange(bp.balance);
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        next.user = server.user;
        continue;
      }

      const cached = (VERSION_TARGETS[key] || []).filter((t) => cachePeek(t));
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      if (!cached.length) continue;

      if (!(prev && prev[key]) && cached.every((t) => cachePeek(t).age < 20000)) {
        next[key] = server[key];
        continue;
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      }
      try {
        await Promise.all(cached.map(refreshDataset));
        next[key] = server[key];
      } catch (_) {}
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
    saveVersions(next);
  } catch (_) {}
  finally { syncing = false; }
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

export function startSync() {
  if (syncTimer) return;
  syncNow();
  syncTimer = setInterval(() => { if (!document.hidden) syncNow(); }, SYNC_EVERY_MS);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.addEventListener('visibilitychange', () => { if (!document.hidden) syncNow(); });
}

export function toast(msg,kind){
  if(window.srtxToast){window.srtxToast(msg,kind);return;}
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let el=document.getElementById('__toast');
  if(!el){el=document.createElement('div');el.id='__toast';el.className='toast';document.body.appendChild(el);}
  el.textContent=msg;el.className='toast show'+(kind?' '+kind:'');clearTimeout(el._timer);el._timer=setTimeout(()=>el.classList.remove('show'),4000);
}
export async function doLogout(){try{localStorage.clear();sessionStorage.clear();await signOut(auth);}catch(e){console.error(e);}finally{location.replace(LOGIN_PATH);}}
// src by SRT X CHEATS. Copy right SRT X CHEATS
window.doLogout=doLogout;
export function fmtDate(iso){if(!iso)return '';try{return new Date(iso).toLocaleString();}catch{return iso;}}
// escapes quotes too, so the result is safe inside HTML attributes (href="...", title="...") and not only in text nodes
export function esc(s){return String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');}
const SCRAMBLE_CHARS='!<>-_\\/[]{}—=+*^?#________';
export function setButtonLoading(btn,loading){if(!btn)return;if(loading){btn.disabled=true;if(window.srtxMorph)window.srtxMorph(btn,true);btn.classList.add('loading');}else{btn.classList.remove('loading');btn.disabled=false;if(window.srtxMorph)window.srtxMorph(btn,false);}}
// src by SRT X CHEATS. Copy right SRT X CHEATS
export function enableTilt(root=document){
  if(!matchMedia('(pointer:fine)').matches)return;
  root.querySelectorAll('.tilt').forEach(el=>{
    if(el._tiltBound)return;
    el._tiltBound=true;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    el.addEventListener('pointermove',e=>{
      const r=el.getBoundingClientRect();
      const px=(e.clientX-r.left)/r.width-.5;
      const py=(e.clientY-r.top)/r.height-.5;
      el.style.setProperty('--rx',`${py*-6}deg`);
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      el.style.setProperty('--ry',`${px*6}deg`);
      el.style.setProperty('--mx',`${(px+.5)*100}%`);
      el.style.setProperty('--my',`${(py+.5)*100}%`);
    });
    el.addEventListener('pointerleave',()=>{
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      el.style.setProperty('--rx','0deg');
      el.style.setProperty('--ry','0deg');
      el.style.setProperty('--mx','50%');
      el.style.setProperty('--my','50%');
    });
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  });
}

function initVisualEffects(){
  if(document.body.dataset.srtVisuals==='1') return;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.body.dataset.srtVisuals='1';

  const reduceMotion=matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isFine=matchMedia('(pointer:fine)').matches;
  const lowFx=document.documentElement.classList.contains('srt-low-fx');
// src by SRT X CHEATS. Copy right SRT X CHEATS

  const canvas=document.createElement('canvas');
  canvas.className='srt-web-canvas';
  document.body.prepend(canvas);
  const ctx=canvas.getContext('2d');
// src by SRT X CHEATS. Copy right SRT X CHEATS

  let vw=0,vh=0;
  const dpr=isFine?Math.min(window.devicePixelRatio||1,2):1;
  function sizeCanvas(){
    vw=window.innerWidth; vh=window.innerHeight;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    canvas.width=Math.round(vw*dpr); canvas.height=Math.round(vh*dpr);
    canvas.style.width=vw+'px'; canvas.style.height=vh+'px';
    ctx.setTransform(dpr,0,0,dpr,0,0);
  }
  sizeCanvas();
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let resizeTimer;
  window.addEventListener('resize',()=>{clearTimeout(resizeTimer);resizeTimer=setTimeout(sizeCanvas,200);},{passive:true});

  const density=isFine?1/15000:1/26000;
  const maxNodes=isFine?42:16;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const nodeCount=Math.max(14,Math.min(maxNodes,Math.round(vw*vh*density)));
  const LINK_DIST=isFine?130:105;
  const LINK_DIST_SQ=LINK_DIST*LINK_DIST;
  const CURSOR_DIST=isFine?165:0;
  const CURSOR_DIST_SQ=CURSOR_DIST*CURSOR_DIST;
// src by SRT X CHEATS. Copy right SRT X CHEATS

  const nodes=Array.from({length:nodeCount},()=>({
    x:Math.random()*vw, y:Math.random()*vh,
    vx:(Math.random()-.5)*.16, vy:(Math.random()-.5)*.16,
    r:1+Math.random()*1.3,
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  }));

  const pointer={x:-9999,y:-9999,active:false};

  function hexToRgb(hex){
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const h=hex.trim().replace('#','');
    const full=h.length===3?h.split('').map(c=>c+c).join(''):h;
    const n=parseInt(full,16);
    return Number.isNaN(n)?[34,211,238]:[(n>>16)&255,(n>>8)&255,n&255];
  }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  function readColors(){
    const cs=getComputedStyle(document.documentElement);
    return{
      node:hexToRgb(cs.getPropertyValue('--neon-blue')||'#22d3ee'),
      web:hexToRgb(cs.getPropertyValue('--neon-purple')||'#a855f7'),
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    };
  }
  let colors=readColors();
  new MutationObserver(()=>{colors=readColors();})
    .observe(document.documentElement,{attributes:true,attributeFilter:['data-theme']});
// src by SRT X CHEATS. Copy right SRT X CHEATS

  function step(){
    for(const n of nodes){
      if(pointer.active && CURSOR_DIST){
        const dx=pointer.x-n.x, dy=pointer.y-n.y;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const d=Math.hypot(dx,dy);
        if(d<CURSOR_DIST && d>0.01){
          const pull=(1-d/CURSOR_DIST)*.02;
          n.vx+=(dx/d)*pull; n.vy+=(dy/d)*pull;
        }
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      }
      n.vx*=.985; n.vy*=.985;
      n.x+=n.vx; n.y+=n.vy;
      if(n.x<-30) n.x=vw+30; else if(n.x>vw+30) n.x=-30;
      if(n.y<-30) n.y=vh+30; else if(n.y>vh+30) n.y=-30;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
  }

  function draw(){
    ctx.clearRect(0,0,vw,vh);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const[nr,ng,nb]=colors.node, [wr,wg,wb]=colors.web;

    for(let i=0;i<nodes.length;i++){
      const a=nodes[i];
      for(let j=i+1;j<nodes.length;j++){
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const b=nodes[j];
        const dx=a.x-b.x, dy=a.y-b.y;
        const distSq=dx*dx+dy*dy;
        if(distSq<LINK_DIST_SQ){
          const dist=Math.sqrt(distSq);
          // src by SRT X CHEATS. Copy right SRT X CHEATS
          ctx.strokeStyle=`rgba(${nr},${ng},${nb},${((1-dist/LINK_DIST)*.45).toFixed(3)})`;
          ctx.lineWidth=1;
          ctx.beginPath(); ctx.moveTo(a.x,a.y); ctx.lineTo(b.x,b.y); ctx.stroke();
        }
      }
      // src by SRT X CHEATS. Copy right SRT X CHEATS
      ctx.beginPath();
      ctx.fillStyle=`rgba(${nr},${ng},${nb},0.5)`;
      ctx.arc(a.x,a.y,a.r,0,Math.PI*2);
      ctx.fill();
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    if(pointer.active && CURSOR_DIST){
      for(const n of nodes){
        const dx=pointer.x-n.x, dy=pointer.y-n.y;
        const distSq=dx*dx+dy*dy;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if(distSq<CURSOR_DIST_SQ){
          const dist=Math.sqrt(distSq);
          ctx.strokeStyle=`rgba(${wr},${wg},${wb},${((1-dist/CURSOR_DIST)*.8).toFixed(3)})`;
          ctx.lineWidth=1.1;
          ctx.beginPath(); ctx.moveTo(pointer.x,pointer.y); ctx.lineTo(n.x,n.y); ctx.stroke();
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        }
      }
    }
  }

  // src by SRT X CHEATS. Copy right SRT X CHEATS
  let raf=0,lastTick=0,lastScroll=0;
  const FRAME_MS=isFine?42:66;
  if(!isFine) window.addEventListener('scroll',()=>{lastScroll=performance.now();},{passive:true});
  function loop(ts){
    raf=requestAnimationFrame(loop);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if(ts-lastTick<FRAME_MS) return;
    if(!isFine && performance.now()-lastScroll<180) return;
    if(document.documentElement.classList.contains('pgfx-on')) return;
    lastTick=ts;
    step(); draw();
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  }

  if(reduceMotion||lowFx){
    draw();
  } else {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    raf=requestAnimationFrame(loop);
    document.addEventListener('visibilitychange',()=>{
      if(document.hidden){ cancelAnimationFrame(raf); raf=0; }
      else if(!raf){ lastTick=0; raf=requestAnimationFrame(loop); }
    });
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  }

  if(!isFine) return;
  const dot=document.createElement('div'); dot.className='srt-cursor-dot';
  const ring=document.createElement('div'); ring.className='srt-cursor-ring';
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.body.append(dot,ring);
  document.body.classList.add('srt-cursor-ready');
  let mx=-100,my=-100,rx=-100,ry=-100,cursorRaf=0;
  const moveCursor=()=>{
    rx += (mx-rx)*.28; ry += (my-ry)*.28;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    dot.style.transform=`translate3d(${mx}px,${my}px,0)`;
    ring.style.transform=`translate3d(${rx}px,${ry}px,0)`;
    if(Math.abs(mx-rx)<.3 && Math.abs(my-ry)<.3){ rx=mx; ry=my; cursorRaf=0; return; }
    cursorRaf=requestAnimationFrame(moveCursor);
  };
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  document.addEventListener('pointermove',e=>{
    mx=e.clientX; my=e.clientY;
    if(!cursorRaf) cursorRaf=requestAnimationFrame(moveCursor);
    pointer.x=mx; pointer.y=my; pointer.active=true;
    dot.style.opacity='1'; ring.style.opacity='1';
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  },{passive:true});
  document.addEventListener('pointerover',e=>{
    if(e.target.closest('a,button,.btn,.tilt,input,textarea,select')) ring.classList.add('active');
  },{passive:true});
  document.addEventListener('pointerout',e=>{
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if(e.target.closest('a,button,.btn,.tilt,input,textarea,select')) ring.classList.remove('active');
  },{passive:true});
  document.addEventListener('pointerleave',()=>{
    dot.style.opacity='0'; ring.style.opacity='0'; pointer.active=false;
  },{passive:true});
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if(!cursorRaf) cursorRaf=requestAnimationFrame(moveCursor);
}

if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',initVisualEffects,{once:true});
else initVisualEffects();
// src by SRT X CHEATS. Copy right SRT X CHEATS
