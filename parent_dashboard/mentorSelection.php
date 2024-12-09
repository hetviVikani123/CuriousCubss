<?php
session_start();
error_reporting(0);
require("parent_header.php");
require("parent_sidebar.php");
require("../Auth/nedded.php");

if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != "parent") {
    //header("Location:logout.php");
}

// Establish connection to the database
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['Mentor_id'])) {
    $mentor_id = $_POST['Mentor_id'];

    // Delete previously selected mentor (if any)
    unset($_SESSION['selected_mentor']);

    // Fetch details of the selected mentor from the database
    $sql_fetch_mentor = "SELECT * FROM mentor WHERE Mentor_id = '$mentor_id'";
    $result_fetch_mentor = mysqli_query($conn, $sql_fetch_mentor);
    if ($result_fetch_mentor && mysqli_num_rows($result_fetch_mentor) > 0) {
        $row_selected_mentor = mysqli_fetch_assoc($result_fetch_mentor);
        $_SESSION['selected_mentor'] = $row_selected_mentor;
        echo json_encode(array("status" => "success", "message" => "Mentor selected successfully!"));
        exit; // Exit after sending response
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to select mentor"));
        exit; // Exit after sending response
    }
}

// Insert data into Mentor_Assignment table
if (isset($_POST['Mentor_id'])) {
    // Retrieve form data including child's name
    $mentor_id = $_POST['Mentor_id'];
    $child_name = $_POST['child_name'];

    // Fetch child_id from the database using child's name
    $sql_fetch_child_id = "SELECT Child_id FROM child WHERE Child_name = '$child_name'";
    $result_fetch_child_id = mysqli_query($conn, $sql_fetch_child_id);
    
    if ($result_fetch_child_id && mysqli_num_rows($result_fetch_child_id) > 0) {
        $row = mysqli_fetch_assoc($result_fetch_child_id);
        $child_id = $row['Child_id'];

        // Insert data into Mentor_Assignment table using mysqli_query
        $sql_insert_assignment = "INSERT INTO mentor_assignment (child_id, mentor_id, date_of_assignment, date_of_release) VALUES ('$child_id', '$mentor_id', NOW(), NULL)";
        $result_insert_assignment = mysqli_query($conn, $sql_insert_assignment);

        if ($result_insert_assignment) {
            echo json_encode(array("status" => "success", "message" => "Mentor assigned successfully!"));
            exit; // Exit after sending response
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to assign mentor"));
            exit; // Exit after sending response
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to fetch child ID"));
        exit; // Exit after sending response
    }
}


if (isset($_POST['Child_name'])) {
    $_SESSION['childName'] = $_POST['Child_name'];
    $_SESSION['childDOB'] = $_POST['childDOB']; // Assuming child's DOB is submitted in the form
}

// Display child details
$childName = isset($_SESSION['Child_name']) ? $_SESSION['Child_name'] : "Child Name Not Available";
$childDOB = isset($_SESSION['date_of_birth']) ?$_SESSION['date_of_birth'] : "Child DOB Not Available";
$parentName = isset($_SESSION['parentName']) ? $_SESSION['parentName'] : "";
$parentEmail = isset($_SESSION['Parent_Email_id']) ? $_SESSION['Parent_Email_id'] : "";
$parentContact = isset($_SESSION['parentContact']) ? $_SESSION['parentContact'] : "";
$parentCity = isset($_SESSION['parentCity']) ? $_SESSION['parentCity'] : "";
$selectedMentor = isset($_SESSION['selected_mentor']) ? $_SESSION['selected_mentor'] : null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .main {
            padding: 20px;
        }

        .pagetitle {
            text-align: center;
            margin-bottom: 20px;
        }

        .breadcrumb {
            background-color: transparent;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .breadcrumb-item {
            display: inline;
        }

        .breadcrumb-item.active {
            color: #855e46;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .selected {
            background-color: #00FF00 !important;
        }

        /* Additional CSS for child details */
        .child-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .child-details table {
            width: 100%;
        }

        .child-details th {
            font-weight: normal;
            width: 30%;
        }

        .child-details td {
            padding: 8px;
        }

        /* Additional CSS for select mentor button */
        .select-mentor-button {
            background-color: #855e46;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .select-mentor-button:hover {
            background-color: #6e4a37;
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
    </div>

    <!-- Display Child Details -->
    <div class="child-details">
        <h2 style="margin-bottom: 20px;">Child Details</h2>
        <table>
            <tr>
                <th>Child Name:</th>
                <td><?php echo $childName; ?></td>
            </tr>
            <tr>
                <th>Child DOB:</th>
                <td><?php echo $childDOB; ?></td>
            </tr>
            <tr>
                <th>Parent Name:</th>
                <td><?php echo $parentName; ?></td>
            </tr>
            <tr>
                <th>Parent Email:</th>
                <td><?php echo $parentEmail; ?></td>
            </tr>
            <tr>
                <th>Contact:</th>
                <td><?php echo $parentContact; ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td><?php echo $parentCity; ?></td>
            </tr>
            <tr>
                <th>Selected Mentor:</th>
                <td colspan="2">
                    <?php
                    if ($selectedMentor) {
                        echo $selectedMentor['Mentor_name'] . "<br>";
                        echo $selectedMentor['Mentor_email'] . "<br>";
                    } else {
                        echo "No mentor selected";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" id="childName" name="child_name" value="<?php echo $_SESSION['Child_name']; ?>">
    <!-- Select Mentor Button -->
    <button class="select-mentor-button" onclick="toggleMentorList()">Select Mentor</button>

    <!-- Mentor List -->
    <section class="section dashboard" id="mentorList" style="display: none;">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Which mentors does your child aim for?</h2>
                        <table id="mentorTable">
                            <thead>
                            <tr>
                                <th>Mentor Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Qualification</th>
                                <th>Experience</th>
                                <th>Expertise</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Query to fetch all mentors
                            $sql = "SELECT * FROM mentor";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr data-mentor-id='{$row["Mentor_id"]}'>";
                                    echo "<td>" . $row["Mentor_name"] . "</td>";
                                    echo "<td>" . $row["Mentor_email"] . "</td>";
                                    echo "<td>" . $row["Mentor_Contact"] . "</td>";
                                    echo "<td>" . $row["Mentor_Qualification"] . "</td>";
                                    echo "<td>" . $row["Mentor_Experience"] . "</td>";
                                    echo "<td>" . $row["Mentor_Expertise"] . "</td>";
                                    echo "<td>" . $row["Status"] . "</td>";
                                    echo "<td><button onclick=\"selectMentor(this, '{$row["Mentor_id"]}');\">Select</button></td>"; // Button for selecting mentor
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No mentors found</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Your existing code for mentor details -->

</main>

<script>
    function toggleMentorList() {
        var mentorList = document.getElementById("mentorList");
        if (mentorList.style.display === "none") {
            mentorList.style.display = "block";
        } else {
            mentorList.style.display = "none";
        }
    }

    function selectMentor(button, mentorId) {
        var table = document.getElementById("mentorTable");
        var rows = table.getElementsByTagName("tr");
        
        // Deselect all mentors
        for (var i = 0; i < rows.length; i++) {
            rows[i].classList.remove("selected");
            var buttons = rows[i].getElementsByTagName("button");
            if (buttons.length > 0) {
                buttons[0].innerText = "Select";
                buttons[0].style.backgroundColor = "";
            }
        }

        var row = button.parentNode.parentNode;
        row.classList.add("selected");

        if (button.innerText === "Select") {
            button.innerText = "Reject";
            button.style.backgroundColor = "red";
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        console.log(response.message);
                        updateChildDetails(); 
                    } else {
                        console.error(response.message);
                    }
                }
            };
            xhr.send("Mentor_id=" + mentorId);
        } else {
            button.innerText = "Select";
            button.style.backgroundColor = "";
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        console.log(response.message);
                        updateChildDetails(); // Update child details on success
                    } else {
                        console.error(response.message);
                    }
                }
            };
            xhr.send();
        }
    }

    // Function to update child details dynamically
    function updateChildDetails() {
        // Fetch the child details from the server and update the child details section
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "child_details.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("childDetails").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
</body>
</html>
