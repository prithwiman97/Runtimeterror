<?php
    require("config.php");
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $table=$_POST['table'];
    $insert="INSERT INTO $table VALUES('$name','$email','$pass')";
    echo mysqli_query($link,$insert)or die(mysqli_error($link));
?>