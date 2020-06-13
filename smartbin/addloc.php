<?php
    require("entities.php");
    require("controllers.php");
    $name=$_POST['name'];
    $lat=$_POST['lat'];
    $lng=$_POST['lng'];
    $loc=new Location(0,$name,$lat,$lng);
    $loc->insert();
    header("location:setupbin.php");
?>