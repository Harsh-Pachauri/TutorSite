<?php
session_start();
include '../../server/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tutorId = intval($_POST['tutor_id']);
    $fullName = $_POST['full_name'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $experience = intval($_POST['experience']);
    $mobileNo = $_POST['mobile_no'];
    $email = $_POST['email'];

    // Update tutor information
    $sql = "UPDATE tutors SET full_name = ?, gender = ?, education = ?, experience = ?, mobile_no = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $fullName, $gender, $education, $experience, $mobileNo, $email,  $tutorId);
    $stmt->execute();

    // Update tutor subjects
    if (isset($_POST['subjects'])) {
        foreach ($_POST['subjects'] as $subjectId => $subjectData) {
            $subject = $subjectData['subject'];
            $medium = $subjectData['medium'];
            $classUpto = $subjectData['class_upto'];
            
            $sql = "UPDATE tutor_subjects SET subject = ?, medium = ?, class_upto = ? WHERE id = ? AND tutor_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $subject, $medium, $classUpto, $subjectId, $tutorId);
            $stmt->execute();
        }
    }

    // Redirect back to the tutor list or details page
    header("Location: view-tutors.php");
    exit();
}
?>
