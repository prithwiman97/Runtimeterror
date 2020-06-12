<?php
    //require("entities.php");
    class LocationManager{
        function getLocations()
        {
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin");
            $select="SELECT * FROM location";
            $rs=mysqli_query($link,$select)or die(mysqli_error($link));
            return $rs;
        }
    }
    class BinManager{
        function updateStatus($bin)
        {
            $bin->update();
        }
        function notifyFull()
        {
            $serv=new ServerAPI();
            $serv->notifyAuthority();
        }
    }
    class MailManager{
        function composeMail($bid)
        {
            require("config.php");
            $select="SELECT l.name FROM bin b JOIN location l ON b.locid=l.locid AND b.bid=$bid";
            $rs=mysqli_query($link,$select);
            $row=mysqli_fetch_assoc($rs);
            $location=$row['name'];
            $body="
            <!doctype html>
            <html>
            <body>
                <h3>Bin number $bid located at $location needs your attention.</h3><br>
                <b>Please get it cleared as soon as possible.</b>
            </body>
            </html>
            ";
            return $body;
        }
    }
?>