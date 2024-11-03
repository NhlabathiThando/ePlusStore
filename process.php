<?php  
session_start();

// Include database connection file
include 'database.php'; // Ensure 'database.php' contains the correct PDO connection ($pdo)

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and sanitize the input data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate email and password
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header('Location: login.php');
        exit();
    }

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
       header('Location: welcome.php');
       
    }

    // Handle login failure
    $_SESSION['error'] = $user ? "Incorrect password. Please try again." : "No account found with this email address.";
    header('Location: login.php');
   
    exit();
}

// Redirect if the form was not submitted
header('Location: login.php');
exit();
?>
