<?php
// Include the database connection file
include('../conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the password from the database based on the username
    $sql = "SELECT password FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin found, verify the password
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if ($password === $storedPassword) {
            // Password is correct, login successful
            session_start();
            $_SESSION['admin_username'] = $username; // Set a session variable for admin
            header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password. Please try again.";
        }
    } else {
        // Admin not found
        echo "Admin not found. Please check your username.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the login page if accessed without form submission
    header("Location: admin_login.php");
    exit();
}
?>
