<?php
session_start();
$companyLogo = "../images/whitelogo.png";
include '../../server/config.php';

// Ensure the user is an admin
// if ($_SESSION['role'] != 'admin') {
//     header("Location: ../login.php");
//     exit();
// }

// Get the student ID from the URL
$student_id = $_GET['id'];

// Fetch the student details
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch the teacher allocations for the student
// $sql_allocations = "SELECT * FROM teacher_allocations WHERE student_id = ?"
$sql_allocations = "SELECT allocation_id, subject, allocated_teacher_name, quoted_price, preferred_timings, preferred_weekdays FROM teacher_allocations WHERE student_id = ?";

$stmt_allocations = $conn->prepare($sql_allocations);
$stmt_allocations->bind_param("i", $student_id);
$stmt_allocations->execute();
$allocations_result = $stmt_allocations->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <!-- Include Bootstrap and custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5;font-family: 'Roboto', sans-serif; 
            font-family: 'Montserrat', sans-serif;
        }
        .container { max-width: 900px; margin-top: 30px; }
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body style="position:absolute; width:100vw;">
    <header style=" position:fixed; width:100vw; z-index:10;   padding: 15px;background-color: #0072e7;
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
    <div style="margin-top:7rem;background-color: #badfff;
    padding: 40px;" class="container">
        <div style="display: flex;
    justify-content: center;">
        <h1 style="    background-color: #002cdf;
    padding: 0.5rem 1rem;
    font-weight: 700;
    color: white;">Edit Student Details</h1>
            
        </div>
<a href="view-students.php" class="btn btn-primary back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <form style="padding-top: 14px;" action="update-student.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id'] ?? '', ENT_QUOTES); ?>">
            
            <div style="margin-bottom: 1.5rem !important;" class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($student['status'] ?? '', ENT_QUOTES); ?>">
            </div>
            
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($student['full_name'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" value="<?php echo htmlspecialchars($student['gender'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="guardian_name" class="form-label">Guardian Name</label>
                <input type="text" class="form-control" name="guardian_name" value="<?php echo htmlspecialchars($student['guardian_name'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="form-group">
                <label for="class_course" class="form-label">Class:</label>
                <select id="class" name="class_course" class="form-select" required>
                    <option value="<?php echo htmlspecialchars($student['class_course'] ?? '', ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($student['class_course'] ?? '', ENT_QUOTES); ?></option>
                    <option value="1">Class 1</option>
                    <option value="2">Class 2</option>
                    <option value="3">Class 3</option>
                    <option value="4">Class 4</option>
                    <option value="5">Class 5</option>
                    <option value="6">Class 6</option>
                    <option value="7">Class 7</option>
                    <option value="8">Class 8</option>
                    <option value="9">Class 9</option>
                    <option value="10">Class 10</option>
                    <option value="11">Class 11</option>
                    <option value="12">Class 12</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="medium" class="form-label">Medium</label>
                <input type="text" class="form-control" name="medium" value="<?php echo htmlspecialchars($student['medium'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_number" value="<?php echo htmlspecialchars($student['contact_number'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($student['email'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($student['address'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="comments_special_instructions" class="form-label">Comments/Special Instructions</label>
                <input type="text" class="form-control" name="comments_special_instructions" value="<?php echo htmlspecialchars($student['comments_special_instructions'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" class="form-control" name="remarks" value="<?php echo htmlspecialchars($student['remarks'] ?? '', ENT_QUOTES); ?>">
            </div>

            <h3>Subjects and Teacher Allocations</h3>
            <div class="table-responsive">
                
            <table class="table table-bordered">
    <thead style="background-color: #97ff62;">
        <tr>
            <th>Subject</th>
            <th>Allocated Teacher</th>
            <th>Quoted Price</th>
            <th>Preferred Timings</th>
            <th>Preferred Weekdays</th>
        </tr>
    </thead>
    <tbody style="background-color: #6567ff;">
        <?php $index = 0; while ($allocation = $allocations_result->fetch_assoc()) { ?>
        <tr>
            <input type="hidden" name="allocation_id[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($allocation['allocation_id'], ENT_QUOTES); ?>">
            <td><input type="text" name="subject[<?php echo $index; ?>]" class="form-control" value="<?php echo htmlspecialchars($allocation['subject'], ENT_QUOTES); ?>"></td>
            <td><input type="text" name="allocated_teacher_name[<?php echo $index; ?>]" class="form-control" value="<?php echo htmlspecialchars($allocation['allocated_teacher_name'], ENT_QUOTES); ?>"></td>
            <td><input type="text" name="quoted_price[<?php echo $index; ?>]" class="form-control" value="<?php echo htmlspecialchars($allocation['quoted_price'], ENT_QUOTES); ?>"></td>
            <td><input type="text" name="preferred_timings[<?php echo $index; ?>]" class="form-control" value="<?php echo htmlspecialchars($allocation['preferred_timings'], ENT_QUOTES); ?>"></td>
            <td><input type="text" name="preferred_weekdays[<?php echo $index; ?>]" class="form-control" value="<?php echo htmlspecialchars($allocation['preferred_weekdays'], ENT_QUOTES); ?>"></td>
            
        </tr>

        <?php $index++; } ?>
    </tbody>
</table>
            </div> 



            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
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
