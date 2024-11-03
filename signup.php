<?php
session_start(); // Start session to handle user data
// Include the database connection file
require 'database.php'; // Ensure this matches the file containing the PDO connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    // Validate the form fields
    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        echo "All fields are required!";
        exit();
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user into the database using PDO
    $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    
    // Use PDO to prepare and execute the query
    try {
        // Prepare the statement
        $stmt = $pdo->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            // Registration successful, store session data
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;

            // Redirect to a welcome page or dashboard
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error: Could not execute query.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
