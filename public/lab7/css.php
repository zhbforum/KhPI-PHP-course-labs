<?php


$ttl = 86400;

header('Content-Type: text/css; charset=utf-8');
header('Cache-Control: public, max-age=' . $ttl);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $ttl) . ' GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', strtotime('2024-01-01 00:00:00')) . ' GMT');

echo <<<CSS
:root { --brand:#4f46e5; --ink:#0f172a; }
body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Noto Sans', sans-serif; margin:0; padding:24px; color:var(--ink); }
h1 { margin:0 0 16px; }
.btn { display:inline-block; padding:10px 14px; border-radius:10px; border:1px solid #e5e7eb; text-decoration:none; }
.btn + .btn { margin-left:8px; }
.btn.primary { background:var(--brand); color:white; border-color:transparent; }
.card { border:1px solid #e5e7eb; border-radius:14px; padding:16px; margin:12px 0; }
small.muted { color:#64748b; }
CSS;
