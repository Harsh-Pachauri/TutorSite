<?php
session_start();
include '../config.php'; // Database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch admin details
    $sql = "SELECT * FROM admins WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the admin exists
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        
        // Verify the password
        if ($password == $admin['password']) {
            // Store admin info in session and redirect to dashboard
            $_SESSION['admin'] = $admin['id'];
            $_SESSION['role'] = $admin['role'];
            header("Location: ../../public/admin/index.php");
            exit();
        } else {
            header("Location: login-error.php");
        }
    } else {
        header("Location: login-error.php");
    }
}
?>
