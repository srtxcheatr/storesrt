<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
$pageTitle = 'Store — SRT X CHEATS';
$metaDescription = 'SRT X CHEATS store: panels for iOS, Android Root/Non-Root and PC.';
$indexable = true;
$currentPage = 'store';
// src by SRT X CHEATS. Copy right SRT X CHEATS
$bodyClass = 'fx-wild';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>

<div class="term-window">
    <div class="term-content">

        <?php $fpHideBanner = true; require __DIR__ . '/includes/topup-warning.php'; ?>

        <div class="store-balance-chip tilt">
            <div><i class="fas fa-wallet" style="color:var(--neon-amber)"></i> <span class="mono-num gold-text" id="balAmount" style="font-weight:800;font-size:16px">NRP —</span></div>
            <div style="display:flex;gap:14px">
                <a href="/store.php#redeem" style="font-size:11px;font-weight:700;color:var(--neon-green);text-decoration:none"><i class="fas fa-gift"></i> Redeem Code</a>
                <a href="/admin/owner.php" style="font-size:11px;font-weight:700;color:var(--neon-purple);text-decoration:none"><i class="fas fa-circle-plus"></i> Add Balance</a>
            </div>
        </div>

        <a href="https://vt.tiktok.com/ZSbLMH1e3/" target="_blank" class="how-to-buy-banner tilt">
            <div class="htb-icon"><i class="fas fa-circle-play"></i></div>
            <div class="htb-text">
                <div class="htb-title">How to Buy <span class="htb-sep">·</span> किनमेल कसरी गर्ने</div>
                <div class="htb-sub">Watch the quick video guide on TikTok / भिडियो गाइड हेर्नुहोस्</div>
            </div>
            <i class="fas fa-arrow-up-right-from-square htb-arrow"></i>
        </a>

        <div class="prompt-header"><i class="fas fa-gamepad"></i> PRODUCTS CATALOG</div>
        <div style="position:relative;margin-bottom:10px">
            <i class="fas fa-magnifying-glass" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted)"></i>
            <input type="text" id="catalogSearch" placeholder="Search product cheats..." style="padding-left:38px">
        </div>

        <div id="catFilters" style="display:flex;gap:8px;margin-bottom:14px;overflow-x:auto;padding-bottom:4px">
            <button class="cat-filter active" data-tag="ALL"><i class="fas fa-layer-group"></i> ALL</button>
            <button class="cat-filter" data-tag="ROOT"><i class="fas fa-mobile-screen-button"></i> ROOT</button>
            <button class="cat-filter" data-tag="NONROOT"><i class="fas fa-tablet-screen-button"></i> NONROOT</button>
            <button class="cat-filter" data-tag="PC"><i class="fas fa-desktop"></i> PC</button>
            <button class="cat-filter" data-tag="IOS"><i class="fab fa-apple"></i> IOS</button>
        </div>

        <div id="catalogList" class="product-grid">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="skeleton-card">
                <div class="skeleton-thumb"></div>
                <div class="skeleton-body">
                    <div class="skeleton-line w-80"></div>
                    <div class="skeleton-line w-60"></div>
                    <div class="skeleton-line w-40"></div>
                    <div class="skeleton-btn"></div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

    </div>
</div>

<style>
/* close (X) button: small, clean red-tinted circle */
#planModal .plan-close, #checkoutModal .plan-close {
    position:absolute !important; right:12px !important; width:32px !important; height:32px !important; padding:0 !important; margin:0 !important;
    display:flex !important; align-items:center !important; justify-content:center !important; border-radius:50% !important; cursor:pointer;
    background:rgba(239,68,68,.16) !important; border:1px solid rgba(239,68,68,.55) !important; color:#ff6b6b !important; box-shadow:none !important; z-index:10 !important;
    transition:background .15s, color .15s, transform .15s;
}
#planModal .plan-close { top:50% !important; transform:translateY(-50%) !important; }
#planModal .pm2-head { position:relative; }
#checkoutModal .plan-close { top:12px !important; }
#planModal .plan-close i, #checkoutModal .plan-close i { color:inherit !important; font-size:15px !important; line-height:1 !important; }
#planModal .plan-close:hover, #checkoutModal .plan-close:hover { background:#ef4444 !important; color:#fff !important; border-color:#ef4444 !important; }
#planModal .plan-close:active { transform:translateY(-50%) scale(.92) !important; }
#checkoutModal .plan-close:active { transform:scale(.92) !important; }
[data-theme="light"] #planModal .plan-close, [data-theme="light"] #checkoutModal .plan-close { color:#dc2626 !important; }
</style>
<div id="planModal" class="modal-overlay hidden">
    <div class="panel pm2" role="dialog" aria-modal="true" aria-labelledby="pm2Title">
        <div class="pm2-head"><i class="fas fa-cart-shopping"></i><span id="pm2Title">SELECT PLAN</span>
            <button type="button" class="plan-close" data-no-busy aria-label="Close" onclick="closeModal('planModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="pm2-body">
            <div class="pm2-product">
                <div class="pm2-thumb"><i id="planThumbIcon" class="fas fa-gamepad"></i></div>
                <div>
                    <div class="pm2-label">Product</div>
                    <div id="planProductName" class="pm2-name"></div>
                    <div id="planProductSub" class="pm2-sub"></div>
                </div>
            </div>
            <div class="pm2-sect"><h3>Choose Duration</h3><p>Select how long you want to use this product.</p></div>
            <div id="planDurationList" role="radiogroup" aria-label="Duration"></div>
        </div>
        <div class="pm2-foot">
            <div class="pm2-qtyrow"><span>Quantity</span>
                <div class="pm2-qty" data-no-busy>
                    <button type="button" id="planQtyMinus" aria-label="Decrease quantity" data-no-busy>&minus;</button>
                    <output id="planQty">1</output>
                    <button type="button" id="planQtyPlus" aria-label="Increase quantity" data-no-busy>+</button>
                </div>
            </div>
            <div class="pm2-buyrow">
                <div class="pm2-total"><span>Total</span><b id="planTotal">Rs 0.00</b>
                    <div class="pm2-secure"><i class="fas fa-shield-halved"></i> Secure &amp; Fast Purchase</div></div>
                <button type="button" class="pm2-buy" id="planBuyBtn" data-no-busy>Buy Now <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<div id="checkoutModal" class="modal-overlay hidden">
    <div class="panel confirm-panel pm2c" role="dialog" aria-modal="true" aria-labelledby="pm2cTitle">
        <button type="button" class="plan-close" data-no-busy aria-label="Close" onclick="closeModal('checkoutModal')"><i class="fas fa-xmark"></i></button>
        <div class="pm2c-icon"><i class="fas fa-cart-shopping"></i></div>
        <h2 class="pm2c-title confirm-title" id="pm2cTitle" style="font-size:26px;letter-spacing:0;text-transform:none;margin:0">Confirm Purchase?</h2>
        <p class="pm2c-sub">Please review your order details before proceeding.</p>
        <div id="checkoutSummary"></div>
        <div id="payFields" class="confirm-fields hidden">
            <div class="field"><label><i class="fas fa-user"></i> Your Name</label><input type="text" id="payName" placeholder="Full name"></div>
            <div class="field"><label><i class="fab fa-whatsapp"></i> WhatsApp Number</label><input type="text" id="payWA" placeholder="98xxxxxxxx"></div>
        </div>
        <button class="btn btn-solid btn-confirm-yes" id="confirmBuyBtn" style="position:relative">
            <span class="btn-text"><i class="fas fa-shield-halved"></i><span class="mid">YES, CONFIRM</span><i class="fas fa-arrow-right"></i></span>
            <span class="btn-spinner hidden"><span class="spinner"></span></span>
        </button>
        <button type="button" class="btn-confirm-cancel" data-no-busy onclick="closeModal('checkoutModal')"><i class="far fa-circle-xmark"></i> CANCEL</button>
    </div>
</div>

<div id="deliveryModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%;padding:28px 24px">
        <div class="prompt-header" style="justify-content:center;margin-bottom:20px">
            <i class="fas fa-shield-halved" style="color:var(--neon-amber)"></i> Fetching Access Key... <i class="fas fa-truck-fast" style="animation: deliveryTruckBounce 1.2s ease-in-out infinite; display:inline-block; margin-left:4px"></i>
        </div>

        <div class="delivery-steps" id="deliverySteps">
            <div class="delivery-step" data-step="request">
                <span class="delivery-step-icon"><i class="fas fa-circle-notch"></i></span>
                <span class="delivery-step-text">Check request</span>
            </div>
            <div class="delivery-step" data-step="product">
                <span class="delivery-step-icon"><i class="fas fa-circle-notch"></i></span>
                <span class="delivery-step-text">Check product</span>
            </div>
            <div class="delivery-step" data-step="balance">
                <span class="delivery-step-icon"><i class="fas fa-circle-notch"></i></span>
                <span class="delivery-step-text">Check balance</span>
            </div>
            <div class="delivery-step" data-step="connecting">
                <span class="delivery-step-icon"><i class="fas fa-circle-notch"></i></span>
                <span class="delivery-step-text">Connecting to server</span>
            </div>
            <div class="delivery-step" data-step="connected">
                <span class="delivery-step-icon"><i class="fas fa-circle-notch"></i></span>
                <span class="delivery-step-text">Server connected...</span>
            </div>
        </div>

        <div class="delivery-pct-row">
            <div class="delivery-pct-track"><div class="delivery-pct-fill" id="deliveryPctFill"></div></div>
            <span class="mono-num" id="deliveryPct">0%</span>
        </div>
    </div>
