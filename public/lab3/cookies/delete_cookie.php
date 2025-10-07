<?php
require_once __DIR__ . '/../lib/bootstrap.php';

setcookie('username', '', [
    'expires'  => time() - 3600,
    'path'     => '/',
    'secure'   => isset($_SERVER['HTTPS']),
    'httponly' => false,
    'samesite' => 'Lax',
]);

flash_set('Cookie видалено.', 'error');
redirect('index.php');
