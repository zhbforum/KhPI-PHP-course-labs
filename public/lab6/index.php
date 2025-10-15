<?php

session_start();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Lab6</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="card">
        <h1>Lab6 working with DB and auth</h1>
        <?php if ($flash): ?>
            <div class="flash <?= $flash['type'] ?? '' ?>"><?= htmlspecialchars($flash['msg'] ?? '') ?></div>
        <?php endif; ?>
        <div class="tabs">
            <a href="#register" onclick="show('register')">Реєстрація</a>
            <a href="#login" onclick="show('login')">Логін</a>
        </div>

        <div id="register">
            <form method="post" action="register.php" autocomplete="off">
                <div>
                    <label>Ім'я користувача</label>
                    <input name="username" required maxlength="50">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" required maxlength="100">
                </div>
                <div>
                    <label>Пароль</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Зареєструватися</button>
            </form>
        </div>

        <div id="login" style="display:none">
            <form method="post" action="login.php" autocomplete="off">
                <div>
                    <label>Ім'я користувача</label>
                    <input name="username" required maxlength="50">
                </div>
                <div>
                    <label>Пароль</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Увійти</button>
            </form>
        </div>
    </div>

    <script>
        function show(tab) {
            document.getElementById('register').style.display = tab === 'register' ? 'block' : 'none';
            document.getElementById('login').style.display = tab === 'login' ? 'block' : 'none';
            history.replaceState(null, '', '#' + tab);
        }
        (function() {
            const hash = location.hash.replace('#', '');
            if (hash === 'login') show('login');
            else show('register');
        })();
    </script>
</body>

</html>