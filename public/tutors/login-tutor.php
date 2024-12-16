<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f4f8;
            padding: 20px; /* Added padding to ensure space from the edges */
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-bottom: 40px; /* Prevents merging with footer */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        input[type="submit"] {
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #fff;
            width: 100%;
            border-top: 1px solid #ddd;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            color: #666;
            font-size: 14px;
            margin-top: auto; /* Keeps the footer below the content */
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
                width: 100%;
                margin: 0 10px; /* Add margin to prevent merging on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Tutor Login</h2>
        <form action="../../server/tutor/login-tutor.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

    <div class="footer">
        &copy; 2024 TutorTuition.com. All rights reserved.
    </div>
</body>
</html>
