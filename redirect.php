<!-- redirect.php -->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'];

    switch ($userType) {
        case 'admin':
            header('Location: admin/admin_login.html');
            break;
        case 'faculty':
            header('Location: faculty/faculty_login.html');
            break;
        case 'student':
            header('Location: student/student_login.html');
            break;
        default:
            // Handle unexpected user type
            break;
    }
} else {
    // Redirect to index page if accessed directly
    header('Location: index.php');
}

?>
