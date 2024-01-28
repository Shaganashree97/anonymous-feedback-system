<?php
// Include the database connection file
include('../conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $faculty_name = $_POST['faculty_name'];
    $faculty_mail_id = $_POST['faculty_mail_id'];
    $password = $_POST['faculty_password'];
    $faculty_course_handling = $_POST['faculty_course_handling'];
    $slot_number = $_POST['slot_number'];

    // Hash the password (You may uncomment this line if needed)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert data into the faculty table
    $sql = "INSERT INTO faculty (faculty_name, faculty_mail_id, faculty_password, course_title, faculty_slot_number) 
            VALUES ('$faculty_name', '$faculty_mail_id', '$password', '$faculty_course_handling', '$slot_number')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "<script>alert('Registration successful. Faculty account created!'); window.location.href = 'faculty_login.html';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href = 'faculty_register.html';</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the registration page if accessed without form submission
    header("Location: faculty_register.html");
    exit();
}
?>
