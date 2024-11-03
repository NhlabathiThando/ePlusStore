<?php
// Include the database connection
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product details from the form
    $name = $_POST['name'];
    $description = $_POST['price'];
    $price = $_POST['product_detail'];
    $image = $_FILES['image']['name'];
    
    // Upload product image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    
    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (name, price, product_detail, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $price, $product_detail, $target_file);
    $stmt->execute();
    
    echo "Product added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Product</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .form-control { margin-bottom: 10px; padding: 10px; }
        .form-group { margin-bottom: 15px; }
        button { padding: 10px 15px; }
    </style>
    <h1>Add New Product</h1>
    <form action="admin_products.php" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Price:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Description:</label><br>
        <input type="number" name="price" required><br><br>

        <label>Image:</label><br>
        <input type="file" name="image" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
