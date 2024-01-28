<?php
// Include the database connection file
include('../conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $student_rollno = $_POST['student_rollno'];
    $student_mail_id = $_POST['student_mail_id'];
    $password = $_POST['password'];
    $student_name = $_POST['student_name'];
    $ds = $_POST['ds'];
    $dm = $_POST['dm'];
    $oops = $_POST['oops'];
    $dbms = $_POST['dbms'];
    $ca = $_POST['ca'];

    // Prepare and execute the SQL query to insert data into the student table
    $sql = "INSERT INTO student (student_rollno, student_mail_id, password, student_name, ds, dm, oops, dbms, ca) 
            VALUES ('$student_rollno', '$student_mail_id', '$password', '$student_name', '$ds', '$dm', '$oops', '$dbms', '$ca')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "<script>alert('Registration successful. Student account created!'); window.location.href = 'student_login.html';</script>";
        exit();
    } else {
        // Registration failed
        echo "<script>alert('Error: Unable to register. Please check your information and try again.'); window.location.href = 'student_register.html';</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the registration page if accessed without form submission
    header("Location: student_register.html");
    exit();
}
?>
