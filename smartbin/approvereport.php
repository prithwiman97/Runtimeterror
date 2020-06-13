<?php
    session_start();
    if(!empty($_SESSION['admin']))
    {
        require("config.php");
        $bid=$_GET['id'];
        $update="UPDATE report SET approval='APPROVED' WHERE bid=$bid";
        echo mysqli_query($link,$update)or die(mysqli_error($link));
    }
?>