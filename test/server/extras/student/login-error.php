<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }
        .error-message {
            color: #e74c3c;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Error</h1>
        <div class="error-message">
            <p>Invalid credentials. Please check your username and password.</p>
        </div>
        <a href="../../public/students/login-student.php" class="btn btn-primary w-100 back-btn">Back to Login</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
