<?php

function h(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url, int $code = 302): never
{
    header("Location: {$url}", true, $code);
    exit;
}

function arr_get(array $a, string $key, $default = null)
{
    return $a[$key] ?? $default;
}

function cookie_json_get(string $name): array
{
    if (!isset($_COOKIE[$name])) return [];
    $data = json_decode($_COOKIE[$name], true);
    return is_array($data) ? $data : [];
}

function cookie_json_set(string $name, array $value, int $days = 7): void
{
    $expires = time() + 60 * 60 * 24 * $days;
    setcookie($name, json_encode($value, JSON_UNESCAPED_UNICODE), [
        'expires'  => $expires,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => false,
        'samesite' => 'Lax',
    ]);
}
