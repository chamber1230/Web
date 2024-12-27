<?php
// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//prod db
// Database configuration
$host = 'localhost';       // Database host (default: localhost)
$dbname = 'u143688490_rice_store';       // Name of your database
$username = 'u143688490_chambe';        // Database username (default: root)
$password = 'Fujiwara000!';            // Database password (leave blank if none)

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
