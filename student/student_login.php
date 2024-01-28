<?php
// Include the database connection file
include('../conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $student_rollno = $_POST['student_rollno'];
    $password = $_POST['password'];

    // Retrieve the password from the database based on the student_rollno
    $sql = "SELECT password FROM student WHERE student_rollno = '$student_rollno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student found, verify the password
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if ($password === $storedPassword) {
            // Password is correct, login successful
            session_start();
            $_SESSION['student_rollno'] = $student_rollno; // Set a session variable for student
            header("Location: student_dashboard.php"); // Redirect to the student dashboard
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'student_login.html';</script>";
        }
    } else {
        // Student not found
        echo "<script>alert('Student not found. Please check your roll number.'); window.location.href = 'student_login.html';</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the login page if accessed without form submission
    header("Location: student_login.html");
    exit();
}
?>
