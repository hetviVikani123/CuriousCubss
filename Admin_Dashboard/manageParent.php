<?php
require("admin_Header.php");
require("admin_Sidebar.php");
require("../Auth/nedded.php");


$serverName = "localhost";
$username = "root";
$password = "";
$database = "curious_cubs";

$conn = mysqli_connect($serverName, $username, $password, $database);


$query = "SELECT * FROM child";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html" style='color:#855e46;'>Home</a></li>
                    <li class="breadcrumb-item" style='color:#855e46;'>Dashboard</li>
                    <li class="breadcrumb-item active" style='color:#855e46;'>Manage Parents</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row mt-4">
                <div class="card p-4 col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style='color:#855e46;'>No</th>
                                <th scope="col" style='color:#855e46;'>Parent ID</th>
                                <th scope="col" style='color:#855e46;'>Child Name</th>
                                <th scope="col" style='color:#855e46;'>Parent Email</th>
                                <th scope="col" style='color:#855e46;'>Parent Name</th>
                                <th scope="col" style='color:#855e46;'>Parent City</th>
                                <th scope="col" style='color:#855e46;'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $query = "SELECT parent.*, child.Child_name FROM parent INNER JOIN child ON parent.Parent_id = child.Parent_id";
                            $result = mysqli_query($conn, $query);


                            if (!$result) {
                                echo "Error executing query: " . mysqli_error($conn);
                                exit;
                            }

                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $counter++; ?></th>
                                    <td><?php echo $row['Parent_Id']; ?></td>
                                    
                                    <td><?php echo $row['Child_name']; ?></td>
                                    <td><?php echo $row['Parent_Email_id']; ?></td>
                                    <td><?php echo $row['Parent_Name']; ?></td>
                                    <td><?php echo $row['City']; ?></td>
                                    <td class="d-flex">
                                        <form action="delete_parent.php" method="POST" class="ms-1" onsubmit="return confirm('Are you sure you want to delete this student record?');">
                                            <input type="hidden" name="Parent_Id" value="<?php echo $row['Parent_Id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>

</html>