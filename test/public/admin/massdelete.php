<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['student_ids']) && !empty($_POST['student_ids'])) {
    $studentIds = $_POST['student_ids'];
    $idsToDelete = implode(",", array_map('intval', $studentIds));

    $sql = "DELETE FROM students WHERE id IN ($idsToDelete)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Selected students have been deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting students: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "No students selected for deletion.";
}

header("Location: view-students.php");
exit();
?>
