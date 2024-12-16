<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['student'];

// Fetch current student data
$sql = "SELECT * FROM students WHERE id = $user_id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class_course = $_POST['class_course'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $preferred_timings = $_POST['preferred_timings'];

    $update_sql = "UPDATE students SET full_name='$full_name', gender='$gender', class_course='$class_course',
                    contact_number='$contact_number', email='$email', address='$address', 
                    preferred_timings='$preferred_timings' WHERE id = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Profile updated successfully";
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
    <title>Edit Student Profile</title>
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
    <form method="POST" action="">
        <label>Full Name: <input type="text" name="full_name" value="<?php echo $student['full_name']; ?>" required></label><br>
        <label>Gender:
            <select name="gender">
                <option value="Male" <?php if($student['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($student['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if($student['gender'] === 'Other') echo 'selected'; ?>>Other</option>
            </select>
        </label><br>
        <label>Class/Course: <input type="text" name="class_course" value="<?php echo $student['class_course']; ?>" required></label><br>
        <label>Contact Number: <input type="text" name="contact_number" value="<?php echo $student['contact_number']; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo $student['email']; ?>" required></label><br>
        <label>Address: <textarea name="address" required><?php echo $student['address']; ?></textarea></label><br>
        <label>Preferred Timings: <input type="text" name="preferred_timings" value="<?php echo $student['preferred_timings']; ?>" required></label><br>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
