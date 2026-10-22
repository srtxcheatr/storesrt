// src by SRT X CHEATS. Copy right SRT X CHEATS
const API = String(window.BACKEND_URL || '').replace(/\/+$/, '');
const $ = (id) => document.getElementById(id);

function showStep(id) {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  ['emailStep','otpStep','passwordStep'].forEach(x => $(x).classList.toggle('hidden', x !== id));
  const emailGuide = $('emailGuide');
  const passwordGuide = $('passwordGuide');
  if (emailGuide) emailGuide.classList.toggle('hidden', id === 'passwordStep');
  if (passwordGuide) passwordGuide.classList.toggle('hidden', id !== 'passwordStep');
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
function setLoading(btn, loading) {
  btn.disabled = loading;
  btn.classList.toggle('loading', loading);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
function toast(message, type='error') {
  if (window.srtxToast) return window.srtxToast(message, type);
  let box = document.getElementById('forgotToast');
  if (!box) {
    box = document.createElement('div');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    box.id = 'forgotToast';
    box.style.cssText = 'position:fixed;left:50%;bottom:22px;transform:translateX(-50%);z-index:9999;max-width:calc(100% - 30px);padding:11px 14px;border-radius:12px;background:rgba(15,12,30,.96);border:1px solid rgba(255,255,255,.16);box-shadow:0 10px 30px rgba(0,0,0,.35);font-size:12px;text-align:center;color:#fff';
    document.body.appendChild(box);
  }
  box.textContent = message;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  box.style.borderColor = type === 'success' ? 'rgba(34,197,94,.65)' : 'rgba(239,68,68,.65)';
  clearTimeout(box._timer);
  box._timer = setTimeout(() => box.remove(), 3500);
}
async function api(path, body) {
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if (!API) throw new Error('Backend URL is not configured.');
  const r = await fetch(API + path, {
    method:'POST', headers:{'Content-Type':'application/json','Accept':'application/json'},
    body:JSON.stringify(body), cache:'no-store'
  });
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  const text = await r.text(); let d={};
  try { d = text ? JSON.parse(text) : {}; } catch { throw new Error(`Backend returned invalid JSON (HTTP ${r.status}).`); }
  if (!r.ok || d.success === false) throw new Error(d.error || 'Request failed.');
  return d;
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

let email = '';
let resetToken = '';
let resendInterval = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS

function startResendTimer(seconds=60) {
  const btn = $('resendOtpBtn'), label = $('resendTimer');
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  clearInterval(resendInterval);
  btn.disabled = true;
  let left = seconds;
  label.textContent = `(${left}s)`;
  resendInterval = setInterval(() => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    left -= 1;
    label.textContent = left > 0 ? `(${left}s)` : '';
    if (left <= 0) { clearInterval(resendInterval); btn.disabled = false; }
  }, 1000);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function updatePasswordGuide() {
  const value = $('newPassword')?.value || '';
  const checks = {
    length: value.length >= 8,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    upper: /[A-Z]/.test(value),
    lower: /[a-z]/.test(value),
    number: /\d/.test(value),
    special: /[^A-Za-z0-9]/.test(value)
  };
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  Object.entries(checks).forEach(([name, ok]) => {
    const row = document.querySelector(`#passwordRules [data-rule="${name}"]`);
    if (!row) return;
    row.classList.toggle('valid', ok);
    const icon = row.querySelector('i');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (icon) icon.className = ok ? 'fas fa-circle-check' : 'fas fa-circle';
  });
  return Object.values(checks).every(Boolean);
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
$('sendOtpBtn').onclick = async () => {
  email = $('forgotEmail').value.trim().toLowerCase();
  if (!/^[^\s@]+@gmail\.com$/i.test(email)) return toast('Enter a valid Gmail address ending with @gmail.com.');
  const btn = $('sendOtpBtn'); setLoading(btn,true);
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  try {
    const d = await api('/api/auth/forgot-password/send-otp', { email });
    toast(d.message || 'OTP sent. Check your Gmail and Spam folder.', 'success');
    showStep('otpStep'); startResendTimer(60); $('forgotOtp').focus();
  } catch(e) { toast(e.message); }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  finally { setLoading(btn,false); }
};

$('verifyOtpBtn').onclick = async () => {
  const otp = $('forgotOtp').value.trim();
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if (!/^\d{6}$/.test(otp)) return toast('Enter the 6-digit OTP.');
  const btn = $('verifyOtpBtn'); setLoading(btn,true);
  try {
    const d = await api('/api/auth/forgot-password/verify-otp', { email, otp });
    resetToken = d.resetToken || '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!resetToken) throw new Error('Verification succeeded but reset token was missing.');
    clearInterval(resendInterval);
    showStep('passwordStep'); $('newPassword').focus(); updatePasswordGuide();
    toast('OTP verified. Create a strong new password.', 'success');
  } catch(e) { toast(e.message); }
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  finally { setLoading(btn,false); }
};

$('newPassword').addEventListener('input', updatePasswordGuide);

// src by SRT X CHEATS. Copy right SRT X CHEATS
$('resetPasswordBtn').onclick = async () => {
  const password = $('newPassword').value;
  const confirm = $('confirmPassword').value;
  if (!updatePasswordGuide()) return toast('Use all strong-password requirements shown below.');
  if (password !== confirm) return toast('Passwords do not match.');
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  if (!resetToken) return toast('Your reset session expired. Start again.');
  const btn = $('resetPasswordBtn'); setLoading(btn,true);
  try {
    await api('/api/auth/forgot-password/reset', { email, resetToken, password });
    toast('Password changed successfully. Redirecting to login...', 'success');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setTimeout(() => location.replace('/login.php'), 1100);
  } catch(e) { toast(e.message); }
  finally { setLoading(btn,false); }
};

// src by SRT X CHEATS. Copy right SRT X CHEATS
$('changeEmailBtn').onclick = () => { clearInterval(resendInterval); resetToken=''; showStep('emailStep'); $('forgotEmail').focus(); };
$('resendOtpBtn').onclick = async () => {
  if (!email) return;
  const btn = $('resendOtpBtn'); btn.disabled = true;
  // src by SRT X CHEATS. Copy right SRT X CHEATS
  try {
    const d = await api('/api/auth/forgot-password/send-otp', { email });
    toast(d.message || 'New OTP sent.', 'success'); startResendTimer(60); $('forgotOtp').value=''; $('forgotOtp').focus();
  } catch(e) { toast(e.message); btn.disabled=false; }
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

showStep('emailStep');
