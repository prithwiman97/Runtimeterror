<?php
    require("entities.php");
    require("controllers.php");
    $id=$_POST['bid'];
    $loc=$_POST['loc'];
    $bin=new Bin($id,$loc,0,"YES");
    $bin->insert();
    header("location:setupbin.php");
?>