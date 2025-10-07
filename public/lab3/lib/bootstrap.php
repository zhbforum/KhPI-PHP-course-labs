<?php

require_once __DIR__ . '/helpers.php';

ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');

session_start();

date_default_timezone_set('Europe/Kyiv');

$now = time();
$timeout = 60 * 5;
$last = arr_get($_SESSION, 'last_activity');

if ($last && ($now - (int)$last) > $timeout) {
    session_unset();
    session_destroy();
    session_start();
    flash_set('Сесія завершена через неактивність (5 хв).', 'error');
}

$_SESSION['last_activity'] = $now;

function flash_set(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = [
        'message' => $message,
        'type'    => $type,
    ];
}

function flash_get(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $raw = $_SESSION['flash'];
    unset($_SESSION['flash']);

    if (is_string($raw)) {
        return ['message' => $raw, 'type' => 'success'];
    }

    $msg  = $raw['message'] ?? '';
    $type = $raw['type'] ?? 'success';

    return ['message' => $msg, 'type' => $type];
}
