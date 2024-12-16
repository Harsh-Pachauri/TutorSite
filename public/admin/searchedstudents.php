<?php
session_start();
$companyLogo = "../images/whitelogo.png";
include '../../server/config.php';

$status = $_GET['status'] ?? 'all';
$subject = $_GET['subject'] ?? 'all';

// Define the list of predefined subjects
$predefined_subjects = [
    "Mathematics", "Science", "English", "Hindi", 
    "Social Studies", "Physics", "Chemistry", 
    "Biology", "Computer Science", "Economics", 
    "Accountancy", "Business Studies", "History", 
    "Geography", "Sanskrit", "Environmental Science", 
    "Physical Education", "Arts", "Performing Arts", 
    "Health Education", "Home Science"
];

// Start building the query
$query = "SELECT students.id, students.full_name, students.status, students.class_course, students.medium, students.contact_number, students.remarks 
          FROM students
          LEFT JOIN teacher_allocations ON students.id = teacher_allocations.student_id
          WHERE 1=1";

// Apply status filter
if ($status !== 'all') {
    $query .= " AND students.status = '$status'";
}

// Apply subject filter
if ($subject === 'Others') {
    // Filter students with subjects not in the predefined list
    $query .= " AND teacher_allocations.subject IS NOT NULL 
                AND teacher_allocations.subject NOT IN ('" . implode("', '", $predefined_subjects) . "')";
} elseif ($subject !== 'all') {
    // Filter by specific subject
    $query .= " AND teacher_allocations.subject = '$subject'";
}

// Execute the query
$result = $conn->query($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Searched Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
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
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            font-family: 'Montserrat', sans-serif;
        }

        h1 {
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .status-select,
        .remarks-input {
            width: 200px;
        }

        td {
            vertical-align: middle;
        }

        .remarks-input {
            width: 150px;
            min-height: 100px;
            max-height: 1000px;
            resize: vertical;
            overflow-y: scroll;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body style="position:absolute; width:100vw;">
    <header style="z-index:10;position:fixed; width:100vw;   padding: 15px;background-color: #0072e7;
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
    <div style="margin-top:7rem" class="container">
        <h1 class="text-center mb-4">Searched Students</h1>
        <a href="index.php" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <!-- Search Form -->
        <form action="searchedstudents.php" method="GET">
            <!-- Status Filter -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="all">All</option>
                    <option value="contacted">Contacted</option>
                    <option value="not contacted">Not contacted</option>
                    <option value="Registered">Registered</option>
                    <option value="Assigned">Assigned</option>
                    <option value="Bloacked">Bloacked</option>
                </select>
            </div>

            <!-- Subject Filter -->
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select name="subject" id="subject" class="form-select">
                    <option value="all">All</option>
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
                                    <option value="Others">Others</option>
                </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
        </form>
        <form id="massDeleteForm" action="massdelete.php" method="POST" onsubmit="return confirmDeleteSelected();">
        <!-- Mass Delete Button -->
            <button type="submit" class="btn btn-danger mt-3")"><i class="fas fa-trash-alt"></i> Delete Selected</button>
            <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th> <!-- Select All Checkbox -->
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Status</th>
                        <th>Class</th>

                        <th>Medium</th>
                        <th>Contact</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                                <input type="checkbox" name="student_ids[]" value="<?php echo $student['id']; ?>"> <!-- Checkbox for each student -->
                            </td>
                        <td>
                            <a href="student-details.php?id=<?php echo $student['id']; ?>">
                                <?php echo $student['id']; ?>
                            </a>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['full_name']); ?>
                        </td>

                        <!-- Status select box -->
                        <td>
                            <form method="POST" action="update-status.php"
                                id="updateForm-<?php echo $student['id']; ?>">
                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                <input type="hidden" name="role" value="student">
                                <select name="status" class="form-control input-group status-select" required>
                                    <option value="contacted" <?php echo $student['status']=='contacted' ? 'selected'
                                        : '' ; ?>>Contacted</option>
                                    <option value="not contacted" <?php echo $student['status']=='not contacted'
                                        ? 'selected' : '' ; ?>>Not Contacted</option>
                                    <option value="Registered" <?php echo $student['status']=='Registered' ? 'selected'
                                        : '' ; ?>>Registered</option>
                                    <option value="Assigned" <?php echo $student['status']=='Assigned' ? 'selected' : ''
                                        ; ?>>Assigned</option>
                                    <option value="Blocked" <?php echo $student['status']=='Blocked' ? 'selected' : '' ;
                                        ?>>Blocked</option>
                                </select>
                        </td>


                        <td>
                            <?php echo htmlspecialchars($student['class_course']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['medium']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['contact_number']); ?>
                        </td>


                        <!-- Remarks input field -->
                        <td>
                            <textarea name="remarks"
                                class="form-control remarks-input"><?php echo htmlspecialchars($student['remarks']); ?></textarea>
                        </td>

                        <!-- Actions: Update and Delete -->
                        <td>
                            <!-- Update Button -->
                            <button type="button" class="btn btn-success"
                                onclick="confirmUpdate(<?php echo $student['id']; ?>)">
                                <i class="fas fa-check"></i> Update
                            </button>
                            </form>

                            <!-- Delete Button -->
                            <!--<button type="button" class="btn btn-danger mt-2"-->
                            <!--    onclick="confirmDelete(<?php echo $student['id']; ?>)">-->
                            <!--    <i class="fas fa-trash-alt"></i> Delete-->
                            <!--</button>-->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </form>
    </div>

    <!-- Confirmation Modal for Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="deleteConfirmBtn" href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal for Update -->
    <div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUpdateModalLabel">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the status and remarks of this student?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="updateConfirmBtn">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function confirmDeleteSelected() {
    const checkboxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
    if (checkboxes.length === 0) {
        alert("Please select at least one student to delete.");
        return false;
    }
    
    return confirm("Are you sure you want to delete the selected students?");
}
    document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="student_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        };
        // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        function confirmDelete(studentId) {
            const deleteUrl = `delete.php?role=student&id=${studentId}`;
            const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');
            deleteConfirmBtn.setAttribute('href', deleteUrl);

            const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            deleteModal.show();
        }

        function confirmUpdate(studentId) {
            const updateModal = new bootstrap.Modal(document.getElementById('confirmUpdateModal'));
            updateModal.show();

            // On confirmation, submit the form for the correct student
            const updateConfirmBtn = document.getElementById('updateConfirmBtn');
            updateConfirmBtn.onclick = function () {
                document.getElementById(`updateForm-${studentId}`).submit();
            }
        }
    </script>
</body>

</html>