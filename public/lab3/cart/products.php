<?php

require_once __DIR__ . '/../lib/bootstrap.php';

$products = require __DIR__ . '/catalog.php';
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Каталог</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Каталог товарів</h1>

            <?php if ($f = flash_get()): ?>
                <div class="flash <?= h($f['type']) ?>"><?= h($f['message']) ?></div>
            <?php endif; ?>

            <ul>
                <?php foreach ($products as $id => $p): ?>
                    <li>
                        <?= h($p['title']) ?> — $<?= number_format($p['price'], 2) ?>
                        <span class="muted">#<?= (int)$id ?></span>
                        <div class="actions">
                            <a class="btn" href="add.php?id=<?= (int)$id ?>">додати в кошик</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="actions">
                <a class="btn outline" href="view.php">Переглянути кошик</a>
                <a class="btn outline" href="../index.php">← На головну</a>
            </div>
        </div>
    </div>
</body>

</html>