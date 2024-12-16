
text/x-generic view-tutors.php ( PHP script, ASCII text, with CRLF line terminators )
<?php
session_start();
include '../../server/config.php';

// Fetch all tutors
$sql = "SELECT * FROM tutors";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tutors</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            vertical-align: top;
        }
        .card h3 {
            margin-top: 0;
        }
        .card p {
            margin: 5px 0;
        }
        .card a {
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <h1>All Tutors</h1>
    <a href="index.php">Back to Dashboard</a>
    <div>
        <?php while ($tutor = $result->fetch_assoc()) { ?>
            <div class="card">
                <h3><?php echo $tutor['full_name']; ?></h3>
                <p><strong>Experience:</strong> <?php echo $tutor['experience']; ?> years</p>
                <p><strong>Subjects:</strong> <?php echo $tutor['subjects']; ?></p>
                <a href="tutor-details.php?id=<?php echo $tutor['id']; ?>">View Full Details</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>