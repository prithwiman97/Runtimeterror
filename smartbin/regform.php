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
	<div class="row p-1 m-0"><h1>Registration</h1></div><hr>
		<form class="container-fluid mt-4 pb-3" onsubmit= "return false;">
            <div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Name : </div>
				<div class="col-sm-8">
					<input type="text" name="rname" class="form-control" pattern="([A-Z][a-z ]+)+" required>
				</div>
			</div>
            <div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Select User Type : </div>
				<div class="col-sm-8">
					<input type="radio" name="rtype" value="admin" required> Admin<br>
                    <input type="radio" name="rtype" value="worker" required> Worker
				</div>
			</div>
            <div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Email : </div>
				<div class="col-sm-8">
					<input type="email" name="remail" class="form-control" required>
				</div>
			</div>
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-3">Password : </div>
				<div class="col-sm-8">
					<input type="password" name="rpass" class="form-control" required>
				</div>
			</div>
			<div class="row col-sm-12 justify-content-center m-3" id="alert">
			</div>
			<div class="row col-sm-12 justify-content-center m-3">
				<div class="col-sm-12" align="center">
					<input type="submit" name="reg" value="Register" class="btn btn-success col-5 shadow">
				</div>
			</div>
		</form>
		<script>
			$(function(){
                $('input[name="remail"]').blur(function(){
                    var email=$('input[name="remail"]').val();
                    var xhttp=new XMLHttpRequest();
					xhttp.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
						{
                            //alert(this.responseText);
							if(this.responseText=="1")
							{
                                alert("Email already exists.");
                                $('input[name="remail"]').val("");
							}
						}
					};
					xhttp.open("GET","checkmail.php?email="+email,true);
					xhttp.send();
                });
				$('input[name="reg"]').click(function(){
					var parent=document.getElementById("alert");
					while(parent.firstChild)
					{
						parent.removeChild(parent.firstChild);
					}
                    var name=$('input[name="rname"]').val();
					var email=$('input[name="remail"]').val();
					var pass=$('input[name="rpass"]').val();
                    var table=$('input[name="rtype"]:checked').val();
                    if(email=="" || pass=="" || table=="" || name=="")
                        return;
					var xhttp=new XMLHttpRequest();
					xhttp.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
						{
                            //alert(this.responseText);
							if(this.responseText=="1")
							{
                                alert("Registered as "+table+" successfully");
								//window.location.replace("home.php");
							}
							else
							{
								var div = document.createElement("div");
								div.className="col m-1 alert alert-danger alert-dismissible col-sm-9";
								var btn = document.createElement("button");
								btn.className="close";
								btn.innerHTML="&times;";
								btn.setAttribute("data-dismiss","alert");
								div.innerHTML="Something went wrong";
								document.getElementById("alert").appendChild(div);
								div.appendChild(btn);
							}
						}
					};
					xhttp.open("POST","register.php",true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("name="+name+"&email="+email+"&pass="+pass+"&table="+table);
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