<?php

require_once __DIR__ . '/config.php';

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, APP_CHARSET);
}

function ensure_upload_dir(): void
{
    if (
        !is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0775, true)
        && !is_dir(UPLOAD_DIR)
    ) {
        http_response_code(500);
        exit('Failed to create uploads directory.');
    }
}
