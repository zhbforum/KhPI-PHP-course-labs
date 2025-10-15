<?php

require __DIR__ . '/config.php';

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;

    $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';options=\'--client_encoding=UTF8\'';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

function hash_password(string $plain): string
{
    if (USE_MD5) return md5($plain);
    return password_hash($plain, PASSWORD_DEFAULT);
}


function verify_password(string $plain, string $stored): bool
{
    if (USE_MD5) return md5($plain) === $stored;
    return password_verify($plain, $stored);
}
