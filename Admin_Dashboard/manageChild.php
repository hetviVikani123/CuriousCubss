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

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
                    <li class="breadcrumb-item active" style='color:#855e46;'>Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row mt-4">
                <div class="card col-12">
                    <div class="card-body">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        <i class="bi bi-journal-text text-dark"></i>
                                        <h5 class="card-title ms-2" style='color:#855e46;'>
                                            Manage Children </h5>
                                    </button>
                                </h2>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card p-4 col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style='color:#855e46;'>Child ID</th>
                                    <th scope="col" style='color:#855e46;'>Parent ID</th>
                                    <th scope="col" style='color:#855e46;'>Child Name</th>
                                    <th scope="col" style='color:#855e46;'>Date Of Birth</th>
                                    <th scope="col" style='color:#855e46;'>Status</th>
                                    <th scope="col" style='color:#855e46;'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $child_id = $_POST['child_id'];
                                    $status = $_POST['status'];

                                    $sql = "UPDATE child SET status = $status WHERE Child_id = $child_id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo '<script>alert("Child status updated successfully!");</script>';
                                    } else {
                                        echo '<script>alert("Error updating child status.");</script>';
                                    }
                                }

                                $query = "SELECT * FROM child";
                                $result = mysqli_query($conn, $query);

                                if (!$result) {
                                    die("Error executing query: " . mysqli_error($conn));
                                }

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['Child_id']; ?></td>
                                        <td><?php echo $row['Parent_id']; ?></td>
                                        <td><?php echo $row['Child_name']; ?></td>
                                        <td><?php echo $row['date_of_birth']; ?></td>
                                        <td>
                                            <?php if ($row['status'] == 1) { ?>
                                                <span class="badge bg-success">Activate</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Deactivate</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <form method="POST" action="manageChild.php">
                                                <input type="hidden" name="child_id" value="<?php echo $row['Child_id']; ?>">
                                                <select name="status" class="form-select" onchange="updateSelectStatus(this)">
                                                    <option value="1">Activate</option>
                                                    <option value="0">Deactivate</option>
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