<?php
require("nedded.php");
session_start();
    $database = "curious_cubs";
    $serverName = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($serverName, $username, $password, $database);
            $error = "";
            $parentname = $_POST['parentName'];
            $parentemail = $_POST['parentEmail'];
            $parentcontact = $_POST['parentContact'];
            $parentpassword = $_POST['parentPassword'];
            $parentcpassword = $_POST['parentCPassword'];
            $city = $_POST['parentCity'];
            $childname = $_POST['childName'];
            $childdob = $_POST['childDOB'];

            $emailQuery = "select * from parent where Parent_Email_id = '$parentemail' ";
            $emailResult = mysqli_query($conn, $emailQuery);
            $emailCount = mysqli_num_rows($emailResult);
            if ($emailResult == 1) {
              $parentIdQuery = "SELECT Parent_id FROM parent WHERE Parent_Email_id='$parentemail'";
              $parentIdResult = mysqli_query($conn, $parentIdQuery);
          
              // Check if query execution was successful
              if ($parentIdResult) {
                  // Fetch the Parent_id from the result
                  $row = mysqli_fetch_assoc($parentIdResult);
                  $parentId = $row['Parent_id'];
          
                  // Insert child data using the fetched Parent_id
                  $sql= "INSERT INTO child(Parent_id, Child_name, date_of_birth) VALUES ('$parentId', '$childname', '$childdob')";
                  $result = mysqli_query($conn, $sql);                    
          
                  // Check if insertion was successful
                  if ($result) {

                      echo "Registered successfully";
                  } else {
                      echo "Error: " . mysqli_error($conn); // Output any error message
                  }
                  
              } else {
                  echo "Error fetching Parent_id: " . mysqli_error($conn); // Output any error message
              }
          }
?>