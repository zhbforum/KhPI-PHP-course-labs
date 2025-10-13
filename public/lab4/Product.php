<?php

class Product
{
    public string $name;
    public string $description;
    protected float $price;

    public function __construct(string $name, float $price, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->setPrice($price);
    }

    public function setPrice(float $price): void
    {
        if ($price < 0) {
            throw new InvalidArgumentException('Ціна товару не може бути від’ємною.');
        }
        $this->price = round($price, 2);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getInfo(): string
    {
        return sprintf(
            "Назва: %s\nЦіна: %s\nОпис: %s\n",
            $this->name,
            number_format($this->price, 2, '.', ' '),
            $this->description !== '' ? $this->description : '—'
        );
    }
}
