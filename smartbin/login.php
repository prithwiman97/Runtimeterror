<?php
	require('config.php');
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$table=$_POST['table'];
	$query="SELECT * FROM $table WHERE email='$email' AND password='$pass'";
	$rs=mysqli_query($link,$query)or die(mysqli_error($link));
	if(mysqli_num_rows($rs)>0)
	{
		session_start();
		$_SESSION["$table"]=mysqli_fetch_assoc($rs);
		echo "LOGGED";
	}
?>