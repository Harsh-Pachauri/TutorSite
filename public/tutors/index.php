<?php
session_start();
if (!isset($_SESSION['tutor'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Dashboard</title>
</head>
<body>
    <h1>Welcome, Tutor!</h1>
    <ul>
        <li><a href="view-tutors.php">View Tutors</a></li>
        <li><a href="edit-profile.php">Edit Profile</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</body>
</html>
