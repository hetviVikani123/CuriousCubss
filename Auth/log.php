<?php
require("nedded.php");
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'];
$password = $input['password'];

$response = array();

$admin_sql = "SELECT * FROM admin WHERE Admin_email='$email'";
$admin_result = $conn->query($admin_sql);
if ($admin_result->num_rows > 0) {
    $row = $admin_result->fetch_assoc();
    if ($password === $row['Admin_password']) {
        $response['success'] = true;
        $response['role'] = 'admin';
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid Password Of Admin';
    }
}

$mentor_sql = "SELECT * FROM mentor WHERE Mentor_Email='$email'";
$mentor_result = $conn->query($mentor_sql);
if ($mentor_result->num_rows > 0) {
    $row = $mentor_result->fetch_assoc();
    if (password_verify($password, $row['Mentor_Password']) && $row['Status'] == 1) {
        $response['success'] = true;
        $response['role'] = 'mentor';
    } else {
        $response['success'] = false;
        $response['message'] = $row['Status'] == 1 ? 'Invalid Password Of Mentor' : 'Admin has not approved you';
    }
}

$parent_sql = "SELECT * FROM parent WHERE Parent_Email_id='$email'";
$parent_result = $conn->query($parent_sql);
if ($parent_result->num_rows > 0) {
    $row = $parent_result->fetch_assoc();
    if (password_verify($password, $row['Parent_Password'])) {
        $response['success'] = true;
        $response['role'] = 'parent';
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid Password Of Parent';
    }
}

echo json_encode($response);

$conn->close();
?>
