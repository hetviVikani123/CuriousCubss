<?php
require("admin_Header.php");
require("admin_Sidebar.php");
require("../Auth/nedded.php");

// Establish database connection
$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = mysqli_connect($serverName, $username, $password, $database);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function updateSelectStatus(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectStatus = document.querySelector('select[name="status"]');

            if (selectedOption.value === '0') {
                selectStatus.options[0].style.display = 'none';
            } else {
                selectStatus.options[0].style.display = '';
            }
        }
    </script>
</head>

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style='color:#855e46;'>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html" style='color:#855e46;'>Home</a></li>
                    <li class="breadcrumb-item" style='color:#855e46;'>Dashboard</li>
                    <li class="breadcrumb-item active" style='color:#855e46;'>Manage Mentors</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <!-- <div class="row mt-4">
                <div class="card col-12">
                    <div class="card-body">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        <i class="bi bi-journal-text text-dark"></i>
                                        <h5 class="card-title ms-2" style='color:#855e46;'>
                                            Manage Mentors </h5>
                                    </button>
                                </h2>
                            </div>
                        </div>

                    </div> -->
                </div>
                <div class="card p-4 col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style='color:#855e46;'>Mentor ID</th>
                                    <th scope="col" style='color:#855e46;'>Name</th>
                                    <th scope="col" style='color:#855e46;'>Email</th>
                                    <th scope="col" style='color:#855e46;'>Contact</th>
                                    <th scope="col" style='color:#855e46;'>Expertise</th>
                                    <th scope="col" style='color:#855e46;'>Status</th>
                                    <th scope="col" style='color:#855e46;'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $user_id = $_POST['user_id'];
                                    $status = $_POST['status'];

                                    $sql = "UPDATE mentor SET Status = $status WHERE Mentor_id = $user_id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo '<script>alert("Mentor status updated successfully!");</script>';
                                    } else {
                                        echo '<script>alert("Error updating mentor status.");</script>';
                                    }
                                }

                                $query = "SELECT * FROM mentor";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['Mentor_id']; ?></td>
                                        <td><?php echo $row['Mentor_name']; ?></td>
                                        <td><?php echo $row['Mentor_email']; ?></td>
                                        <td><?php echo $row['Mentor_Contact']; ?></td>
                                        <td><?php echo $row['Mentor_Expertise']; ?></td>
                                        <td>
                                            <?php if ($row['Status'] == 1) { ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Rejected</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <form method="POST" action="ManageMentor.php">
                                                <input type="hidden" name="user_id" value="<?php echo $row['Mentor_id']; ?>">
                                                <select name="status" style="width:120px;"class="form-select" onchange="updateSelectStatus(this)">
                                                    <option value="1">Approve</option>
                                                    <option value="0">Reject</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

<?php
mysqli_close($conn);
?>