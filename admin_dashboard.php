<?php
// Start the session and include necessary files (database, auth, etc.)
session_start();
include_once 'database.php'; // Database connection
// include_once 'admin_auth.php'; // Authentication check to verify admin role

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch products and orders for display
$product = $pdo->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
$orders = $pdo->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_ASSOC);

// Handle actions like adding or updating products, managing orders, etc.
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add_product') {
        // Code to add a product
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = $_FILES['image']['name'];

        // Upload product image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        $sql = "INSERT INTO product (product_name, price, stock, image) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $stock, $image]);
        echo "Product added successfully.";
        
        // Refresh products after adding
        $product = $pdo->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($_POST['action'] === 'update_order_status') {
        // Code to update order status
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $order_id]);
        echo "Order status updated.";
        
        // Refresh orders after updating
        $orders = $pdo->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--link rel="stylesheet" href="index.css"-->
</head>
<body>
<style>
/* General Styles */
body {
    background-color: #f4f5f7;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
   /* width: 80%;
    margin: auto;
    padding-top: 20px;*/
    width: 90%;
    margin: 0 auto;
    max-width: 1200px;
}
.header {
    background-color: #ffb347;
    padding: 60px 0;
    text-align: center;
    background-size: cover;
}

.header h1 {
    font-size: 48px;
    color: black;
    margin-bottom: 10px;
}
/* Tabs */
.tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 2px solid #ddd; /* Adds a bottom border for separation */
}

.tablinks {
    background-color:  #f39c12;
    color: white;
    border: none;
    padding: 15px 25px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 12px;
    border-radius: 5px 5px 0 0; /* Rounded top corners */
    margin-right: 5px; /* Space between tabs */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.tablinks:last-child {
    margin-right: 0; /* Remove margin for the last tab */
}

.tablinks:hover {
    background-color: #e51e5a;
}

.tabcontent {
    display: none;
    padding: 20px; /* Padding around the content */
    border: 1px solid #ddd; /* Border around content */
    border-top: none; /* Remove top border to merge with tabs */
    border-radius: 0 0 5px 5px; /* Rounded bottom corners */
    background-color: white; /* Background color for content */
}

/* Active tab styling */
.tablinks.active {
    background-color: #e51e5a; /* Change background for active tab */
    color: white; /* Ensures text is readable */
    font-weight: bold; /* Makes the active tab text bold */
}


/* Table Styles */
.products-table, .orders-table {
    width: 100%;
    background-color: white;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.products-table th, .orders-table th, .products-table td, .orders-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.products-table th, .orders-table th {
    background-color: #f7f7f7;
    color: #333;
}

.products-table tbody tr:hover, .orders-table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Form and Button Styles */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"], .form-group input[type="number"], .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    background-color: #f7246d;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #e51e5a;
}
</style>
<div class="container">
    <h1>Admin Dashboard</h1>
    
    <!-- Tabs for Navigation -->
    <div class="tabs">
        <button class="tablinks" onclick="openTab(event, 'products')">Manage Products</button>
        <button class="tablinks" onclick="openTab(event, 'orders')">Manage Orders</button>
        <button class="tablinks" onclick="openTab(event, 'reports')">Sales Reports</button>
    </div>

    <!-- Manage Products Section -->
    <div id="products" class="tabcontent">
        <h2>Manage Products</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_product">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            <button type="submit">Add Product</button>
        </form>

        <h3>Product Listings</h3>
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($product)): ?>
                    <?php foreach ($product as $products): ?>
                        <tr>
                            <td><?= htmlspecialchars($products['id']) ?></td>
                            <td><?= htmlspecialchars($products['product_name']) ?></td>
                            <td><?= htmlspecialchars($products['price']) ?></td>
                            <td><?= htmlspecialchars($products['stock']) ?></td>
                            <td><img src="uploads/<?= htmlspecialchars($products['image']) ?>" alt="Product Image" width="50"></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No products found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Manage Orders Section -->
    <div id="orders" class="tabcontent">
        <h2>Manage Orders</h2>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td><?= htmlspecialchars($order['total']) ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="action" value="update_order_status">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                                    <select name="status">
                                        <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Shipped" <?= $order['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                        <option value="Delivered" <?= $order['status'] === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                    </select>
                                    <button type="submit">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No orders found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Sales Reports Section -->
    <div id="reports" class="tabcontent">
        <h2>Sales Reports</h2>
        <p>Here, you can generate and view sales reports.</p>
    </div>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Default open the Products tab on page load
document.getElementById("products").style.display = "block";
</script>

</body>
</html>
