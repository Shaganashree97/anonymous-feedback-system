<!-- admin_dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8 p-4 lg:p-8 bg-white rounded-md shadow-md">
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl lg:text-3xl font-bold text-indigo-700">Admin Dashboard</h1>
            
            <!-- Navigation links for different views (Desktop) -->
            <nav class="hidden lg:flex space-x-4">
                <a href="details_students.php" class="text-gray-700 hover:text-indigo-500">Students</a>
                <a href="details_faculties.php" class="text-gray-700 hover:text-indigo-500">Faculties</a>
                <a href="details_courses.php" class="text-gray-700 hover:text-indigo-500">Courses</a>
                <a href="details_feedback.php" class="text-gray-700 hover:text-indigo-500">Feedback</a>
            </nav>

            <!-- Dropdown menu for mobile view -->
            <div class="lg:hidden relative">
                <button type="button" class="text-gray-700 hover:text-indigo-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Dropdown menu items -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                    <a href="details_students.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Student Details</a>
                    <a href="details_faculties.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Faculty Details</a>
                    <a href="details_courses.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Course Details</a>
                    <a href="details_feedback.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Feedback</a>
                </div>
            </div>
        </header>

        <!-- Default content: Welcome to Admin Control! -->
        <section class="text-center">
            <h2 class="text-xl lg:text-2xl font-semibold text-indigo-700 mb-4">Welcome to Admin Control!</h2>
            <!-- Additional content can be added here if needed -->
        </section>

        <a href="admin_logout.php" class="text-indigo-500 hover:underline">Logout</a>
    </div>

</body>
</html>
