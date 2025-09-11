<?php

require_once __DIR__ . '/bootstrap.php';

$logFile = __DIR__ . DIRECTORY_SEPARATOR . 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content'] ?? '');
    if ($content === '') {
        http_response_code(400);
        exit('Empty text. Nothing to write.');
    }
    $entry = sprintf(
        "[%s] %s\n",
        date('Y-m-d H:i:s'),
        str_replace(["\r", "\n"], ' ', $content)
    );
    if (false === @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX)) {
        http_response_code(500);
        exit('Failed to write to log.txt');
    }
    header('Location: text.php?written=1');
    exit;
}

$logText = is_file($logFile) ? (file_get_contents($logFile) ?: '') : '';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="<?= APP_CHARSET ?>">
    <title>Log (log.txt)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>log.txt contents</h1>
    <?php if ($logText === ''): ?>
        <p>Log is empty.</p>
    <?php else: ?>
        <pre><?= e($logText) ?></pre>
    <?php endif; ?>
    <p><a href="index.html">Back</a></p>
</body>

</html>