<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$username = $_COOKIE['username'] ?? null;
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Cookies — Привітання</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>$_COOKIE: зберігаємо ім’я користувача</h1>
            <?php if ($f = flash_get()): ?>
                <div class="flash <?= h($f['type']) ?>"><?= h($f['message']) ?></div>
            <?php endif; ?>

            <?php if ($username): ?>
                <p>Привіт, <strong><?= h($username) ?></strong>!</p>
                <div class="actions">
                    <a class="btn danger" href="delete_cookie.php">Видалити cookie</a>
                </div>
            <?php else: ?>
                <form action="set_cookie.php" method="post" autocomplete="off">
                    <label>
                        Введіть ім’я:
                        <input type="text" name="username" required minlength="2" maxlength="50">
                    </label>
                    <button type="submit" class="btn">Зберегти в cookie (7 днів)</button>
                </form>
            <?php endif; ?>

            <div class="actions">
                <a class="btn outline" href="../index.php">← На головну</a>
            </div>
        </div>
    </div>
</body>

</html>