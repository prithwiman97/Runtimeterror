<?php
    require("entities.php");
    require("controllers.php");
    class ServerAPI{
        function receiveGarbageUpdate($bid)
        {
            require("config.php");
            $select="SELECT * FROM bin WHERE bid=$bid";
            $rs=mysqli_query($link,$select);
            $row=mysqli_fetch_assoc($rs);
            echo $row['status'].",".$row['cleared'];
        }
        function notifyAuthority($bid)
        {
            session_start();
            $emailId=$_SESSION['admin']['email'];
            $email=new Email();
            $mailer=new MailManager();
            $content=$mailer->composeMail($bid);
            $email->setRecipient($emailId);
            $email->setSubject("Smartbin Alert!!!");
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if($email->sendMail($content,$headers))
                return "Sent";
        }
        function viewRoutine($bin)
        {
            $lat=$bin->getLat();
            $lng=$bin->getLng();
            header("location:route.php?blat=$lat&blng=$lng");
        }
        function reportCompletion($bid,$file)
        {
            require("config.php");
            $fname=$bid."_".time().$file['name'];
            $path="./img/".$fname;
            $date=date("Y-m-d");
            $insert="INSERT INTO report VALUES($bid,'$path','$date','')";
            if(mysqli_query($link,$insert)or die(mysqli_error($link)))
            {
                return move_uploaded_file($file['tmp_name'],$path);
            }
        }
    }
?>