</div>

<div id="keyModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-key" style="color:var(--neon-green)"></i> ACCESS KEY DELIVERED</div>
        <div id="keyProductName" style="font-size:13px;margin-bottom:8px"></div>
        <div id="keyValueList"></div>
        <button class="btn btn-solid" onclick="window.__closeKeyAndRate()" style="margin-top:4px"><i class="fas fa-check"></i> Done</button>
    </div>
</div>

<div id="feedbackPromptModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%;text-align:center">
        <div class="prompt-header" style="justify-content:center"><i class="fas fa-star" style="color:var(--neon-amber)"></i> RATE YOUR PURCHASE</div>
        <div id="feedbackProductName" style="font-size:13px;margin-bottom:14px;color:var(--text-secondary)"></div>
        <div class="feedback-star-picker" id="feedbackStarPicker">
            <i class="far fa-star" data-star="1"></i><i class="far fa-star" data-star="2"></i><i class="far fa-star" data-star="3"></i><i class="far fa-star" data-star="4"></i><i class="far fa-star" data-star="5"></i>
        </div>
        <textarea id="feedbackComment" placeholder="Optional — tell others what you think..." style="margin-top:12px;min-height:70px;width:100%"></textarea>
        <div style="display:flex;gap:8px;margin-top:14px">
            <button class="btn btn-ghost" onclick="closeModal('feedbackPromptModal')" style="flex:1">Skip</button>
            <button class="btn btn-solid" id="feedbackSubmitBtn" style="flex:1"><i class="fas fa-paper-plane"></i> Submit</button>
        </div>
    </div>
</div>

<div id="waDetailsModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fab fa-whatsapp" style="color:#25D366"></i> <span id="waDetailsTitle">Product Details</span></div>
        <div id="waDetailsPrice" style="font-family:var(--font-heading);font-weight:800;font-size:18px;margin-bottom:10px"></div>
        <div id="waDetailsBody" style="font-size:13px;color:var(--text-secondary);line-height:1.6;margin-bottom:16px;white-space:pre-wrap"></div>
        <a id="waDetailsChatBtn" href="#" target="_blank" class="btn btn-solid" style="display:block;text-align:center;margin-bottom:8px"><i class="fab fa-whatsapp"></i> Chat to Buy</a>
        <button class="btn btn-ghost" onclick="closeModal('waDetailsModal')"><i class="fas fa-xmark"></i> Close</button>
    </div>
</div>

