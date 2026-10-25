<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
require_once __DIR__ . '/config.php';
if (!headers_sent()) { header('Cache-Control: no-cache, must-revalidate'); } // always fetch fresh HTML so new ?v= asset links load

$fxPage   = $currentPage ?? '';
$fxOff    = ($bodyClass ?? '') === 'boot-body';
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title><?= htmlspecialchars($pageTitle ?? 'ADMIN PANEL') ?></title>
<?php
// src by SRT X CHEATS. Copy right SRT X CHEATS
$siteUrl   = SITE_URL;
$siteName  = SITE_NAME;
// src by SRT X CHEATS. Copy right SRT X CHEATS
$siteIcon  = $siteUrl . '/assets/img/logo.png';
$seoDesc   = $metaDescription ?? 'SRT X CHEATS — Nepal\'s trusted panel seller and Glory Bot seller. Android panel, NonRoot panel, Root panel and iOS panel. Buy instantly.';
$seoPath   = $canonicalPath ?? parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$seoUrl    = $siteUrl . ($seoPath === '/index.php' ? '/' : $seoPath);
$seoTitle  = $pageTitle ?? $siteName;
// src by SRT X CHEATS. Copy right SRT X CHEATS
?>
<meta name="description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta name="robots" content="<?= !empty($indexable) ? 'index,follow,max-image-preview:large,max-snippet:-1' : 'noindex,nofollow' ?>">
<link rel="canonical" href="<?= htmlspecialchars($seoUrl) ?>">
<meta name="keywords" content="SRT X CHEATS, Nepali panel seller, Nepal trusted panel seller, Android panel, NonRoot panel, iOS panel, Glory bot seller">
<meta name="application-name" content="<?= $siteName ?>">
<meta name="theme-color" content="#060a14">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" type="image/png" sizes="48x48" href="/assets/img/favicon-48.png">
<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon-96.png">
<link rel="icon" type="image/png" sizes="192x192" href="/assets/img/favicon-192.png">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_NP">
<meta name="geo.region" content="NP">
<meta property="og:site_name" content="<?= $siteName ?>">
<meta property="og:title" content="<?= htmlspecialchars($seoTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($seoUrl) ?>">
<meta property="og:image" content="<?= $siteIcon ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?= htmlspecialchars($seoTitle) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta name="twitter:image" content="<?= $siteIcon ?>">
<?php if (!empty($indexable)): ?>
<script type="application/ld+json"><?= json_encode([
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type' => 'WebSite', '@id' => $siteUrl . '/#website', 'url' => $siteUrl . '/', 'name' => $siteName,
         'alternateName' => ['SRTXCHEATS', 'SRTX CHEATS'], 'description' => $seoDesc, 'inLanguage' => 'en'],
        ['@type' => 'Store', '@id' => $siteUrl . '/#store', 'name' => $siteName, 'url' => $siteUrl . '/', 'logo' => $siteIcon, 'image' => $siteIcon, 'description' => 'Nepal trusted panel seller and Glory bot seller', 'areaServed' => 'NP'],
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        ['@type' => 'Organization', '@id' => $siteUrl . '/#org', 'name' => $siteName, 'url' => $siteUrl . '/',
         'logo' => ['@type' => 'ImageObject', 'url' => $siteIcon], 'image' => $siteIcon],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="/assets/css/terminal.css?v=20261023-2">
<link rel="stylesheet" href="/assets/css/clean.css?v=20261011-2">
<link rel="stylesheet" href="/assets/css/rewards.css?v=20261026-1">
<?php if (!$fxOff): ?>
<link rel="stylesheet" href="/assets/css/fx.css?v=20261018-2">
<?php endif; ?>
<link rel="stylesheet" href="/assets/css/glass.css?v=20261025-4">

<script src="/assets/js/consent.js?v=20261025-1"></script>
<script>
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    window.BACKEND_URL = "<?= BACKEND_URL ?>";
    window.WELCOME_REDIRECT_URL = <?= json_encode(defined('WELCOME_REDIRECT_URL') ? WELCOME_REDIRECT_URL : '') ?>;
    window.FIREBASE_CONFIG = <?= FIREBASE_CONFIG_JSON ?>;

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    (function() {
        const savedTheme = localStorage.getItem('srtx_theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    })();

    // src by SRT X CHEATS. Copy right SRT X CHEATS
    (function() {
        try {
            var reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
            var lowMemory = typeof navigator.deviceMemory === 'number' && navigator.deviceMemory <= 4;
            var lowCores = typeof navigator.hardwareConcurrency === 'number' && navigator.hardwareConcurrency <= 4;
            // src by SRT X CHEATS. Copy right SRT X CHEATS
            if (reduceMotion || lowMemory || lowCores) {
                document.documentElement.classList.add('srt-low-fx');
            }
        } catch (e) {  }
    })();
</script>
<script src="/assets/js/toast.js?v=20261014-2"></script>
<script src="/assets/js/ban.js?v=20261014-2"></script>
<script src="/assets/js/busy.js?v=20261025-3"></script>
<?php if (!$fxOff): ?>
<script>
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    window.SRT_FX_PAGE = <?= json_encode($fxPage) ?>;
</script>
<script src="/assets/js/fx.js?v=20261023-1"></script>
<?php else: ?>
<script>window.SRT_FX_OFF = true;</script>
<?php endif; ?>
<?= $extraHead ?? '' ?>
</head>
<?php $bodyClasses = trim(($fxOff ? '' : 'fx-wild ') . ($bodyClass ?? '')); ?>
<body<?= $bodyClasses !== '' ? ' class="' . htmlspecialchars($bodyClasses) . '"' : '' ?>>
