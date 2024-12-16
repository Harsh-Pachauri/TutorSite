<?php
include '../../server/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectId = intval($_POST['subject_id']);
    $price = trim($_POST['price']);

    // Validate the price
    if (is_numeric($price) && $price > 0) {
        // Update the quoted price in the database
        $sql = "UPDATE tutor_subjects SET quoted_price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $price, $subjectId);
        
        if ($stmt->execute()) {
            echo "Price updated successfully!";
        } else {
            echo "Error updating price: " . $stmt->error;
        }
    } else {
        echo "Invalid price.";
    }
} else {
    echo "Invalid request.";
}
?>
