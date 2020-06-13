<?php
    require("config.php");
    $email=$_GET['email'];
    $select="SELECT a.email,w.email FROM admin a,worker w WHERE a.email='$email' OR w.email='$email'";
    $rs=mysqli_query($link,$select)or die(mysqli_error($link));
    if(mysqli_num_rows($rs)>0)
        echo true;
    else
        echo false;
?>