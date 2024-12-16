<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0047ab;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Card Styles */
        .dashboard-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card h2 {
            color: #0047ab;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .dashboard-card a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 25px;
            background-color: #0047ab;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .dashboard-card a:hover {
            background-color: #00357e;
        }

        /* Logout Button Styles */
        .logout-btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .logout-btn {
            padding: 12px 25px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }

        .logout-btn i {
            font-size: 1.2rem;
        }

        /* Footer Styles */
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #555;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .dashboard-card h2 {
                font-size: 1.4rem;
            }

            .dashboard-card a {
                font-size: 0.9rem;
            }

            .logout-btn {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <h1>Welcome, Student!</h1>

    <div class="dashboard-container">
        <!-- Card 1: View Tutors -->
        <div class="dashboard-card">
            <h2>View Tutors</h2>
            <p>Find the best tutors available to assist you with your studies.</p>
            <a href="view-tutors.php">Go to Tutors</a>
        </div>

        <!-- Card 2: Edit Profile -->
        <div class="dashboard-card">
            <h2>Edit Profile</h2>
            <p>Update your personal information and settings.</p>
            <a href="edit-profile.php">Edit Profile</a>
        </div>
    </div>

    <!-- Logout Button Centered -->
    <div class="logout-btn-container">
        <form action="../logout.php" method="post">
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 TuitionTutor.com. All Rights Reserved.</p>
    </div>

</body>
</html>
