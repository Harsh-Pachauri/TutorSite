<?php
session_start();
include '../../server/config.php';

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Check if the required parameters are present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status']) && isset($_POST['remarks']) && isset($_POST['role'])) {
    // Get the posted data
    $id = intval($_POST['id']);
    $new_status = $_POST['status'];
    $new_remarks = $_POST['remarks'];
    $role = $_POST['role']; // Get the role (student or tutor)

    // Determine the correct table for the update
    if ($role === 'student') {
        $table = 'students';
    } elseif ($role === 'tutor') {
        $table = 'tutors';
    } else {
        echo "Invalid role!";
        exit();
    }

    // Update both status and remarks in the database
    $updateSql = "UPDATE $table SET status = ?, remarks = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssi', $new_status, $new_remarks, $id); // 'ssi' means string, string, and integer

    if ($stmt->execute()) {
        // Redirect back to the appropriate view page after updating
        header("Location: view-{$role}s.php"); // Redirect based on role
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If accessed directly, redirect to the appropriate view page
    header("Location: view-students.php"); // Default to students
    exit();
}
?>
