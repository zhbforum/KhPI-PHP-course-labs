<?php

$what = $_GET['what'] ?? '';

if ($what === 'file') {
    $cacheFile = __DIR__ . '/cache/report.html';
    if (is_file($cacheFile)) unlink($cacheFile);
    echo 'Файл-кеш видалено';
} elseif ($what === 'session') {
    session_start();
    $_SESSION = [];
    session_destroy();
    echo 'Сесію очищено';
} else {
    echo 'Вкажи ?what=file або ?what=session';
}
