<?php

session_start();

$ttl = 600;

if (isset($_SESSION['rates'], $_SESSION['rates_time']) && (time() - $_SESSION['rates_time'] < $ttl)) {
    $data   = $_SESSION['rates'];
    $source = 'з кешу сесії';
} else {
    $data   = generateRates();
    $_SESSION['rates'] = $data;
    $_SESSION['rates_time'] = time();
    $source = 'згенеровано наново';
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'source' => $source,
    'data'   => $data,
    'time'   => date('H:i:s'),
], JSON_UNESCAPED_UNICODE);

function generateRates(): array
{
    sleep(2);
    return [
        'usd' => random_int(35, 45),
        'eur' => random_int(40, 49),
        'gbp' => random_int(44, 55),
    ];
}
