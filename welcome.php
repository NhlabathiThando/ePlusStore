<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['user_id'])) {
// If not logged in, redirect to login page
header('Location: login.php');
    exit();
}

$customer_name = $_SESSION['user_name']; // Retrieve customer name from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $customer_name ; ?>!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($customer_name); ?>!</h1>
        <p>Thank you for signing up! We're excited to have you onboard.</p>
        <p>You can now explore our products, view your profile, and much more.</p>

        <div class="welcome-actions">
            <a href="products.php" class="btn">Explore Products</a>
            <a href="profile.php" class="btn">View Profile</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>

</body>
</html>
