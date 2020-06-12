<?php
    require("config.php");
    $bid=$_GET['bid'];
    $select="SELECT bid FROM report WHERE bid=$bid";
    $rs=mysqli_query($link,$select);
    if(mysqli_num_rows($rs)>0)
        echo "Found";
    else
        echo "Not Found";
?>