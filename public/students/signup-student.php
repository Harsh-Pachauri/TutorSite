<?php
session_start();
include '../../server/config.php'; // Database connection

$errors = [];
$companyLogo = "../images/whitelogo.png";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Other form fields
    $full_name = trim($_POST['full_name']);
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : null;
    $class_course = isset($_POST['class_course']) ? trim($_POST['class_course']) : null;
    $contact_number = trim($_POST['contact_number']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $guardian_name = trim($_POST['guardian_name']);
    $medium = implode(', ', $_POST['medium'] ?? []);
    $comments_special_instructions = trim($_POST['comments_special_instructions']);
    $_SESSION['student_name'] = $full_name;

    // Fetch subjects, optional subjects, preferred timings, and weekdays from POST data
    $subjects = $_POST['subjects'] ?? [];
    $optsubject = $_POST['optsubject'] ?? [];
    $preferred_timings = $_POST['preferred_timings'] ?? [];
    $preferredWeekdays = $_POST['preferred_weekdays'] ?? [];

    // Validate form inputs
    if (empty($full_name) || empty($contact_number) || empty($subjects)) {
        $errors[] = "All fields are required.";
    }

    // Validate mobile number
    if (!preg_match('/^[6-9]\d{9}$/', $contact_number)) {
        $errors[] = "Please enter a valid 10-digit mobile number.";
    }

    if (empty($errors)) {
        // Insert student data
        $sql = "INSERT INTO students (full_name, gender, class_course, contact_number, email, address, guardian_name, medium, comments_special_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $errors[] = "Error preparing student insert statement: " . $conn->error;
        } else {
            $stmt->bind_param("sssssssss", $full_name, $gender, $class_course, $contact_number, $email, $address, $guardian_name, $medium, $comments_special_instructions);

            if ($stmt->execute()) {
                $student_id = $stmt->insert_id;

                // Insert each subject
                $sqlAlloc = "INSERT INTO teacher_allocations (student_id, subject, preferred_timings, preferred_weekdays) VALUES (?, ?, ?, ?)";
                $stmtAlloc = $conn->prepare($sqlAlloc);

                if ($stmtAlloc === false) {
                    $errors[] = "Error preparing teacher allocation insert statement: " . $conn->error;
                } else {
                    foreach ($subjects as $subjectIndex => $subject) {
                        // If "Optional Subject", use the corresponding optsubject value
                        if ($subject == "Optional Subject") {
                            $subject = !empty($optsubject[$subjectIndex]) ? $optsubject[$subjectIndex] : null;
                        }

                        // Check if the subject is still null after replacing (to avoid inserting null)
                        if ($subject === null) {
                            $errors[] = "Optional subject name is required.";
                            continue; // Skip to next iteration if no valid subject
                        }

                        // Get preferred timing for this subject
                        $timing = !empty($preferred_timings[$subjectIndex]) ? $preferred_timings[$subjectIndex] : '';

                        // Get preferred weekdays for this subject
                        $selectedWeekdays = isset($preferredWeekdays[$subjectIndex]) ? implode(", ", $preferredWeekdays[$subjectIndex]) : '';

                        // Bind and execute the allocation insertion
                        $stmtAlloc->bind_param("isss", $student_id, $subject, $timing, $selectedWeekdays);

                        if (!$stmtAlloc->execute()) {
                            $errors[] = "Error inserting subject data for subject {$subject}: " . $stmtAlloc->error;
                        }
                    }
                }

                // Redirect if no errors
                if (empty($errors)) {
                    header("Location: thank-you.php");
                    exit();
                }
            } else {
                $errors[] = "Error inserting student data: " . $stmt->error;
            }
        }
    }
}

