
<?php
session_start();

// Check if the file details are stored in the session
// if(isset($_SESSION['uploadedFile'])) {
//     $uploadedFile = $_SESSION['uploadedFile'];
//     $fileName = $uploadedFile['fileName'];
//     $filePath = $uploadedFile['filePath'];
    
//     // Output HTML to display the file link
//     echo "<a href='viewFile.php?file=$filePath'>$fileName</a>";
// } else {
//     echo "No file uploaded.";
// }
?>
<?php
require("child_Header.php");
require("child_Sidebar.php");
require("../Auth/nedded.php");

// Fetch subjects data from the database
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

$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Examples</title>

    <style>
        /* Your existing CSS styles remain unchanged */
        body {
            background: #f2f4f8;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            height: 100vh;
            font-family: "Open Sans";
        }

        .education,
        .credentialing,
        .combination  {
            --bg-color: #b78f76;
            margin-right: 1000px;
            --bg-color-light: #ffeeba;
            --text-color-hover: #4C5656;
            --box-shadow-color: rgba(138, 255, 84, 0.48);
        }

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
            width: 100%; /* Make the image fill the circle */
            height: 100%; /* Make the image fill the circle */
            border-radius: 50%;
            object-fit: contain; /* Use "contain" instead of "cover" */
        }
        .circle:after {
           /* content: "";*/
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

        .circle svg {
            z-index: 10000;
            transform: translateZ(0);
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
        .Box{
            margin: -30px;
            display: flex;
            justify-content: center;
            margin-left: 230px;
        }
    </style>
</head>

<body>
<div class="Box">
    <?php
    // Check if there are any subjects in the database
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $subjectName = $row["SubjectName"];
            $subjectImagePath = $row["SubjectImagePath"];

            // Check the category to determine which code block to execute
            if ($subjectName === 'Maths') {
                // Code for Maths category
    ?>
                <a href="mathsContent.php" class="card">
                    <div class="overlay"></div>
                    <div class="circle">
                        <img src="<?php echo $subjectImagePath; ?>" alt="<?php echo $subjectName; ?> Image">
                    </div>
                    <p><?php echo $subjectName; ?></p>
                </a>
    <?php
            } elseif ($subjectName === 'English') {
                // Code for English category
    ?>
                <a href="englishContent.php" class="card">
                    <div class="overlay"></div>
                    <div class="circle">
                        <img src="<?php echo $subjectImagePath; ?>" alt="<?php echo $subjectName; ?> Image">
                    </div>
                    <p><?php echo $subjectName; ?></p>
                </a>
    <?php
           
            } else {
                // Handle other categories or scenarios
            }
        }
    } else {
        echo "0 results";
    }
    ?>
</div>

</body>

</html>
<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Examples</title>

    <style>
        body {
            background: #f2f4f8;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            height: 100vh;
            font-family: "Open Sans";
        }

        .education,
        .credentialing,
        .combination  {
            --bg-color: #b78f76;
            margin-right: 1000px;
            --bg-color-light: #ffeeba;
            --text-color-hover: #4C5656;
            --box-shadow-color: rgba(138, 255, 84, 0.48);
        }

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
            width: 100%; /* Make the image fill the circle */
            height: 100%; /* Make the image fill the circle */
            border-radius: 50%;
            object-fit: contain; /* Use "contain" instead of "cover" */
        }
        .circle:after {
           /* content: "";*/
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

        .circle svg {
            z-index: 10000;
            transform: translateZ(0);
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
        .Box{
            margin: -30px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<div class="Box">
<body>

    <a href="maths.php"class="card education">
        <div class="overlay"></div>
        
        <div class="circle">
            <img src="https://i.pinimg.com/originals/16/1c/ca/161cca17bd8c423f845916ee0ec2b8f7.jpg" alt="Maths Image"> 
        </div>
        <p>MATHS</p>
    </a>

    <a href="#" class="card credentialing">
        <div class="overlay"></div>
        <div class="circle">
            <img src="IMG_2645.jpg" alt="Real world Image"> 

        </div>
       <p>REAL WORLD</p>
    </a>
    <a href="english.php" class="card combination">
        <div class="overlay"></div>
        <div class="circle">
            <img src="ENGLISH.jpeg" alt="">
        </div>
        <p>ENGLISH</p>
    </a>
    
    </box>
</body>

</html> -->