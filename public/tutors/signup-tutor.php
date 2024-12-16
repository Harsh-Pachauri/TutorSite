<?php
session_start();
include '../../server/config.php'; // Database connection

$errors = [];
$companyLogo = "../images/whitelogo.png";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the basic form data
    $full_name = trim($_POST['full_name']);
    $gender = trim($_POST['gender']);
    $education = trim($_POST['education']);
    $experience = trim($_POST['experience']);
    $mobile_no = trim($_POST['mobile_no']);
    $email = trim($_POST['email']);
    // Get the dynamic fields data
    $subjects = $_POST['subjects'];
    $optsubject = $_POST['optsubject'] ?? [];
    $preferred_timings = $_POST['preferred_timings'] ?? [];
    $class_upto = $_POST['class_upto'];
    $medium = $_POST['medium'];
    $comments = trim($_POST['comments']); // Separate comments field

    // Store tutor name in session
    $_SESSION['tutor_name'] = $full_name;

    // Validate basic form data
    if (empty($full_name) || empty($gender) || empty($education) || empty($experience) || empty($mobile_no) || empty($email) ) {
        $errors[] = "All fields are required.";
    }

    // Validate mobile number
    if (!preg_match('/^[0-9]{10}$/', $mobile_no)) {
        $errors[] = "Mobile number must be 10 digits long and numeric.";
    }

    // Proceed if there are no errors
    if (empty($errors)) {
        // Insert tutor details into the database
        $sql = "INSERT INTO tutors (full_name, gender, education, experience, mobile_no, email, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $full_name, $gender, $education, $experience, $mobile_no, $email, $comments);

        if ($stmt->execute()) {
            // Get the last inserted tutor ID
            $tutor_id = $stmt->insert_id;

            // Insert the dynamic fields data
            $sql_subjects = "INSERT INTO tutor_subjects (tutor_id, subject, class_upto, medium, preferred_timings) VALUES (?, ?, ?, ?, ?)";
            $stmt_subjects = $conn->prepare($sql_subjects);

            // Insert each dynamic row into the database
            for ($i = 0; $i < count($subjects); $i++) {
    // Get preferred timing for this subject
    $timing = !empty($preferred_timings[$i]) ? $preferred_timings[$i] : '';

    if ($subjects[$i] == "Optional Subject") {
        $subjects[$i] = !empty($optsubject[$i]) ? $optsubject[$i] : null;
    }

    // Check if the subject is still null after replacing (to avoid inserting null)
    if ($subjects[$i] === null) {
        $errors[] = "Optional subject name is required.";
        continue; // Skip to next iteration if no valid subject
    }
    
    // Bind each individual parameter
    $stmt_subjects->bind_param("issss", $tutor_id, $subjects[$i], $class_upto[$i], $medium[$i], $timing);

    if (!$stmt_subjects->execute()) {
        $errors[] = "Error inserting subject data: " . $stmt_subjects->error;
    }
}


            // Redirect to a thank you page or any other page
            header("Location: thank-you.php");
            exit();
        } else {
            $errors[] = "Error inserting tutor data: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            background-color: #f3f4f6;
            font-family: 'Roboto', sans-serif;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .dynamic-row {
            margin-bottom: 20px;
        }
        .add-row-btn {
            margin-top: 30px;
        }
        #hey{
            height:100%;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #0a2540;
            border-color: #0a2540;
        }
        .btn-primary:hover {
            background-color: #09304b;
            border-color: #09304b;
        }
        .benefits {
            background-color: #e7f3ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .benefits h4 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #007bff;
        }
        .benefits ul {
            list-style-type: none;
            padding: 0;
        }
        .benefits li {
            margin-bottom: 10px;
        }
        .benefits li i {
            color: #0a2540;
            margin-right: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        footer {
            margin-top: 20px;
            text-align: center;
        }
        header {
    position: -webkit-sticky; /* For Safari */
    position: sticky;
    top: 0;
    z-index: 1000;
    width: 100%;
    background-color: #0072e7;
    color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
        .card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}
.required::after {
  content: " *";
  color: red;
  font-weight: bold;
  margin-left: 4px;
}


    </style>
</head>
<body>
    <header style="    padding: 15px;">
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
<div style="background-color: #e9f186;" class="container">
    <h1 class="text-center mb-4"><b>Why Join TutorTuition?</b></h1>
    <a style="display:flex;justify-content:center; align-items:center;" href="#form" class="btn btn-primary w-100 mb-3"><h3 style="margin:1vh">Register as a Tutor</h3></a>

    <div class="row text-center">
        <div  class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #007bff; color: white;">
                    <h4 class="card-title"><b>Small Batch Offline Coaching</b></h4>
                    <p class="card-text">Get personalized attention in small groups.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #ffd700; color: #0a2540;">
                    <h4 class="card-title"><b>Home Tuitions</b></h4>
                    <p class="card-text">Personalized coaching at your home.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #007bff; color: white;">
                    <h4 class="card-title"><b>Online Group Coaching</b></h4>
                    <p class="card-text">Learn with peers in interactive online sessions.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #ffd700; color: #0a2540;">
                    <h4 class="card-title"><b>1-on-1 Personalized Coaching</b></h4>
                    <p class="card-text">Dedicated attention with customized sessions.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #007bff; color: white;">
                    <h4 class="card-title"><b>Free Trial Class</b></h4>
                    <p class="card-text">Experience our teaching methods for free.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div id="hey" class="card border-0 shadow rounded">
                <div class="card-body" style="background-color: #ffd700; color: #0a2540;">
                    <h4 class="card-title"><b>1-on-1 Personalized Coaching</b></h4>
                    <p class="card-text">Dedicated attention with customized sessions.</p>
                </div>
            </div>
        </div>
    </div>
<div id="form" style="background-color: #9fd2ff;" class="container">
    <div style="display:flex; justify-content:center;"><b><h2 style="font-weight:800;">Join as Tutor</h2></b></div>

    <!-- Error display -->
    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Tutor form -->
   <form  action="signup-tutor.php" class="needs-validation"  method="POST" novalidate>
        <label for="full_name" class="required">Tutor Name:</label>
        <input type="text" id="full_name" name="full_name" class="form-control" required>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" class="form-control" >

        <label for="education">Education:</label>
        <input type="text" id="education" name="education" class="form-control" >

        <label for="experience">Experience:</label>
        <input type="text" id="experience" name="experience" class="form-control" >

        <label for="mobile_no" class="required">Mobile No:</label>
        <input type="text" id="mobile_no" name="mobile_no" class="form-control" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" >

        <!-- Dynamic table for subjects -->
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dynamic-field-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Class Upto</th>
                        <th>Medium</th>
                        <th>Preferred Timing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dynamic-field-container">
                    <tr class="dynamic-row" id="row-1">
                        <td>
                            <label for="subjects" class="required">Subjects</label>
                            <select style="width:auto" style="width:auto" name="subjects[]" class="form-select" id="subjectSelect-0" required onchange="toggleOptionalSubject0()" required>
                                <!-- Subjects from 1st to 12th in India -->
                                <option value="Mathematics">Mathematics</option>
                                <option value="Science">Science</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Social Studies">Social Studies</option>
                                <option value="Physics">Physics</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Biology">Biology</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Economics">Economics</option>
                                <option value="Accountancy">Accountancy</option>
                                <option value="Business Studies">Business Studies</option>
                                <option value="History">History</option>
                                <option value="Geography">Geography</option>
                                <option value="Sanskrit">Sanskrit</option>
                                <option value="Environmental Science">Environmental Science</option>
                                <option value="Physical Education">Physical Education</option>
                                <option value="Arts">Arts</option>
                                <option value="Performing Arts">Performing Arts</option>
                                <option value="Health Education">Health Education</option>
                                <option value="Home Science">Home Science</option>
                                <option value="Optional Subject">Others</option>
                            </select>
                            <!-- Hidden textbox for Optional Subject with initial blank space -->
    <div id="optionalSubjectDiv-0" style="display: none; margin-top: 10px;">
        <label for="optsubject-0" class="required">Other Subject Name</label>
        <input type="text" name="optsubject[]" class="form-control" id="optsubject-0" value=" ">
        <div class="invalid-feedback">
            Please provide the name of the other subject.
        </div>
    </div>
                        </td>
                        <td>
                            <select name="class_upto[]" class="form-select" required>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </td>
                        <td>
                            <select name="medium[]" class="form-select" required>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Both">Both</option>
                            </select>
                        </td>
                        <td>
        <div class="row">
            <div class="col">
                <label for="from_time_0" class="form-label">From:</label>
                <select style="width:auto" name="from_time[]" id="from_time_0" class="form-select time-picker" required>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                            </select>
                        </div>
                        <div class="col">
                <label for="to_time_0" class="form-label">To:</label>
                <select name="to_time[]" id="to_time_0" class="form-select time-picker" required>
                                <option value="" disabled selected>Select Time</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="preferred_timings[]" class="preferred-timings">
                </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row-btn" onclick="removeRow(1)">
                        <i class="fas fa-trash"></i> <!-- Font Awesome trash bin icon -->
                    </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add Row button -->
        <div class="row">
            <div class="col-md-2 offset-md-10">
                <button type="button" class="btn btn-primary add-row-btn" id="addRowBtn">Add More Subjects</button>
            </div>
        </div>


        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" class="form-control" rows="3"></textarea>

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
function toggleOptionalSubject0() {
    var subjectSelect = document.getElementById(`subjectSelect-0`);
    var optionalSubjectDiv = document.getElementById(`optionalSubjectDiv-0`);
    var optionalSubjectInput = document.getElementById(`optsubject-0`);

    // Check if the elements exist before trying to access their properties
    if (subjectSelect && optionalSubjectDiv && optionalSubjectInput) {
        if (subjectSelect.value === 'Optional Subject') {
            optionalSubjectDiv.style.display = 'block';
            optionalSubjectInput.value = ""; // Allow user input
        } else {
            optionalSubjectDiv.style.display = 'none';
            optionalSubjectInput.value = ""; // Clear the optional subject input
        }
    } else {
        console.error(`Element with ID subjectSelect-0, optionalSubjectDiv-0, or optsubject-0 not found.`);
    }
}
function toggleOptionalSubject(rowId) {
    var subjectSelect = document.getElementById(`subjectSelect-${rowId}`);
    var optionalSubjectDiv = document.getElementById(`optionalSubjectDiv-${rowId}`);
    var optionalSubjectInput = document.getElementById(`optsubject-${rowId}`);

    // Check if the elements exist before trying to access their properties
    if (subjectSelect && optionalSubjectDiv && optionalSubjectInput) {
        if (subjectSelect.value === 'Optional Subject') {
            optionalSubjectDiv.style.display = 'block';
            optionalSubjectInput.value = ""; // Allow user input
        } else {
            optionalSubjectDiv.style.display = 'none';
            optionalSubjectInput.value = ""; // Clear the optional subject input
        }
    } else {
        console.error(`Element with ID subjectSelect-${rowId}, optionalSubjectDiv-${rowId}, or optsubject-${rowId} not found.`);
    }
}
// JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    $(document).ready(function() {
        let rowCount = 1;

        // Add row functionality
        $('#addRowBtn').click(function() {
            rowCount++;
            let newRow = `
                <tr class="dynamic-row" id="row-${rowCount}">
                    <td>
                        <select name="subjects[]" class="form-select" id="subjectSelect-${rowCount}" required onchange="toggleOptionalSubject(${rowCount})">
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Social Studies">Social Studies</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Biology">Biology</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics">Economics</option>
                            <option value="Accountancy">Accountancy</option>
                            <option value="Business Studies">Business Studies</option>
                            <option value="History">History</option>
                            <option value="Geography">Geography</option>
                            <option value="Sanskrit">Sanskrit</option>
                            <option value="Environmental Science">Environmental Science</option>
                            <option value="Physical Education">Physical Education</option>
                            <option value="Arts">Arts</option>
                            <option value="Performing Arts">Performing Arts</option>
                            <option value="Health Education">Health Education</option>
                            <option value="Home Science">Home Science</option>
                            <option value="Optional Subject">Others</option>
                        </select>
                        <!-- Hidden textbox for Optional Subject -->
                        <div id="optionalSubjectDiv-${rowCount}" style="display: none; margin-top: 10px;">
                            <label for="optsubject-${rowCount}" class="required">Other Subject Name</label>
                            <input type="text" name="optsubject[]" class="form-control" id="optsubject-${rowCount}" value=" ">
                            <div class="invalid-feedback">
                                Please provide the name of the Other subject.
                            </div>
                        </div>
                    </td>
                    <td>
                        <select name="class_upto[]" class="form-select" required>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </td>
                    <td>
                        <select name="medium[]" class="form-select" required>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Both">Both</option>
                        </select>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col">
                        <label for="from_time_${rowCount}" class="form-label">From:</label>
                        <select name="from_time[]" id="from_time_${rowCount}" class="form-select time-picker" required>
                                    <option value="" disabled selected>Select Time</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                </select>
                            </div>
                            <div class="col">
                        <label for="to_time_${rowCount}" class="form-label">To:</label>
                        <select name="to_time[]" id="to_time_${rowCount}" class="form-select time-picker" required>
                                    <option value="" disabled selected>Select Time</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="preferred_timings[]" class="preferred-timings">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row-btn" onclick="removeRow(${rowCount})">
                        <i class="fas fa-trash"></i> <!-- Font Awesome trash bin icon -->
                    </button>

                    </td>
                </tr>
            `;
            $('#dynamic-field-container').append(newRow);
            initializeTimePickers();
        });

        // Initialize Flatpickr for time picking
        function initializeTimePickers() {
            $('.time-picker').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: new Date(),
                minuteIncrement: 1,
            });
        }

        // Remove row functionality
        window.removeRow = function(rowId) {
            $('#row-' + rowId).remove();
        }

        // Initialize Flatpickr on page load
        initializeTimePickers();
    });
    // Update the hidden "preferred_timings[]" field whenever "from_time" or "to_time" is changed
$(document).on('change', 'select[name="from_time[]"], select[name="to_time[]"]', function() {
    $('tr.dynamic-row').each(function(index) {
        let fromTime = $(this).find('select[name="from_time[]"]').val();
        let toTime = $(this).find('select[name="to_time[]"]').val();
        
        // Only set the value if both times are selected
        if (fromTime && toTime) {
            $(this).find('input[name="preferred_timings[]"]').val(fromTime + ' - ' + toTime);
        }
    });
});
</script>
</body>
</html>
