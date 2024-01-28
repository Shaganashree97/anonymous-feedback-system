<?php
// Include the database connection file
include('../conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $faculty_mail_id = $_POST['faculty_mail_id'];
    $password = $_POST['faculty_password'];

    // Retrieve the password from the database based on the email
    $sql = "SELECT faculty_password FROM faculty WHERE faculty_mail_id = '$faculty_mail_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Faculty found, verify the password
        $row = $result->fetch_assoc();
        $storedPassword = $row['faculty_password'];

        if ($password === $storedPassword) {
            // Password is correct, login successful
            session_start();
            $_SESSION['faculty_mail_id'] = $faculty_mail_id; // Set a session variable for faculty
            header("Location: faculty_dashboard.php"); // Redirect to the faculty dashboard
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'faculty_login.html';</script>";
        }
    } else {
        // Faculty not found
        echo "<script>alert('Faculty not found. Please check your email.'); window.location.href = 'faculty_login.html';</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the login page if accessed without form submission
    header("Location: faculty_login.html");
    exit();
}
?>
