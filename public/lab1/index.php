<?php

/**
 * Part 1:
 * Create a basic PHP script that outputs "Hello, World!".
 */
echo "Hello, World!<br><br>";

/**
 * Part 2:
 * Variables and data types.
 */
$name = "Name";
$age = 25;
$height = 1.89;
$isAuthenticated = true;

echo "String: $name <br>";
echo "Integer: $age <br>";
echo "Float: $height <br>";
echo "Boolean: " . ($isAuthenticated ? "true" : "false") . "<br><br>";

// Pretty var_dump
echo '<pre>';
var_dump($name);
var_dump($age);
var_dump($height);
var_dump($isAuthenticated);
echo '</pre><br><br>';

/**
 * Part 3:
 * String concatenation.
 */
// Hint PHP7103: Interpolation is usually cleaner and more readable than concatenation
$firstString = "Hello,";
$secondString = "World";
$fullString = "$firstString $secondString";
echo "$fullString<br><br>";

/**
 * Part 4:
 * Conditional statements (if-else).
 */
$number = 33;
if ($number % 2 === 0) {
    echo "$number is even.<br><br>";
} else {
    echo "$number is odd.<br><br>";
}

/**
 * Part 5:
 * Loops (for and while).
 */
// For: 1..10
for ($i = 1; $i <= 10; $i++) {
    echo "$i ";
}
echo "<br><br>";

$counter = 10;
while ($counter >= 1) {
    echo "$counter ";
    $counter--;
}
echo "<br><br>";

/**
 * Part 6:
 * Arrays — associative array with student info
 */
$student = [
    'first_name' => 'Mark',
    'last_name'  => 'Zuckerberg',
    'age'        => 19,
    'major'      => 'Computer Science',
];

echo "Student info:<br>";
echo "First name: {$student['first_name']}<br>";
echo "Last name: {$student['last_name']}<br>";
echo "Age: {$student['age']}<br>";
echo "Major: {$student['major']}<br><br>";

// 100-point average score
$student['average_score'] = 87;

echo "<strong>Updated array:</strong><br>";
foreach ($student as $key => $value) {
    echo "$key: $value<br>";
}
