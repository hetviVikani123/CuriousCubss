<?php
require("admin_Header.php");
require("admin_Sidebar.php");
require("../Auth/nedded.php");
?>

<?php
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM mentors";
$result = mysqli_query($conn, $query);

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1 style='color:#855e46;'>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html" style='color:#855e46;'>Home</a></li>
          <li class="breadcrumb-item active" style='color:#855e46;'>Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row mt-4">
        <!-- <div class="col-3 ">
          <a href="../user_registration/user_reg_selection.php">
            <div class="card  mt-3">
              <div class="card-body">
                <h5 class="card-title text-center text-success text-wrap" style='color:#855e46;'><i class="ri-account-circle-fill h1"></i><br>Mentors</h5>
                <p class="h1 text-center " style='color:#855e46;'> 0 </p>
              </div>
            </div>
          </a>
        </div> -->
      </div>
<div class="row">
      <div class="col-3">
        <a href="#" onclick="showMentors()">
          <div class="card mt-3">
            <div class="card-body">
              <?php
              $conn = mysqli_connect($serverName, $username, $password, $database);

              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              $query = "SELECT COUNT(*) AS mentor_count FROM mentor";
              $result = mysqli_query($conn, $query);

              $row = mysqli_fetch_assoc($result);
              $mentorCount = $row['mentor_count'];

              ?>
              <h5 class="card-title text-center text-success text-wrap" style='color:#855e46;'><i class="ri-account-circle-fill h1"></i><br>Mentors</h5>
              <p class="h1 text-center" style='color:#855e46;'><?php echo $mentorCount; ?></p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-3">
        <a href="#" onclick="showParents()">
          <div class="card mt-3">
            <div class="card-body">
              <?php
              $query = "SELECT COUNT(*) AS parent_count FROM parent";
              $result = mysqli_query($conn, $query);

              $row = mysqli_fetch_assoc($result);
              $parent_Count = $row['parent_count'];
              ?>
              <h5 class="card-title text-center text-success text-wrap"><i class="ri-account-circle-fill h1"></i><br>Parents</h5>
              <p class="h1 text-center " style='color:#855e46;'><?php echo $parent_Count; ?></p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-3">
        <a href="#" onclick="showChildren()">
          <div class="card mt-3">
            <div class="card-body">
              <?php
              $query = "SELECT COUNT(*) AS child_count FROM child";
              $result = mysqli_query($conn, $query);

              $row = mysqli_fetch_assoc($result);
              $Child_count = $row['child_count'];
              ?>
              <h5 class="card-title text-center text-success text-wrap"><i class="ri-account-circle-fill h1"></i><br>Child</h5>
              <p class="h1 text-center " style='color:#855e46;'><?php echo $Child_count; ?></p>
            </div>
          </div>
        </a>
      </div>
</div>
      <!-- for the mentor -->
      <div id="mentorTable" style="display:none;">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style="text-align:center;">Mentor ID</th>
              <th style="text-align:center;">Name</th>
              <th style="text-align:center;">Email</th>
              <th style="text-align:center;">Contact</th>
              <th style="text-align:center;">Expertise</th>
              <th style="text-align:center;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM mentor";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td style="text-align:center;"><?php echo $row['Mentor_id']; ?></td>
                <td style="text-align:center;"><?php echo $row['Mentor_name']; ?></td>
                <td style="text-align:center;"><?php echo $row['Mentor_email']; ?></td>
                <td style="text-align:center;"><?php echo $row['Mentor_Contact']; ?></td>
                <td style="text-align:center;"><?php echo $row['Mentor_Expertise']; ?></td>
                <td style="text-align:center;"><?php echo $row['Status']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- for the parent -->
      <div id="parentTable" style="display:none;">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style="text-align:center;">Parent ID</th>
              <th style="text-align:center;">Name</th>
              <th style="text-align:center;">Email</th>
              <th style="text-align:center;">Password</th>
              <th style="text-align:center;">Contact</th>
              <th style="text-align:center;">City</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM parent";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td style="text-align:center;"><?php echo $row['Parent_Id']; ?></td>
                <td style="text-align:center;"><?php echo $row['Parent_Name']; ?></td>
                <td style="text-align:center;"><?php echo $row['Parent_Email_id']; ?></td>
                <td style="text-align:center;"><?php echo $row['Parent_Password']; ?></td>
                <td style="text-align:center;"><?php echo $row['Parent_contact']; ?></td>
                <td style="text-align:center;"><?php echo $row['City']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- for the child -->
      <div id="childTable" style="display:none;">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style="text-align:center;">Child_id</th>
              <th style="text-align:center;">Parent_id</th>
              <th style="text-align:center;">Child_name</th>
              <th style="text-align:center;">date_of_birth</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM child";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td style="text-align:center;"><?php echo $row['Child_id']; ?></td>
                <td style="text-align:center;"><?php echo $row['Parent_id']; ?></td>
                <td style="text-align:center;"><?php echo $row['Child_name']; ?></td>
                <td style="text-align:center;"><?php echo $row['date_of_birth']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <script>
  function showMentors() {
    document.getElementById("mentorTable").style.display = "block";
    document.getElementById("parentTable").style.display = "none";
    document.getElementById("childTable").style.display = "none";
  }

  function showParents() {
    document.getElementById("mentorTable").style.display = "none";
    document.getElementById("parentTable").style.display = "block";
    document.getElementById("childTable").style.display = "none";
  }

  function showChildren() {
    document.getElementById("mentorTable").style.display = "none";
    document.getElementById("parentTable").style.display = "none";
    document.getElementById("childTable").style.display = "block";
  }
</script>

    </section>
  </main>


</body>

</html>