<?php
session_start();
require("../Auth/nedded.php");

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "curious_cubs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetching the child's name
$child_name = "Child"; // Default name
if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id'];

    // Prepare SQL query to fetch child's name associated with the parent
    $sql_child = "SELECT Child_name FROM child WHERE Parent_Id = ?";
    $stmt_child = mysqli_prepare($conn, $sql_child);

    if ($stmt_child === false) {
        die('MySQL prepare error: ' . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt_child, "i", $parent_id);

    // Execute statement
    mysqli_stmt_execute($stmt_child);

    // Bind result variables
    mysqli_stmt_bind_result($stmt_child, $child_name);

    // Fetch value
    mysqli_stmt_fetch($stmt_child);

    // Close statement
    mysqli_stmt_close($stmt_child);
}

// Close connection
mysqli_close($conn);

require("child_Header.php");
require("child_Sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .centered-card {
            position: absolute;
            top: 30%;
            left: 35%;
            height:100px;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .centered-card h5 {
            color: #855e46;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .centered-card p {
            color: #855e46;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style='color:#855e46;'>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html" style='color:#855e46;'>Home</a></li>
                    <li class="breadcrumb-item active" style='color:#855e46;'>Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="centered-card">
            <?php
            if (isset($_SESSION['parent_id'])) {
                // Display the personalized message
if (isset($_GET['child_name'])) {
    $child_name = htmlspecialchars(urldecode($_GET['child_name']));
    echo "<p>Hello " . $child_name . "<br>Welcome and have a great day!</p>";
} else {
    echo "No child selected.";
}

            } else {
                echo "<p>Parent not logged in.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
