<!DOCTYPE html>
<?php
session_start();
$companyLogo = "../images/whitelogo.png";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    /* Container */
.containerhead {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}


/* Logo */
header .logon img {
    max-width: 150px;
}

/* Header Image (Assuming #header-img is the same as the logo) */
#headerr-img {
    max-width: 150px;
}

/* Navbar Logo */
.navbar-logon {
    max-width: 150px;
}

/* New2 */
.neww2 {
    margin-left: 2vw;
}

/* New */
#neww {
    background-color: #0072e7;
}

/* Nav Links */
header .nav-linkss {
    display: flex;
    flex-direction: row;
    position: relative;
    transition: max-height 0.3s ease-in-out;
}

header .nav-linkss.active {
    display: block;
    flex-direction: column;
    background-color: #007bff;
    position: absolute;
    top: 70px;
    left: 0;
    width: 100%;
    max-height: 300px;
    z-index: 1000;
}

header .nav-linkss li {
    margin-left: 20px;
}

header .nav-linkss li a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

header .nav-linkss li a:hover {
    color: #ffde00;
}

/* Hamburger Menu */
.hamburgers {
    display: none;
    cursor: pointer;
}

.hamburgers i {
    font-size: 24px;
    color: #fff;
}

/* #f1 */
#f01 {
    display: flex;
    align-items: center;
}

/* Responsive Styles */
@media (max-width: 768px) {
    header .nav-linkss {
        display: none;
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 70px;
        left: 0;
        background-color: #007bff;
        padding: 20px 0;
    }

    header .nav-linkss li {
        margin: 10px 0;
        text-align: center;
    }

    header .hamburgers {
        display: block;
    }

    #neww {
        background-color: #4b9efd;
    }

    .neww2 {
        margin-left: 1vw;
    }
}
        body {
            background-color: #f0f2f5;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: auto;
            flex-grow: 1; /* Allow the container to take available space */
            margin-top: 50px; /* Added top margin for spacing */
            margin-bottom: 20px; /* Added bottom margin for spacing */
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            margin-top: auto; /* Ensure footer is at the bottom */
        }
    </style>
</head>
<body>
    <header style="    padding: 15px;    background-color: #0072e7;">
        <div style="display: flex;
    justify-content: space-around;
    align-items: center;" class="containerhead">
            <div id="f01" class="logon">
                <!-- <img src="images/logo.png" alt="Company Logo"> -->
                <img width="50px" id="headerr-img" src="<?php echo $companyLogo; ?>" alt="logo" class="navbar-logon">
                <span style="    color: white;" class="neww2">
                    <h2><b>Tutor Tuition</b></h2>
                </span>
            </div>
            <nav style="display: flex;
    align-items: center;">
                <ul style="align-items: center;
    margin: 0;
    list-style: none;
    justify-content: center;" id="neww" class="nav-linkss">
                    <li><a href="http://tutor-tuition.com/#">Home</a></li>
                    <li><a href="http://tutor-tuition.com/#about">About Us</a></li>
                    <li><a href="http://tutor-tuition.com/#features">Features</a></li>
                    <li><a href="http://tutor-tuition.com/#contactpart">Contact</a></li> <!-- New Contact link -->
                    <li><a href="http://tutor-tuition.com/public/students/signup-student.php">Get a Tutor</a></li>
                    <li><a href="http://tutor-tuition.com/public/tutors/signup-tutor.php">Become a Tutor</a></li>
                    <li><a href="http://tutor-tuition.com/public/admin/login-admin.php">Login</a></li>
                </ul>
                <div class="hamburgers">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2 class="text-center mb-4">Admin Login</h2>
        <form action="../../server/admin/login-admin.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 TutorTuition.com. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>
