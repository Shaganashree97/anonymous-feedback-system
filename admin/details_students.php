<?php include_once '../conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8 p-4 lg:p-8 bg-white rounded-md shadow-md">
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl lg:text-3xl font-bold text-indigo-700">Student Details</h1>
            <a href="admin_dashboard.php" class="text-indigo-500 hover:underline">Back to Dashboard</a>
        </header>

        <?php
        // Fetch student details from the database
        $sql = "SELECT student_rollno, student_name, student_mail_id, ds, dm, oops, dbms, ca FROM student";
        $result = $conn->query($sql);
        ?>

        <!-- Display student details from the database -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Roll No</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Data Structures</th>
                        <th class="py-2 px-4 border-b">Discrete Mathematics</th>
                        <th class="py-2 px-4 border-b">Object Oriented Programming</th>
                        <th class="py-2 px-4 border-b">DataBase Management Systems</th>
                        <th class="py-2 px-4 border-b">Computer Architecture</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["student_rollno"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["student_name"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["student_mail_id"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["ds"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["dm"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["oops"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["dbms"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>" . $row["ca"] . "</td>";
                            echo "<td class='py-2 px-4 border-b'>
                                    <button class='bg-red-500 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-red-700' 
                                            onclick=\"confirmDelete('delete_student.php?rollno=" . $row["student_rollno"] . "')\">
                                        Delete
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='py-2 px-4 text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Additional content can be added here if needed -->
    </div>

    <!-- JavaScript for confirming deletion -->
    <script>
        function confirmDelete(url) {
            if (confirm("Are you sure you want to delete this student?")) {
                window.location.href = url;
            }
        }
    </script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
