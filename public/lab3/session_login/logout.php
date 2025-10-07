<?php
require_once __DIR__ . '/../lib/bootstrap.php';

session_unset();
session_destroy();
session_start();
$_SESSION['flash'] = 'Ви вийшли з облікового запису.';
redirect('../index.php');
