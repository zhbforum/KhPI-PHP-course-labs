<?php require_once __DIR__ . '/../lib/bootstrap.php'; ?>
<!doctype html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <title>$_SERVER — Форма</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Надішліть POST, щоб побачити $_SERVER</h1>
            <form action="index.php" method="post">
                <button type="submit" class="btn">Відправити POST</button>
            </form>
            <div class="actions">
                <a class="btn outline" href="../index.php">← На головну</a>
            </div>
        </div>
    </div>
</body>

</html>