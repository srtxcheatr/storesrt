<?php // Lightweight uptime check: no DB, no session, no external calls
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('X-Robots-Tag: noindex, nofollow');
http_response_code(200);
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'HEAD') exit;
echo json_encode(['status' => 'ok', 'time' => gmdate('c')]);
