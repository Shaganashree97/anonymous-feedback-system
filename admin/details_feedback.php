<?php 

include_once '../conn.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8 p-4 lg:p-8 bg-white rounded-md shadow-md">
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl lg:text-3xl font-bold text-indigo-700">Feedback Details</h1>
            <a href="admin_dashboard.php" class="text-indigo-500 hover:underline">Back to Dashboard</a>
        </header>

        <?php
        // Fetch feedback details from the database
        $sql = "SELECT feedback_id, student_rollno, student_name, course_title, faculty_name, feedback, timestamp FROM feedback";
        $result = $conn->query($sql);
        ?>

        <!-- Display feedback details from the database -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Student Roll No</th>
                        <th class="py-2 px-4 border-b">Student Name</th>
                        <th class="py-2 px-4 border-b">Course Title</th>
                        <th class="py-2 px-4 border-b">Faculty Name</th>
                        <th class="py-2 px-4 border-b">Feedback</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["student_rollno"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["student_name"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["course_title"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["faculty_name"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["feedback"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["timestamp"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='py-2 px-4 text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Additional content can be added here if needed -->
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
