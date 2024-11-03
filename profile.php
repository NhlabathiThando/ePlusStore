<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) { // Change 'user_id' to 'customer_id' to match your session variable
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}

// Include database connection file
include 'database.php'; // Ensure this file establishes a correct PDO connection

$customer_id = $_SESSION['customer_id']; // Using 'customer_id' from the session

// Fetch the customer's details from the database
$sql = "SELECT * FROM users WHERE id = :id"; // Use a named parameter for PDO
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $customer_id, PDO::PARAM_INT); // Bind the correct variable
$stmt->execute();
$customer = $stmt->fetch();

// Check if customer data was found
if (!$customer) {
    // Handle the case where no customer data is found
    echo "Customer not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($customer['name']); ?>'s Profile</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="profile-container">
    <h1>Your Profile</h1>

    <div class="profile-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($customer['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
        <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($customer['created_at'])); ?></p>
    </div>

    <div class="profile-actions">
        <a href="edit_profile.php" class="btn">Edit Profile</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

</body>
</html>