<style>
.ss-features { list-style: none; margin: 8px 0 10px; padding: 0; display: grid; gap: 4px; }
.ss-features li { font-size: 12px; display: flex; gap: 6px; align-items: flex-start; color: var(--text-secondary); }
.ss-features li.no { opacity: .65; }
.product-tag-shop { background: rgba(212,175,55,.18); color: var(--neon-amber, #d4af37); }
</style>
<div id="shopSrcModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-store"></i> <span id="ssTitle">Shop Project</span></div>
        <div id="ssPrice" style="font-family:var(--font-heading);font-weight:800;font-size:20px;margin-bottom:8px"></div>
        <p style="font-size:12.5px;color:var(--text-secondary);line-height:1.6;margin-bottom:14px">
            The price is deducted from your store balance now. After that you can download the source code and fill your shop details.
        </p>
        <button class="btn btn-solid" id="ssConfirmBtn" style="margin-bottom:8px"><i class="fas fa-check"></i> Confirm &amp; Pay</button>
        <button class="btn btn-ghost" onclick="closeModal('shopSrcModal')"><i class="fas fa-xmark"></i> Cancel</button>
    </div>
</div>

<div id="redeemModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-gift"></i> REDEEM CODE</div>
        <div class="field">
            <label><i class="fas fa-ticket"></i> Enter your code</label>
            <input type="text" id="redeemCodeInput" placeholder="SRT_XXXXX_YYYYYCHEATS" style="text-transform:uppercase;font-family:var(--font-mono)">
        </div>
        <button class="btn btn-solid" id="redeemSubmitBtn" style="margin-bottom:8px;position:relative">
            <span class="btn-text"><i class="fas fa-check"></i> Redeem</span>
            <span class="btn-spinner hidden"><span class="spinner"></span></span>
        </button>
        <button class="btn btn-ghost" onclick="closeModal('redeemModal')"><i class="fas fa-xmark"></i> Cancel</button>
    </div>
</div>

<div id="topupModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-qrcode"></i> TOPUP BALANCE</div>

        <div class="topup-steps" id="topupSteps">
            <span class="topup-step active" data-step="1">1</span>
            <span class="topup-step-line"></span>
            <span class="topup-step" data-step="2">2</span>
            <span class="topup-step-line"></span>
            <span class="topup-step" data-step="3">3</span>
        </div>

        <div class="topup-step-panel" id="topupStep1">
            <div class="field"><label><i class="fas fa-id-card"></i> Enter eSewa Number</label><input type="text" id="topupEsewa" placeholder="98xxxxxxxx" inputmode="numeric"></div>
            <button class="btn btn-solid" id="topupNext1" style="margin-bottom:8px"><i class="fas fa-arrow-right"></i> Next</button>
            <button class="btn btn-ghost" onclick="closeModal('topupModal')"><i class="fas fa-xmark"></i> Cancel</button>
        </div>

        <div class="topup-step-panel hidden" id="topupStep2">
            <div class="dim" style="font-size:12px;margin-bottom:12px" id="topupHint"><i class="fas fa-info-circle"></i> Pay via eSewa, then submit your transaction ID.</div>

            <div style="font-size:11px;font-weight:700;letter-spacing:0.5px;color:var(--text-secondary);margin-bottom:8px"><i class="fas fa-rupee-sign"></i> BALANCE (RS)</div>
            <div class="amount-chip-row" id="amountChipRow">
                <button type="button" class="amount-chip active" data-amount="100">Rs 100</button>
                <button type="button" class="amount-chip" data-amount="500">Rs 500</button>
                <button type="button" class="amount-chip" data-amount="1000">Rs 1000</button>
                <button type="button" class="amount-chip" data-amount="2000">Rs 2000</button>
                <button type="button" class="amount-chip" data-amount="5000">Rs 5000</button>
                <button type="button" class="amount-chip" id="amountChipCustom" data-amount="custom"><i class="fas fa-pen"></i> Custom</button>
            </div>
            <div class="field" id="customAmountField" style="display:none">
                <label id="customAmountLabel"><i class="fas fa-pen"></i> Enter Custom Amount</label>
                <input type="number" id="topupAmount" value="1000" min="50">
            </div>
            <button class="btn btn-solid" id="topupNext2" style="margin-bottom:8px"><i class="fas fa-arrow-right"></i> Next</button>
            <button class="btn btn-ghost" id="topupBack2"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <div class="topup-step-panel hidden" id="topupStep3">
            <div style="text-align:center;margin-bottom:12px">
                <img src="https://i.postimg.cc/zXm07q9C/Screenshot-20260425-142906.jpg" alt="eSewa QR" style="max-width:180px;border-radius:12px;border:1px solid var(--glass-border)">
            </div>
            <div class="topup-warning">
                <i class="fas fa-triangle-exclamation"></i>
                Pay from eSewa and enter the right amount. Wrong amount = order cancelled — no refunds.
            </div>
            <div class="field"><label><i class="fas fa-hashtag"></i> Transaction Code</label><input type="text" id="topupTx" placeholder="Enter transaction code" autocomplete="off" autocapitalize="characters" spellcheck="false"></div>
            <button class="btn btn-solid" id="submitTopup" style="margin-bottom:8px;position:relative">
                <span class="btn-text"><i class="fas fa-paper-plane"></i> Submit Topup</span>
                <span class="btn-spinner hidden"><span class="spinner"></span></span>
            </button>
            <button class="btn btn-ghost" id="topupBack3"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
    </div>
</div>

<div id="helpModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-headset"></i> WELCOME TO SRT SUPPORT</div>
        <div class="support-ticket">
            <div class="ticket-row"><span class="k">Token</span><span class="eq">=</span><span class="v" id="supToken">—</span></div>
            <div class="ticket-row"><span class="k">UID</span><span class="eq">=</span><span class="v" id="supUid">—</span></div>
            <div class="ticket-row"><span class="k">Name</span><span class="eq">=</span><span class="v" id="supName">—</span></div>
            <div class="ticket-row"><span class="k">WhatsApp</span><span class="eq">=</span><span class="v" id="supWa">—</span></div>
            <div class="ticket-row"><span class="k">Email</span><span class="eq">=</span><span class="v" id="supEmail">—</span></div>
        </div>
        <div class="field" style="margin-top:14px"><label><i class="fas fa-bug"></i> Bug Type</label><select id="problemCategory"><option value="">Choose bug type</option><option value="Balance">Balance</option><option value="Unknown product">Unknown product</option><option value="Others">Others</option></select></div>
        <div class="field"><label><i class="fas fa-comment-dots"></i> Describe your issue</label><textarea id="problemText" rows="3" placeholder="Describe your issue..."></textarea></div>
        <button class="btn btn-solid" id="submitReport" style="margin-bottom:8px;position:relative">
            <span class="btn-text"><i class="fas fa-paper-plane"></i> Send Report</span>
            <span class="btn-spinner hidden"><span class="spinner"></span></span>
        </button>
        <button class="btn btn-ghost" onclick="closeModal('helpModal')"><i class="fas fa-xmark"></i> Close</button>
    </div>
</div>

<div id="successInfoModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%;text-align:center">
        <div class="prompt-header"><i class="fas fa-circle-check" style="color:var(--neon-green)"></i> REQUEST SENT</div>
        <div id="successInfoText" style="padding:14px 4px 18px;color:var(--text-primary);font-size:13px;line-height:1.7"></div>
        <button class="btn btn-solid" onclick="closeModal('successInfoModal')"><i class="fas fa-check"></i> OK</button>
    </div>
</div>

<div id="errorModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%">
        <div class="prompt-header"><i class="fas fa-exclamation-triangle" style="color:var(--neon-red)"></i> SYSTEM ERROR</div>
        <div id="errorMsg" style="background:rgba(255,0,0,0.05);border:1px solid var(--neon-red);border-radius:var(--radius-md);padding:12px;color:var(--neon-red);font-size:12px;margin-bottom:12px"></div>
        <button class="btn btn-solid" id="retryPurchaseBtn" style="margin-bottom:8px"><i class="fas fa-rotate-right"></i> Try Again</button>
        <button class="btn btn-ghost" id="dismissErrorBtn"><i class="fas fa-times"></i> Dismiss</button>
    </div>
</div>

<div id="topupPromptModal" class="modal-overlay hidden">
    <div class="panel" style="max-width:400px;width:100%;text-align:center">
        <div class="prompt-header" style="justify-content:center"><i class="fas fa-wallet" style="color:var(--neon-amber)"></i> INSUFFICIENT BALANCE</div>
        <div style="font-size:13px;line-height:1.6;color:var(--text-secondary);margin:14px 0 18px">
            You have <b style="color:var(--text-primary)">0 balance</b> and can't purchase any product — please top up first then try again.
        </div>
        <button type="button" id="topupPromptTgBtn" class="btn btn-solid" style="margin-bottom:8px" data-no-morph>
            <i class="fab fa-telegram"></i> Deposit via Telegram
        </button>
        <a href="/admin/owner.php" class="btn btn-ghost" style="margin-bottom:8px;text-decoration:none"><i class="fas fa-qrcode"></i> Pay with QR</a>
        <button class="btn btn-ghost" onclick="closeModal('topupPromptModal')"><i class="fas fa-times"></i> Not Now</button>
    </div>
</div>

<div id="checkoutBanModal" class="modal-overlay hidden" style="z-index:10000">
    <div class="panel" style="max-width:400px;width:100%;text-align:center">
        <div class="prompt-header" style="justify-content:center"><i class="fas fa-hourglass-half" style="color:var(--neon-red)"></i> CHECKOUT TEMPORARILY LOCKED</div>
        <div style="font-size:13px;line-height:1.6;color:var(--text-secondary);margin:14px 0 18px">
            Too many purchase attempts without enough balance. Checkout is locked for 1 hour.
        </div>
        <div class="mono-num" id="checkoutBanCountdown" style="font-size:32px;font-weight:800;color:var(--neon-red);margin-bottom:6px">60:00</div>
        <div style="font-size:11px;color:var(--text-muted)">This will close automatically when the timer ends.</div>
    </div>
</div>

<style>
/* src by SRT X CHEATS. Copy right SRT X CHEATS */

.store-balance-chip {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px; margin-bottom: 16px;
    background: var(--glass-panel);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}

.how-to-buy-banner {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    display: flex; align-items: center; gap: 12px;
    padding: 12px 14px; margin-bottom: 16px;
    background: linear-gradient(135deg, rgba(34,211,238,0.10), rgba(168,85,247,0.10));
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    text-decoration: none; color: inherit;
    transition: border-color 0.2s ease, transform 0.2s ease;
}
.how-to-buy-banner:hover { border-color: var(--neon-blue); }
.htb-icon {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    flex: 0 0 auto; width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(34,211,238,0.15); color: var(--neon-blue); font-size: 18px;
}
.htb-text { flex: 1; min-width: 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.htb-title { font-size: 13px; font-weight: 700; color: var(--text-primary); }
.htb-sep { color: var(--text-muted); margin: 0 2px; }
.htb-sub { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }
.htb-arrow { flex: 0 0 auto; color: var(--text-muted); font-size: 13px; }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.product-card.product-maintenance {
    position: relative;
    opacity: 0.96;
}
.product-card.product-maintenance .product-thumb {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    position: relative;
    overflow: hidden;
}
.product-card.product-maintenance .product-thumb::after {
    content: "";
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    position: absolute;
    inset: 0;
    background: rgba(8, 10, 18, 0.48);
    pointer-events: none;
    z-index: 1;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.maintenance-badge {
    position: absolute;
    top: 50%;
    left: 50%;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    transform: translate(-50%, -50%);
    z-index: 4;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    gap: 8px;
    min-width: 150px;
    padding: 10px 16px;
    border-radius: 10px;
    background: rgba(220, 38, 38, 0.94);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    border: 1px solid rgba(255, 255, 255, 0.28);
    color: #fff;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 1px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    text-align: center;
    box-shadow: 0 0 0 2px rgba(220,38,38,.18), 0 0 28px rgba(220,38,38,.55);
    text-shadow: 0 1px 2px rgba(0,0,0,.35);
    pointer-events: none;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.maintenance-badge i {
    font-size: 12px;
}
.maintenance-badge.stock-badge {
    background: rgba(212,175,55,.16);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    border-color: rgba(212,175,55,.4);
    color: var(--neon-amber, #d4af37);
}
.plan-duration-disabled {
    opacity: .45;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    cursor: not-allowed !important;
    text-decoration: line-through;
    pointer-events: none;
}
.feedback-star-picker {
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    display: flex; justify-content: center; gap: 10px; font-size: 30px; padding: 6px 0;
}
.feedback-star-picker i {
    color: rgba(255,255,255,.25); cursor: pointer; transition: color .15s ease, transform .1s ease;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.feedback-star-picker i:hover, .feedback-star-picker i.active {
    color: var(--neon-amber, #d4af37);
}
.feedback-star-picker i:active { transform: scale(1.15); }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hud-card { position: relative; }
.hud-corner {
    position: absolute; width: 13px; height: 13px; pointer-events: none;
    opacity: .4; transition: opacity .25s ease, width .25s ease, height .25s ease;
    z-index: 3;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.hud-corner.tl { top: 7px; left: 7px; border-top: 2px solid var(--neon-blue); border-left: 2px solid var(--neon-blue); border-radius: 4px 0 0 0; }
.hud-corner.tr { top: 7px; right: 7px; border-top: 2px solid var(--neon-purple); border-right: 2px solid var(--neon-purple); border-radius: 0 4px 0 0; }
.hud-corner.bl { bottom: 7px; left: 7px; border-bottom: 2px solid var(--neon-purple); border-left: 2px solid var(--neon-purple); border-radius: 0 0 0 4px; }
.hud-corner.br { bottom: 7px; right: 7px; border-bottom: 2px solid var(--neon-blue); border-right: 2px solid var(--neon-blue); border-radius: 0 0 4px 0; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.hud-card:hover .hud-corner, .hud-card:focus-within .hud-corner { opacity: 1; width: 19px; height: 19px; }
.hud-card.product-maintenance .hud-corner { display: none; }

.dur-chip-row {
    display: flex; gap: 6px; overflow-x: auto; padding: 1px 0 5px; margin-top: 6px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    scrollbar-width: none;
}
.dur-chip-row::-webkit-scrollbar { display: none; }
.dur-chip {
    flex: 0 0 auto; padding: 5px 11px; border-radius: 8px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background: rgba(255,255,255,.04); border: 1px solid var(--glass-border);
    color: var(--text-secondary); font-size: 10.5px; font-weight: 700;
    letter-spacing: .3px; cursor: pointer; transition: background .18s ease, border-color .18s ease, box-shadow .18s ease, color .18s ease;
    font-family: var(--font-mono, monospace); white-space: nowrap;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.dur-chip.active {
    background: linear-gradient(135deg, rgba(34,211,238,.2), rgba(168,85,247,.2));
    border-color: var(--neon-blue); color: #fff;
    box-shadow: 0 0 10px rgba(34,211,238,.35);
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.dur-chip:disabled { opacity: .35; cursor: not-allowed; text-decoration: line-through; }

.product-price-live {
    font-family: var(--font-heading); font-weight: 800; font-size: 16px;
    color: #fff; margin: 5px 0 8px;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
@keyframes pricePulse { 0% { transform: scale(1.1); color: var(--neon-blue); } 100% { transform: scale(1); color: #fff; } }
.product-price-live.price-pulse { animation: pricePulse .3s ease; }
.maintenance-note {
    margin-top: 7px;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    color: #facc15;
    font-size: 10px;
    font-weight: 700;
}
.btn-buy.btn-maintenance,
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.btn-buy:disabled {
    cursor: not-allowed !important;
    opacity: .55;
    filter: grayscale(.25);
    pointer-events: none;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.btn-download.btn-download-disabled,
.btn-download:disabled {
    cursor: not-allowed !important;
    opacity: .48;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    filter: grayscale(.35);
    background: rgba(120, 120, 130, 0.18) !important;
    border: 1px solid rgba(160, 160, 170, 0.28) !important;
    color: var(--text-muted) !important;
    pointer-events: none;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.apk-update-row {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 14px; font-size: 12px; font-weight: 700;
    border-top: 1px solid var(--glass-border);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    color: var(--neon-blue);
    text-decoration: none;
}
.apk-update-row:hover { background: rgba(0,240,255,0.05); }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes deliveryTruckBounce { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(3px); } }

.delivery-steps { display: flex; flex-direction: column; gap: 4px; margin-bottom: 18px; }
.delivery-step {
    display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: var(--radius-md);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    color: var(--text-muted); font-size: 13px; transition: color 0.25s ease, background 0.25s ease;
}
.delivery-step-icon { flex: 0 0 18px; display: flex; align-items: center; justify-content: center; font-size: 13px; }

.delivery-step-icon .icon-pending { color: var(--text-muted); opacity: 0.4; font-size: 8px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.delivery-step.active { color: var(--text-primary); background: rgba(212, 175, 55, 0.08); font-weight: 600; }
.delivery-step-icon .icon-active { color: var(--neon-amber); animation: deliverySpin 0.8s linear infinite; }
.delivery-step.done { color: var(--text-secondary); }
.delivery-step-icon .icon-done { color: var(--neon-green); }

/* src by SRT X CHEATS. Copy right SRT X CHEATS */
@keyframes deliverySpin { to { transform: rotate(360deg); } }

.delivery-pct-row { display: flex; align-items: center; gap: 10px; }
.delivery-pct-track { flex: 1; height: 6px; border-radius: 999px; background: var(--surface-tint-strong); overflow: hidden; }
.delivery-pct-fill { height: 100%; width: 0%; background: var(--neon-amber); border-radius: 999px; transition: width 0.4s cubic-bezier(0.4,0,0.2,1), background 0.3s ease; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.delivery-pct-fill.complete { background: var(--neon-green); }
.delivery-pct-row .mono-num { font-size: 13px; font-weight: 700; color: var(--text-primary); min-width: 36px; text-align: right; }

.key-row {
    display: flex; align-items: center; gap: 8px; background: var(--input-bg);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    border: 1px solid var(--neon-green); border-radius: var(--radius-md);
    padding: 12px 14px; margin-bottom: 10px;
}
.key-row-text { flex: 1; min-width: 0; word-break: break-all; color: var(--neon-green); font-weight: 700; font-family: var(--font-mono); font-size: 13px; }
.key-row-label { font-size: 10px; color: var(--text-muted); font-weight: 600; margin-bottom: 2px; display: block; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.key-copy-btn {
    flex: 0 0 auto; display: flex; align-items: center; gap: 5px; padding: 7px 11px;
    border-radius: var(--radius-sm, 6px); border: 1px solid var(--neon-green); background: transparent;
    color: var(--neon-green); font-size: 11px; font-weight: 700; cursor: pointer; transition: all 0.2s ease;
}
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.key-copy-btn:hover { background: rgba(0, 230, 118, 0.1); }
.key-copy-btn.copied { background: var(--neon-green); color: #0a0a0a; }

.modal-overlay {
    position: fixed; inset: 0; z-index: 999;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    background: rgba(4,3,12,0.75);
    backdrop-filter: blur(12px);
    display: flex; align-items: center; justify-content: center;
    padding: 16px;
    animation: fadeIn 0.25s ease;
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
}
.modal-overlay.hidden { display: none !important; }
@keyframes fadeIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }

.topup-steps { display: flex; align-items: center; justify-content: center; gap: 6px; margin-bottom: 18px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.topup-step {
    width: 26px; height: 26px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
    background: var(--surface-tint-strong); color: var(--text-muted);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    border: 1px solid var(--glass-border);
    transition: all 0.25s ease;
}
.topup-step.active { background: linear-gradient(135deg, var(--neon-purple), #6d28d9); color: #fff; border-color: transparent; box-shadow: 0 0 10px rgba(168,85,247,0.5); }
.topup-step.done { background: var(--neon-green); color: #fff; border-color: transparent; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.topup-step-line { width: 28px; height: 2px; background: var(--glass-border); }
.topup-step-panel.hidden { display: none; }
.topup-warning {
    display: flex; align-items: flex-start; gap: 8px;
    background: rgba(239,68,68,0.08); border: 1px solid var(--neon-red); border-radius: var(--radius-md);
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    padding: 10px 12px; font-size: 12px; line-height: 1.5; color: var(--neon-red); margin-bottom: 14px;
}
.topup-warning i { margin-top: 2px; }

.amount-chip-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
/* src by SRT X CHEATS. Copy right SRT X CHEATS */
.amount-chip {
    flex: 1 1 auto; min-width: 70px; padding: 10px 12px;
    border-radius: var(--radius-md); border: 1px solid var(--glass-border);
    background: var(--surface-tint); color: var(--text-secondary);
    font-size: 13px; font-weight: 700; font-family: inherit;
    /* src by SRT X CHEATS. Copy right SRT X CHEATS */
    cursor: pointer; text-align: center; transition: all 0.2s ease;
}
.amount-chip:hover { border-color: var(--neon-purple); color: var(--text-primary); }
.amount-chip.active { background: linear-gradient(135deg, var(--neon-purple), #6d28d9); border-color: transparent; color: #fff; box-shadow: 0 0 10px rgba(168,85,247,0.4); }
#amountChipCustom { flex-basis: 100%; }
</style>

<script type="module">
// src by SRT X CHEATS. Copy right SRT X CHEATS
import {
    requireAuth, backendFetch, toast, esc, getAuthToken, enableTilt,
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    getData, refreshData, cachePeek, cacheInvalidate, applyBalanceChange, recordPurchase,
} from '/assets/js/app.js?v=20261025-4';

window.openModal = (id) => document.getElementById(id)?.classList.remove('hidden');
window.closeModal = (id) => document.getElementById(id)?.classList.add('hidden');
// src by SRT X CHEATS. Copy right SRT X CHEATS
let successInfoTimer = null;
function showSuccessInfo(message, autoCloseMs = 300000) {
    const modal = document.getElementById('successInfoModal');
    const text = document.getElementById('successInfoText');
    if (!modal || !text) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    text.innerHTML = message;
    modal.classList.remove('hidden');
    clearTimeout(successInfoTimer);
    successInfoTimer = setTimeout(() => modal.classList.add('hidden'), autoCloseMs);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

let supportToken = null;
function getSupportToken() {
    if (!supportToken) supportToken = 'SRT-' + Math.random().toString(36).slice(2, 8).toUpperCase();
    return supportToken;
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function openHelpModal() {
    document.getElementById('supToken').textContent = getSupportToken();
    document.getElementById('supUid').textContent = currentUid || '—';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('supName').textContent = userState.profileName || '—';
    document.getElementById('supWa').textContent = userState.profilePhone || '—';
    document.getElementById('supEmail').textContent = userState.email || '—';
    openModal('helpModal');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function routeHash() {
    const hash = location.hash.replace('#', '');
    if (!hash) return;
    if (hash === 'topup') { window.location.href = '/admin/owner.php'; return; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    else if (hash === 'redeem') openModal('redeemModal');
    else if (hash === 'support') { window.location.href = '/support.php'; return; }
    else if (hash === 'profile' || hash === 'password') { window.location.href = '/profile.php'; return; }
    history.replaceState(null, '', location.pathname);
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
window.addEventListener('hashchange', routeHash);

function setLoading(btn, loading) {
    if (!btn) return;
    const text = btn.querySelector('.btn-text');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const spinner = btn.querySelector('.btn-spinner');
    btn.classList.toggle('loading', loading);
    btn.disabled = loading;
    if (text) text.classList.toggle('hidden', loading);
    if (spinner) spinner.classList.toggle('hidden', !loading);
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

document.getElementById('redeemSubmitBtn').onclick = async () => {
    const btn = document.getElementById('redeemSubmitBtn');
    const input = document.getElementById('redeemCodeInput');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const code = input.value.trim();
    if (!code) return toast('Enter a code', 'error');
    setLoading(btn, true);
    try {
        const d = await backendFetch('/api/user/redeem', { method: 'POST', body: JSON.stringify({ code }) });
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        toast(`Rs ${d.amountCredited} credited!`, 'success');
        document.getElementById('balAmount').textContent = d.newBalance;
        applyBalanceChange(d.newBalance);
        input.value = '';
        closeModal('redeemModal');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        setLoading(btn, false);
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

let userState = {};
let catalog = {};
let pendingCheckout = null;
// src by SRT X CHEATS. Copy right SRT X CHEATS
let currentUid = '';

function paintFromCache() {
    const p = cachePeek('profile');
    if (p) applyBalance(p.value);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const c = cachePeek('catalog');
    if (c?.value?.catalog) { catalog = c.value.catalog; renderCatalog(); }
}

window.addEventListener('srtx:data', (e) => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const { key, value } = e.detail || {};
    if (!value) return;
    if (key === 'profile') {
        applyBalanceLight(value);
    } else if (key === 'catalog' && value.catalog) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        catalog = value.catalog; renderCatalog();
    }
});


requireAuth(async (user) => {
    currentUid = user.uid;
    await Promise.all([loadBalance(), loadCatalog()]);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    routeHash();
    enableTilt();
});

async function loadBalance() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const d = await getData('profile', { onStale: applyBalance });
        applyBalance(d);
    } catch (e) {
        if (!cachePeek('profile')) toast(e.message, 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
}

function applyBalanceLight(d) {
    userState = d;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('balAmount').textContent = d.balance;
    const drawerBal = document.getElementById('drawerBalance');
    if (drawerBal) drawerBal.textContent = 'NRP ' + d.balance;
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function applyBalance(d) {
        userState = d;
        document.getElementById('balAmount').textContent = d.balance;
        const drawerBal = document.getElementById('drawerBalance');
        if (drawerBal) drawerBal.textContent = 'NRP ' + d.balance;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const drawerName = document.getElementById('drawerUserName');
        if (drawerName) drawerName.textContent = d.profileName || 'My Account';
        document.getElementById('payName').value = d.profileName || '';
        document.getElementById('payWA').value = d.profilePhone || '';
        setupTopupLock();
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function setupTopupLock() {
    const amountInput = document.getElementById('topupAmount');
    const hint = document.getElementById('topupHint');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const chipRow = document.getElementById('amountChipRow');
    chipRow.style.display = 'flex';
    amountInput.readOnly = false;
    amountInput.style.opacity = '1';
    hint.textContent = 'Pay via eSewa, then submit your transaction ID. Admin verifies and credits shortly.';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    selectAmountChip('100');
}

function selectAmountChip(amount) {
    const amountInput = document.getElementById('topupAmount');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const customField = document.getElementById('customAmountField');
    const customLabel = document.getElementById('customAmountLabel');
    document.querySelectorAll('.amount-chip').forEach(c => c.classList.toggle('active', c.dataset.amount === amount));
    if (amount === 'custom') {
        customLabel.innerHTML = '<i class="fas fa-pen"></i> Enter Custom Amount';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        customField.style.display = 'block';
        amountInput.readOnly = false;
        amountInput.style.opacity = '1';
        amountInput.value = '';
        amountInput.focus();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } else {
        customField.style.display = 'none';
        amountInput.value = amount;
    }
}
// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('amountChipRow').addEventListener('click', (e) => {
    const chip = e.target.closest('.amount-chip');
    if (chip) selectAmountChip(chip.dataset.amount);
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
async function loadCatalog() {
    try {
        const d = await getData('catalog', { onStale: (old) => { if (old?.catalog) { catalog = old.catalog; renderCatalog(); } } });
        catalog = d.catalog || {};
        renderCatalog();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    } catch (e) {
        if (Object.keys(catalog).length) return;
        document.getElementById('catalogList').innerHTML = `<div class="dim" style="text-align:center;padding:30px;grid-column:1/-1;color:var(--neon-red)"><i class="fas fa-exclamation-triangle"></i> Failed to load catalog<br><small>${esc(e.message)}</small></div>`;
    }
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

let searchQuery = new URLSearchParams(location.search).get('q') || '';
let activeTag = 'ALL';
let lastGroups = [];
let selectedDurationIdx = {};
// src by SRT X CHEATS. Copy right SRT X CHEATS

function tagsOf(row, items) {
    const fromData = (items || []).flatMap(it => Array.isArray(it.tags) ? it.tags : []);
    const unique = [...new Set(fromData)];
    if (unique.length) return unique;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const guess = /root/i.test(row) && !/non ?root/i.test(row) ? 'ROOT'
        : /ios/i.test(row) ? 'IOS'
        : /pc/i.test(row) ? 'PC'
        : 'NONROOT';
    return [guess];
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function tagBadgesHtml(tags) {
    return tags.map(t => `<span class="product-tag product-tag-${esc(t.toLowerCase())}">${esc(t)}</span>`).join('');
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function isMaintenanceProduct(p) {
    if (!p || typeof p !== 'object') return false;
    if (p.maintenance === true || p.maintenance === 1 || String(p.maintenance).toLowerCase() === 'true') return true;
    const values = [p.status, p.state, p.availability, p.stockStatus, p.productStatus];
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    return values.some(v => {
        const x = String(v ?? '').trim().toLowerCase();
        return x === 'maintenance' || x === 'maintain' || x.includes('maintenance');
    });
}
// src by SRT X CHEATS. Copy right SRT X CHEATS

function isOutOfStockProduct(p) {
    return !!p && (p.outOfStock === true || p.outOfStock === 1 || String(p.outOfStock).toLowerCase() === 'true');
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
function outOfStockLabel(p) {
    return String(p?.outOfStockMessage || '').trim() || 'Out of stock — check back soon.';
}

function maintenanceLabel(p) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const raw = String(p?.maintenanceMessage || p?.statusMessage || p?.maintenanceReason || '').trim();
    return raw || 'This product is currently under maintenance.';
}

function starsHtml(rating, reviewCount) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const r = Number(rating);
    if (!r) return '<span class="rating-num dim">No reviews yet</span>';
    const full = Math.floor(r);
    const half = r - full >= 0.5;
    let html = '';
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    for (let i = 0; i < 5; i++) {
        if (i < full) html += '<i class="fas fa-star"></i>';
        else if (i === full && half) html += '<i class="fas fa-star-half-stroke"></i>';
        else html += '<i class="far fa-star"></i>';
    }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const count = Number(reviewCount) || 0;
    return `<span class="stars">${html}</span><span class="rating-num">${r.toFixed(1)}${count ? ` (${count})` : ''}</span>`;
}

function renderCatalog() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const groups = {};
    for (const [sku, p] of Object.entries(catalog)) {
        if (!groups[p.row]) groups[p.row] = [];
        groups[p.row].push({ sku, ...p });
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    const q = searchQuery.trim().toLowerCase();
    const filteredEntries = Object.entries(groups).filter(([row, items]) => {
        const isShop = items[0].type === 'shopsrc';
        if (!isShop && activeTag !== 'ALL' && !tagsOf(row, items).includes(activeTag)) return false;
        if (!q) return true;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        return row.toLowerCase().includes(q) || items.some(it => it.name.toLowerCase().includes(q));
    });

    const container = document.getElementById('catalogList');
    if (!filteredEntries.length) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        container.innerHTML = '<div class="dim" style="text-align:center;padding:30px;grid-column:1/-1"><i class="fas fa-box-open"></i> No products match.</div>';
        return;
    }

    // shop-project products are pinned to the very top of the store
    filteredEntries.sort((a, b) => Number(b[1][0].type === 'shopsrc') - Number(a[1][0].type === 'shopsrc'));
    lastGroups = filteredEntries.map(([row, items]) => ({ row, items }));
// src by SRT X CHEATS. Copy right SRT X CHEATS

    container.innerHTML = lastGroups.map(({ row, items }, gi) => {
        if (items[0].type === 'shopsrc') {
            const p = items[0];
            const feats = (p.features || []).map(f => `<li class="${f.ok ? '' : 'no'}"><span>${f.ok ? '✅' : '❌'}</span><span>${esc(f.text)}</span></li>`).join('');
            const locked = isMaintenanceProduct(p) || isOutOfStockProduct(p);
            return `
            <div class="product-card tilt hud-card${locked ? ' product-maintenance' : ''}" data-gi="${gi}">
                <div class="hud-corner tl"></div><div class="hud-corner tr"></div>
                <div class="hud-corner bl"></div><div class="hud-corner br"></div>
                <div class="product-thumb">
                    <img src="${esc(p.image || '')}" alt="${esc(row)}" loading="lazy" decoding="async">
                    <div class="product-tag-row"><span class="product-tag product-tag-shop">SOURCE CODE</span></div>
                </div>
                <div class="product-body">
                    <div class="product-title">${esc(row)}</div>
                    <div class="product-rating">${starsHtml(p.rating, p.reviewCount)}</div>
                    <ul class="ss-features">${feats}</ul>
                    <div class="product-price-live">Rs ${p.price}</div>
                    <div class="product-actions">
                        <button class="btn-buy" type="button" ${locked ? 'disabled' : ''} onclick="window.__buyShopSrc(${gi})"><i class="fas fa-cart-shopping"></i> ${locked ? (isMaintenanceProduct(p) ? 'Maintenance' : 'Sold Out') : 'Buy'}</button>
                    </div>
                </div>
            </div>`;
        }

        if (items[0].type === 'whatsapp') {
            const p = items[0];
            const waText = encodeURIComponent((p.whatsappMessage || `Hi! I'm interested in ${row}`));
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const waLink = `https://wa.me/${esc(p.whatsappNumber)}?text=${waText}`;
            return `
            <div class="product-card tilt hud-card" data-gi="${gi}">
                <div class="hud-corner tl"></div><div class="hud-corner tr"></div>
                <div class="hud-corner bl"></div><div class="hud-corner br"></div>
                <div class="product-thumb">
                    <img src="${p.image || ''}" alt="${esc(row)}" loading="lazy" decoding="async">
                    <div class="product-tag-row"><span class="product-tag product-tag-contact">CONTACT</span></div>
                </div>
                <div class="product-body">
                    <div class="product-title">${esc(row)}</div>
                    <div class="product-rating">${starsHtml(p.rating, p.reviewCount)}</div>
                    <div class="product-price-live">Rs ${p.price}</div>
                    <div class="product-actions">
                        <button class="btn-buy" type="button" onclick="window.__viewWaDetails(${gi})"><i class="fas fa-circle-info"></i> View Details</button>
                        <a href="${waLink}" target="_blank" class="btn-download" onclick="event.stopPropagation()">
                            <i class="fab fa-whatsapp"></i> Chat to Buy
                        </a>
                    </div>
                </div>
            </div>`;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        }

        const maintenance = items.some(isMaintenanceProduct);
        const maintenanceText = maintenanceLabel(items.find(isMaintenanceProduct));
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const anyBuyable = items.some(it => !isMaintenanceProduct(it) && !isOutOfStockProduct(it));
        const soldOut = !maintenance && !anyBuyable;

        const defaultIdx = Math.max(0, items.findIndex(it => !isMaintenanceProduct(it) && !isOutOfStockProduct(it)));
        selectedDurationIdx[gi] = defaultIdx;
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const defaultItem = items[defaultIdx];
        const locked = maintenance || soldOut;

        const downloadLink = defaultItem?.downloadLink || items[0]?.downloadLink || '/allupdate.php';

        // src by SRT X CHEATS. Copy right SRT X CHEATS
        return `
        <div class="product-card tilt hud-card${locked ? ' product-maintenance' : ''}" data-gi="${gi}">
            <div class="hud-corner tl"></div><div class="hud-corner tr"></div>
            <div class="hud-corner bl"></div><div class="hud-corner br"></div>
            <div class="product-thumb">
                <img src="${items[0].image || ''}" alt="${esc(row)}" loading="lazy" decoding="async">
                <div class="product-tag-row">${tagBadgesHtml(tagsOf(row, items))}</div>
                ${maintenance ? '<span class="maintenance-badge"><i class="fas fa-screwdriver-wrench"></i> MAINTENANCE</span>' : soldOut ? '<span class="maintenance-badge stock-badge"><i class="fas fa-ban"></i> SOLD OUT</span>' : ''}
            </div>
            <div class="product-body">
                <div class="product-title">${esc(row)}</div>
                <div class="product-rating">${starsHtml(defaultItem?.rating, defaultItem?.reviewCount)}</div>
                ${maintenance ? `<div class="maintenance-note"><i class="fas fa-triangle-exclamation"></i> ${esc(maintenanceText)}</div>` : ''}
                ${soldOut ? `<div class="maintenance-note"><i class="fas fa-triangle-exclamation"></i> All durations are currently out of stock.</div>` : ''}
                <div class="product-plan-preview">
                    <i class="fas fa-clock"></i> ${items.filter(it => !isMaintenanceProduct(it) && !isOutOfStockProduct(it)).length} duration${items.filter(it => !isMaintenanceProduct(it) && !isOutOfStockProduct(it)).length === 1 ? '' : 's'} available
                    <span>Tap Buy to select</span>
                </div>
                <div class="product-price-live">${locked && !defaultItem ? 'Unavailable' : `From Rs ${defaultItem.price}`}</div>
                <div class="product-actions">
                    ${locked
                        // src by SRT X CHEATS. Copy right SRT X CHEATS
                        ? `<button class="btn-buy btn-maintenance" type="button" disabled><i class="fas fa-lock"></i> ${maintenance ? 'Maintenance' : 'Sold Out'}</button>`
                        : `<button class="btn-buy" onclick="window.__buySelected(${gi})"><i class="fas fa-cart-shopping"></i> Buy</button>`}
                    ${maintenance ? `
                        <button class="btn-download btn-download-disabled" type="button" disabled aria-disabled="true" title="Download unavailable during maintenance">
                            <i class="fas fa-lock"></i> Download Disabled
                        </button>
                    ` : `
                        <a href="${esc(downloadLink)}" target="_blank" rel="noopener" class="btn-download" onclick="event.stopPropagation()">
                            <i class="fas fa-download"></i> Download
                        </a>
                    `}
                </div>
            </div>
        </div>`;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }).join('');

    enableTilt();
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
let pendingShopSrc = null;
window.__buyShopSrc = (gi) => {
    const p = lastGroups[gi]?.items?.[0];
    if (!p || p.type !== 'shopsrc') return;
    pendingShopSrc = p;
    document.getElementById('ssTitle').textContent = lastGroups[gi].row;
    document.getElementById('ssPrice').textContent = `Rs ${p.price}`;
    openModal('shopSrcModal');
};
document.getElementById('ssConfirmBtn').addEventListener('click', async (ev) => {
    const btn = ev.currentTarget;
    if (!pendingShopSrc || btn.disabled) return;
    btn.disabled = true;
    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Processing...';
    try {
        const r = await backendFetch('/api/shopsrc/buy', { method: 'POST', body: JSON.stringify({ productId: pendingShopSrc.sku }) });
        if (r.entry) recordPurchase({ entry: r.entry, newBalance: r.newBalance });
        else { applyBalanceChange(r.newBalance); cacheInvalidate('history'); }
        location.href = '/registershopproject.php?order=' + encodeURIComponent(r.orderId);
    } catch (e) {
        btn.disabled = false; btn.innerHTML = orig;
        closeModal('shopSrcModal');
        if (e.code === 'INSUFFICIENT_BALANCE') {
            if (e.body?.balance !== undefined) applyBalanceChange(e.body.balance);
            toast(`Not enough balance — you need Rs ${e.body?.required ?? pendingShopSrc.price}. Please top up first.`, 'error');
        } else toast(e.message || 'Purchase failed', 'error');
    }
});

window.__viewWaDetails = (gi) => {
    const group = lastGroups[gi];
    const p = group?.items?.[0];
    if (!p || p.type !== 'whatsapp') return;
    document.getElementById('waDetailsTitle').textContent = group.row;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('waDetailsPrice').textContent = `Rs ${p.price}`;
    document.getElementById('waDetailsBody').textContent = p.viewDetails || 'No additional details for this product.';
    const waText = encodeURIComponent(p.whatsappMessage || `Hi! I'm interested in ${group.row}`);
    document.getElementById('waDetailsChatBtn').href = `https://wa.me/${p.whatsappNumber}?text=${waText}`;
    openModal('waDetailsModal');
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

let pendingPlan = null;
let purchaseQuantity = 1;

// src by SRT X CHEATS. Copy right SRT X CHEATS
let planState = { gi: -1, sku: null, qty: 1 };
const planAvailable = (it) => !isMaintenanceProduct(it) && !isOutOfStockProduct(it);

function planRowsHtml(items, gi) {
    const firstOk = items.find(planAvailable);
    return `<div class="pm2-opts">` + items.map(it => {
        const down = isMaintenanceProduct(it);
        const off = !planAvailable(it);
        const sel = firstOk && it.sku === firstOk.sku;
        const badge = off ? (down ? 'Maintenance' : 'Sold out') : '';
        return `
        <label class="pm2-opt${off ? ' off' : ''}" data-no-busy>
            <input type="radio" name="planOpt" value="${esc(it.sku)}" ${off ? 'disabled' : ''} ${sel ? 'checked' : ''}>
            <span class="pm2-radio"></span>
            <span class="pm2-opt-txt"><span class="pm2-opt-dur">${esc(it.duration)}</span>${badge ? `<span class="pm2-badge">${badge}</span>` : ''}<span class="pm2-opt-price">Rs ${esc(it.price)}</span></span>
        </label>`;
    }).join('') + `</div>`;
}

function planUpdateTotal() {
    const raw = catalog[planState.sku];
    const total = raw ? Number(raw.price) * planState.qty : 0;
    document.getElementById('planTotal').textContent = `Rs ${total.toFixed(2)}`;
    document.getElementById('planQty').textContent = planState.qty;
    document.getElementById('planBuyBtn').disabled = !raw;
}

function productIconClass(row, items) {
    const t = tagsOf(row, items)[0];
    return t === 'PC' ? 'fas fa-desktop' : t === 'IOS' ? 'fab fa-apple' : (t === 'ROOT' || t === 'NONROOT') ? 'fas fa-mobile-screen-button' : 'fas fa-gamepad';
}

function openPlanPicker(gi) {
    const group = lastGroups[gi];
    if (!group) return;
    if (!group.items.some(planAvailable)) return toast('This product is currently unavailable.', 'error');
    const first = group.items[0] || {};
    const sub = String(first.subtitle || first.tagline || first.description || '').trim();
    document.getElementById('planProductName').textContent = group.row;
    document.getElementById('planProductSub').textContent = sub.slice(0, 80);
    document.getElementById('planThumbIcon').className = productIconClass(group.row, group.items);
    document.getElementById('planDurationList').innerHTML = planRowsHtml(group.items, gi);
    const firstOk = group.items.find(planAvailable);
    planState = { gi, sku: firstOk ? firstOk.sku : null, qty: 1 };
    planUpdateTotal();
    openModal('planModal');
}
window.__buySelected = (gi) => openPlanPicker(gi);

document.getElementById('planDurationList').addEventListener('change', (e) => {
    if (e.target.name !== 'planOpt') return;
    planState.sku = e.target.value;
    planUpdateTotal();
});
document.getElementById('planQtyMinus').addEventListener('click', () => { planState.qty = Math.max(1, planState.qty - 1); planUpdateTotal(); });
document.getElementById('planQtyPlus').addEventListener('click', () => { planState.qty = Math.min(10, planState.qty + 1); planUpdateTotal(); });
document.getElementById('planBuyBtn').addEventListener('click', () => window.__buyRow(planState.sku, planState.qty));

window.__buyRow = (sku, qtyIn) => {
    const raw = catalog[sku];
    if (!raw || !planAvailable(raw)) return toast('This plan is currently unavailable.', 'error');
    const qty = Math.max(1, Math.min(10, parseInt(qtyIn, 10) || 1));
    const p = { ...raw, sku };
    purchaseQuantity = qty;
    pendingCheckout = { sku, ...p, quantity: qty };
    const grp = lastGroups[planState.gi];
    const icon = grp ? productIconClass(grp.row, grp.items) : 'fas fa-gamepad';
    document.getElementById('checkoutSummary').innerHTML = `
        <div class="pm2c-card">
            <div class="pm2c-prod">
                <div class="pm2-thumb"><i class="${icon}"></i></div>
                <div style="text-align:left"><div class="pm2-label">Product</div><div class="pm2-name">${esc(p.row || p.name)}</div></div>
            </div>
            <div class="pm2c-line"><i class="far fa-clock"></i><span>Duration</span><b class="acc">${esc(p.duration)}</b></div>
            <div class="pm2c-line"><i class="fas fa-cube"></i><span>Quantity</span><b>${qty}</b></div>
        </div>
        <div class="pm2c-total"><i class="fas fa-wallet"></i><span>Total</span><b>Rs ${(Number(p.price) * qty).toFixed(2)}</b></div>`;
    // name + WhatsApp come from the profile; only ask when missing
    const nameEl = document.getElementById('payName'), waEl = document.getElementById('payWA');
    document.getElementById('payFields').classList.toggle('hidden', !!(nameEl.value.trim() && waEl.value.trim()));
    closeModal('planModal');
    openModal('checkoutModal');
};

document.getElementById('catalogSearch').value = searchQuery;
document.getElementById('catalogSearch').addEventListener('input', (e) => {
    searchQuery = e.target.value;
    renderCatalog();
});
// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('catFilters').addEventListener('click', (e) => {
    const btn = e.target.closest('.cat-filter');
    if (!btn) return;
    document.querySelectorAll('.cat-filter').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    activeTag = btn.dataset.tag;
    renderCatalog();
});

const DELIVERY_STEP_ORDER = ['request', 'product', 'balance', 'connecting', 'connected'];
// src by SRT X CHEATS. Copy right SRT X CHEATS
const DELIVERY_LABEL_TO_STEP = {
    'Checking request...': 'request',
    'Checking product...': 'product',
    'Checking balance...': 'balance',
    'Connecting to server...': 'connecting',
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    'Server connected...': 'connected',
    'Finalizing order...': 'connected',
    'Delivered!': 'connected',
};

// src by SRT X CHEATS. Copy right SRT X CHEATS
function setDeliveryStep(stepId, { final = false } = {}) {
    const targetIdx = DELIVERY_STEP_ORDER.indexOf(stepId);
    document.querySelectorAll('.delivery-step').forEach((el) => {
        const idx = DELIVERY_STEP_ORDER.indexOf(el.dataset.step);
        el.classList.remove('active', 'done');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (targetIdx === -1) return;
        if (idx < targetIdx || (idx === targetIdx && final)) {
            el.classList.add('done');
            el.querySelector('.delivery-step-icon').innerHTML = '<i class="icon-done fas fa-circle-check"></i>';
        } else if (idx === targetIdx) {
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            el.classList.add('active');
            el.querySelector('.delivery-step-icon').innerHTML = '<i class="icon-active fas fa-circle-notch"></i>';
        } else {
            el.querySelector('.delivery-step-icon').innerHTML = '<i class="icon-pending fas fa-circle"></i>';
        }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    });
}

function setDeliveryProgress(percent, label) {
    const p = Math.max(0, Math.min(100, percent));
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const fill = document.getElementById('deliveryPctFill');
    const pct = document.getElementById('deliveryPct');
    if (fill) { fill.style.width = p + '%'; fill.classList.toggle('complete', p >= 100); }
    if (pct) pct.textContent = Math.round(p) + '%';

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const stepId = DELIVERY_LABEL_TO_STEP[label];
    if (stepId) setDeliveryStep(stepId, { final: p >= 100 });
}

function resetDeliverySteps() {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.querySelectorAll('.delivery-step').forEach((el) => {
        el.classList.remove('active', 'done');
        el.querySelector('.delivery-step-icon').innerHTML = '<i class="icon-pending fas fa-circle"></i>';
    });
    setDeliveryProgress(0, '');
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

function renderKeyRows(keys) {
    const container = document.getElementById('keyValueList');
    container.innerHTML = keys.map((key, i) => `
        <div class="key-row">
            <div style="flex:1;min-width:0">
                ${keys.length > 1 ? `<span class="key-row-label">KEY ${i + 1}</span>` : ''}
                <div class="key-row-text">${key}</div>
            </div>
            <button type="button" class="key-copy-btn" data-key="${key.replace(/"/g, '&quot;')}">
                <i class="fas fa-copy"></i> Copy
            </button>
        </div>
    `).join('');
// src by SRT X CHEATS. Copy right SRT X CHEATS

    container.querySelectorAll('.key-copy-btn').forEach((btn) => {
        btn.addEventListener('click', async () => {
            const key = btn.dataset.key;
            try {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                await navigator.clipboard.writeText(key);
            } catch (e) {
                toast('Could not copy automatically — please select the key manually', 'error');
                return;
            }
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied';
            btn.classList.add('copied');
            setTimeout(() => { btn.innerHTML = original; btn.classList.remove('copied'); }, 1800);
        });
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    });
}

// src by SRT X CHEATS. Copy right SRT X CHEATS
let banCountdownInterval = null;

function showTopupPrompt() {
    openModal('topupPromptModal');
}
document.getElementById('topupPromptTgBtn')?.addEventListener('click', async (e) => {
    const btn = e.currentTarget;
    const tab = window.open('', '_blank');          // opened inside the tap so pop-up blockers allow it
    btn.disabled = true;
    try {
        const r = await backendFetch('/api/user/telegram-deposit-link', { method: 'POST' });
        if (tab) tab.location.href = r.url; else window.location.href = r.url;
    } catch (err) {
        if (tab) tab.close();
        toast(err.message || 'Could not open Telegram. Please try again.', 'error');
    } finally { btn.disabled = false; }
});

function showCheckoutBan(bannedUntil) {
    closeModal('topupPromptModal');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    closeModal('errorModal');
    closeModal('deliveryModal');
    openModal('checkoutBanModal');

    clearInterval(banCountdownInterval);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const tick = () => {
        const msLeft = bannedUntil - Date.now();
        if (msLeft <= 0) {
            clearInterval(banCountdownInterval);
            closeModal('checkoutBanModal');
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            return;
        }
        const totalSeconds = Math.ceil(msLeft / 1000);
        const mm = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
        const ss = String(totalSeconds % 60).padStart(2, '0');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('checkoutBanCountdown').textContent = `${mm}:${ss}`;
    };
    tick();
    banCountdownInterval = setInterval(tick, 1000);

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try { sessionStorage.setItem('srtx_checkout_ban_until', String(bannedUntil)); } catch (e) {}
}

(function resumeBanIfActive() {
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        const saved = Number(sessionStorage.getItem('srtx_checkout_ban_until') || 0);
        if (saved > Date.now()) showCheckoutBan(saved);
        else sessionStorage.removeItem('srtx_checkout_ban_until');
    } catch (e) {}
})();
// src by SRT X CHEATS. Copy right SRT X CHEATS

async function runPurchase() {
    const name = document.getElementById('payName').value.trim();
    const waNum = document.getElementById('payWA').value.trim();
    if (!name || !waNum) { toast('Please fill name and WhatsApp', 'error'); return; }
// src by SRT X CHEATS. Copy right SRT X CHEATS

    closeModal('errorModal');
    setLoading(confirmBtn, true);

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    try {
        const quantity = Math.max(1, Math.min(10, Number(pendingCheckout.quantity) || 1));
        const keys = [];
        let lastBalance;
        const token = await getAuthToken();
// src by SRT X CHEATS. Copy right SRT X CHEATS

        for (let n = 1; n <= quantity; n++) {
            let startRes;
            try {
                startRes = await backendFetch('/api/purchase/checkout/start', {
                    // src by SRT X CHEATS. Copy right SRT X CHEATS
                    method: 'POST',
                    body: JSON.stringify({ sku: pendingCheckout.sku, name, waNum }),
                });
            } catch (startErr) {
                if (startErr.code === 'INSUFFICIENT_BALANCE') {
                    // src by SRT X CHEATS. Copy right SRT X CHEATS
                    if (startErr.body?.balance !== undefined) applyBalanceChange(startErr.body.balance);
                    showTopupPrompt(); return;
                }
                if (startErr.code === 'CHECKOUT_BANNED') { showCheckoutBan(startErr.body?.bannedUntil || Date.now() + 3600_000); return; }
                throw startErr;
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            }

            if (n === 1) { closeModal('checkoutModal'); openModal('deliveryModal'); resetDeliverySteps(); }

            const jobId = startRes.jobId;
// src by SRT X CHEATS. Copy right SRT X CHEATS

            let done = false;
            let result = null;
            while (!done) {
                const resp = await fetch(`${window.BACKEND_URL}/api/purchase/checkout/status/${jobId}`, {
                    // src by SRT X CHEATS. Copy right SRT X CHEATS
                    headers: { Authorization: `Bearer ${token}` },
                });
                if (!resp.ok) {
                    let eb = null; try { eb = await resp.json(); } catch (_) {}
                    if (window.srtxHandleBan && window.srtxHandleBan(resp.status, eb)) throw new Error('Your account has been banned by admin.');
                    // src by SRT X CHEATS. Copy right SRT X CHEATS
                    throw new Error(`Status request failed (HTTP ${resp.status})`);
                }
                const status = await resp.json();
                const overall = ((n - 1) + (Number(status.percent || 0) / 100)) / quantity * 100;
                setDeliveryProgress(overall, status.label);
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                if (status.done) { done = true; result = status; break; }
                await new Promise(r => setTimeout(r, 500));
            }

            if (!result || !result.success) {
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                throw new Error(quantity > 1 && keys.length ? `${keys.length} key(s) delivered, but key ${n} failed: ${result?.error || 'Purchase failed'}` : (result?.error || 'Purchase failed'));
            }
            keys.push(result.key);
            if (result.newBalance !== undefined) lastBalance = result.newBalance;
            if (result.entry) recordPurchase({ entry: result.entry, newBalance: result.newBalance });
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            else { applyBalanceChange(result.newBalance); cacheInvalidate('history'); }
        }

        setDeliveryProgress(100, 'Delivered!');
        closeModal('deliveryModal');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('keyProductName').textContent = `${pendingCheckout.name} • ${pendingCheckout.duration} • Qty ${quantity}`;
        renderKeyRows(keys);
        lastPurchasedRow = pendingCheckout.row || pendingCheckout.name || null;
        openModal('keyModal');

        // src by SRT X CHEATS. Copy right SRT X CHEATS
        if (lastBalance !== undefined) {
            document.getElementById('balAmount').textContent = lastBalance;
        }
    } catch (e) {
        closeModal('deliveryModal');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('errorMsg').textContent = e.message || 'Key delivery failed. Contact admin.';
        openModal('errorModal');
    } finally {
        setLoading(confirmBtn, false);
        closeModal('checkoutModal');
    }
// src by SRT X CHEATS. Copy right SRT X CHEATS
}

const confirmBtn = document.getElementById('confirmBuyBtn');
confirmBtn.onclick = async () => {
    if (!pendingCheckout) return;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    await runPurchase();
};

document.getElementById('retryPurchaseBtn')?.addEventListener('click', async () => {
    if (!pendingCheckout) { closeModal('errorModal'); return; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    await runPurchase();
});

document.getElementById('dismissErrorBtn')?.addEventListener('click', () => {
    closeModal('errorModal');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    pendingCheckout = null;
    pendingPlan = null;
    purchaseQuantity = 1;
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
let lastPurchasedRow = null;
let feedbackStars = 0;

window.__closeKeyAndRate = () => {
    closeModal('keyModal');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    pendingCheckout = null;
    pendingPlan = null;
    purchaseQuantity = 1;
    if (!lastPurchasedRow) return;
    feedbackStars = 0;
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.getElementById('feedbackProductName').textContent = lastPurchasedRow;
    document.getElementById('feedbackComment').value = '';
    document.querySelectorAll('#feedbackStarPicker i').forEach(s => { s.className = 'far fa-star'; });
    openModal('feedbackPromptModal');
};
// src by SRT X CHEATS. Copy right SRT X CHEATS

document.getElementById('feedbackStarPicker').addEventListener('click', (e) => {
    const starEl = e.target.closest('[data-star]');
    if (!starEl) return;
    feedbackStars = Number(starEl.dataset.star);
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    document.querySelectorAll('#feedbackStarPicker i').forEach(s => {
        s.className = Number(s.dataset.star) <= feedbackStars ? 'fas fa-star active' : 'far fa-star';
    });
});

// src by SRT X CHEATS. Copy right SRT X CHEATS
document.getElementById('feedbackSubmitBtn').onclick = async () => {
    if (!feedbackStars) return toast('Tap a star to rate it first', 'error');
    const btn = document.getElementById('feedbackSubmitBtn');
    setLoading(btn, true);
    try {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        await backendFetch('/api/user/feedback', {
            method: 'POST',
            body: JSON.stringify({
                row: lastPurchasedRow,
                stars: feedbackStars,
                // src by SRT X CHEATS. Copy right SRT X CHEATS
                comment: document.getElementById('feedbackComment').value.trim(),
                authorName: document.getElementById('payName')?.value?.trim() || '',
            }),
        });
        toast('Thanks for the feedback!', 'success');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        cacheInvalidate('feedback', 'catalog');
        closeModal('feedbackPromptModal');
    } catch (e) {
        toast(e.message || 'Could not submit feedback', 'error');
    } finally {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        setLoading(btn, false);
    }
};

function goToTopupStep(step) {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    [1, 2, 3].forEach(n => {
        document.getElementById(`topupStep${n}`).classList.toggle('hidden', n !== step);
        const dot = document.querySelector(`.topup-step[data-step="${n}"]`);
        if (dot) { dot.classList.toggle('active', n === step); dot.classList.toggle('done', n < step); }
    });
// src by SRT X CHEATS. Copy right SRT X CHEATS
}
window.resetTopupSteps = () => {
    document.getElementById('topupTx').value = '';
    setupTopupLock();
    goToTopupStep(1);
// src by SRT X CHEATS. Copy right SRT X CHEATS
};

document.getElementById('topupNext1').onclick = () => {
    const esewaId = document.getElementById('topupEsewa').value.trim();
    if (!esewaId) return toast('Enter your eSewa number', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    goToTopupStep(2);
};
document.getElementById('topupNext2').onclick = () => {
    const amount = parseInt(document.getElementById('topupAmount').value, 10);
    if (!amount || amount < 50) return toast('Enter a valid amount (min Rs 50)', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    goToTopupStep(3);
};
document.getElementById('topupBack2').onclick = () => goToTopupStep(1);
document.getElementById('topupBack3').onclick = () => goToTopupStep(2);

// src by SRT X CHEATS. Copy right SRT X CHEATS
const topupBtn = document.getElementById('submitTopup');
topupBtn.onclick = async () => {
    const amount = parseInt(document.getElementById('topupAmount').value, 10);
    const esewaId = document.getElementById('topupEsewa').value.trim();
    const txCode = document.getElementById('topupTx').value.trim();
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    if (!amount || !esewaId || !txCode) return toast('Fill all fields', 'error');
    // the transaction-code rules are checked on the server only (never shown here); the server's answer is toasted below
    setLoading(topupBtn, true);
    try {
        await backendFetch('/api/user/topup', { method: 'POST', body: JSON.stringify({ amount, esewaId, txCode }) });
        toast('Submitted — awaiting admin approval', 'success');
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        closeModal('topupModal');
        window.resetTopupSteps();
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        setLoading(topupBtn, false);
    }
};

const reportBtn = document.getElementById('submitReport');
// src by SRT X CHEATS. Copy right SRT X CHEATS
reportBtn.onclick = async () => {
    const category = document.getElementById('problemCategory').value;
    const problem = document.getElementById('problemText').value.trim();
    if (!category) return toast('Choose a bug type', 'error');
    if (!problem) return toast('Please describe the problem', 'error');
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    setLoading(reportBtn, true);
    try {
        await backendFetch('/api/user/report', { method: 'POST', body: JSON.stringify({ category, problem, token: getSupportToken() }) });
        showSuccessInfo('YOUR REPORT HAS BEEN SENT TO ADMIN.<br><br>PLEASE WAIT WHILE WE CHECK AND FIX YOUR REPORTED PROBLEM.');
        document.getElementById('problemCategory').value = '';
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        document.getElementById('problemText').value = '';
        closeModal('helpModal');
    } catch (e) {
        toast(e.message, 'error');
    } finally {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        setLoading(reportBtn, false);
    }
};

(() => {
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    const el = document.getElementById('balAmount')?.parentElement;
    if (!el) return;
    el.style.cursor = 'pointer';
    el.title = 'Tap to refresh balance';
    el.addEventListener('click', async () => {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        try { await refreshData('profile'); toast('Balance updated', 'success'); }
        catch (e) { toast(e.message, 'error'); }
    });
})();

// src by SRT X CHEATS. Copy right SRT X CHEATS
try { paintFromCache(); } catch (e) { console.error('[cache-paint]', e); }

</script>
<?php require __DIR__ . '/includes/copyright.php'; ?>
</body>
</html>
