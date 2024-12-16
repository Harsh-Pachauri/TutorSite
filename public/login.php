<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6; /* Soft gray background */
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure footer stays at the bottom */
            margin: 0;
        }
        .navbar {
            background-color: #000000; /* Glossy black navbar */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
        }
        .navbar-brand img {
            height: 50px; /* Fixed height for the logo */
            width: auto; /* Maintain aspect ratio */
        }
        .container {
            max-width: 400px;
            background-color: #ffffff; /* White background for the form */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: auto; /* Center the container */
            flex: 1; /* Allow the container to grow */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            margin: 30px auto; /* Space from footer */
        }
        h2 {
            margin-bottom: 20px;
            color: #333333; /* Dark gray for better contrast */
        }
        h3 {
            color: #555555; /* Slightly lighter gray */
            margin-bottom: 15px; /* Space below headings */
        }
        .btn {
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #4a90e2; /* Bright blue */
            border: none;
        }
        .btn-primary:hover {
            background-color: #357ABD; /* Darker blue on hover */
        }
        .btn-outline-primary {
            border-color: #4a90e2; /* Matching border color */
            color: #4a90e2;
        }
        .btn-outline-primary:hover {
            background-color: #4a90e2;
            color: white;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #ffffff; /* White background for the footer */
            color: #666666; /* Light gray */
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for separation */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../public/images/TutorTutionLogo.png" alt="Logo"> 
                TutorTution.com
            </a>
        </div>
    </nav>

    <div class="container">
        <h2>Login</h2>

        <h3 class="mb-3">Login As:</h3>
        <form action="students/login-student.php" method="POST">
            <button type="submit" class="btn btn-primary w-100 mb-3">Student</button>
        </form>
        <form action="tutors/login-tutor.php" method="POST">
            <button type="submit" class="btn btn-primary w-100 mb-3">Tutor</button>
        </form>
        <form action="admin/login-admin.php" method="POST">
            <button type="submit" class="btn btn-primary w-100 mb-4">Admin</button>
        </form>

        <h3 class="mb-3">Or Sign Up As:</h3>
        <form action="./students/signup-student.php" method="POST">
            <button type="submit" class="btn btn-outline-primary w-100 mb-2">Student</button>
        </form>
        <form action="tutors/signup-tutor.php" method="POST">
            <button type="submit" class="btn btn-outline-primary w-100">Tutor</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 TutorTution.com. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
