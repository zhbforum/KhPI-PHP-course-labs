<?php
require_once __DIR__ . '/../lib/bootstrap.php';
if (arr_get($_SESSION, 'user')) {
    redirect('dashboard.php');
}
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Логін</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Вхід користувача</h1>
            <?php if ($f = flash_get()): ?>
                <div class="flash error"><?= h($f) ?></div>
            <?php endif; ?>

            <form action="authenticate.php" method="post" autocomplete="off">
                <div>
                    <label>Логін: <input type="text" name="login" required></label>
                </div>
                <div>
                    <label>Пароль: <input type="password" name="password" required></label>
                </div>
                <button type="submit" class="btn">Увійти</button>
            </form>

            <div class="actions">
                <a class="btn outline" href="../index.php">← На головну</a>
            </div>
        </div>
    </div>
</body>

</html>