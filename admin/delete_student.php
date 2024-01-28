<?php
include_once '../conn.php';

// Check if the student_rollno parameter is set
if (isset($_GET['rollno'])) {
    $studentRollNo = $_GET['rollno'];

    // Delete the student record from the database
    $sql = "DELETE FROM student WHERE student_rollno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentRollNo);

    if ($stmt->execute()) {
        // Redirect back to the student details page after deletion
        header("Location: details_students.php");
        exit();
    } else {
        // Handle deletion error (you may customize this part)
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Redirect to the student details page if no rollno parameter is provided
    header("Location: details_students.php");
    exit();
}

// Close the database connection
$conn->close();
?>
