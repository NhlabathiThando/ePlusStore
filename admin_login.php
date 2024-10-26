<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Login</title>
</head>
<body>
    <section class="form-container">
        <form method="post" action="admin_login.php">
            <h1>Login</h1>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="submit" name="login-btn" value="Login">
           
            <?php
            // Display error message if login fails
            if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            ?>
        </form>
    </section>
</body>
</html>
<?php
// Include the admin authentication script
include_once 'admin_auth.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login-btn'])) {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the adminLogin function to authenticate the admin
    $error = adminLogin($email, $password);

    // If authentication fails, the error message will be displayed on the form
}
?>
