<?php
    session_unset();
    session_destroy();
//    echo "<script language=\"JavaScript\">\n";
//    echo 'window.location.href = "login.php"';
//    echo '</script>';
header("location:login.php");
 ?>