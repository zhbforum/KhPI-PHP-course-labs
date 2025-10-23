<?php

$ttl = 86400;

header('Content-Type: image/png');
header('Cache-Control: public, max-age=' . $ttl);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $ttl) . ' GMT');

$size = 160;
$im   = imagecreatetruecolor($size, $size);
$bg   = imagecolorallocate($im, 79, 70, 229);
$fg   = imagecolorallocate($im, 255, 255, 255);

imagefilledrectangle($im, 0, 0, $size, $size, $bg);
imagestring($im, 5, 22, 70, 'CACHE', $fg);

imagepng($im);
imagedestroy($im);
