<?php
// Assuming the student's name is stored in the session after form submission
session_start();
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : 'Student';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - TutorTuition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .thank-you-card {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .thank-you-card h1 {
            font-size: 2.5rem;
            color: #0a2540;
            margin-bottom: 15px;
        }
        .thank-you-card p {
            font-size: 1.1rem;
            color: #666;
        }
        .thank-you-card .icon {
            font-size: 4rem;
            color: #0a2540;
            margin-bottom: 20px;
        }
        .thank-you-card .btn {
            background-color: #0a2540;
            color: white;
            margin-top: 25px;
            padding: 10px 30px;
            font-size: 1rem;
            border-radius: 30px;
        }
        .thank-you-card .btn:hover {
            background-color: #00263f;
        }
    </style>
</head>
<body>

    <div class="thank-you-card">
        <div class="icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h1>Thank You, <?php echo htmlspecialchars($student_name); ?>!</h1>
        <p>Your inquiry has been successfully received. Our team will reach out to you soon.</p>
        <a href="../../index.php" class="btn">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.js"></script>
</body>
</html>
