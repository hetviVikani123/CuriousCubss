<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #855e46;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #855e46;
        }
    </style>
</head>
<body>
   <center>  <big style="font-size:25px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">This Is An Information Of Parent</big></center><br>
    <table style="width:1200px;margin-left:120px;">
        <tr>
            <th style="background:#855e46;color:white;text-align:center;">Parent_ID</th>
            <th style="background:#855e46;color:white;text-align:center;">Parent_Name</th>
            <th style="background:#855e46;color:white;text-align:center;">Parent_Email_id</th>
            <th style="background:#855e46;color:white;text-align:center;">Parent_Contact</th>
            <th style="background:#855e46;color:white;text-align:center;">City</th>
        </tr>
        <?php
        session_start();
        // Establish connection to MySQL
        $serverName = "localhost";
        $username = "root";
        $password = "";
        $database = "curious_cubs";

        $connection = mysqli_connect($serverName, $username, $password, $database);

        // Check if connection is successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query'])) {

            // Escape user input to prevent SQL injection
            $query = mysqli_real_escape_string($connection, $_POST['query']);

            // Perform search query
            $sql = "SELECT * FROM parent WHERE Parent_Name LIKE '%$query%' OR Parent_Email_id LIKE '%$query%' OR Parent_contact LIKE '%$query%' OR City LIKE '%$query%'";
            $result = mysqli_query($connection, $sql);

            // Display search results in table rows
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='background:white;color:#855e46;font-weight:600;text-align:center;'>" . $row['Parent_Id'] . "</td>";
                    echo "<td style='background:white;color:#855e46;font-weight:600;text-align:center;'>" . $row['Parent_Name'] . "</td>";
                    echo "<td style='background:white;color:#855e46;font-weight:600;text-align:center;'>" . $row['Parent_Email_id'] . "</td>";
                    echo "<td style='background:white;color:#855e46;font-weight:600;text-align:center;'>" . $row['Parent_contact'] . "</td>";
                    echo "<td style='background:white;color:#855e46;font-weight:600;text-align:center;'>" . $row['City'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'  style='border:1px solid #855e46;font-size:20px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;'>No results found</td></tr>";
            }
        }
        ?>
    </table>


<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #855e46;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body><br>
   <center>  <big style="font-size:25px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">This Is Information Of Child</big></center><br>
    <table style="width:1200px;margin-left:120px;">
        <tr>
            <th style="background:#855e46;color:white;text-align:center;">Child ID</th>
            <th style="background:#855e46;color:white;text-align:center;">Parent Name</th>
            <th style="background:#855e46;color:white;text-align:center;">Child Name</th>
            <th style="background:#855e46;color:white;text-align:center;">Date of Birth</th>
        </tr>
        
        <?php
       // session_start();
        // Establish connection to MySQL
        $serverName = "localhost";
        $username = "root";
        $password = "";
        $database = "curious_cubs";

        $connection = mysqli_connect($serverName, $username, $password, $database);

        // Check if connection is successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query'])) {

            // Escape user input to prevent SQL injection
            $query = mysqli_real_escape_string($connection, $_POST['query']);

            // Perform search query
            $sql = "SELECT * FROM child WHERE Child_name LIKE '%$query%' OR Parent_id LIKE '%$query%' OR date_of_birth LIKE '%$query%'";
            $result = mysqli_query($connection, $sql);

            // Check if query was successful
            if ($result) {
                // Display search results in table rows
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['Child_id'] . "</td>";
                        echo "<td>" . $row['Parent_id'] . "</td>";
                        echo "<td>" . $row['Child_name'] . "</td>";
                        echo "<td>" . $row['date_of_birth'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='border:1px solid #855e46;font-size:20px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;'>No results found</td></tr>";
                }
            } else {
                echo "Query failed: " . mysqli_error($connection);
            }
        }
        ?>
    </table>
    <head>
                <style>
                         table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>    
    <body><br>
        <center> <big style="font-size:25px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">This Is Information Of Mentor</big></mark></center><br>
   <table style="width:1200px;margin-left:120px;">
   <tr>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor ID</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Name</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Email</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Contact</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Qualification</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Experience</th>
                        <th style="background:#855e46;color:white;text-align:center;">Mentor Expertise</th>
                        <th style="background:#855e46;color:white;text-align:center;">Status</th>
                    </tr>
   
    <?php
// Establish connection to MySQL
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$connection = mysqli_connect($serverName, $username, $password, $database);

// Check if connection is successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query'])) {

    // Escape user input to prevent SQL injection
    $query = mysqli_real_escape_string($connection, $_POST['query']);

    // Perform search query
    $sql = "SELECT * FROM mentor WHERE Mentor_name LIKE '%$query%' OR Mentor_id LIKE '%$query%' OR Mentor_email LIKE '%$query%' OR Mentor_Contact LIKE '%$query%' OR Mentor_Qualification LIKE '%$query%' OR Mentor_Experience LIKE '%$query%' OR Mentor_Expertise LIKE '%$query%' OR Status LIKE '%$query%'";
    $result = mysqli_query($connection, $sql);

    // Check if query was successful
    if ($result) {
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Mentor_id'] . "</td>";
                echo "<td>" . $row['Mentor_name'] . "</td>";
                echo "<td>" . $row['Mentor_email'] . "</td>";
                echo "<td>" . $row['Mentor_Contact'] . "</td>";
                echo "<td>" . $row['Mentor_Qualification'] . "</td>";
                echo "<td>" . $row['Mentor_Experience'] . "</td>";
                echo "<td>" . $row['Mentor_Expertise'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } 
        else {
            echo "<tr><td colspan='8' style='border:1px solid #855e46;font-size:20px;color:#855e46;font-weight:900;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;'>No results found</td></tr>";
        }
    } else {
        echo "Query failed: " . mysqli_error($connection);
    }

?>
</table>
</body>
</html>
