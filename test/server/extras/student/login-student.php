<?php
session_start();
include '../config.php'; // Database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch student details
    $sql = "SELECT * FROM students WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the student exists
    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $student['hashed_password'])) {
            // Store student info in session and redirect to student dashboard
            $_SESSION['student'] = $student['id'];
            $_SESSION['role']=$student['role'];
            header("Location: ../../public/students/index.php");
            exit();
        } else {
            header("Location: login-error.php");
        }
    } else {
        header("Location: login-error.php");
    }
}
?>
