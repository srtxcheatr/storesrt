<?php // src by SRT X CHEATS. Copy right SRT X CHEATS
(function () {
    $f = __DIR__ . '/.env';
    if (!is_readable($f)) return;
    foreach (file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        // src by SRT X CHEATS. Copy right SRT X CHEATS
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) continue;
        [$k, $v] = array_map('trim', explode('=', $line, 2));
        $v = trim($v, "\"'");
        if ($k !== '' && getenv($k) === false) { putenv("$k=$v"); $_ENV[$k] = $v; }
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    }
})();

$env = static fn (string $k, string $d = '') => (($v = getenv($k)) !== false && $v !== '') ? $v : $d;

// src by SRT X CHEATS. Copy right SRT X CHEATS
define('COPYRIGHT_NAME', $env('COPYRIGHT_NAME', 'SRT X CHEATS'));
define('SITE_NAME', $env('SITE_NAME', 'SRT X CHEATS'));
define('SITE_URL', rtrim($env('SITE_URL', 'https://srtxcheats.com'), '/'));
define('SITE_ICON', $env('SITE_ICON', 'https://i.postimg.cc/Gpsmfbfj/app-icon-foreground.png'));
define('DEVELOPER_URL', $env('DEVELOPER_URL', 'https://srtxcheatr.github.io/srtxcheats/'));
// src by SRT X CHEATS. Copy right SRT X CHEATS
define('BACKEND_URL', rtrim($env('BACKEND_URL', 'https://repromax5.onrender.com'), '/'));
define('WELCOME_REDIRECT_URL', $env('WELCOME_REDIRECT_URL', 'https://whatsapp.com/channel/0029Vb8nlud3mFY0H8Jfev2e'));
define('WHATSAPP_TOPUP_NUMBER', $env('WHATSAPP_TOPUP_NUMBER', '9779827260865'));
define('WHATSAPP_TOPUP_MESSAGE', $env('WHATSAPP_TOPUP_MESSAGE', 'I am coming from admin panel and I want to get deposit balance and get panel key'));
// src by SRT X CHEATS. Copy right SRT X CHEATS

define('BANNERS', [
    ['image' => 'https://i.postimg.cc/0rgvg95j/file-00000000a47882118a513b5f8330bb53.png', 'link' => 'GZOWtlF8OFSeM0E08epGicNHvAh2'],
    ['image' => 'https://i.postimg.cc/RFZ9zPc2/file-000000000e688211a2be320f8de763e4.png', 'link' => 'GZOWtlF8OFSeM0E08epGicNHvAh2'],
]);
// src by SRT X CHEATS. Copy right SRT X CHEATS

define('FIREBASE_CONFIG_JSON', json_encode([
    'apiKey' => $env('FIREBASE_API_KEY'),
    'authDomain' => $env('FIREBASE_AUTH_DOMAIN'),
    'projectId' => $env('FIREBASE_PROJECT_ID'),
    // src by SRT X CHEATS. Copy right SRT X CHEATS
    'storageBucket' => $env('FIREBASE_STORAGE_BUCKET'),
    'messagingSenderId' => $env('FIREBASE_MESSAGING_SENDER_ID'),
    'appId' => $env('FIREBASE_APP_ID'),
]));
