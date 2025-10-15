<?php

session_start();

require_once __DIR__ . '/config/db.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Введіть логін і пароль.'];
    header('Location: index.php#login');
    exit;
}

try {
    $pdo = db();
    $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :u LIMIT 1');
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    if (!$user || !verify_password($password, $user['password'])) {
        $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Невірні облікові дані.'];
        header('Location: index.php#login');
        exit;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['username'] = $user['username'];

    header('Location: welcome.php');
    exit;
} catch (Throwable $e) {
    $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Помилка сервера.'];
    header('Location: index.php#login');
    exit;
}
