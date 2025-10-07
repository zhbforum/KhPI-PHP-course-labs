<?php

require_once __DIR__ . '/../lib/bootstrap.php';

$user = arr_get($_SESSION, 'user');
if (!$user) {
    $_SESSION['flash'] = 'Будь ласка, увійдіть.';
    redirect('login.php');
}
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Кабінет</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Вітаємо, <?= h($user['login']) ?>!</h1>
            <p>Сесія активна. Остання активність: <?= date('H:i:s', (int)$_SESSION['last_activity']) ?></p>
            <div class="actions">
                <a class="btn danger" href="logout.php">Вихід</a>
                <a class="btn outline" href="../index.php">← На головну</a>
            </div>
        </div>
    </div>
</body>

</html>