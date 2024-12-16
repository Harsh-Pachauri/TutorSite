<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['tutor_ids']) && !empty($_POST['tutor_ids'])) {
    $tutorIds = $_POST['tutor_ids'];
    $idsToDelete = implode(",", array_map('intval', $tutorIds));

    // First, delete all related entries in tutor_subjects for the selected tutors
    $deleteSubjectsSql = "DELETE FROM tutor_subjects WHERE tutor_id IN ($idsToDelete)";
    if ($conn->query($deleteSubjectsSql) === TRUE) {

        // Now delete the selected tutors
        $deleteTutorsSql = "DELETE FROM tutors WHERE id IN ($idsToDelete)";
        if ($conn->query($deleteTutorsSql) === TRUE) {
            $_SESSION['message'] = "Selected tutors have been deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting tutors: " . $conn->error;
        }

    } else {
        $_SESSION['error'] = "Error deleting related subjects: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "No tutors selected for deletion.";
}

header("Location: view-tutors.php");
exit();
?>
