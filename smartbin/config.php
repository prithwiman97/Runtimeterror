<?php
    $link=mysqli_connect('localhost','root','');
    mysqli_select_db($link,'smartbin')or die(mysqli_error($link));
?>