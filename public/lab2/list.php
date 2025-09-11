<?php

require_once __DIR__ . '/bootstrap.php';

ensure_upload_dir();

$files = [];
$dir = new DirectoryIterator(UPLOAD_DIR);
foreach ($dir as $fileinfo) {
    if ($fileinfo->isDot()) continue;
    if (!$fileinfo->isFile()) continue;
    $files[] = $fileinfo->getFilename();
}
sort($files, SORT_NATURAL | SORT_FLAG_CASE);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="<?= APP_CHARSET ?>">
    <title>Files in uploads/</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Files in <code>uploads/</code></h1>
    <?php if (!$files): ?>
        <p>No files yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($files as $f):
                $href = 'uploads/' . rawurlencode($f); ?>
                <li><a href="<?= e($href) ?>" download><?= e($f) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <p><a href="index.html">Back</a></p>
</body>

</html>