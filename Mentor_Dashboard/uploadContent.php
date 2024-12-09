<?php
session_start();
include "../db.php";
require("./mentor_Header.php");
require("mentor_Sidebar.php");
require("../Auth/nedded.php");
ob_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check if the form fields are set
    if(isset($_POST['topic'], $_POST['description'], $_POST['category'], $_POST['age_group'], $_FILES['file'], $_FILES['image'])) {
        $topic = $_POST['topic'];
        $description = $_POST['description'];
        $category = $_POST['category']; // Added to get selected category
        $age_group = $_POST['age_group']; // Added to get selected age group

        // Define the directory where the files will be uploaded
        $targetDirectory = "../files/"; // Change this to your desired directory
        $pdf_path = $targetDirectory . basename($_FILES["file"]["name"]);
        $img_path = $targetDirectory . basename($_FILES["image"]["name"]);

        // Check if the directory exists, if not, create it
        if (!file_exists($targetDirectory)) 
        {
            mkdir($targetDirectory, 0777, true);
        }

        // Check for file upload errors
        if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) 
        {
            echo "File upload failed with error code: " . $_FILES["file"]["error"];
            exit;
        }

        if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) 
        {
            echo "Image upload failed with error code: " . $_FILES["image"]["error"];
            exit;
        }

        // Get the file details
        $fileName = basename($_FILES["file"]["name"]);
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDirectory . $fileName;
        $targetImagePath = $targetDirectory . $imageName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $imageType = pathinfo($targetImagePath, PATHINFO_EXTENSION);

        // Check if file and image are valid uploads
        if (!empty($_FILES["file"]["name"]) && !empty($_FILES["image"]["name"])) 
        {
            // Allow certain file formats
            $allowedFileTypes = array('pdf', 'doc', 'docx', 'txt', 'mp4', 'mp3');
            $allowedImageTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedFileTypes) && in_array($imageType, $allowedImageTypes)) 
            {
                // Upload file and image to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetImagePath)) 
                {
                    // Set permissions to make the file and image readable
                    chmod($targetFilePath, 0644);
                    chmod($targetImagePath, 0644);
                    // File and image uploaded successfully, store file details in session
                    $_SESSION['uploadedFile'] = array(
                        'fileName' => $fileName,
                        'filePath' => $targetFilePath,
                        'imageName' => $imageName,
                        'imagePath' => $targetImagePath,
                        // Add other file details if needed
                    );

                    // Escape single quotes in file paths for SQL query
                    $escaped_pdf_path = $conn->real_escape_string($pdf_path);
                    $escaped_img_path = $conn->real_escape_string($img_path);

                    // Fetch subject ID based on category
                    $subject_id = null; // Initialize subject ID
                    if ($category == 'maths') 
                    {
                        // Fetch subject ID for Maths from subjects table
                        $subject_result = $conn->query("SELECT SubjectID FROM subjects WHERE SubjectName = 'Maths'");
                        if ($subject_result && $subject_result->num_rows > 0) {
                            $row = $subject_result->fetch_assoc();
                            $subject_id = $row['SubjectID'];
                        }
                    } else if($category=='real_world') {
                        $subject_result = $conn->query("SELECT SubjectID FROM subjects WHERE SubjectName = 'RealWorld'");
                        if ($subject_result && $subject_result->num_rows > 0) 
                        {
                            $row = $subject_result->fetch_assoc();
                            $subject_id = $row['SubjectID'];
                        }
                    }
                    else if($category=='english') {
                        $subject_result = $conn->query("SELECT SubjectID FROM subjects WHERE SubjectName = 'english'");
                        if ($subject_result && $subject_result->num_rows > 0) {
                            $row = $subject_result->fetch_assoc();
                            $subject_id = $row['SubjectID'];
                        }
                    }

                    // Insert data into material table
                    $sql = "INSERT INTO material(material_name, description, SubjectID, pdf_path, img_path) VALUES ('$topic', '$description', '$subject_id', '$escaped_pdf_path', '$escaped_img_path')";

                    // Execute the SQL query and handle errors
                    if ($conn->query($sql) === TRUE) {
                        echo "File and image uploaded successfully";
                        //header('Location:uploadContent.php');
                        exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file and image.";
                }
            } else {
                echo "File or image format not supported.";
            }
        }
    } else {
        // Handle case when form fields are not set
        echo "Form fields are not set.";
    }
}
    
ob_end_flush(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Uploading Form</title>
    <style>
       .uploadFile{
        margin-top: 30px;
        margin-left: 30px;
        margin-bottom: 30px;
       }
    </style>
</head>
<body>
    <main id="main" class="main">
    <div class="pagetitle">
            <h1>Mentor Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html" style='color:#855e46;'>Home</a></li>
                    <li class="breadcrumb-item" style='color:#855e46;'>Mentor Dashboard</li>
                    <li class="breadcrumb-item active" style='color:#855e46;'>Upload content</li>
                </ol>
            </nav>
        </div>
<div class="card p-2 col-9" style="width:100%;">
    <form  class="uploadFile" method="post" enctype="multipart/form-data">
        <label for="topic" style='color:#855e46;'>Content Topic:</label><br>
        <input type="text" id="topic" name="topic" required style="border:3px solid #855e46;border-radius:5px 5px 5px 5px;"><br><br>

        <label for="description" style='color:#855e46;'>Content Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required style="border:3px solid #855e46;border-radius:5px 5px 5px 5px;"></textarea><br><br>

        <label for="file" style='color:#855e46;'>File Upload:</label><br>
        <input type="file" id="file" name="file" required style='color:#855e46;'><br><br>

        <label for="image" style='color:#855e46;'>Image Upload:</label><br>
        <input type="file" id="image" name="image" required style='color:#855e46;'><br><br>

        <label for="category" style='color:#855e46;'>Category:</label><br>
        <select id="category" name="category" required style="border:3px solid #855e46;border-radius:5px 5px 5px 5px;">
        <?php
                              // Database connection
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

                              // Fetch subject names from subjects table
                              $sql = "SELECT SubjectName FROM subjects";
                              $result = $conn->query($sql);

                              // Output options in select dropdown
                              if ($result->num_rows > 0) {
                                  while ($row = $result->fetch_assoc()) {
                                      echo "<option>" . $row['SubjectName'] . "</option>";
                                  }
                              }

                              $conn->close();
                              ?>
        </select><br><br>

        <label for="age_group" style='color:#855e46;'>Age Group:</label><br>
        <select id="age_group" name="age_group" required>
            <option value="3_5" style='color:#855e46;'>Age 3-5</option>
            <option value="6_10" style='color:#855e46;'>Age 6-10</option>
            <option value="11_15" style='color:#855e46;'>Age 11-15</option>
        </select><br><br>

        <input type="submit" value="Upload" style='color:beige;background:#855e46;border:3px solid #855e46;border-radius:5px 5px 5px 5px;'>
        <input type="reset" value="Cancel" style='color:beige;background:#855e46;border:3px solid #855e46;border-radius:5px 5px 5px 5px;'>
    </form>
</div>
    </main>

</body>
</html>
