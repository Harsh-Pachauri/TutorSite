<?php
session_start();
include '../../server/config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['student'];

// Fetch current student data
$sql = "SELECT * FROM students WHERE id = $user_id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class_course = $_POST['class_course'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $preferred_timings = $_POST['preferred_timings'];

    $update_sql = "UPDATE students SET full_name='$full_name', gender='$gender', class_course='$class_course',
                    contact_number='$contact_number', email='$email', address='$address', 
                    preferred_timings='$preferred_timings' WHERE id = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Profile</title>
    <style>
        /* Resetting some default browser styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #0047ab;
            margin-bottom: 20px;
        }

        label {
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], 
        input[type="email"], 
        select, 
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            background-color: #f9f9f9;
        }

        input:focus, 
        select:focus, 
        textarea:focus {
            outline: none;
            border-color: #0047ab;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            width: 100%;
            padding: 15px;
            font-size: 1rem;
            background-color: #0047ab;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #00357e;
        }

        .back-btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            color: #ffffff;
            background-color: #0047ab;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        /* Media query for smaller devices */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.75rem;
            }

            button {
                padding: 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="back-btn-container">
        <a href="index.php" class="back-btn">Back to Dashboard</a>
    </div>

    <div class="container">
        <h1>Edit Profile</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $student['full_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male" <?php if($student['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($student['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if($student['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Class/Course:</label>
                <input type="text" name="class_course" value="<?php echo $student['class_course']; ?>" required>
            </div>

            <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo $student['contact_number']; ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
            </div>

            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" required><?php echo $student['address']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Preferred Timings:</label>
                <input type="text" name="preferred_timings" value="<?php echo $student['preferred_timings']; ?>" required>
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>

</body>
</html>
