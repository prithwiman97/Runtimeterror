<!doctype html>
<html>
<head>
	<script src='jquery.min.js'></script>
   	<link rel='stylesheet' type='text/css' href='bootstrap.min.css'>
    <script src='bootstrap.min.js'></script>
    <script src='popper.min.js'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<div id="login_frm" class="container-fluid rounded col-sm-5 mt-5 shadow-lg">
	<div class="row p-1 m-0"><h1>Login</h1></div><hr>
		<form class="container-fluid mt-4 pb-3">
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Email : </div>
				<div class="col-sm-8">
					<input type="text" name="email" class="form-control">
				</div>
			</div>
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Password : </div>
				<div class="col-sm-8">
					<input type="password" name="pass" class="form-control">
				</div>
			</div>
			<div class="row col-sm-12 justify-content-center m-3" id="alert">
			</div>
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-12" align="center">
					<input type="button" name="alogin" value="Login as Admin" class="btn btn-primary col-5 shadow">
				</div>
			</div>
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-12" align="center">
					<input type="button" name="wlogin" value="Login as Worker" class="btn btn-warning col-5 shadow">
				</div>
			</div>
		</form>
		<script>
			$(function(){
				$('input[name="alogin"]').click(function(){
					var parent=document.getElementById("alert");
					while(parent.firstChild)
					{
						parent.removeChild(parent.firstChild);
					}
					var email=$('input[name="email"]').val();
					var pass=$('input[name="pass"]').val();
					var xhttp=new XMLHttpRequest();
					xhttp.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
						{
							if(this.responseText=="LOGGED")
							{
								window.location.replace("home.php");
							}
							else
							{
								var div = document.createElement("div");
								div.className="col m-1 alert alert-danger alert-dismissible col-sm-9";
								var btn = document.createElement("button");
								btn.className="close";
								btn.innerHTML="&times;";
								btn.setAttribute("data-dismiss","alert");
								div.innerHTML="Email and Password does not match";
								document.getElementById("alert").appendChild(div);
								div.appendChild(btn);
							}
						}
					};
					xhttp.open("POST","login.php",true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("email="+email+"&pass="+pass+"&table=admin");
				});
				$('input[name="wlogin"]').click(function(){
					var parent=document.getElementById("alert");
					while(parent.firstChild)
					{
						parent.removeChild(parent.firstChild);
					}
					var email=$('input[name="email"]').val();
					var pass=$('input[name="pass"]').val();
					var xhttp=new XMLHttpRequest();
					xhttp.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
						{
							if(this.responseText=="LOGGED")
							{
								window.location.replace("home.php");
							}
							else
							{
								var div = document.createElement("div");
								div.className="col m-1 alert alert-danger alert-dismissible col-sm-9";
								var btn = document.createElement("button");
								btn.className="close";
								btn.innerHTML="&times;";
								btn.setAttribute("data-dismiss","alert");
								div.innerHTML="Email and Password does not match";
								document.getElementById("alert").appendChild(div);
								div.appendChild(btn);
							}
						}
					};
					xhttp.open("POST","login.php",true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("email="+email+"&pass="+pass+"&table=worker");
				});
			});
		</script>
</div>
<style>
	#login_frm{
		background-color: hsla(0,0%,100%,0.7);
	}
</style>
</html>