<?php
require("child_Header.php");
require("child_Sidebar.php");
require("../Auth/nedded.php");

// Enable error reporting
error_reporting(0);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Material Content</title>
    <style>
        .card {
            width: 260px;
            height: 330px;
            background: #fff;
            border-top-right-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            box-shadow: 0 14px 26px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease-out;
            text-decoration: none;
            margin: 20px;
            margin-top:200px;
            margin-left:150px;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.005) translateZ(0);
            box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
                0 24px 46px var(--box-shadow-color);
        }

        .card:hover .overlay {
            transform: scale(4) translateZ(0);
        }

        .card:hover .circle {
            border-color: var(--bg-color-light);
            background: var(--bg-color);
        }

        .card:hover .circle:after {
            background: var(--bg-color-light);
        }

        .card:hover p {
            color: var(--text-color-hover);
        }

        .card:active {
            transform: scale(1) translateZ(0);
            box-shadow: 0 15px 24px rgba(0, 0, 0, 0.11),
                0 15px 24px var(--box-shadow-color);
        }

        .card p {
            font-size: 27px;
            color: #737c7c;
            margin-top: 90px;
            z-index: 1000;
            transition: color 0.3s ease-out;
        }

        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease-out;
        }

        .circle img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: contain;
        }

        .circle:after {
            width: 138px;
            height: 138px;
            display: block;
            position: absolute;
            background: var(--bg-color);
            border-radius: 50%;
            top: 6px;
            left: 6px;
            transition: opacity 0.3s ease-out;
        }

        .overlay {
            width: 121px;
            position: absolute;
            height: 90px;
            border-radius: 32%;
            background: var(--bg-color);
            top: 55px;
            left: 77px;
            z-index: 0;
            transition: transform 0.3s ease-out;
        }

        .materials {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        /* Centering the video frame */
        #content-container {
            display: none; /* Initially hide the content container */
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>

<div id="header">
    <?php //require("child_Header.php"); ?>
</div>

<div id="sidebar">
    <?php //require("child_Sidebar.php"); ?>
</div>

<div class="materials" id="materials-container">
<?php
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "curious_cubs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debug: Check database connection
//echo "Connected successfully";

// Fetch data from material table where category is 'Maths'
$sql = "SELECT m.material_id, m.material_name, m.description, m.pdf_path, m.img_path
        FROM material m
        JOIN subjects s ON m.SubjectID = s.SubjectID
        WHERE s.SubjectName = 'Maths'";
$result = $conn->query($sql);

// Debug: Check if the query ran successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $materialName = $row["material_name"];
        $imgPath = $row["img_path"];
        $pdfPath = $row["pdf_path"];
        echo "<a href='javascript:void(0);' class='material-link' data-type='" . pathinfo($pdfPath, PATHINFO_EXTENSION) . "' data-path='" . $pdfPath . "'>
                <div class='card'>
                    <div class='overlay'></div>
                    <div class='circle'>
                        <img src='$imgPath' alt='$materialName'>
                    </div>
                    <p>$materialName</p>
                </div>
            </a>";
    }
} else {
    echo "0 results";
}

$conn->close();
ob_end_flush();
?>
</div>

<div class="content" id="content-container"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var materialLinks = document.querySelectorAll('.material-link');
    var contentContainer = document.getElementById('content-container');
    var materialsContainer = document.getElementById('materials-container');

    materialLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            var type = this.getAttribute('data-type');
            var path = this.getAttribute('data-path');

            // Check the file type and display accordingly
            if (type === 'pdf') {
                // Display PDF
                contentContainer.innerHTML = '<embed src="' + path + '" type="application/pdf" />';
            } else if (type === 'mp4' || type === 'mp3') {
                // Display video or audio
                contentContainer.innerHTML = '<video controls><source src="' + path + '" type="video/mp4"></video>';
            } else {
                // Display unsupported format message
                contentContainer.innerHTML = 'Unsupported format';
            }

            // Hide the materials container
            materialsContainer.style.display = 'none';
            // Show the content container
            contentContainer.style.display = 'flex';
        });
    });
});
</script>

</body>
</html>
