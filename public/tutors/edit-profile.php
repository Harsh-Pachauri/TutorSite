<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] !== 'tutor') {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['tutor'];

// Fetch tutor's profile
$sql = "SELECT * FROM tutors WHERE id = $id";
$result = $conn->query($sql);
$tutor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $subjects = $_POST['subjects'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    $sql = "UPDATE tutors SET full_name=?, email=?, subjects=?, experience=?, bio=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $full_name, $email, $subjects, $experience, $bio, $id);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tutor Profile</title>
    <style>
        a.back-btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    <h1>Edit Profile</h1>
    
    <form method="post" action="edit-profile.php">
        <label>Full Name: <input type="text" name="full_name" value="<?php echo $tutor['full_name']; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo $tutor['email']; ?>" required></label><br>
        <label>Subjects: <input type="text" name="subjects" value="<?php echo $tutor['subjects']; ?>" required></label><br>
        <label>Experience: <input type="text" name="experience" value="<?php echo $tutor['experience']; ?>" required></label><br>
        <label>Bio: <textarea name="bio" required><?php echo $tutor['bio']; ?></textarea></label><br>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
