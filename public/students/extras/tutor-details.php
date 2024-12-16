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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-weight: 700;
            color: #0047ab;
        }
        .tutor-info {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
        .tutor-details {
            flex: 3;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .tutor-details h2 {
            color: #0047ab;
        }
        .tutor-details p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .tutor-details strong {
            color: #333;
        }
        .actions {
            margin-top: 20px;
            text-align: center;
        }
        .back-btn {
            background-color: #0047ab;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #00357e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tutor Details</h1>
        <div class="tutor-info">
            <div class="tutor-details">
                <h2><?php echo $tutor['full_name']; ?></h2>
                <p><strong>Gender:</strong> <?php echo $tutor['gender']; ?></p>
                <p><strong>Education:</strong> <?php echo $tutor['education']; ?></p>
                <p><strong>Experience:</strong> <?php echo $tutor['experience']; ?> years</p>
                <p><strong>Subjects:</strong> <?php echo $tutor['subjects']; ?></p>
                <p><strong>Contact:</strong> <?php echo $tutor['mobile_no']; ?></p>
                <p><strong>Email:</strong> <?php echo $tutor['email']; ?></p>
                <p><strong>Bio:</strong> <?php echo $tutor['bio']; ?></p>
            </div>
        </div>
        <div class="actions">
            <a href="view-tutors.php" class="back-btn">Back to All Tutors</a>
        </div>
    </div>
</body>
</html>

