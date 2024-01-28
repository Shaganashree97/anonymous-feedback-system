<?php
include_once '../conn.php';

// Check if the faculty mail ID is set in the URL
if (isset($_GET['faculty_mail_id'])) {
    $faculty_mail_id = $_GET['faculty_mail_id'];

    // Fetch faculty details based on the provided mail ID
    $sql = "SELECT * FROM faculty WHERE faculty_mail_id = '$faculty_mail_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $faculty_mail_id = $row['faculty_mail_id'];
        $faculty_name = $row['faculty_name'];
        $course_title = $row['course_title'];
        $faculty_slot_number = $row['faculty_slot_number'];
    } else {
        // Redirect to the faculty details page if no record is found
        header("Location: details_faculties.php");
        exit();
    }
} else {
    // Redirect to the faculty details page if no faculty mail ID is provided
    header("Location: details_faculties.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $updated_faculty_name = $_POST['faculty_name'];
    $updated_course_title = $_POST['course_title'];
    $updated_slot_number = $_POST['faculty_slot_number'];

    // Update faculty details in the database
    $update_sql = "UPDATE faculty SET faculty_name = '$updated_faculty_name', course_title = '$updated_course_title', faculty_slot_number = '$updated_slot_number' WHERE faculty_mail_id = '$faculty_mail_id'";
    $conn->query($update_sql);

    // Redirect to the faculty details page after updating
    header("Location: details_faculties.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Faculty Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8 p-4 lg:p-8 bg-white rounded-md shadow-md">
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl lg:text-3xl font-bold text-indigo-700">Update Faculty Details</h1>
            <a href="details_faculties.php" class="text-indigo-500 hover:underline">Back to Faculty Details</a>
        </header>

        <!-- Faculty details form -->
        <form action="" method="post" class="w-full max-w-lg mx-auto">
            <div class="mb-4">
                <label for="faculty_name" class="block text-gray-700 text-sm font-semibold mb-2">Faculty Name:</label>
                <input type="text" id="faculty_name" name="faculty_name" value="<?php echo $faculty_name; ?>" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="course_title" class="block text-gray-700 text-sm font-semibold mb-2">Course Title:</label>
                <input type="text" id="course_title" name="course_title" value="<?php echo $course_title; ?>" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="faculty_slot_number" class="block text-gray-700 text-sm font-semibold mb-2">Slot Number:</label>
                <input type="text" id="faculty_slot_number" name="faculty_slot_number" value="<?php echo $faculty_slot_number; ?>" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-md cursor-pointer transition duration-300 hover:bg-blue-700 hover:shadow-md">Update</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
