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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #0047ab;
            margin-bottom: 20px;
        }

        /* Card container */
        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Individual cards */
        .card {
            flex: 1;
            min-width: 250px;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-icon {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 10px;
        }

        .card a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #0047ab;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #00357e;
        }

        /* Logout Button Styling */
        .logout-btn-container {
            text-align: center;
            margin-top: 40px;
        }

        .logout-btn {
            padding: 12px 25px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                max-width: 300px;
                margin-bottom: 20px;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome, Tutor!</h1>
        <div class="card-container">
            <!-- View Tutors Card -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="card-title">View Tutors</div>
                <a href="view-tutors.php">Go to View Tutors</a>
            </div>

            <!-- Edit Profile Card -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-user-edit"></i></div>
                <div class="card-title">Edit Profile</div>
                <a href="edit-profile.php">Go to Edit Profile</a>
            </div>
        </div>

        <!-- Centered Logout Button -->
        <div class="logout-btn-container">
            <form action="../logout.php" method="post">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

</body>
</html>
