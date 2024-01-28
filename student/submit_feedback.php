<?php
// Include the database connection file
include('../conn.php');

// Start the session
session_start();

// Check if the student is logged in
if (!isset($_SESSION['student_rollno'])) {
    header("Location: student_login.html");
    exit();
}

// Retrieve the student's roll number and name from the session
$student_rollno = $_SESSION['student_rollno'];
$student_name = $_POST['student_name'];

// Retrieve other form data
$selected_course = $_POST['selected_course'];
$selected_faculty = $_POST['selected_faculty'];
$feedback = $_POST['feedback'];

// Include the student_name in the INSERT query
$insert_feedback_query = "INSERT INTO feedback (student_rollno, course_title, faculty_name, feedback, student_name) VALUES ('$student_rollno', '$selected_course', '$selected_faculty', '$feedback', '$student_name')";

// Execute the query and track success
$success = $conn->query($insert_feedback_query);

// Set variables for notification
$notificationType = $success ? 'success' : 'error';
$notificationMessage = $success ? 'Feedback submitted successfully!' : 'Error submitting feedback. Please try again.';

// Redirect to the student dashboard after submitting feedback
header("Location: student_dashboard.php?notificationType=$notificationType&notificationMessage=$notificationMessage");
exit();
?>
