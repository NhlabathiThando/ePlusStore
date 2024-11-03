<?php
session_start();
include('database.php');

// Check if the cart session exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $cart_empty = true;
} else {
    // Fetch product details from the database based on product IDs in the cart
    $cart_items = $_SESSION['cart'];
    $placeholders = implode(',', array_fill(0, count($cart_items), '?')); // Create placeholders for SQL query

    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($cart_items)), ...$cart_items);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_products = $result->fetch_all(MYSQLI_ASSOC);
    $cart_empty = false;
}

// Function to calculate the total price
function calculateTotalPrice($products) {
    $total = 0;
    foreach ($products as $product) {
        $total += $product['price'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-left">
                <h2>+Plus Shop</h2>
            </div>
            <div class="navbar-right">
                <a href="products.php" class="icon-link">Products</a>
                <a href="logout.php" class="icon-link"><i class='bx bx-log-out'></i> Logout</a>
            </div>
        </div>
    </nav>

    <!-- Cart Section -->
    <section class="cart">
        <div class="container">
            <h1>Your Cart</h1>
            
            <?php if ($cart_empty): ?>
                <p>Your cart is empty. <a href="products.php">Go shopping!</a></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_products as $product): ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td>
                                    <form action="remove_from_cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h3>Total: $<?php echo number_format(calculateTotalPrice($cart_products), 2); ?></h3>

                <form action="checkout.php" method="POST">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            <?php endif; ?>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
