<?php
// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$host = 'localhost';       // Database host (default: localhost)
$dbname = 'rice_db';       // Name of your database
$username = 'root';        // Database username (default: root)
$password = '';            // Database password (leave blank if none)

// Database connection
try {
    // Create a new PDO instance for the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the connection fails, display an error message
    die("Database connection failed: " . $e->getMessage());
}
?>
