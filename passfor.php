<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Forgot Password — SRT X CHEATS';
$bodyClass = 'auth-body forgot-body';
require __DIR__ . '/includes/head.php';
?>
<link rel="stylesheet" href="/assets/css/forgot.css?v=20260906-2">

<div class="forgot-shell">
  <div class="auth-brand">
    <div class="logo-img-wrap" style="margin:0 auto">
      <img src="/assets/img/logo.png?v=1" alt="Logo" class="site-logo">
    </div>
    <div class="auth-brand-title">SRT <span class="neon-cyan">X</span> CHEATS</div>
    <div class="auth-brand-sub">Password Recovery</div>
  </div>

  <div class="panel forgot-card">
    <div class="forgot-step" id="emailStep">
      <div class="forgot-icon"><i class="fas fa-key"></i></div>
      <div class="prompt-header">FORGOT PASSWORD</div>
      <p class="forgot-desc">Enter the Gmail address connected to your account. We will send a one-time OTP.</p>
      <div class="field">
        <label><i class="fas fa-envelope"></i> Your Gmail</label>
        <input type="email" id="forgotEmail" placeholder="you@gmail.com" autocomplete="email" inputmode="email">
      </div>
      <button class="btn btn-solid" id="sendOtpBtn">
        <span class="btn-text"><i class="fas fa-paper-plane"></i> Next</span>
        <span class="btn-spinner hidden"><i class="fas fa-circle-notch fa-spin"></i> Sending...</span>
      </button>
    </div>

    <div class="forgot-step hidden" id="otpStep">
      <div class="forgot-icon"><i class="fas fa-shield-halved"></i></div>
      <div class="prompt-header">ENTER OTP</div>
      <p class="forgot-desc">Enter the 6-digit OTP sent to your email.</p>
      <div class="field">
        <label><i class="fas fa-lock"></i> OTP</label>
        <input type="text" id="forgotOtp" placeholder="123456" maxlength="6" inputmode="numeric" autocomplete="one-time-code">
      </div>
      <button class="btn btn-solid" id="verifyOtpBtn">
        <span class="btn-text"><i class="fas fa-check"></i> Verify OTP</span>
        <span class="btn-spinner hidden"><i class="fas fa-circle-notch fa-spin"></i> Verifying...</span>
      </button>
      <button class="btn btn-ghost" id="changeEmailBtn" type="button">Change email</button>
      <button class="btn btn-ghost" id="resendOtpBtn" type="button" disabled>Resend OTP <span id="resendTimer"></span></button>
    </div>

    <div class="forgot-step hidden" id="passwordStep">
      <div class="forgot-icon"><i class="fas fa-lock"></i></div>
      <div class="prompt-header">SET NEW PASSWORD</div>
      <p class="forgot-desc">OTP verified. Create a new password for your account.</p>
      <div class="field">
        <label><i class="fas fa-lock"></i> New Password</label>
        <input type="password" id="newPassword" placeholder="Create a strong password" autocomplete="new-password" minlength="8">
      </div>
      <div class="field">
        <label><i class="fas fa-lock"></i> Confirm Password</label>
        <input type="password" id="confirmPassword" placeholder="Repeat your new password" autocomplete="new-password" minlength="8">
      </div>
      <button class="btn btn-solid" id="resetPasswordBtn">
        <span class="btn-text"><i class="fas fa-key"></i> Reset Password</span>
        <span class="btn-spinner hidden"><i class="fas fa-circle-notch fa-spin"></i> Updating...</span>
      </button>
    </div>

    <div class="forgot-guide" id="emailGuide">
      <div class="guide-title"><i class="fas fa-circle-info"></i> GMAIL OTP GUIDE</div>
      <ol>
        <li><b>Step 1:</b> Enter your email and click <b>Next</b>.</li>
        <li><b>Step 2:</b> Check your email — the code was sent.</li>
      </ol>
      <div class="guide-sender"><i class="fas fa-paper-plane"></i> Sender — <b>S𝚁ᴛ. ✘ .𝐃𝙴𝚅</b></div>
      <div class="guide-warning"><i class="fas fa-triangle-exclamation"></i> Code not received or not showing? Check your <b>Spam</b> folder.</div>
    </div>

    <div class="forgot-guide hidden" id="passwordGuide">
      <div class="guide-title"><i class="fas fa-shield-halved"></i> STRONG PASSWORD GUIDE</div>
      <ul class="password-rules" id="passwordRules">
        <li data-rule="length"><i class="fas fa-circle"></i> At least 8 characters</li>
        <li data-rule="upper"><i class="fas fa-circle"></i> One uppercase letter (A-Z)</li>
        <li data-rule="lower"><i class="fas fa-circle"></i> One lowercase letter (a-z)</li>
        <li data-rule="number"><i class="fas fa-circle"></i> One number (0-9)</li>
        <li data-rule="special"><i class="fas fa-circle"></i> One special character (!@#$...)</li>
      </ul>
      <div class="guide-tip"><i class="fas fa-lightbulb"></i> Don't use your name, email, or an easy-to-guess password.</div>
    </div>

    <div class="forgot-footer">
      <a href="/login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
    </div>
  </div>
</div>

<script type="module" src="/assets/js/forgot.js?v=20261014-2"></script>
</body>
</html>
