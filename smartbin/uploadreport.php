<?php
    require("apis.php");
    $bid=$_POST['bid'];
    $file=$_FILES['pic'];
    $serv=new ServerAPI();
    if($serv->reportCompletion($bid,$file)==1)
        echo "File Uploaded Success";
?>
