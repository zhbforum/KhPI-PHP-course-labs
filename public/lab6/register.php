<?php

session_start();

require_once __DIR__ . '/config/db.php';

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $email === '' || $password === '') {
    $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Заповніть усі поля'];
    header('Location: index.php#register');
    exit;
}

try {
    $pdo = db();

    $q = $pdo->prepare('SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1');
    $q->execute([':u' => $username, ':e' => $email]);
    if ($q->fetch()) {
        $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Такий користувач або email вже існує'];
        header('Location: index.php#register');
        exit;
    }

    $hash = hash_password($password);

    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:u, :e, :p)');
    $stmt->execute([':u' => $username, ':e' => $email, ':p' => $hash]);

    $_SESSION['flash'] = ['type' => '', 'msg' => 'Реєстрація успішна. Увійдіть.'];
    header('Location: index.php#login');
    exit;
} catch (Throwable $e) {
    $_SESSION['flash'] = ['type' => 'err', 'msg' => 'Помилка сервера.'];
    header('Location: index.php#register');
    exit;
}
