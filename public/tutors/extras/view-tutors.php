
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
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0047ab;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Container */
        .tutors-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px; /* Increased gap for better spacing */
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Card Styles */
        .card {
            background-color: white;
            border-radius: 12px;
            padding: 25px; /* Increased padding for better spacing */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 15px; /* Spacing between heading and text */
            font-size: 1.8rem;
            color: #0047ab;
        }

        .card p {
            font-size: 1rem;
            color: #555;
            margin: 8px 0; /* Consistent margin for paragraph spacing */
        }

        /* Button Styles */
        .view-details-btn {
            display: inline-block;
            margin-top: 20px; /* Spacing between the text and button */
            padding: 12px 25px;
            background-color: #0047ab;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .view-details-btn:hover {
            background-color: #00357e;
        }

        /* Back Button */
        .back-btn {
            display: inline-block;
            margin: 10px 0 30px 0; /* Added margin above and below */
            padding: 10px 20px;
            background-color: #0047ab;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1rem;
        }

        .back-btn:hover {
            background-color: #ADD8E6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .card h3 {
                font-size: 1.5rem;
            }

            .view-details-btn {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <h1>All Tutors</h1>
    <a href="index.php" class="back-btn">Back to Dashboard</a>

    <!-- Tutors Grid -->
    <div class="tutors-container">
        <?php while ($tutor = $result->fetch_assoc()) { ?>
            <div class="card">
                <h3><?php echo $tutor['full_name']; ?></h3>
                <p><strong>Experience:</strong> <?php echo $tutor['experience']; ?> years</p>
                <p><strong>Subjects:</strong> <?php echo $tutor['subjects']; ?></p>
                <a href="tutor-details.php?id=<?php echo $tutor['id']; ?>" class="view-details-btn">View Full Details</a>
            </div>
        <?php } ?>
    </div>

</body>
</html>
