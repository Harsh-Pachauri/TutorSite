<?php
session_start();
$companyLogo = "../images/whitelogo.png";
include '../../server/config.php';

if (isset($_GET['id'])) {
    $tutorId = intval($_GET['id']); // Get tutor ID from URL
} else {
    die("No tutor ID provided.");
}

// Fetch tutor details
$sql = "SELECT * FROM tutors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutorId);
$stmt->execute();
$tutor = $stmt->get_result()->fetch_assoc();

// Fetch tutor subjects
$sql = "SELECT * FROM tutor_subjects WHERE tutor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutorId);
$stmt->execute();
$subjects = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* Custom styles for contrasting colors */
        .table-header {
            background-color: #007bff;
            color: white;
        }
        .table-row {
            background-color: #f8f9fa;
        }
        .table-row:nth-child(even) {
            background-color: #e9ecef;
        }
                .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        label{
            color:black;
        }
    </style>
</head>
<body style="position:absolute; width:100vw; display: flex; justify-content: center;;
    color: white;">
    <header style="  position:fixed; width:100vw;z-index:10;  padding: 15px;background-color: #0072e7">
        <div style=" display: flex;
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
    <div style="margin-top:7rem;max-width: 926px; background-color: #b0d5fa; padding: 32px;" class="container">
        <div style="display:flex;justify-content:center;background-color:blue;margin-bottom:16px;"><h1 style="    margin: 10px;">Tutor Details for <?php echo htmlspecialchars($tutor['full_name']); ?></h1></div>
        <a href="view-tutors.php" class="btn btn-primary back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <form id="updateForm-<?php echo $tutorId; ?>" method="POST" action="update-tutor.php">
            <input type="hidden" name="tutor_id" value="<?php echo $tutorId; ?>">

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($tutor['full_name']); ?>" required readonly>
            </div>
            
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" value="<?php echo htmlspecialchars($tutor['gender']); ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="education" class="form-label">Education</label>
                <input type="text" class="form-control" name="education" value="<?php echo htmlspecialchars($tutor['education']); ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="experience" class="form-label">Experience</label>
                <input type="number" class="form-control" name="experience" value="<?php echo htmlspecialchars($tutor['experience']); ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="mobile_no" class="form-label">Mobile No</label>
                <input type="text" class="form-control" name="mobile_no" value="<?php echo htmlspecialchars($tutor['mobile_no']); ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($tutor['email']); ?>" readonly>
            </div>


            <!-- Subjects Table -->
            <h3>Subjects</h3>
            <div class="table-responsive">
                
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr>
                        <th>Subject</th>
                        <th>Medium</th>
                        <th>Class Upto</th>
                        <th>Preferred Timings</th>
                        <th>Quoted Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($subject = $subjects->fetch_assoc()) { ?>
                    <tr class="table-row">
                        <td><?php echo htmlspecialchars($subject['subject']); ?></td>
                        <td><?php echo htmlspecialchars($subject['medium']); ?></td>
                        <td><?php echo htmlspecialchars($subject['class_upto']); ?></td>
                        <td><?php echo htmlspecialchars($subject['preferred_timings']); ?></td>
                        <td>
                            <input type="text" class="form-control" name="quoted_price[<?php echo $subject['id']; ?>]" value="<?php echo htmlspecialchars($subject['quoted_price']); ?>">
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="updatePrice(<?php echo $subject['id']; ?>)">Update Price</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>

            <button type="button" class="btn btn-success" onclick="confirmUpdate(<?php echo $tutorId; ?>)">
                Update Tutor
            </button>
            <a href="view-tutors.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>
    
    <script>
    // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        function confirmUpdate(tutorId) {
            const form = document.getElementById(`updateForm-${tutorId}`);
            form.submit();
        }

        function updatePrice(subjectId) {
            const priceInput = document.querySelector(`input[name="quoted_price[${subjectId}]"]`);
            const price = priceInput.value;
            
            // AJAX call to update the price in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update-price.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.send('subject_id=' + subjectId + '&price=' + price);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
