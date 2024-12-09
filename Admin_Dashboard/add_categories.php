<?php
error_reporting(0);
require("../Auth/nedded.php");
include("./admin_Header.php");
include("./admin_Sidebar.php");

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectName = $_POST['subjectName'];

    // File upload handling
    $targetDirectory = "uploads/";  // Directory where uploaded files will be saved
    $targetFile = $targetDirectory . basename($_FILES["subjectImagePath"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["subjectImagePath"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["subjectImagePath"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["subjectImagePath"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["subjectImagePath"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    // End of file upload handling

    // Insert into database
    $sql = "INSERT INTO subjects (SubjectName, SubjectImagePath) VALUES ('$subjectName', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "New subject added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <style>
        body {
            background-color: #f8f9fa; /* Setting a light gray background */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 100px 0px 0px 350px; /* Centering the form */
            padding: 20px;
            background-color: white; /* White background for the card */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adding a subtle shadow */
        }

        h2 {
            color: #855e46; /* Dark brown heading color */
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #855e46; /* Dark brown label color */
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #855e46; /* Dark brown submit button */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #6e4939; /* Darken the button on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Subject</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="subjectName">Subject Name:</label>
            <input type="text" id="subjectName" name="subjectName" required>

            <label for="subjectImagePath">Subject Image:</label>
            <input type="file" id="subjectImagePath" name="subjectImagePath" required>

            <input type="submit" value="Add Subject">
        </form>
    </div>
</body>
</html>
