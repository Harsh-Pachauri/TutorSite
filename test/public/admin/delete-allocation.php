<?php
session_start();
include '../../server/config.php';

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Check if allocation ID is set
if (isset($_POST['allocation_id'])) {
    $allocation_id = intval($_POST['allocation_id']);

    // Prepare and execute the delete statement
    $sql = "DELETE FROM teacher_allocations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $allocation_id);

    if ($stmt->execute()) {
        echo "Allocation deleted successfully.";
    } else {
        echo "Error deleting allocation: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
