<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Child_id'])) {
        require_once("connection.php");

        $Child_id = mysqli_real_escape_string($conn, $_POST['Child_id']);

        $query = "DELETE FROM child WHERE Child_id = '$Child_id'";

        if (mysqli_query($conn, $query)) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Child ID is not provided.";
    }
} else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}
?>
