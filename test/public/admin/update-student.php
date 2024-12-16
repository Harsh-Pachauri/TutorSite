<?php
session_start();
include '../../server/config.php';


// Get the posted data
$student_id = $_POST['id'];
$full_name = $_POST['full_name'];
$guardian_name = $_POST['guardian_name'];
$gender = $_POST['gender'];
$class_course = $_POST['class_course'];
$medium = $_POST['medium'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$comments_special_instructions = $_POST['comments_special_instructions'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];
$teachers = $_POST['allocated_teacher_name'];


// Update student details
$sql = "UPDATE students SET full_name = ?, guardian_name = ?, gender = ?, class_course = ?, medium = ?, contact_number = ?, email = ?, address = ?, comments_special_instructions = ?, status = ?
, remarks = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssi", $full_name, $guardian_name, $gender, $class_course, $medium, $contact_number, $email, $address, $comments_special_instructions, $status, $remarks, $student_id);
$stmt->execute();

// Update teacher allocations
// Update teacher allocations
if (isset($_POST['subject'])) {
    foreach ($_POST['subject'] as $index => $subject) {
        $allocation_id = $_POST['allocation_id'][$index]; // Get the allocation ID
        $allocated_teacher_name = $_POST['allocated_teacher_name'][$index];
        $quoted_price = $_POST['quoted_price'][$index];
        $preferred_timings = $_POST['preferred_timings'][$index];
        $preferred_weekdays = $_POST['preferred_weekdays'][$index];

        // Update based on the allocation ID
$sql = "UPDATE teacher_allocations SET subject = ?, allocated_teacher_name = ?, quoted_price = ?, preferred_timings = ?, preferred_weekdays = ? WHERE allocation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $subject, $allocated_teacher_name, $quoted_price, $preferred_timings, $preferred_weekdays, $allocation_id);

        $stmt->execute();
    }
}








// Redirect back to the student list
header("Location: view-students.php");
exit();
?>
