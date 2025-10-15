<?php

require_once __DIR__ . '/auth.php';

$username = $_SESSION['username'] ?? 'Користувач';
?>

<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Lab6</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="welcome.css">
    </style>
</head>

<body>
    <div class="card">
        <h1>Вітаю, <?= htmlspecialchars($username) ?>!</h1>
        <p>Це захищена сторінка. Ви успішно авторизувалися.</p>
        <a href="logout.php">Вийти</a>
    </div>
</body>

</html>