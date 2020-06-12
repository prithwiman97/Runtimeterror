<?php
    require("apis.php");
    $bid=$_GET['bid'];
    $serv=new ServerAPI();
    echo $serv->notifyAuthority($bid);
?>