<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$cart = $_SESSION['cart'] ?? [];
$products = require __DIR__ . '/catalog.php';

$total = 0.0;
foreach ($cart as $id => $qty) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * (int)$qty;
    }
}
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Кошик</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Кошик</h1>

            <?php if ($f = flash_get()): ?>
                <div class="flash <?= h($f['type']) ?>"><?= h($f['message']) ?></div>
            <?php endif; ?>

            <?php if (!$cart): ?>
                <p>Кошик порожній.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>К-сть</th>
                            <th>Ціна</th>
                            <th>Сума</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $qty): ?>
                            <?php if (!isset($products[$id])) continue; ?>
                            <?php $p = $products[$id]; ?>
                            <tr>
                                <td><?= h($p['title']) ?></td>
                                <td><?= (int)$qty ?></td>
                                <td>$<?= number_format($p['price'], 2) ?></td>
                                <td>$<?= number_format($p['price'] * (int)$qty, 2) ?></td>
                                <td>
                                    <a class="btn danger" href="remove.php?id=<?= (int)$id ?>">видалити</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Разом:</th>
                            <th>$<?= number_format($total, 2) ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>

            <div class="actions">
                <a class="btn outline" href="products.php">← До каталогу</a>
                <a class="btn danger" href="clear.php">Очистити кошик</a>
            </div>
        </div>
    </div>
</body>

</html>