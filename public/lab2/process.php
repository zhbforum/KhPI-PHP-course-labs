<?php

require_once __DIR__ . '/bootstrap.php';

ensure_upload_dir();

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed.');
}

if (!isset($_FILES['file'])) {
    http_response_code(400);
    exit('No file received.');
}

$file = $_FILES['file'];

if (!empty($file['error'])) {
    $msg = PHP_UPLOAD_ERRORS[$file['error']] ?? 'Unknown upload error.';
    http_response_code(400);
    exit(e($msg));
}

if (!is_uploaded_file($file['tmp_name'])) {
    http_response_code(400);
    exit('File is not a valid uploaded file.');
}

if ($file['size'] > MAX_BYTES) {
    http_response_code(400);
    exit('File size exceeds 2 MB limit.');
}

$origName = $file['name'] ?? 'file';
$basename = basename($origName);
$ext = strtolower(pathinfo($basename, PATHINFO_EXTENSION));
if (!in_array($ext, ALLOWED_EXTENSIONS, true)) {
    http_response_code(400);
    exit('Only PNG, JPG, JPEG images are allowed.');
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = $finfo->file($file['tmp_name']) ?: 'application/octet-stream';
if (!in_array($mime, ALLOWED_MIME_TYPES, true)) {
    http_response_code(400);
    exit('Unsupported MIME type.');
}

$cleanBase = preg_replace('/[^A-Za-z0-9._-]/', '_', $basename);
if ($cleanBase === '' || $cleanBase[0] === '.') {
    $cleanBase = "image.{$ext}";
}

$targetPath = UPLOAD_DIR . DIRECTORY_SEPARATOR . $cleanBase;
$finalName  = $cleanBase;
$wasRenamed = false;

if (file_exists($targetPath)) {
    $nameOnly   = pathinfo($cleanBase, PATHINFO_FILENAME);
    $suffix     = date('Ymd_His') . '_' . random_int(1000, 9999);
    $finalName  = "{$nameOnly}_{$suffix}.{$ext}";
    $targetPath = UPLOAD_DIR . DIRECTORY_SEPARATOR . $finalName;
    $wasRenamed = true;
}

if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    http_response_code(500);
    exit('Failed to save the uploaded file.');
}

$sizeKb = number_format($file['size'] / 1024, 2);
$downloadUrl = "uploads/" . rawurlencode($finalName);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="<?= APP_CHARSET ?>">
    <title>Upload result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>File uploaded successfully</h1>
    <?php if ($wasRenamed): ?>
        <p><strong>Note:</strong> A file with the same name already existed. New file name: <code><?=
                                                                                                    e($finalName) ?></code></p>
    <?php endif; ?>
    <ul>
        <li>Original name: <code><?= e($origName) ?></code></li>
        <li>Saved as: <code><?= e($finalName) ?></code></li>
        <li>MIME type: <code><?= e($mime) ?></code></li>
        <li>Size: <code><?= e("{$sizeKb} KB") ?></code></li>
    </ul>
    <p>
        <a href="<?= e($downloadUrl) ?>" download>Download file</a> &nbsp;|&nbsp;
        <a href="index.html">Back</a> &nbsp;|&nbsp;
        <a href="list.php">File list</a>
    </p>
    <p><img src="<?= e($downloadUrl) ?>" alt="Uploaded image" style="max-width:100%;height:auto" /></p>
</body>

</html>