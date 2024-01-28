<?php
// Include the database connection file
include('../conn.php');

// Retrieve the selected course and student_name from the AJAX request
$selected_course = $_GET['course'];
$student_name = $_GET['student_name'];

// Query to get faculty names for the selected course
$faculty_names_query = "SELECT faculty_name FROM faculty WHERE course_title = '$selected_course'";
$faculty_names_result = $conn->query($faculty_names_query);

// Fetch the faculty names
$faculty_names = [];
while ($row = $faculty_names_result->fetch_assoc()) {
    $faculty_names[] = $row['faculty_name'];
}

// Display the faculty names as options in a select box
echo "<label class='mb-2'>
        <span class='text-gray-700 dark:text-gray-300'>Select Faculty:</span>
        <select name='selected_faculty' required class='border rounded-md p-2 focus:outline-none focus:border-blue-500'>";
echo "<option value='' disabled selected>Select a faculty</option>";
foreach ($faculty_names as $faculty_name) {
    echo "<option value='$faculty_name'>$faculty_name</option>";
}
echo "</select>
      </label>";
?>
