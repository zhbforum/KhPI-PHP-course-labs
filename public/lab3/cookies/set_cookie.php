<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$name = trim((string)arr_get($_POST, 'username', ''));
if ($name === '') {
    $_SESSION['flash'] = 'Ім’я не може бути порожнім.';
    redirect('index.php');
}

setcookie('username', $name, [
    'expires'  => time() + 7 * 24 * 60 * 60,
    'path'     => '/',
    'secure'   => isset($_SERVER['HTTPS']),
    'httponly' => false,
    'samesite' => 'Lax',
]);

$_SESSION['flash'] = 'Ім’я збережене в cookie.';
redirect('index.php');
