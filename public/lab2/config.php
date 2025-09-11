<?php

const APP_CHARSET        = 'UTF-8';

const BASE_DIR           = __DIR__;
const UPLOAD_DIR         = BASE_DIR . DIRECTORY_SEPARATOR . 'uploads';

const MAX_BYTES          = 2 * 1024 * 1024;
const ALLOWED_EXTENSIONS = ['png', 'jpg', 'jpeg'];
const ALLOWED_MIME_TYPES = ['image/png', 'image/jpeg'];

const PHP_UPLOAD_ERRORS = [
    UPLOAD_ERR_INI_SIZE   => 'Exceeded upload_max_filesize.',
    UPLOAD_ERR_FORM_SIZE  => 'Exceeded MAX_FILE_SIZE (form).',
    UPLOAD_ERR_PARTIAL    => 'File only partially uploaded.',
    UPLOAD_ERR_NO_FILE    => 'No file uploaded.',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder.',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
    UPLOAD_ERR_EXTENSION  => 'Upload stopped by a PHP extension.',
];
