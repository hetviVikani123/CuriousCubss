<?php
require("nedded.php");
    error_reporting(0);
    session_start();
    $database = "curious_cubs";
    $serverName = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($serverName, $username, $password, $database);

    try {
        if (isset($_POST['btn3'])) {
            $error = "";
            $parentname = $_POST['parentName'];
            $_SESSION['parentEmail']=$parentemail;
            $parentcontact = $_POST['parentContact'];
            $parentpassword = $_POST['parentPassword'];
            $parentcpassword = $_POST['parentCPassword'];
            $city = $_POST['parentCity'];
            $childname = $_POST['childName'];
            $childdob = $_POST['childDOB'];

            $emailQuery = "select * from parent where Parent_Email_id = '$parentemail' ";
            $emailResult = mysqli_query($conn, $emailQuery);
            $emailCount = mysqli_num_rows($emailResult);
          //   if ($emailResult == 1) {
          //     $parentIdQuery = "SELECT Parent_id FROM parent WHERE Parent_Email_id='$parentemail'";
          //     $parentIdResult = mysqli_query($conn, $parentIdQuery);
          
          //     // Check if query execution was successful
          //     if ($parentIdResult) {
          //         // Fetch the Parent_id from the result
          //         $row = mysqli_fetch_assoc($parentIdResult);
          //         $parentId = $row['Parent_id'];
          
          //         // Insert child data using the fetched Parent_id
          //         $sql= "INSERT INTO child VALUES ('$parentId', '$childname', '$childdob')";
              
          //         $result = mysqli_query($conn, $sql);
          
          //         // Check if insertion was successful
          //         if ($result) {

          //             echo "Registered successfully";
          //         } else {
          //             echo "Error: " . mysqli_error($conn); // Output any error message
          //         }
                  
          //     } else {
          //         echo "Error fetching Parent_id: " . mysqli_error($conn); // Output any error message
          //     }
          // }
            if ($parentname == "") {
                echo"Parent Name Is Empty";
            
            // } elseif (($emailCount > 0)) {
            //     echo '<b style="background-color: red; color: white;">Email Already Taken.</b>';
            } elseif (strlen($parentcontact) != 10 || !is_numeric($parentcontact)) {
                echo "Phone Number should be of 10 digits and numeric value";
            } elseif (strlen(trim($parentpassword)) < 5) {
                echo'<script type="text/JavaScript">alert("Password length should not be less than 5 characters");</script>';
            } elseif (($parentpassword != $parentcpassword)) {
                echo "Password does not match.";
            } elseif ($city == "") {
                echo"City Is Empty!";
            } 
          
            else {
                if (!( empty(trim($parentname)) || empty(trim($parentpassword)) || empty(trim($parentemail)) ||  empty(trim($city)) || empty(trim($parentcontact)))) {
                    $sqlp = "INSERT INTO parent(Parent_Name, Parent_Email_id, Parent_Password, Parent_contact, City) VALUES ('$parentname', '$parentemail', '$parentpassword', '$parentcontact', '$city')";
                    $resultp = mysqli_query($conn, $sqlp);
                    // if ($resultp) {
                    //     $result1 = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
                    //     $auto_incr = mysqli_fetch_row($result1);
                        // $parent_id = $auto_incr[0];

                        // $sql2 = "INSERT INTO child(Parent_id,Child_name,date_of_birth) VALUES ($parent_id,'$childname','$childdob');";
                        // mysqli_query($conn, $sql2);

                        // $_SESSION['parentname'] = $parentname;
                        // $_SESSION['parentemail'] = $parentemail;
                        // $_SESSION['pnumber'] = $parentcontact;
                        // $_SESSION['cname'] = $childname;
                        // $_SESSION['cdob'] = $childdob;
                        // $_SESSION['city'] = $city;
                        // $_SESSION['login_type'] = "parent";

                        header("Location:./parent_dashboard/parent_dashboard.php");

                    }
                    else{
                        echo "Registration unsuccessful";
                    }
                } 
            }
            
        
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
    }

    try {
        if (isset($_POST['btn2'])) {
            $error = "";
            $mentorname = $_POST['mentorName'];
            $mentoremail = $_POST['mentorEmail'];
            $mentorpassword = $_POST['mentorPassword'];
            $mentorcpassword = $_POST['mentorCPassword'];
            $mentorcontact = $_POST['mentorContact'];
            $mentorqualification = $_POST['mentorQualification'];
            $mentorexperience = $_POST['mentorExperience'];
            $mentorexpertise = $_POST['mentorExpertise'];

            $emailQuery2 = "select * from mentor where Mentor_email = '$mentoremail' ";
            $emailResult2 = mysqli_query($conn, $emailQuery2);
            $emailCount2 = mysqli_num_rows($emailResult2);

            if ($mentorname == "") {
                echo"Mentor Name Is Empty";
            } elseif (($emailCount2 > 0)) {
                echo "Email Already Taken.";
            } elseif (strlen(trim($mentorpassword)) < 5) {
                echo'<script type="text/JavaScript">alert("Mentor Password length should not be less than 5 characters");</script>';
            } elseif (($mentorpassword != $mentorcpassword)) {
                echo "Password does not match.";
            } elseif (strlen($mentorcontact) != 10 || !is_numeric($mentorcontact)) {
                echo "Phone Number should be of 10 digits and numeric value";
            } elseif ($mentorqualification == "") {
                echo"Mentor Qualification Is Empty";
            } elseif ($mentorexperience == "") {
                echo"Mentor Experience Is Empty";
            } else {
                if (!( empty(trim($mentorname)) || empty(trim($mentoremail)) || empty(trim($mentorpassword)) || empty(trim($mentorcontact)) || empty(trim($mentorqualification)) || empty(trim($mentorexperience)) || empty(trim($mentorexpertise)))) {
                    $sql = "INSERT INTO mentor (Mentor_name,Mentor_email, Mentor_Password, Mentor_Contact, Mentor_Qualification, Mentor_Experience, Mentor_Expertise) VALUES ('$mentorname', '$mentoremail', '$mentorpassword', '$mentorcontact', '$mentorqualification','$mentorexperience','$mentorexpertise');";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "Sign Up Successfull";
                    }
                    $_SESSION['mentorname'] = $mentorname;
                    $_SESSION['mentoremail'] = $mentoremail;
                    $_SESSION['mnumber'] = $mentorcontact;
                    $_SESSION['mqualification'] = $mentorqualification;
                    $_SESSION['mexperience'] = $mentorexperience;
                    $_SESSION['mexpertise'] = $mentorexpertise;
                    $_SESSION['login_type'] = "mentor";

                    header("Location:..\Mentor_Dashboard\mentor_dashboard.php");
                } else {
                    echo'<script type="text/JavaScript">alert("Please Fill all the fields before submitting");</script>';
                }
            }
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
    }


    mysqli_close($conn);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"style='color:#855e46;'>Create an Account</h5>
                    <p class="text-center small"style='color:#855e46;'>Enter your personal details to create an account</p>
                  </div>
                  <form class="row g-3 needs-validation" action="" method="post" novalidate>
                    <div id="parentForm" style="display: none;">
                      <div class="col-12">
                        <label for="parentName" class="form-label" style='color:#855e46;'>Parent's Name</label>
                        <input type="text" name="parentName" class="form-control" id="parentName" required>
                      </div>
                        <div class="col-12">
                        <label for="parentEmail" class="form-label" style='color:#855e46;'>Parent's Email</label>
                        <input type="email" name="parentEmail" class="form-control"  required>
                        </div>
                        <div class="col-12">
                        <label for="parentContact" class="form-label" style='color:#855e46;'>Parent's Contact</label>
                        <input type="number" name="parentContact" class="form-control"  required >
                        </div>
                        <div class="col-12">
                        <label for="parentPassword" class="form-label" style='color:#855e46;'>Parent's Password</label>
                        <input type="password" name="parentPassword" class="form-control" required>
                        </div>
                        <div class="col-12">
                        <label for="parentCPassword" class="form-label" style='color:#855e46;'>Parent's Confirm Password</label>
                        <input type="password" name="parentCPassword" class="form-control"  required>
                        </div>
                        <div class="col-12">
                        <label for="parentCity" class="form-label" style='color:#855e46;'>Parent's City</label>
                        <input type="text" name="parentCity" class="form-control"  required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 mt-2" type="submit" name="btn3" style='color:beige;background:#855e46;border:2px solid #855e46'>Create Account</button>
                    </div>
                    </div>
                    <div id="mentorForm" style="display: none;">
                      <div class="col-12">
                        <label for="mentorName" class="form-label" style='color:#855e46;'>Mentor's Name</label>
                        <input type="text" name="mentorName" class="form-control" id="mentorName" required>
                      </div>
                      <div class="col-12">
                        <label for="mentorEmail" class="form-label" style='color:#855e46;'>Mentor's Email</label>
                        <input type="email" name="mentorEmail" class="form-control" id="mentorEmail" required>
                      </div>
                      <div class="col-12">
                        <label for="mentorPassword" class="form-label" style='color:#855e46;'>Mentor's Password</label>
                        <input type="password" name="mentorPassword" class="form-control" id="mentorPassword" required pattern=".{6,}" title="Password must be at least 6 characters">
                        <div class="invalid-feedback">Please enter your password (at least 6 characters)!</div>
                      </div>
                        <div class="col-12">
                        <label for="mentorCPassword" class="form-label" style='color:#855e46;'>Mentor's Confirm Password</label>
                        <input type="password" name="mentorCPassword" class="form-control" id="mentorCPassword" required pattern=".{6,}" title="Password must be at least 6 characters">
                        <div class="invalid-feedback">Please enter your password (at least 6 characters)!</div>
                      </div>
                      <div class="col-12">
                        <label for="mentorContact" class="form-label" style='color:#855e46;'>Mentor's Contact</label>
                        <input type="number" name="mentorContact" class="form-control" id="mentorContact" required>
                      </div>
                      <div class="col-12">
                        <label for="mentorQualification" class="form-label" style='color:#855e46;'>Mentor's Qualification</label>
                        <input type="text" name="mentorQualification" class="form-control" id="mentorQualification" required>
                      </div>
                      <div class="col-12">
                        <label for="mentorExperience" class="form-label" style='color:#855e46;'>Mentor's Experience(In Years)</label>
                        <input type="number" name="mentorExperience" class="form-control" id="mentorExperience" required>
                      </div>
                      <div class="col-12">
                        <label for="mentorExpertise" class="form-label" style='color:#855e46;'>Mentor's Expertise</label>
                        <select id="mentorExpertise" name="mentorExpertise" placeholder="Mentor Expertise" class="form-control" required>
                            <option>Select Expertise</option>
                            <option>Real World</option>
                            <option>Maths</option>
                            <option>English</option>
                            <option>Personal development</option>
                        </select>
                      </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 mt-2" type="submit" name="btn2" style='color:beige;background:#855e46;border:2px solid #855e46'>Create Account</button>
                    </div>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-primary w-100" type="button" onclick="showParentForm()" style='color:beige;background:#855e46;border:2px solid #855e46'>Parent</button>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-primary w-100" type="button" onclick="showMentorForm()" style='color:beige;background:#855e46;border:2px solid #855e46'>Mentor</button>
                    </div>
                    
                    <div class="col-12">
                      <p class="small mb-0" style='color:#855e46;'>Already have an account? <a href="./login.php">Log in</a></p>
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

  <!-- Custom Validation Script -->
  <script>
    function showParentForm() {
      document.getElementById("parentForm").style.display = "block";
      document.getElementById("mentorForm").style.display = "none";

    }

    function showMentorForm() {
      document.getElementById("mentorForm").style.display = "block";
      document.getElementById("parentForm").style.display = "none";
      
    }
  </script>


  <!-- Custom Validation Script -->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation');
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
//        .forEach(function(form) {
//          form.addEventListener('submit', function(event) {
//            if (!form.checkValidity()) {
//              event.preventDefault();
//              event.stopPropagation();
//            }
//            form.classList.add('was-validated');
//          }, false);
//        });

      // Password Strength Validation
      document.getElementById('yourPassword').addEventListener('input', function() {
        var password = this.value;
        var lowercaseRegex = /[a-z]/;
        var uppercaseRegex = /[A-Z]/;
        var digitRegex = /[0-9]/;
        var specialRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        var strength = 0;
        if (lowercaseRegex.test(password)) {
          strength++;
        }
        if (uppercaseRegex.test(password)) {
          strength++;
        }
        if (digitRegex.test(password)) {
          strength++;
        }
        if (specialRegex.test(password)) {
          strength++;
        }

        var progressBar = document.getElementById('passwordStrength');
        var strengthText = document.getElementById('passwordStrengthText');

        if (password.length >= 8 && password.length <= 16) {
          strength++;
        }

        switch (strength) {
          case 0:
          case 1:
            progressBar.style.width = '20%';
            progressBar.classList.remove('bg-warning', 'bg-danger');
            strengthText.textContent = 'Very Weak';
            strengthText.classList.remove('text-warning', 'text-danger');
            break;
          case 2:
            progressBar.style.width = '40%';
            progressBar.classList.remove('bg-danger');
            progressBar.classList.add('bg-warning');
            strengthText.textContent = 'Weak';
            strengthText.classList.remove('text-danger');
            strengthText.classList.add('text-warning');
            break;
          case 3:
            progressBar.style.width = '60%';
            progressBar.classList.remove('bg-danger', 'bg-warning');
            strengthText.textContent = 'Moderate';
            strengthText.classList.remove('text-danger', 'text-warning');
            break;
          case 4:
            progressBar.style.width = '80%';
            progressBar.classList.remove('bg-danger', 'bg-warning');
            strengthText.textContent = 'Strong';
            strengthText.classList.remove('text-danger', 'text-warning');
            break;
          case 5:
            progressBar.style.width = '100%';
            progressBar.classList.remove('bg-warning');
            progressBar.classList.add('bg-success');
            strengthText.textContent = 'Very Strong';
            strengthText.classList.remove('text-warning');
            strengthText.classList.add('text-success');
            break;
          default:
            progressBar.style.width = '20%';
            progressBar.classList.remove('bg-warning', 'bg-danger');
            strengthText.textContent = 'Very Weak';
            strengthText.classList.remove('text-warning', 'text-danger');
            break;
        }
      });

      // Auto-capitalization for parent's name and child's name
      document.getElementById('parentName').addEventListener('input', function() {
        var value = this.value;
        this.value = value.charAt(0).toUpperCase() + value.slice(1);
      });

      document.getElementById('childName').addEventListener('input', function() {
        var value = this.value;
        this.value = value.charAt(0).toUpperCase() + value.slice(1);
      });
    })();
    const emailInput = document.getElementById('yourEmail');
        const passwordInput = document.getElementById('yourPassword');
  // Email Validation
  emailInput.addEventListener('blur', function() {
            const email = emailInput.value.trim().toLowerCase();
            const validDomains = ['gmail.com', 'yahoo.com']; // Add more domains as needed

            const isValidEmail = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/i.test(email);
            const isValidDomain = validDomains.some(domain => email.endsWith('@' + domain));

            if (!isValidEmail || !isValidDomain) {
                emailInput.classList.add('invalid'); // Add a class to apply CSS for highlighting
                emailInput.setCustomValidity('Please enter a valid email address with one of the allowed domains: ' + validDomains.join(', '));
            } else {
                emailInput.classList.remove('invalid'); // Remove the class if email is valid
                emailInput.setCustomValidity('');
            }
        });
        emailInput.addEventListener('input', function() {
    emailInput.classList.remove('invalid');
});
  </script>
</body>

</html>