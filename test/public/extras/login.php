<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Work+Sans:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #eef3f7;
            font-family: 'Work Sans', sans-serif;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .extra {
            padding-top: 3vh;
            display: flex;
            justify-content: center;
            position: relative;
        }

        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin: 20px;
            margin-bottom: 80px;
        }

        .navbar {
            background-color: #007bff;
            padding: 10px 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar>div {
            display: block;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .navbar-brand img {
            height: 35px;
            width: auto;
            margin-right: 8px;
        }

        h2 {
            color: #0a2540;
            font-size: 1.6rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        h3 {
            color: #6b7c93;
            font-size: 1rem;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .btn {
            border-radius: 25px;
            padding: 12px;
            font-weight: 500;
            margin-bottom: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #0a2540;
            border: none;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #081a2d;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            border-color: #0a2540;
            color: #0a2540;
        }

        .btn-outline-primary:hover {
            background-color: #0a2540;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        /* Updated Back to Home Button */
        .btn-back-home {
            background-color: #0a2540;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: absolute;
            top: 50px;
            left: 15px;
            z-index: 10;
            text-decoration: none;
        }

        .btn-back-home:hover {
            background-color: #081a2d;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            color: #6b7c93;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            font-size: 0.85rem;
            margin-top: 20px;
        }

        .extra2 {
            width: 100%;
            position: relative;
            bottom: 0;
        }

        #extra3 {
            display: block;
            padding-left: 2vw;
        }
        
        .new1{
            color: white;
        }
        @media (max-width: 576px) {
            .btn-back-home {
                top: 60px;
                left: 10px;
                font-size: 0.8rem;
                padding: 8px 16px;
                z-index: 10;
            }

            .container {
                margin-top: 100px; /* Add margin on top to prevent overlap */
            }

            h2 {
                font-size: 1.4rem;
            }

            h3 {
                font-size: 0.9rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            .navbar-brand img {
                height: 30px;
            }

            footer {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav id="new1" class="navbar navbar-dark">
        <div id="extra3" class="container-fluid justify-content-center">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../public/images/whitelogo.png" alt="Logo"> 
                Tutor Tuition
            </a>
        </div>
    </nav>

    <div class="extra">
        <!-- Back to Home Button -->
        <a href="../index.php" class="btn-back-home">← Back to Home</a>

        <div class="container">
            <h2>Welcome Back</h2>
            <h3>Please login to continue</h3>
            
            <form action="students/login-student.php" method="POST">
                <button type="submit" class="btn btn-primary w-100">Login as Student</button>
            </form>
            
            <form action="tutors/login-tutor.php" method="POST">
                <button type="submit" class="btn btn-primary w-100">Login as Tutor</button>
            </form>
            
            <form action="admin/login-admin.php" method="POST">
                <button type="submit" class="btn btn-primary w-100 mb-3">Login as Admin</button>
            </form>

            <h3>Don't have an account? Sign up below:</h3>
            
            <form action="./students/signup-student.php" method="POST">
                <button type="submit" class="btn btn-outline-primary w-100">Sign Up as Student</button>
            </form>
            
            <form action="tutors/signup-tutor.php" method="POST">
                <button type="submit" class="btn btn-outline-primary w-100">Sign Up as Tutor</button>
            </form>
        </div>
    </div>

    <footer class="extra2">
        <p>&copy; 2024 TutorTuition. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
