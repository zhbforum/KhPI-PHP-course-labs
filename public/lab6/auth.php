<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Увійдіть для доступу до сторінки.'];
    header('Location: index.php#login');
    exit;
}
