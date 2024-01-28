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

// Retrieve the student's roll number from the session
$student_rollno = $_SESSION['student_rollno'];

// Query to get the courses for the student
$courses_query = "SELECT DISTINCT course_title, faculty_name FROM faculty
                  JOIN student ON faculty.faculty_name = student.ds or faculty.faculty_name = student.dm or faculty.faculty_name = student.oops or faculty.faculty_name = student.dbms or faculty.faculty_name = student.ca
                  WHERE student.student_rollno = '$student_rollno'";

$courses_result = $conn->query($courses_query);

// Fetch the courses
$courses = [];
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row['course_title'];
}

// Fetch the student's name
$student_name_query = "SELECT student_name FROM student WHERE student_rollno = '$student_rollno'";
$student_name_result = $conn->query($student_name_query);
$student_name_row = $student_name_result->fetch_assoc();
$student_name = $student_name_row['student_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="container p-4 lg:p-20 bg-white rounded-full shadow-md text-center dark:bg-gray-700 w-full lg:w-auto">
        <header class="mb-4">
            <h1 class="text-2xl lg:text-3xl font-bold text-blue-700 dark:text-white">Student Dashboard</h1>
        </header>

        

        <div class="dashboard-form">
            <form action="submit_feedback.php" method="post" class="flex flex-col items-center">
                <label class="mb-2">
                    <span class="text-gray-700 dark:text-gray-300">Select Course:</span>
                    <select name="selected_course" required class="border rounded-md p-2 focus:outline-none focus:border-blue-500" onchange="getFacultyNames(this.value)">
                        <option value="" disabled selected>Select a course</option>
                        <?php
                        // Display course options
                        foreach ($courses as $course) {
                            echo "<option value='$course'>$course</option>";
                        }
                        ?>
                    </select>
                </label>

                <div id="facultyNamesContainer" class="mb-2"></div>

                <!-- Add the student_name as a hidden input field in the form -->
                <input type="hidden" name="student_name" value="<?php echo $student_name; ?>">

                <label class="mb-2">
                    <span class="text-gray-700 dark:text-gray-300">Feedback:</span>
                    <textarea name="feedback" rows="4" required class="border rounded-md p-2 focus:outline-none focus:border-blue-500"></textarea>
                </label>

                <button type="submit" class="bg-blue-500 text-white px-8 py-3 mt-7 rounded-md cursor-pointer transition duration-300 hover:bg-blue-700 hover:shadow-md">
                    Submit Feedback
                </button>
            </form>
            <!-- Logout button -->
    <form action="student_logout.php" method="post" class="mt-4">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md cursor-pointer transition duration-300 hover:bg-red-700 hover:shadow-md">
            Logout
        </button>
    </form>
        </div>
    </div>

    <script>
        // Function to get faculty names based on the selected course
        function getFacultyNames(selectedCourse) {
            var facultyNamesContainer = document.getElementById("facultyNamesContainer");

            // Check if a course is selected
            if (selectedCourse) {
                // Use AJAX to fetch faculty names
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Update the faculty names container with the fetched data
                            facultyNamesContainer.innerHTML = xhr.responseText;
                        } else {
                            console.error("Error fetching faculty names. Status: " + xhr.status);
                        }
                    }
                };
                // Include student_name in the AJAX request
                xhr.open("GET", "get_faculty_names.php?course=" + selectedCourse + "&student_name=" + encodeURIComponent('<?php echo $student_name; ?>'), true);
                xhr.send();
            } else {
                // Clear the faculty names container if no course is selected
                facultyNamesContainer.innerHTML = "";
            }
        }
    </script>
    <!-- Add this script in your student_dashboard.php file -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const notificationType = urlParams.get('notificationType');
        const notificationMessage = urlParams.get('notificationMessage');

        if (notificationType && notificationMessage) {
            // Display the notification div
            const notificationDiv = document.createElement('div');
            notificationDiv.className = `notification ${notificationType}`;
            notificationDiv.textContent = notificationMessage;
            document.body.appendChild(notificationDiv);

            // Remove the notification after a delay (e.g., 5 seconds)
            setTimeout(function () {
                notificationDiv.remove();
            }, 5000);
        }
    });
</script>

<style>
    /* Add this style in your CSS or inside a <style> tag in your HTML */
    .notification {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
        z-index: 9999;
    }

    .success {
        background-color: #4CAF50;
        color: white;
    }

    .error {
        background-color: #f44336;
        color: white;
    }
</style>


</body>
</html>