// Output any errors (optional for debugging)
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join TutorTuition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        body {
            background-color: #f7f9fc;
            font-family: 'Roboto', sans-serif;
            font-family: 'Montserrat', sans-serif;
        }

        #hey {
            height: 100%;
        }

        .container {
            margin-top: 60px;
            max-width: 650px;
            background-color: #98d8f7;
            padding: 40px;
            /*border-radius: 12px;*/
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
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

        header {
            position: -webkit-sticky;
            /* For Safari */
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background-color: #0072e7;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    <div class="container">
        <h1 class="text-center mb-4"><b>Why Join TutorTuition?</b></h1>
        <a style="display:flex;justify-content:center; align-items:center;" href="#register"
            class="btn btn-primary w-100 mb-3">
            <h3 style="margin:1vh">Register as Student</h3>
        </a>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
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


    </div>

    </div>

    <div class="container" id="register">
        <h2 class="text-center mb-4"><b>Student Registration</b></h2>

        <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
            <p>
                <?php echo htmlspecialchars($error); ?>
            </p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form action="signup-student.php" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="full_name" class="form-label required">Student Name:</label>
                <input type="text" id="full_name" name="full_name" class="form-control" required>
                <div class="invalid-feedback">
                    Please fill out your name.
                </div>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-select">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="guardian_name" class="form-label">Guardian Name (in case of minor):</label>
                <input type="text" id="guardian_name" name="guardian_name" class="form-control">
            </div>

            <!-- Class -->
            <div class="form-group">
                <label for="class_course" class="form-label">Class:</label>
                <select id="class" name="class_course" class="form-select">
                    <option value="" disabled selected>Select Class</option>
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
                <label for="contact_number" class="form-label required">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" class="form-control" required>
                <div class="invalid-feedback">
                    Please fill out your contact number.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" class="form-control">
            </div>




            <div class="form-group">
                <label class="form-label">Medium:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="medium[]" value="Hindi">
                    <label class="form-check-label">Hindi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="medium[]" value="English">
                    <label class="form-check-label">English</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="medium[]" value="Hindi-English">
                    <label class="form-check-label">Hindi-English</label>
                </div>
            </div>
            <!-- Preferred Weekdays (Multi-Checkbox) -->
            <div class="table-responsive">
                <table class="table table-bordered mt-3" id="dynamic-field-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Preferred Weekday</th>
                            <th>Preferred Timing</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-field-container">
                        <tr class="dynamic-row" id="row-0">
                            <td>
                                <label for="subjects" class="required">Subjects</label>
                                <select style="width:auto" name="subjects[]" class="form-select" id="subjectSelect-0"
                                    required onchange="toggleOptionalSubject0()" required>
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

                                <div class="invalid-feedback">
                                    Please select a subject.
                                </div>
                                <!-- Hidden textbox for Optional Subject with initial blank space -->
                                <div id="optionalSubjectDiv-0" style="display: none; margin-top: 10px;">
                                    <label for="optsubject-0" class="required">Other Subject Name</label>
                                    <input type="text" name="optsubject[]" class="form-control" id="optsubject-0"
                                        value=" ">
                                    <div class="invalid-feedback">
                                        Please provide the name of the Other subject.
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Monday" id="monday-0">
                                    <label class="form-check-label" for="monday-0">Monday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Tuesday" id="tuesday-0">
                                    <label class="form-check-label" for="tuesday-0">Tuesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Wednesday" id="wednesday-0">
                                    <label class="form-check-label" for="wednesday-0">Wednesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Thursday" id="thursday-0">
                                    <label class="form-check-label" for="thursday-0">Thursday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Friday" id="friday-0">
                                    <label class="form-check-label" for="friday-0">Friday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Saturday" id="saturday-0">
                                    <label class="form-check-label" for="saturday-0">Saturday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferred_weekdays[0][]"
                                        value="Sunday" id="sunday-0">
                                    <label class="form-check-label" for="sunday-0">Sunday</label>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <label for="from_time_0" class="form-label">From:</label>
                                        <select style="width:auto" name="from_time[]" id="from_time_0"
                                            class="form-select time-picker" required>
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
                                        <select name="to_time[]" id="to_time_0" class="form-select time-picker"
                                            required>
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
                                <button type="button" class="btn btn-danger remove-row-btn" onclick="removeRow(0)">
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

            <div class="mb-3">
                <label for="comments_special_instructions" class="form-label">Special Requirements:</label>
                <textarea id="comments_special_instructions" name="comments_special_instructions"
                    class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <footer class="text-muted">
        &copy; 2024 TutorTuition
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // JavaScript to toggle Optional Subject input field for dynamically added rows
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
                console.error(`Element with ID subjectSelect-${rowId}, optionalSubjectDiv-${rowId}, or optsubject-${rowId} not found.`);
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
        // Initial setup for the first row
        // document.addEventListener("DOMContentLoaded", function() {
        //     toggleOptionalSubject(0); // Initialize for the first row (row 0)
        // });
        // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        $(document).ready(function () {
            let rowCount = 1; // Start from 1 since row-0 is already there


            // Function to add a new row
            $('#addRowBtn').click(function () {
                let newRow = `
                <tr class="dynamic-row" id="row-${rowCount}">
                    <td>
                        <label for="subjects" class="required">Subjects</label>
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
                        <div class="invalid-feedback">
                            Please select a subject.
                        </div>

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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Monday" id="monday-${rowCount}">
                            <label class="form-check-label" for="monday-${rowCount}">Monday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Tuesday" id="tuesday-${rowCount}">
                            <label class="form-check-label" for="tuesday-${rowCount}">Tuesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Wednesday" id="wednesday-${rowCount}">
                            <label class="form-check-label" for="wednesday-${rowCount}">Wednesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Thursday" id="thursday-${rowCount}">
                            <label class="form-check-label" for="thursday-${rowCount}">Thursday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Friday" id="friday-${rowCount}">
                            <label class="form-check-label" for="friday-${rowCount}">Friday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Saturday" id="saturday-${rowCount}">
                            <label class="form-check-label" for="saturday-${rowCount}">Saturday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_weekdays[${rowCount}][]" value="Sunday" id="sunday-${rowCount}">
                            <label class="form-check-label" for="sunday-${rowCount}">Sunday</label>
                        </div>
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
                rowCount++;
            });
        });

        // Function to remove a specific row
        function removeRow(rowId) {
            $(`#row-${rowId}`).remove();
        }
        // Update the hidden "preferred_timings[]" field whenever "from_time" or "to_time" is changed
        $(document).on('change', 'select[name="from_time[]"], select[name="to_time[]"]', function () {
            $('tr.dynamic-row').each(function (index) {
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