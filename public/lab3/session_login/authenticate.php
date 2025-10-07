<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$login = trim((string)arr_get($_POST, 'login', ''));
$pass  = (string)arr_get($_POST, 'password', '');

if ($login === 'admin' && $pass === 'admin') {
    $_SESSION['user'] = [
        'login' => $login,
        'role'  => 'admin',
        'login_at' => time(),
    ];
    redirect('dashboard.php');
} else {
    $_SESSION['flash'] = 'Невірний логін або пароль.';
    redirect('login.php');
}
