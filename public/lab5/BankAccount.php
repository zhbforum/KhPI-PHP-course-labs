<?php

require_once __DIR__ . '/AccountInterface.php';

class BankAccount implements AccountInterface
{
    public const MIN_BALANCE = 0.0;

    protected float $balance;

    protected string $currency;

    public function __construct(string $currency, float $initialBalance = 0.0)
    {
        if ($initialBalance < 0) {
            throw new \InvalidArgumentException("Початковий баланс не може бути від’ємним");
        }

        $this->currency = $currency;
        $this->balance = $initialBalance;
    }

    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException("Сума поповнення має бути більше 0");
        }

        $this->balance += $amount;
    }

    public function withdraw(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException("Сума зняття має бути більше 0");
        }

        if ($this->balance - $amount < self::MIN_BALANCE) {
            throw new \Exception("Недостатньо коштів");
        }

        $this->balance -= $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
