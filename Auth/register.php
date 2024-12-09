<?php
require("nedded.php");
    error_reporting(0);
    session_start();
    $database = "curious_cubs";
    $serverName = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($serverName, $username, $password, $database);


        if (isset($_POST['btn3'])) {
            
            
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

//            if ($parentname == "") {
//                echo'<script type="text/JavaScript">alert("Parent Name Is Empty");</script>';              
//            } elseif (empty($parentemail)) {
//                echo'<script type="text/JavaScript">alert("Email id Empty.");</script>';
//            } elseif (strlen($parentcontact) != 10 || !is_numeric($parentcontact)) {
//                echo'<script type="text/JavaScript">alert("Phone Number should be of 10 digits and numeric value");</script>';
//            } elseif (strlen(trim($parentpassword)) < 8 || strlen(trim($parentpassword)) > 12) {
//                echo'<script type="text/JavaScript">alert("Password length should not be less than 8 OR more than 12 characters");</script>';
//            } elseif (($parentpassword != $parentcpassword)) {
//               echo'<script type="text/JavaScript">alert("Password does not match.");</script>';
//            } elseif ($city == "") {
//               echo'<script type="text/JavaScript">alert("City Is Empty!");</script>';
//            } elseif ($childname == "") {
//               echo'<script type="text/JavaScript">alert("Child Name Is Empty!");</script>';
//            } else {
//                if (!( empty(trim($parentname)) || empty(trim($parentpassword)) || empty(trim($parentemail)) || empty(trim($childdob)) || empty(trim($childname)) || empty(trim($city)) || empty(trim($parentcontact)))) {
                    $phash = password_hash($parentpassword,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO parent(Parent_Name, Parent_Email_id, Parent_Password, Parent_contact, City) VALUES ('$parentname', '$parentemail', '$phash', '$parentcontact', '$city');";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $result1 = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
                        $auto_incr = mysqli_fetch_row($result1);
                        $parent_id = $auto_incr[0];

                        $sql2 = "INSERT INTO child(Parent_id,Child_name,date_of_birth) VALUES ($parent_id,'$childname','$childdob');";
                        mysqli_query($conn, $sql2);

                        $_SESSION['parentname'] = $parentname;
                        $_SESSION['parentemail'] = $parentemail;
                        $_SESSION['pnumber'] = $parentcontact;
                        $_SESSION['cname'] = $childname;
                        $_SESSION['cdob'] = $childdob;
                        $_SESSION['city'] = $city;
                        $_SESSION['login_type'] = "parent";

                        header("Location:..\child_dashboard\child_dashboard.php");

                    }
//                } else {
//                    echo '<script type="text/JavaScript">alert("Please Fill all the fields before submitting");</script>';
//                }
            }
        //}
    

        if (isset($_POST['btn2'])) {
            
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

//            if ($mentorname == "") {
//                 echo'<script type="text/JavaScript">alert("Mentor Name Is Empty") ;</script>';
//                 
//            } elseif (($emailCount2 > 0)) {
//                 echo'<script type="text/JavaScript">alert("Email Already Taken.");</script>';
//            } elseif (strlen(trim($mentorpassword)) < 8) {
//                echo'<script type="text/JavaScript">alert("Mentor Password length should not be less than 8 characters");</script>';
//            } elseif (($mentorpassword != $mentorcpassword)) {
//                 echo'<script type="text/JavaScript">alert("Password does not match.");</script>';
//            } elseif (strlen($mentorcontact) != 10 || !is_numeric($mentorcontact)) {
//                 echo'<script type="text/JavaScript">alert("Phone Number should be of 10 digits and numeric value");</script>';
//            } elseif ($mentorqualification == "") {
//                 echo'<script type="text/JavaScript">alert("Mentor Qualification Is Empty");</script>';
//            } elseif ($mentorexperience == "") {
//                echo'<script type="text/JavaScript">alert("Mentor Experience Is Empty");</script>';
//            } else {
//                if (!( empty(trim($mentorname)) || empty(trim($mentoremail)) || empty(trim($mentorpassword)) || empty(trim($mentorcontact)) || empty(trim($mentorqualification)) || empty(trim($mentorexperience)) || empty(trim($mentorexpertise)))) {
                    $mhash = password_hash($mentorpassword,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO mentor (Mentor_name,Mentor_email, Mentor_Password, Mentor_Contact,Mentor_Expertise) VALUES ('$mentorname', '$mentoremail', '$mhash', '$mentorcontact','$mentorexpertise');";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "Sign Up Successfull";
                    }
                    // $_SESSION['mentorname'] = $mentorname;
                    // $_SESSION['mentoremail'] = $mentoremail;
                    // $_SESSION['mnumber'] = $mentorcontact;
                  
                  
                    // $_SESSION['mexpertise'] = $mentorexpertise;
                    // $_SESSION['login_type'] = "mentor";

                    header("Location:../Auth/login.php");
//                } else {
//                    echo'<script type="text/JavaScript">alert("Please Fill all the fields before submitting");</script>';
//                }
            //}
        }
   


    mysqli_close($conn);
    ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Registration</title>
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
                    
                    <form class="row g-3 needs-validation"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                    <div id="parentForm" style="display: none;">
                        <div class="col-12">
                        <label for="pName" class="form-label" style='color:#855e46;'>Parent's Name</label>
                        <input type="text" name="parentName" id="parentName" class="form-control" id="pName" onkeypress="return /[a-zA-Z ]/i.test(event.key)" required>
                        <span id="msg1" style="color:red;"></span>
                        </div>
                        <div class="col-12">
                        <label for="parentEmail" class="form-label" style='color:#855e46;'>Parent's Email</label>
                        <input type="email" name="parentEmail" id="parentEmail" class="form-control"  required>
                        <span id="msg2" style="color:red;"></span>
                        </div>
                        <div class="col-12">
                        <label for="parentContact" class="form-label" style='color:#855e46;'>Parent's Contact</label>
                        <input type="tel" name="parentContact" id="parentContact" class="form-control"  onkeypress="return /[0-9]/i.test(event.key)" required >
                        <span id="msg3" style="color:red;"></span>
                        </div>
                        <div class="col-12">
                        <label for="parentPassword" class="form-label" style='color:#855e46;'>Parent's Password</label>
                        <input type="password" name="parentPassword" id="parentPassword" class="form-control" required>
                        <span id="msg4" style="color:red;"></span>
                        </div>
                        <div class="col-12">
                        <label for="parentCPassword" class="form-label" style='color:#855e46;'>Parent's Confirm Password</label>
                        <input type="password" name="parentCPassword" id="parentCPassword" class="form-control"  required>
                        <span id="msg5" style="color:red;"></span>
                        </div>
                        <div class="col-12">
                        <label for="parentCity" class="form-label" style='color:#855e46;'>Parent's City</label>
                        <input type="text" name="parentCity" class="form-control"  required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 mt-2" type="submit" name="btn3" onclick="return preg()" style='color:beige;background:#855e46;border:2px solid #855e46'>Create Account</button>
                        </div><br>
                    </div>
                  </form>
                  <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                    <div id="mentorForm" style="display: none;">
                      <div class="col-12">
                        <label for="mentorName" class="form-label" style='color:#855e46;'>Mentor's Name</label>
                        <input type="text" name="mentorName" class="form-control" id="mentorName" onkeypress="return /[a-zA-Z ]/i.test(event.key)" required>
                        <span id="msg7" style="color:red;"></span>
                      </div>
                      <div class="col-12">
                        <label for="mentorEmail" class="form-label" style='color:#855e46;'>Mentor's Email</label>
                        <input type="email" name="mentorEmail" class="form-control" id="mentorEmail" required>
                        <span id="msg8" style="color:red;"></span>
                      </div>
                      <div class="col-12">
                        <label for="mentorPassword" class="form-label" style='color:#855e46;'>Mentor's Password</label>
                        <input type="password" name="mentorPassword" class="form-control" id="mentorPassword" required >
                        <span id="msg9" style="color:red;"></span>
                      </div>
                        <div class="col-12">
                        <label for="mentorCPassword" class="form-label" style='color:#855e46;'>Mentor's Confirm Password</label>
                        <input type="password" name="mentorCPassword" class="form-control" id="mentorCPassword" required>
                        <span id="msg10" style="color:red;"></span>
                      </div>
                      <div class="col-12">
                        <label for="mentorContact" class="form-label" style='color:#855e46;'>Mentor's Contact</label>
                        <input type="number" name="mentorContact" class="form-control" id="mentorContact" onkeypress="return /[0-9]/i.test(event.key)" required>
                        <span id="msg11" style="color:red;"></span>
                      </div>
                     
                      
                      <div class="col-12">
                        <label for="mentorExpertise" class="form-label" style='color:#855e46;'>Mentor's Expertise</label>
                        <select id="mentorExpertise" name="mentorExpertise" placeholder="Mentor Expertise" class="form-control" required>
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
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="mentorExtraSkills" class="form-label" style='color:#855e46;'>Extra Skills(Comma Separated):</label>
                        <input type="number" name="mentorContact" class="form-control" id="mentorContact" onkeypress="return /[0-9]/i.test(event.key)" required>
                        <span id="msg11" style="color:red;"></span>
                      </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 mt-2" type="submit" name="btn2" onclick="return mreg()" style='color:beige;background:#855e46;border:2px solid #855e46'>Create Account</button>
                            <br>
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


  <script>
    function showParentForm() {
      document.getElementById("parentForm").style.display = "block";
      document.getElementById("mentorForm").style.display = "none";

    }

    function showMentorForm() {
      document.getElementById("mentorForm").style.display = "block";
      document.getElementById("parentForm").style.display = "none";
      
    }
    
    function preg(){
        var returnval = true;
        var pname = document.getElementById("parentName").value;      
        var pemail = document.getElementById("parentEmail").value;
        var pphone = document.getElementById("parentContact").value; 
        var ppass = document.getElementById("parentPassword").value;
        var pcpass = document.getElementById("parentCPassword").value;
           
               
        if(pname === ""){                  
            document.getElementById("msg1").innerHTML="Parent Name Is Empty!";   
            returnval = false;
        }else if(pname.length <10){
            document.getElementById("msg1").innerHTML="Name Should Not Less Than 10 Characters!";   
            returnval = false;
        }else{
             document.getElementById("msg1").innerHTML="";
        }
        
        if(pemail === ""){
            document.getElementById("msg2").innerHTML="Parent Email Is Empty!";   
            returnval = false;
        }else{
             document.getElementById("msg2").innerHTML="";
        }
        
        if(pphone ===""){
            document.getElementById("msg3").innerHTML="Parent Contact Is Empty!";   
            returnval = false;
        }
        else if(pphone.length > 10){
            document.getElementById("msg3").innerHTML="Parent Contact Length Should Be 10!";   
            returnval = false;
        }else{
             document.getElementById("msg3").innerHTML="";
        }
                       
        if(ppass.length <8 || ppass.length > 12){
            document.getElementById("msg4").innerHTML="Password Should Be In Between 8 To 12 Characters!";
            returnval = false;
        }else{
             document.getElementById("msg4").innerHTML="";
        }
        
        if(pcpass.length < 8 || pcpass.length > 12){
            document.getElementById("msg5").innerHTML=" Confirm Password Should Be In Between 8 To 12 Characters!";
            returnval = false;
        }else if(ppass !== pcpass ){
            document.getElementById("msg5").innerHTML="Password Does Not Match Confirm Password!";
            returnval = false;
        }else{
             document.getElementById("msg5").innerHTML="";
        }
              
        return returnval;
    }
     
    function mreg(){
        var returnval = true;
        var mname = document.getElementById("mentorName").value;
        var memail = document.getElementById("mentorEmail").value;
        var mpass = document.getElementById("mentorPassword").value;
        var mcpass = document.getElementById("mentorCPassword").value;
        var mphone = document.getElementById("mentorContact").value;
        
        
        if(mname === ""){                  
            document.getElementById("msg7").innerHTML="Mentor Name Is Empty!";   
            returnval = false;
        }else if(mname.length <10){
            document.getElementById("msg7").innerHTML="Name Should Not Less Than 10 Characters!";   
            returnval = false;
        }else{
             document.getElementById("msg7").innerHTML="";
        }
        
        if(memail === ""){
            document.getElementById("msg8").innerHTML="Mentor Email Is Empty!";   
            returnval = false;
        }else{
             document.getElementById("msg8").innerHTML="";
        }
        
        if(mpass.length <8 || mpass.length > 12){
            document.getElementById("msg9").innerHTML="Password Should Be In Between 8 To 12 Characters!";
            returnval = false;
        }else{
             document.getElementById("msg9").innerHTML="";
        }
        
        if(mcpass.length < 8 || mcpass.length > 12){
            document.getElementById("msg10").innerHTML="Confirm Password Should Be In Between 8 To 12 Characters!";
            returnval = false;
        }else if(mpass !== mcpass ){
            document.getElementById("msg10").innerHTML="Password Does Not Match Confirm Password!";
            returnval = false;
        }else{
             document.getElementById("msg10").innerHTML="";
        }
        
        if(mphone ===""){
            document.getElementById("msg11").innerHTML="Mentor Contact Is Empty!";   
            returnval = false;
        }
        else if(mphone.length > 10){
            document.getElementById("msg11").innerHTML="Mentor Contact Length Should Be 10!";   
            returnval = false;
        }else{
             document.getElementById("msg11").innerHTML="";
        }
        
       
        
        
        
        return returnval;
    }
  </script>


</body>

</html>