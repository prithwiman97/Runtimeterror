<?php
    require('config.php');
?>
<!doctype html>
<html>
<head>
    <script src='jquery.min.js'></script>
    <link rel='stylesheet' type='text/css' href='bootstrap.min.css'>
    <script src='bootstrap.min.js'></script>
	<script src='popper.min.js'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<nav class="navbar navbar-collapse text-light bg-success">
	<div class="row col-12">
		<a href="home.php" class="navbar-brand col-sm-6 text-light m-0">Bantala Municipal Corporation</a>
	<?php
		session_start();
		$login;
		if($login=!empty($_SESSION["admin"]))
		{
	?>
			<ul class="nav navbar-right col-sm-6 m-0">
					<li class="col-sm-3 p-1 nav-item">
						<a id="view" class="btn btn-outline-light active" href="#view_status" data-toggle="tab">View Status <span class="fa fa-info-circle"></span></a>
					</li>
					<li class="col-sm-3 p-1 nav-item">
						<a class="btn btn-outline-light" href="#view_report" data-toggle="tab">View Report <i class="fa fa-image"></i></a>
					</li>
					<li class="col-sm-3 p-1">
						<a href="logout.php" class="btn btn-outline-light">Logout <i class="fa fa-sign-out-alt"></i></a>
					</li>
			</ul>
	<?php
		}
		else if($login=!empty($_SESSION["worker"]))
		{
	?>
			<ul class="nav navbar-right col-sm-6 m-0">
					<li class="col-sm-3 p-1 nav-item">
						<a class="btn btn-outline-light active" href="#view_status" data-toggle="tab">View Status <span class="fa fa-info-circle"></span></a>
					</li>
					<li class="col-sm-4 p-1 nav-item">
						<a class="btn btn-outline-light" href="#upload_report" data-toggle="tab">Upload Report <i class="fa fa-file-alt"></i></a>
					</li>
					<li class="col-sm-3 p-1">
						<a href="logout.php" class="btn btn-outline-light">Logout <i class="fa fa-sign-out-alt"></i></a>
					</li>
			</ul>
	<?php
		}
		else
		{
			session_destroy();
		}
	?>
	</div>
</nav>

</html>