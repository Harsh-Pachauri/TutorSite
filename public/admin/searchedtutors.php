<?php
session_start();
$companyLogo = "../images/whitelogo.png";
include '../../server/config.php';

// Fetch tutors based on search criteria (assuming filters are applied through GET parameters)
$searchSubject = $_GET['subject'] ?? 'all';
$searchStatus = $_GET['status'] ?? 'all';

$sql = "SELECT t.*, 
        GROUP_CONCAT(CONCAT(ts.subject, ' (', ts.medium, ', Upto: ', ts.class_upto, ')') ORDER BY ts.subject SEPARATOR '<br>') AS subject_details
        FROM tutors t 
        LEFT JOIN tutor_subjects ts ON t.id = ts.tutor_id 
        WHERE 1";

// Apply filters if they are not "all"
if ($searchSubject !== 'all') {
    $sql .= " AND ts.subject = '$searchSubject'";
}
if ($searchStatus !== 'all') {
    $sql .= " AND t.status = '$searchStatus'";
}

$sql .= " GROUP BY t.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS and Bootstrap here -->
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

        .input-group {
            width: 300px;
            /* Adjust width as needed */
        }

        td {
            vertical-align: middle;
            /* Center content vertically */
        }

        .subject-table {
            margin-top: 10px;
        }

        .remarks-input,
        .comments-input {
            width: 150px;
            min-height: 100px;
            max-height: 1000px;
            /* Set a maximum height to prevent the field from getting too big */
            resize: vertical;
            overflow-y: scroll;
            /* Allow vertical scrolling */
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* For smooth scrolling on mobile */
        }
    </style>
</head>
<body style="width:100vw;position:absolute;">
    <header style=" position:fixed; width:100vw;z-index:10;  padding: 15px;background-color: #0072e7;
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
    <div style="margin-top:7rem;" class="container">
        <h1 class="text-center mb-4">Searched Tutors</h1>
        <a href="index.php" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <form action="searchedtutors.php" method="GET">
            <!-- Status Filter -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="all">All</option>
                    <option value="contacted">Contacted</option>
                    <option value="not contacted">Not contacted</option>
                    <option value="Verified">Verified</option>
                    <option value="Blocked">Blocked</option>
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
                </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
        </form>
        <form id="massDeleteForm" action="massdeletetut.php" method="POST" onsubmit="return confirmDeleteSelected();">
        <!-- Mass Delete Button -->
            <button type="submit" class="btn btn-danger mt-3")"><i class="fas fa-trash-alt"></i> Delete Selected</button>
            <br><br>
            
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                    <th><input type="checkbox" id="selectAll"></th> <!-- Select All Checkbox -->
                        
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Status</th>
                        <th>Subjects</th>
                        <th>Mobile No</th>
                        <th>Remark</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($tutor = $result->fetch_assoc()) { ?>
                    <tr>
                    <td>
                                <input type="checkbox" name="tutor_ids[]" value="<?php echo $tutor['id']; ?>"> <!-- Checkbox for each student -->
                            </td>
                        <!-- Updated ID column -->
                        <td>
                            <a href="tutor-details.php?id=<?php echo $tutor['id']; ?>" class="text-primary">
                                <?php echo htmlspecialchars($tutor['id']); ?>
                            </a>
                        </td>

                        <!-- Rest of the columns -->
                        <td>
                            <?php echo htmlspecialchars($tutor['full_name']); ?>
                        </td>
                        <td>
                            <form method="POST" action="update-status.php" id="updateForm-<?php echo $tutor['id']; ?>">
                                <input type="hidden" name="id" value="<?php echo $tutor['id']; ?>">
                                <input type="hidden" name="role" value="tutor">
                                <select name="status" class="form-control input-group" required>
                                    <option value="contacted" <?php echo $tutor['status']=='contacted' ? 'selected' : ''
                                        ; ?>>Contacted</option>
                                    <option value="not contacted" <?php echo $tutor['status']=='not contacted'
                                        ? 'selected' : '' ; ?>>Not Contacted</option>
                                    <option value="Verified" <?php echo $tutor['status']=='Verified' ? 'selected' : '' ;
                                        ?>>Verified</option>
                                    <option value="Blocked" <?php echo $tutor['status']=='Blocked' ? 'selected' : '' ;
                                        ?>>Blocked</option>
                                </select>
                        </td>

                        <td>
                            <table class="table table-sm subject-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Medium</th>
                                        <th>Upto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    // Fetch subjects for the current tutor
                    $tutorId = $tutor['id'];
                    $subjectSql = "SELECT subject, medium, class_upto FROM tutor_subjects WHERE tutor_id = $tutorId";
                    $subjectResult = $conn->query($subjectSql);
                    while ($subject = $subjectResult->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($subject['subject']) . '</td>';
                        echo '<td>' . htmlspecialchars($subject['medium']) . '</td>';
                        echo '<td>' . htmlspecialchars($subject['class_upto']) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($tutor['mobile_no']); ?>
                        </td>

<td>
    <textarea name="remarks" class="form-control remarks-input"><?php echo htmlspecialchars($tutor['remarks'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
</td>
                        <td>
                            <button type="button" class="btn btn-success"
                                onclick="confirmUpdate(<?php echo $tutor['id']; ?>)">
                                <i class="fas fa-check"></i> Update
                            </button>
                            </form> 
                            <!-- Moved the form tag here to include the update button inside the form -->

                            <!--<button type="button" class="btn btn-danger mt-2"-->
                            <!--    onclick="confirmDelete()">-->
                            <!--    <i class="fas fa-trash-alt"></i> Delete-->
                            <!--</button>-->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
    <!--<div class="modal fade" id="confirmMassDeleteModal" tabindex="-1">-->
    <!--    <div class="modal-dialog">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--                <h5 class="modal-title">Confirm Delete</h5>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                Are you sure you want to delete the selected tutors?-->
    <!--            </div>-->
    <!--            <div class="modal-footer">-->
    <!--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
    <!--                <button type="button" class="btn btn-danger" onclick="submitMassDeleteForm()">Delete</button>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
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
                    Are you sure you want to delete this tutor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
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
                    Are you sure you want to update the status, remark, and comments of this tutor?
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
    const checkboxes = document.querySelectorAll('input[name="tutor_ids[]"]:checked');
    if (checkboxes.length === 0) {
        alert("Please select at least one tutor to delete.");
        return false;
    }
    
    return confirm("Are you sure you want to delete the selected tutor?");
}
    document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="tutor_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        };
        
        
        // JavaScript for the hamburger menu functionality
        const hamburger = document.querySelector('.hamburgers');
        const navLinks = document.querySelector('.nav-linkss');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        // Handle delete confirmation
        function confirmDelete(tutorId) {
            const deleteUrl = `delete.php?role=tutor&id=${tutorId}`;
            const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');
            deleteConfirmBtn.setAttribute('href', deleteUrl);
            const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            deleteModal.show();
        }

        // Handle update confirmation
        function confirmUpdate(tutorId) {
            const updateModal = new bootstrap.Modal(document.getElementById('confirmUpdateModal'));
            updateModal.show();

            document.getElementById('updateConfirmBtn').addEventListener('click', function () {
                const form = document.getElementById(`updateForm-${tutorId}`);
                form.submit(); // Submit the form for the specific tutor
            });
        }
    </script>
</body>

</html>