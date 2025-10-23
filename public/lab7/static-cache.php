<?php

final class Memo
{
    private static array $store = [];
    public static function remember(string $key, callable $factory)
    {
        if (!array_key_exists($key, self::$store)) {
            self::$store[$key] = $factory();
        }
        return self::$store[$key];
    }
}

function expensiveCalc(): array
{
    sleep(1);
    return ['value' => random_int(1000, 9999), 'at' => date('H:i:s')];
}

header('Content-Type: application/json; charset=utf-8');

$first  = Memo::remember('calc', fn() => expensiveCalc());
$second = Memo::remember('calc', fn() => expensiveCalc());

echo json_encode(['first' => $first, 'second' => $second, 'note' => 'другий виклик взявся зі static'], JSON_UNESCAPED_UNICODE);
