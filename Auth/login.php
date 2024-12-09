<?php
require("nedded.php");
error_reporting(0);
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = mysqli_connect($serverName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
// If the form is submitted
if(isset($_COOKIE['emailid']) && isset($_COOKIE['pass'])){
    $emailid = $_COOKIE['emailid'];
    $pass = $_COOKIE['pass'];
}
 else {
  $emailid = $pass = "";  
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    
   
    
    // Check admin table
    $admin_sql = "SELECT * FROM admin WHERE Admin_email='$email'";
    $admin_result = $conn->query($admin_sql);
    if ($admin_result->num_rows > 0) {
        $row = $admin_result->fetch_assoc();
        $stored_password = $row['Admin_password'];
        $adminname = $row['Admin_name'];
        
        if ($password === $stored_password) {
        //if (password_verify($password,$row['Admin_password'])) {
            $_SESSION['adminname'] = $adminname;
            $_SESSION['adminemail']=$email;
            $_SESSION['login_type'] = "admin";
            echo "Admin login successful";
             if(isset($_REQUEST['RememberMe']))
            {
                setcookie('emailid',$email, time()+10);
                setcookie('pass',$password,time()+10);
            }
            header("location: ../Admin_Dashboard/admin_Dashboard.php"); 
        } else {
         echo '<script>alert("Invalid Password Of Admin! ");</script>';
        }
    }

    // Check mentor table/
//     $mentor_sql = "SELECT * FROM mentor WHERE Mentor_Email='$email'";
// $mentor_result = $conn->query($mentor_sql);


        $query = "SELECT * FROM mentor WHERE Mentor_Email='$email'";
        $result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // $stored_password = $row['Mentor_Password'];
    $status = $row['Status']; // Assuming status field is retrieved from the database

    
    // if (password_verify($password, $stored_password)) {
         
    if (password_verify($password,$row['Mentor_Password'])) {
        if ($status == 1) {
            
            $mentorname = $row['Mentor_name'];
            $mentorcontact = $row['Mentor_Contact'];
            $mentorexperience = $row['Mentor_Experience'];
            $mentorexpertise = $row['Mentor_Expertise'];
            // Set session variables
            $_SESSION['mentorname'] = $mentorname;
            $_SESSION['mentoremail'] = $email;
            $_SESSION['mnumber'] = $mentorcontact;
            $_SESSION['mexperience'] = $mentorexperience;
            $_SESSION['mexpertise'] = $mentorexpertise;
            $_SESSION['login_type'] = "mentor";
            
            if(isset($_REQUEST['RememberMe']))
            {
                setcookie('emailid',$email, time()+10);
                setcookie('pass',$password,time()+10);
            }
            
            // Redirect to mentor dashboard
            header("Location: ../Mentor_Dashboard/mentor_Dashboard.php");
        } else {
            echo '<script>alert("Admin has not approved you! ");</script>';            
        }
     }
      else {
         echo '<script>alert("Invalid Password Of Mentor! ");</script>';
         }
}


    // Similarly, check parent and child tables...
    //$parent_sql = "SELECT p.*, c.Child_name, c.date_of_birth FROM parent p INNER JOIN child c ON c.Parent_id = p.Parent_id WHERE p.Parent_Email_id='$email'";
    $parent_sql = "SELECT * FROM parent WHERE Parent_Email_id='$email'";
    $parent_result = $conn->query($parent_sql);
    if ($parent_result->num_rows > 0) {
        $row = $parent_result->fetch_assoc();
        //$stored_password = $row['Parent_Password'];
        //if ($password === $stored_password) {
        if (password_verify($password,$row['Parent_Password'])) {
            $parentname = $row['Parent_Name'];
            $parentcontact = $row['Parent_contact'];
            $childname = $row['Child_name'];
            $childdob = $row['date_of_birth'];
            $city = $row['City'];

            $_SESSION['parentname'] = $parentname;
            $_SESSION['parentEmail']=$email;
            $_SESSION['pnumber'] = $parentcontact;
            $_SESSION['cname'] = $childname;
            $_SESSION['cdob'] = $childdob;
            $_SESSION['city'] = $city;
            $_SESSION['login_type'] = "parent";
            
            if(isset($_REQUEST['RememberMe']))
            {
                setcookie('emailid',$email, time()+10);
                setcookie('pass',$password,time()+10);
            }
            
            // echo "Parent login successful";
            header("Location: ../parent_dashboard/parent_dashboard.php");
            // header("location:../parent/parentUI.php"); 
            
        } else {
            echo '<script>alert("Invalid Password Of Parent! ");</script>';
          
        }
    }else{
        echo'Error';
    }
}


// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <style>
        .container{
            background-image: url(./bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            width:100%;
        }
        .card-body{
            background: beige;
            width: 190%;
            margin-left: -90px;
            box-shadow:5px 5px 15px 5px grey;
            border-radius: 25px 25px 25px 25px;
        }
        .card-body h5{
            color:#855e46;
            font-weight: 600;
            font-size: 900px;
        }
        .card-body .pt-4 p{
            font-size: 20px;
        }
        #loginForm  label{
            color:#855e46;
            font-size:20px;
            font-weight: 600;
        }
        .btn{
            color:beige;
            background: #855e46;
            border:2px solid #855e46;
            font-weight: 600;
        }
        .btn:hover{
            color:#855e46;
            background: beige;
            border:3px solid #855e46;
        }
        .small{
            color:#855e46;
            font-weight: 500;
        }
    </style> -->
</head>
<body>
<main>
    <div class="container">
        <section class="section login min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4"style='color:#855e46;'>Log In</h5>
                                    <p class="text-center small"style='color:#855e46;'>Enter your credentials to log in</p>
                                </div>
                                <form id="loginForm" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label"style='color:#855e46;'>Email I'd</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail" value="<?php echo $emailid; ?>" required>
                                        <div class="invalid-feedback">Please enter a valid Email address!</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label"style='color:#855e46;'>Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" value="<?php echo $pass; ?>" required>
                                        <div class="invalid-feedback">Password must be at least 8 characters long</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 " type="submit"style='color:beige; background:#855e46; border:3px solid #855e46;'>Log In</button>
                                    </div>
                                    <div class="col-12">
                                        <input type="checkbox" name="RememberMe"><span> Remember Me</span>
                                        <p class="small mb-0">Don't have an account? <a href="./register.php">Sign up</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    // JavaScript for form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
        const emailInput = document.getElementById('yourEmail');
        const passwordInput = document.getElementById('yourPassword');

        emailInput.addEventListener('blur', function() {
            const email = emailInput.value.trim().toLowerCase();
            const validDomains = ['gmail.com']; // Add more domains as needed

            const isValidEmail = /^[a-zA-Z0-9._%+-]+@(gmail\.com)$/i.test(email);
            const isValidDomain = validDomains.some(domain => email.endsWith('@' + domain));

            if (!isValidEmail || !isValidDomain) {
                emailInput.classList.add('invalid'); // Add a class to apply CSS for highlighting
                emailInput.setCustomValidity('Please enter a valid email address with one of the allowed domains: ' + validDomains.join(', '));
            } else {
                emailInput.classList.remove('invalid'); // Remove the class if email is valid
                emailInput.setCustomValidity('');
            }
        });

// Additional event listener to remove 'invalid' class when user starts typing
emailInput.addEventListener('input', function() {
    emailInput.classList.remove('invalid');
});


        passwordInput.addEventListener('blur', function() {
            if (!passwordInput.value.match(/.{8,}/)) {
                passwordInput.setCustomValidity('Password must be at least 8 characters long');
            } else {
                passwordInput.setCustomValidity('');
            }
        });
    });
</script>
</body>
</html>
