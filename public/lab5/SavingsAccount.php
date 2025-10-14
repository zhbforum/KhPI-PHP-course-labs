<?php

require_once __DIR__ . '/BankAccount.php';

class SavingsAccount extends BankAccount
{
    public static float $interestRate = 5.0;

    public function applyInterest(): void
    {
        if (self::$interestRate <= 0) {
            return;
        }

        $interest = $this->balance * (self::$interestRate / 100.0);
        if ($interest > 0) {
            $this->deposit($interest);
        }
    }
}
