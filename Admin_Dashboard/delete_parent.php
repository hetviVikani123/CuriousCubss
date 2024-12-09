<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Parent_Id'])) {
        require_once("connection.php");

        $Parent_Id = mysqli_real_escape_string($conn, $_POST['Parent_Id']);

        $query = "DELETE FROM parent WHERE Parent_Id = '$Parent_Id'";

        if (mysqli_query($conn, $query)) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        
        echo "Parent ID is not provided.";
    }
} else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}
?>
