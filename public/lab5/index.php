<?php

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/SavingsAccount.php';

$LOG = [];

function logMsg(string $text, string $type = 'info'): void
{
    $GLOBALS['LOG'][] = ['type' => $type, 'text' => $text];
}

function out(string $label, float $amount, string $currency = 'USD'): void
{
    logMsg($label . ': ' . number_format($amount, 2, '.', ' ') . " {$currency}", 'ok');
}


function safe(callable $callback): void
{
    try {
        $callback();
    } catch (\InvalidArgumentException $e) {
        logMsg("Помилка вхідних даних: {$e->getMessage()}", 'error');
    } catch (\Exception $e) {
        logMsg("Помилка операції: {$e->getMessage()}", 'error');
    } catch (\Throwable $e) {
        logMsg("Несподівана помилка: {$e->getMessage()}", 'error');
    }
}


logMsg('Тест BankAccount', 'title');
safe(function () {
    $acc = new BankAccount('USD', 100.00);
    out('Початковий баланс', $acc->getBalance());

    $acc->deposit(50.00);
    out('Після поповнення +50', $acc->getBalance());

    $acc->withdraw(30.00);
    out('Після зняття -30', $acc->getBalance());

    $acc->withdraw(1000.00);
});

logMsg('Тест SavingsAccount', 'title');
safe(function () {
    $sav = new SavingsAccount('EUR', 500.00);
    out('Старт', $sav->getBalance(), 'EUR');

    SavingsAccount::$interestRate = 6.5;
    logMsg('Ставка: ' . SavingsAccount::$interestRate . '%', 'info');

    $sav->applyInterest();
    out('Після нарахування %', $sav->getBalance(), 'EUR');

    $sav->deposit(200.00);
    out('Після поповнення +200', $sav->getBalance(), 'EUR');

    $sav->withdraw(50.00);
    out('Після зняття -50', $sav->getBalance(), 'EUR');

    safe(fn() => $sav->deposit(0));
    safe(fn() => $sav->withdraw(-10));
    safe(fn() => $sav->withdraw(10000));
});

?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Lab5 oop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Lab5 oop</h1>
        <ul class="log">
            <?php foreach ($LOG as $item): ?>
                <?php if ($item['type'] === 'title'): ?>
                    <li class="title"><?= htmlspecialchars($item['text']) ?></li>
                <?php else: ?>
                    <li class="row">
                        <span class="badge <?= htmlspecialchars($item['type']) ?>">
                            <?= strtoupper(htmlspecialchars($item['type'])) ?>
                        </span>
                        <span class="text"><?= htmlspecialchars($item['text']) ?></span>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>