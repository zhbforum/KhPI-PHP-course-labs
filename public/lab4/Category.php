<?php

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/DiscountedProduct.php';

class Category
{
    private string $title;

    private array $products = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function all(): array
    {
        return $this->products;
    }

    public function getInfo(): string
    {
        $lines = ["Категорія: {$this->title}"];
        if (empty($this->products)) {
            $lines[] = "Товарів ще немає.";
            return implode("\n", $lines) . "\n";
        }

        foreach ($this->products as $i => $product) {
            $lines[] = str_repeat('-', 40);
            $lines[] = 'Товар №' . ($i + 1) . ':';
            $lines[] = $product->getInfo();
        }

        return implode("\n", $lines);
    }
}
