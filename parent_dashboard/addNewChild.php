<?php
//session_start();
require("../Auth/nedded.php");
require("parent_header.php");
require("parent_sidebar.php");

$parentId = $_SESSION['pr'];

$database = "curious_cubs";
$serverName = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($serverName, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['btn3'])) {
    $childname = $_POST['Child_name'];
    $childdob = $_POST['date_of_birth'];
    $_SESSION['Child_name'] = $childname;
    $_SESSION['date_of_birth'] = $childdob;
    
    // Calculate age
    $dob = new DateTime($childdob);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
    
    $sql = "INSERT INTO child (Parent_Id, Child_name, date_of_birth, age) VALUES ('$parentId', '$childname', '$childdob', '$age')";
    if (mysqli_query($conn, $sql)) {
        echo "Registered successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Child Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        /* Custom styling for input controls */
        .card-title {
            color: #855e46;
            font-size: 30px;
            margin-bottom: 10px;
        }

        input.form-control {
            border: 2px solid #855e46;
        }

        label {
            color: #855e46;
            font-weight: 600;
            font-size: 20px;
        }

        .submit-btn {
            background-color: #855e46;
            color: white;
        }

        .container {
            margin-top: 90px;
            margin-left: 130px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-9 offset-lg-2">
            <div class="card p-2">
                <div class="card-body">
                    <h5 class="card-title">Add Child</h5>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="childName">Child Name</label>
                            <input type="text" class="form-control" name="Child_name" id="childName"
                                   placeholder="Enter Child's Name">
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="text" class="form-control datepicker" name="date_of_birth" id="dateOfBirth"
                                   placeholder="Date of Birth">
                        </div>
                        <input type="submit" value="Submit" name="btn3" class="btn submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
</script>

</body>
</html>
