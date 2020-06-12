<?php
    require("apis.php");
    $bid=$_GET['bid'];
    $serv=new ServerAPI();
    $serv->receiveGarbageUpdate($bid);
?>