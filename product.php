<?php
// Start session
session_start();

// Include the database connection
include('database.php');

// Fetch all products from the database
$query = $conn->prepare("SELECT * FROM products");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="icon-link"><i class='bx bx-user'></i> Login</a>
                    <a href="register.php" class="icon-link"><i class='bx bx-user-plus'></i> Sign Up</a>
                <?php else: ?>
                    <span>Welcome, User!</span>
                    <a href="logout.php" class="icon-link"><i class='bx bx-log-out'></i> Logout</a>
                <?php endif; ?>
                <a href="cart.php" class="icon-link"><i class='bx bx-cart'></i> Cart</a>
            </div>
        </div>
    </nav>

    <!-- Products Section -->
    <section class="products">
        <div class="container">
            <h1>Our Products</h1>
            <div class="product-grid">
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
                        <button class="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
