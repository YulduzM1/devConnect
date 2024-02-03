<?php
// Database configuration
$host = 'localhost'; // Change this to your MySQL host
$dbname = 'devMingle_db'; // Change this to your database name
$username = 'root'; // Change this to your MySQL username
$password = ''; // Change this to your MySQL password
$port = 4306;

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set PDO to return rows as associative arrays by default
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Optional: Set character encoding to UTF-8
    $pdo->exec("SET NAMES 'utf8'");
    echo "Connection successful.";
} catch (PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}

