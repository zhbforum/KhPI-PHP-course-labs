<?php

require_once __DIR__ . '/Product.php';

class DiscountedProduct extends Product
{
    private float $discount;

    public function __construct(string $name, float $price, string $description = '', float $discount = 0.0)
    {
        parent::__construct($name, $price, $description);
        $this->setDiscount($discount);
    }

    public function setDiscount(float $discount): void
    {
        if ($discount < 0 || $discount > 100) {
            throw new InvalidArgumentException('Знижка має бути в межах 0..100%.');
        }
        $this->discount = round($discount, 2);
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getDiscountedPrice(): float
    {
        $factor = (100.0 - $this->discount) / 100.0;
        return round($this->price * $factor, 2);
    }

    public function getInfo(): string
    {
        return sprintf(
            "Назва: %s\nЦіна: %s\nЗнижка: %s%%\nНова ціна: %s\nОпис: %s\n",
            $this->name,
            number_format($this->getPrice(), 2, '.', ' '),
            number_format($this->discount, 2, '.', ' '),
            number_format($this->getDiscountedPrice(), 2, '.', ' '),
            $this->description !== '' ? $this->description : '—'
        );
    }
}
