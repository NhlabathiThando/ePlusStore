<?php
// Start the session
session_start();

// Function to check if the admin login credentials are correct
function adminLogin($email, $password) {
    // Hardcoded correct admin credentials
    $correctEmail = "Admin@gmail.com";
    $correctPassword = "P@ssword12";

    // Check if provided email and password match the correct ones
    if ($email === $correctEmail && $password === $correctPassword) {
        // Store admin ID and email in the session to maintain login state
        $_SESSION['admin_id'] = 2; // You can change this to a dynamic ID if needed
        $_SESSION['admin_email'] = $correctEmail;

        // Redirect to the admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // If authentication fails, return an error message
        return "Invalid email or password.";
    }
}

// Function to check if admin is logged in
function checkAdminAuth() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: admin_login.php");
        exit();
    }
}

// Function to log out admin
function adminLogout() {
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}
