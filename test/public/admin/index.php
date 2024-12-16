<?php
session_start();
$companyLogo = "../images/whitelogo.png";
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f7f9;
            /*display: flex;*/
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            align-items: flex-start;
            height: 100vh;
            /*padding: 20px;*/
        }

        .dashboard-container {
            max-width: 1200px;
            width: 100%;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 2rem;
            color: #333;
        }

        .dashboard-header h2 {
            font-size: 1.5rem;
            color: #666;
            margin-top: 10px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card a {
            text-decoration: none;
            color: inherit;
        }

        .dashboard-card h2 {
            font-size: 1.2rem;
            color: #333;
            margin: 15px 0;
        }

        .dashboard-card i {
            font-size: 2.5rem;
            color: #007bff;
        }

        .dashboard-card p {
            font-size: 1rem;
            color: #666;
        }

        /* Logout Button */
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header style="    padding: 15px;background-color: #0072e7;
    color: white;">
        <div style="display: flex;
    justify-content: space-around;
    align-items: center;" class="containerhead">
            <div id="f01" class="logon">
                <!-- <img src="images/logo.png" alt="Company Logo"> -->
                <img width="50px" id="headerr-img" src="<?php echo $companyLogo; ?>" alt="logo" class="navbar-logon">
                <span class="neww2">
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
    <div style="display:flex;justify-content:center;align-items:center;">

        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Admin Dashboard</h1>
                <h2>Manage Your Platform Efficiently</h2>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <a href="view-students.php">
                        <i class="fas fa-user-graduate"></i>
                        <h2>View Students</h2>
                        <p>Manage and view student profiles</p>
                    </a>
                </div>

                <div class="dashboard-card">
                    <a href="view-tutors.php">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <h2>View Tutors</h2>
                        <p>Manage and view tutor profiles</p>
                    </a>
                </div>

                <div class="dashboard-card">
                    <a href="edit-profile.php">
                        <i class="fas fa-user-edit"></i>
                        <h2>Edit Profile</h2>
                        <p>Edit your admin profile information</p>
                    </a>
                </div>


            </div>

            <div style="text-align: center;">
                <a href="../logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
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