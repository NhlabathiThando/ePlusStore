<?php
session_start();
include('database.php');

// Here, you can add checkout logic such as payment processing, saving orders to the database, etc.
// After the order is placed, you can clear the cart.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the order is processed successfully
    unset($_SESSION['cart']); // Clear the cart
    header('Location: order_confirmation.php'); // Redirect to confirmation page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Checkout</h1>
    <p>Your order has been placed successfully!</p>

</body>
</html>
