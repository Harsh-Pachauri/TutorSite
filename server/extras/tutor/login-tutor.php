<?php
session_start();
include '../config.php'; // Database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch tutor details
    $sql = "SELECT * FROM tutors WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the tutor exists
    if ($result->num_rows == 1) {
        $tutor = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $tutor['hashed_password'])) {
            // Store tutor info in session and redirect to tutor dashboard
            $_SESSION['tutor'] = $tutor['id'];
            $_SESSION['role']=$tutor['role'];
            header("Location: ../../public/tutors/index.php");
            exit();
        } else {
            header("Location: login-error.php");
        }
    } else {
        header("Location: login-error.php");
    }
}
?>
