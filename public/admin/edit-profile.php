<?php
session_start();
$companyLogo = "../images/whitelogo.png";
include '../../server/config.php'; // Database connection

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

$admin_email = $_SESSION['admin']; // Using email instead of username

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    $new_password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($new_password) {
        $sql = "UPDATE admins SET email = ?, password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $new_email, $new_password, $admin_email);
    } else {
        $sql = "UPDATE admins SET email = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $new_email, $admin_email);
    }

    if ($stmt->execute()) {
        $_SESSION['admin'] = $new_email; // Update session email
        echo "<script>alert('Profile updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch current admin details
$sql = "SELECT * FROM admins WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $admin_email);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
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
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px; /* Increased padding */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px; /* Increased margin */
        }
        .back-btn {
            margin-bottom: 20px;
        }
        .note {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 15px; /* Increased margin */
        }
        button {
            transition: background-color 0.3s ease;
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
                    <li><div style="text-align: center;">
                <a href="../logout.php" >Logout</a>
            </div></li>
                </ul>
                <div class="hamburgers">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <a href="index.php" class="btn btn-primary back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <h1>Edit Profile</h1>
        <form method="post" action="edit-profile.php">
            <div class="mb-4"> <!-- Increased bottom margin -->
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
            </div>
            <div class="mb-4"> <!-- Increased bottom margin -->
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if not changing">
            </div>
            <button type="submit" class="btn btn-success w-100">Update Profile</button>
        </form>
        <p class="note">Leave the password field blank if you don't want to change it.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
