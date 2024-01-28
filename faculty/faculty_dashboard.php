<?php
// Include the database connection file
include('../conn.php');

// Start the session
session_start();

// Check if the faculty is logged in
if (!isset($_SESSION['faculty_mail_id'])) {
    header("Location: faculty_login.html");
    exit();
}

// Retrieve the faculty's email from the session
$faculty_mail_id = $_SESSION['faculty_mail_id'];

// Query to get feedback for the faculty
$feedback_query = "SELECT * FROM feedback WHERE faculty_name = (SELECT faculty_name FROM faculty WHERE faculty_mail_id = '$faculty_mail_id')";
$feedback_result = $conn->query($feedback_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-brown-200">

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6 text-brown-800">Faculty Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            // Check if there is feedback for the faculty
            if ($feedback_result->num_rows > 0) {
                while ($row = $feedback_result->fetch_assoc()) {
                    echo "<div class='p-4 border rounded-md bg-brown-100 shadow-md text-brown-800'>";
                    echo "<p><strong>FeedBack ID:</strong> {$row['feedback_id']}</p>";
                    // echo "<p><strong>Student Name:</strong> {$row['student_name']}</p>";
                    echo "<p><strong>Course Title:</strong> {$row['course_title']}</p>";
                    echo "<p><strong>Feedback:</strong> {$row['feedback']}</p>";
                    // echo "<p><strong>Timestamp:</strong> {$row['timestamp']}</p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-brown-800'>No feedback available for this faculty.</p>";
            }
            ?>
        </div>

        <!-- Styled Logout button -->
        <form action="faculty_logout.php" method="post" class="mt-8">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-700 hover:shadow-md">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
