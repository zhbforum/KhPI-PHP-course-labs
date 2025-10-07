<?php
require_once __DIR__ . '/lib/bootstrap.php';
?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>Lab3 cookies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Lab3 global arrays(Cookie, Session, Server)</h1>
            <?php if ($f = flash_get()): ?>
                <div class="flash <?= h($f['type']) ?>"><?= h($f['message']) ?></div>
            <?php endif; ?>
            <ul>
                <li><a href="cookies/">$_COOKIE — привітання та видалення</a></li>
                <li><a href="session_login/login.php">$_SESSION — логін/вихід</a></li>
                <li><a href="server_info/form.php">$_SERVER — інформація про запит (POST)</a></li>
                <li><a href="cart/products.php">Cookie + Session — кошик + попередні покупки</a></li>
            </ul>
        </div>
    </div>
</body>

</html>