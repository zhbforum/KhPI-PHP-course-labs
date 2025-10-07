<?php

require_once __DIR__ . '/../lib/bootstrap.php';

$cart = $_SESSION['cart'] ?? [];
if (!$cart) {
    $_SESSION['flash'] = 'Кошик порожній, нічого оформляти.';
    redirect('view.php');
}

$current = [];
foreach ($cart as $id => $qty) {
    for ($i = 0; $i < (int)$qty; $i++) {
        $current[] = (int)$id;
    }
}

$prev = cookie_json_get('previous_purchases');
$merged = array_values(array_merge($prev, $current));

cookie_json_set('previous_purchases', $merged, 30);

unset($_SESSION['cart']);

$_SESSION['flash'] = 'Покупку оформлено. Дані додано до "попередніх покупок" (cookie).';
redirect('view.php');
