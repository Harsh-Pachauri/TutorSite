<?php
include '../../server/config.php'; // Database connection
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

// Check if the required parameters are present
if (isset($_GET['id']) && isset($_GET['role'])) { // Change 'type' to 'role'
    $id = intval($_GET['id']); // Ensure ID is an integer
    $role = $_GET['role']; // Change 'type' to 'role'

    // Define the SQL query based on the role
    if ($role === 'student') {
        $sql = "DELETE FROM students WHERE id = ?";
        $redirectPage = 'view-students.php'; // Redirect after deletion
    } elseif ($role === 'tutor') {
        $sql = "DELETE FROM tutors WHERE id = ?";
        $redirectPage = 'view-tutors.php'; // Redirect after deletion
    } else {
        echo "Invalid user role!";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='$redirectPage';</script>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Missing required parameters.";
}

// Close the database connection
$conn->close();
?>
