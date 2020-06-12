<?php
require("entities.php");
require("controllers.php");
$id=$_GET['id'];
$bin=new Bin($id,"",0,0,0);
$bin->delete();
?>