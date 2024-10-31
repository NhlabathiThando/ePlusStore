<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Default XAMPP MySQL password is empty
$dbname = "plus"; // Make sure this matches your database

try {
    // Create a new PDO instance and set attributes for error handling
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set error mode to exception to handle errors more elegantly
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set fetch mode to associative arrays by default
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Connection successful message (for development; remove in production)
    echo "Connected successfully<br>\n";
} catch (PDOException $e) {
    // If there is a connection error, display it (in production, you might want to log this instead of showing it to users)
    die("Connection failed: " . $e->getMessage());
}
?>
