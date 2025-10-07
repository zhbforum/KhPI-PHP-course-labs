<?php

require_once __DIR__ . '/../lib/bootstrap.php';

$id = (int)arr_get($_GET, 'id', 0);
if ($id <= 0) {
    flash_set('Невірний товар.', 'error');
    redirect('products.php');
}

$_SESSION['cart'] ??= [];
$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

flash_set('Товар додано в кошик.', 'success');
redirect('view.php');
