<?php
session_start();
include '../../server/config.php';

// Get the tutor ID from the URL
$tutor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the tutor details from the database
$sql = "SELECT * FROM tutors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutor_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the tutor exists
if ($result->num_rows === 1) {
    $tutor = $result->fetch_assoc();
} else {
    // Redirect back if tutor not found
    header("Location: view-tutors.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tutor['full_name']; ?> - Details</title>
</head>
<body>
    <h1>Tutor Details</h1>
    <h2><?php echo $tutor['full_name']; ?></h2>
    <p><strong>Gender:</strong> <?php echo $tutor['gender']; ?></p>
    <p><strong>Education:</strong> <?php echo $tutor['education']; ?></p>
    <p><strong>Experience:</strong> <?php echo $tutor['experience']; ?> years</p>
    <p><strong>Subjects:</strong> <?php echo $tutor['subjects']; ?></p>
    <p><strong>Contact:</strong> <?php echo $tutor['mobile_no']; ?></p>
    <p><strong>Email:</strong> <?php echo $tutor['email']; ?></p>
    <p><strong>Bio:</strong> <?php echo $tutor['bio']; ?></p>
    
    <!-- Back button to return to the list of tutors -->
    <a href="view-tutors.php">Back to All Tutors</a>
</body>
</html>
