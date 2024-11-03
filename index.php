<?php
// Start the session
session_start();

// Check if the user is logged in by checking the session variable (assuming you set it when logging in)
$is_logged_in = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+Plus</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .logo h1 {
        font-size: 24px;
        font-weight: bold;
        color: black;
    }

    .search-bar input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px 0 0 5px;
        outline: none;
    }

    .search-bar button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 8px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .search-bar button i {
        font-size: 16px;
    }

    .icons a {
        color: #333;
        font-size: 18px;
        margin-left: 20px;
        text-decoration: none;
        position: relative;
    }

    .icons a span {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 2px 5px;
        border-radius: 50%;
    }
</style>
<!-- Header Section -->
<header class="py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div class="logo">
            <h1>+Plus</h1>
        </div>

        <!-- Search Bar -->
        <form class="search-bar d-flex w-50">
            <input type="text" placeholder="Search for products...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- Icons -->
        <div class="icons d-flex">
            <?php if (!$is_logged_in): ?>
                <a href="login.php"><i class="fas fa-user"></i></a> <!-- User Icon -->
            <?php else: ?>
                <span>Welcome, User!</span>
                <a href="logout.php" class="icon-link"><i class='fas fa-user'></i> Logout</a>
            <?php endif; ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a> <!-- Cart Icon -->
            <a href="#"><i class="fas fa-heart"></i><span>0</span></a> <!-- Wishlist Icon -->
            <a href="contact.php"><i class="fas fa-headset"></i></a> <!-- Support Icon -->
        </div>
    </div>
</header>

<!-- Hero Section -->
<header class="header text-center py-5 bg-warning text-white" style="background-image: url('Home.png'); background-size: cover;">
    <div class="container">
        <h1>High Quality Food</h1>
        <p>Save 30% on your first AutoShip order</p>
    </div>
</header>

<!-- Categories Section -->
<section class="categories py-5 bg-light">
    <div class="container">
        <h2 class="text-center">Top Categories</h2>
        <div class="row text-center mt-4">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="product.php?id=1">
                    <img src="1.jpeg" class="img-fluid rounded-circle mb-2" alt="Grocery">
                    <h3>Grocery</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="product.php?id=2">
                    <img src="4.jpg" class="img-fluid rounded-circle mb-2" alt="Burger">
                    <h3>Burgers</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="product.php?id=3">
                    <img src="2.jpg" class="img-fluid rounded-circle mb-2" alt="Pizza">
                    <h3>Pizza</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="product.php?id=4">
                    <img src="18.jpeg" class="img-fluid rounded-circle mb-2" alt="Beverages">
                    <h3>Beverages</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Best Seller Section -->
<section class="best-seller py-5">
    <div class="container">
        <h2 class="text-center">Best Seller</h2>
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img src="10.jpg" class="img-fluid" alt="Product 1">
                <h3>Product 1</h3>
                <p>R19.99</p>
                <button class="btn btn-danger">Add to Cart</button>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img src="2.jpg" class="img-fluid" alt="Product 2">
                <h3>Product 2</h3>
                <p>R24.99</p>
                <button class="btn btn-danger">Add to Cart</button>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img src="3.jpg" class="img-fluid" alt="Product 3">
                <h3>Product 3</h3>
                <p>R29.99</p>
                <button class="btn btn-danger">Add to Cart</button>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer py-4 bg-dark text-white text-center">
    <div class="container">
<p>© 2024 +Plus | All Rights Reserved</p>
    </div>
</footer>
<script src="script.js"></script>
</body>
</html>
