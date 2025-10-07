<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$id = (int)arr_get($_GET, 'id', 0);
$cart = $_SESSION['cart'] ?? [];

if ($id > 0 && isset($cart[$id])) {
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;
    flash_set('Товар видалено з кошика.', 'success');
} else {
    flash_set('Товар не знайдено.', 'error');
}

redirect('view.php');
