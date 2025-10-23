<?php

$cacheDir  = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/report.html';
$ttl       = 600;

is_dir($cacheDir) || mkdir($cacheDir, 0777, true);

$useCache = is_file($cacheFile) && (time() - filemtime($cacheFile) < $ttl);

if ($useCache) {
    $html   = file_get_contents($cacheFile);
    $source = 'from FILE CACHE';
} else {
    $source = 'generated';
    $html   = buildReportHtml($source);
    file_put_contents($cacheFile, $html);
}

header('Content-Type: text/html; charset=utf-8');
echo $html;
exit;

function buildReportHtml(string $source): string
{
    sleep(3);

    $rows = [];
    $now = new DateTimeImmutable();
    for ($i = 1; $i <= 1000; $i++) {
        $name = sprintf('Client %04d', $i);
        $sum  = number_format(random_int(1000, 100000) / 100, 2);
        $date = $now->sub(new DateInterval('P' . random_int(0, 365) . 'D'))->format('Y-m-d');
        $rows[] = "<tr><td>{$i}</td><td>{$name}</td><td>\${$sum}</td><td>{$date}</td></tr>";
    }

    $table = implode('', $rows);
    $stamp = date('H:i:s');
    $src   = htmlspecialchars($source, ENT_QUOTES, 'UTF-8');

    return <<<HTML
<!doctype html>
<html lang="uk">
<meta charset="utf-8">
<title>Report ({$stamp})</title>
<link rel="stylesheet" href="./css.php">
<body>
<div class="card"><b>Звіт</b> <small class="muted">({$stamp})</small></div>
<div class="card">
<table border="1" cellpadding="6" cellspacing="0">
<thead><tr><th>#</th><th>Імʼя</th><th>Сума</th><th>Дата</th></tr></thead>
<tbody>{$table}</tbody>
</table>
</div>
<div class="card"><small class="muted">Джерело: {$src}</small></div>
</body></html>
HTML;
}
