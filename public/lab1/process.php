<?php

declare(strict_types=1);

/**
 * Part 7:
 * Process form data from index.html:
 *  - Validate non-empty values and string content.
 *  - Output a greeting using the submitted first and last name.
 */

const MAX_LENGTH_NAME = 20;
const APP_CHARSET = 'UTF-8';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, APP_CHARSET);
}


function validateName(string $value, string $label, string $pattern, int $maxLen): array
{
    $errors = [];

    if ($value === '') {
        $errors[] = "$label must not be empty.";
        return $errors;
    }

    if (mb_strlen($value, APP_CHARSET) > $maxLen) {
        $errors[] = "$label is too long (max $maxLen characters).";
    }

    if (!preg_match($pattern, $value)) {
        $errors[] = "$label contains invalid characters.";
    }

    return $errors;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo '<p>Invalid request method. Please submit the form from <a href="index.html">index.html</a>.</p>';
    exit;
}

$firstName = trim((string)($_POST['first_name'] ?? ''));
$lastName  = trim((string)($_POST['last_name']  ?? ''));

$firstName = preg_replace('/\s+/u', ' ', $firstName) ?? $firstName;
$lastName  = preg_replace('/\s+/u', ' ', $lastName)  ?? $lastName;

$pattern = '/^[\p{L}\s\'-]+$/u';

$errors = [
    ...validateName($firstName, 'First name', $pattern, MAX_LENGTH_NAME),
    ...validateName($lastName,  'Last name',  $pattern, MAX_LENGTH_NAME),
];

if ($errors) {
    echo '<h1>Validation errors</h1><ul>';
    foreach ($errors as $msg) {
        echo '<li>' . e($msg) . '</li>';
    }
    echo '</ul><p><a href="index.html">Go back to the form</a></p>';
    exit;
}

echo '<h1>Welcome!</h1>';
echo '<p>Hello, <strong>' . e($firstName) . ' ' . e($lastName) . '</strong></p>';

$fnNorm = mb_convert_case($firstName, MB_CASE_TITLE, APP_CHARSET);
$lnNorm = mb_convert_case($lastName,  MB_CASE_TITLE, APP_CHARSET);
echo '<p>(Normalized) Hello, <strong>' . e($fnNorm) . ' ' . e($lnNorm) . '</strong></p>';
echo '<p><a href="index.html">Back to form</a></p>';
