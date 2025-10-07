<?php

require_once __DIR__ . '/../lib/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('form.php');
}
$clientIp    = arr_get($_SERVER, 'REMOTE_ADDR', 'невідомо');
$userAgent   = arr_get($_SERVER, 'HTTP_USER_AGENT', 'невідомо');
$phpSelf     = arr_get($_SERVER, 'PHP_SELF', 'невідомо');
$requestUri  = arr_get($_SERVER, 'REQUEST_URI', '');
$scriptFile  = arr_get($_SERVER, 'SCRIPT_FILENAME', 'невідомо');
$method      = arr_get($_SERVER, 'REQUEST_METHOD', 'невідомо');
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>$_SERVER — Інформація</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Інформація про сервер і запит</h1>
            <ul>
                <li>IP клієнта: <strong><?= h($clientIp) ?></strong></li>
                <li>Браузер (User-Agent): <strong><?= h($userAgent) ?></strong></li>
                <li>Скрипт (PHP_SELF): <strong><?= h($phpSelf) ?></strong></li>
                <li>Метод запиту: <strong><?= h($method) ?></strong></li>
                <li>Request URI: <strong><?= h($requestUri) ?></strong></li>
                <li>Шлях до файлу на сервері: <strong><?= h($scriptFile) ?></strong></li>
            </ul>
            <div class="actions">
                <a class="btn outline" href="form.php">← Назад</a>
            </div>
        </div>
    </div>
</body>

</html>