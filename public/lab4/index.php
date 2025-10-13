<?php

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/DiscountedProduct.php';
require_once __DIR__ . '/Category.php';


header('Content-Type: text/plain; charset=UTF-8');

try {
    $p1  = new Product('test1', 29.99, 'sometext1');
    $p2  = new Product('test2', 8.50,  'sometext2');
    $dp1 = new DiscountedProduct('test3', 59.90, 'sometext3', 15.00);
    $dp2 = new DiscountedProduct('test4', 39.99, 'sometext4', 25.00);

    echo $p1->getInfo() . "\n";
    echo $p2->getInfo() . "\n";
    echo $dp1->getInfo() . "\n";
    echo $dp2->getInfo() . "\n";

    $cat = new Category('smth');
    $cat->addProduct($p2);
    $cat->addProduct($dp1);
    $cat->addProduct($dp2);

    echo $cat->getInfo();
} catch (Throwable $e) {
    echo "Помилка: " . $e->getMessage() . PHP_EOL;
}
