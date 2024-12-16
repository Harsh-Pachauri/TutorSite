<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] !== 'tutor') {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['tutor'];

// Fetch tutor's profile
$sql = "SELECT * FROM tutors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
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
        echo "<p class='text-green-500 text-center mt-4'>Profile updated successfully!</p>";
    } else {
        echo "<p class='text-red-500 text-center mt-4'>Error updating profile: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tutor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f4f8;
        }
        h1 {
            font-size: 2.5rem; /* Increased size for emphasis */
            color: #0047ab;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        <h1 class="text-center mb-4">Edit Your Profile</h1>

        <form method="post" action="edit-profile.php" class="bg-white p-5 rounded shadow">
            <div class="mb-4">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($tutor['full_name']); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($tutor['email']); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Subjects</label>
                <input type="text" name="subjects" class="form-control" value="<?php echo htmlspecialchars($tutor['subjects']); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control" value="<?php echo htmlspecialchars($tutor['experience']); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" required><?php echo htmlspecialchars($tutor['bio']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Update Profile</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
