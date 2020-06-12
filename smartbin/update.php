<?php
    require("entities.php");
    require("controllers.php");
    $bid=$_GET['bid'];
    $stat=$_GET['stat'];
    $clr=$_GET['clr'];
    $bin=new Bin($bid,"",$stat,$clr);
    $bm=new BinManager();
    $bm->updateStatus($bin);
    echo "Updated";
?>