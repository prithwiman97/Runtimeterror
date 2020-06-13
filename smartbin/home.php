<?php
	require("config.php");
?>
<!doctype html>
<html>
<head>
	<style>
		img{
			height:400px;
			width:100%;
		}
	</style>
</head>
<body style="background-color: hsla(0,0%,26%,1.00)">
<?php
	require('menubar.php');
	if($login)
	{
?>
<script>
window.onload = function () {

var options = {
	title: {
		text: "Garbage Level in Bins"
	},

	data: [{
		type: "column",
		yValueFormatString: "#,###",
		indexLabel: "{y}",
      	color: "#546BC1",
		dataPoints: [
<?php
	$select="SELECT * FROM bin";
	$rs=mysqli_query($link,$select);
	while($row=mysqli_fetch_assoc($rs))
	{
?>
			{ label: "Bin <?php echo $row['bid'];?>", y: 0 },
<?php
	}
?>
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);
var yVal=0;
var fullBins=new Set();
var initSize=0;
function updateChart() {
	var dps = options.data[0].dataPoints;
	var xhttp=new XMLHttpRequest();
	for (var i = 0; i < dps.length; i++) {
		var bid=dps[i].label.split(" ").pop();
		xhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				var values=this.responseText.split(",");
				yVal = parseFloat(values[0]);
				if(yVal>80)
				{
					fullBins.add(bid);
					if(values[1]=="YES")
					{
						var xhr=new XMLHttpRequest();
						xhr.onreadystatechange=function(){
							if(this.readyState==4 & this.status==200)
							{
								
							}
						};
						xhr.open("GET","update.php?bid="+bid+"&stat="+yVal+"&clr=NO",true);
						xhr.send();
						xhr.open("GET","sendmail.php?bid="+bid,true);
						xhr.send();
					}
				}
				else
					fullBins.delete(bid);
				console.log(fullBins);
			}
		};
		xhttp.open("GET","getgarbage.php?bid="+bid,false);
		xhttp.send();
		dps[i].y=yVal;
		if(fullBins.size>initSize)
		{
			$("#mhead").html("Full Bins Alert");
			var bins=[...fullBins];
			$("#mbody").html("<h5>Bin number(s) "+bins+" are full</h5>");
			$("#report").modal("show");
		}
		initSize=fullBins.size;
	}
	options.data[0].dataPoints = dps;
	$("#chartContainer").CanvasJSChart().render();
};
updateChart();

setInterval(function () { updateChart(); }, 500);

}
</script>
<?php
					if(!empty($_SESSION['worker']))
					{
					?>
						<div class="row container-fluid ml-5 mt-2 col-6 text-white">
						<h4>Welcome: <?php echo $_SESSION['worker']['email'];?></h4>
						</div>
					<?php
					}
					else if(!empty($_SESSION['admin']))
					{
					?>
						<div class="row container-fluid ml-5 mt-2 col-6 text-white">
						<h4>Welcome: <?php echo $_SESSION['admin']['email'];?></h4>
						</div>
					<?php
					}
					?>
		<div class="container-fluid col-sm-8 mt-5">
			<div class="tab-content col-sm-12">
				<div id="view_status" class="tab-pane active">
					<div class="row text-white-50">
						<h1>View Status</h1>
					</div>
					<div id="chartContainer" class="row container-fluid" style="height: 370px; max-width: 920px; margin: 0px auto;">
						
					</div>
					<script src="jquery.canvasjs.min.js"></script>
					<script>
						$("#view").click(function(){
							window.location.reload();
						});
					</script>
				</div>
				<div id="view_report" class="tab-pane fade">
					<div class="row text-white-50">
						<h1>Clearance Reports</h1>
					</div>
					<div class="row container-fluid text-light">
						<h4>Approve Report</h4>
						<?php
						$select="SELECT b.bid,l.name,r.path,r.approval FROM bin b JOIN report r JOIN location l ON b.bid=r.bid AND b.locid=l.locid";
						$rs=mysqli_query($link,$select)or die(mysqli_error($link));
						if(mysqli_num_rows($rs)>0)
						{
						?>
						<table class="table table-bordered table-dark rounded">
							<thead align="center" class="text-success">
								<th>Bin ID</th>
								<th>Location</th>
								<th>Clearance Proof</th>
								<th>Action</th>
							</thead>
							<tbody align="center">
							<?php
							while($row=mysqli_fetch_assoc($rs))
							{
							?>
								<tr>
									<td><?php echo $row['bid'];?></td>
									<td><?php echo $row['name'];?></td>
									<td><button id="<?php echo $row['bid'];?>view" class="btn btn-info" data-toggle="modal" data-target="#report">View Image</button></td>
									<td id="<?php echo $row['bid'];?>approval">
										<?php
										if($row['approval']!="APPROVED")
										{
										?>
											<button id="<?php echo $row['bid'];?>appr" class="btn btn-primary">Approve</button>
										<?php
										}
										else echo $row['approval'];
										?>
									</td>
								</tr>
								<script>
									$("#<?php echo $row['bid'];?>view").click(function(){
										$("#mhead").html("Proof");
										$("#mbody").html("<img src='<?php echo $row['path'];?>'>");
									});
									$("#<?php echo $row['bid'];?>appr").click(function(){
										var xhttp=new XMLHttpRequest();
										xhttp.onreadystatechange=function(){
											if(this.readyState==4 && this.status==200)
											{
												if(this.responseText=='1')
												{
													alert("Report Approved");
													$("#<?php echo $row['bid'];?>approval").html("APPROVED");
												}
											}
										};
										xhttp.open("GET","approvereport.php?id=<?php echo $row['bid'];?>",true);
										xhttp.send();
									});
								</script>
							<?php
							}
							?>
							</tbody>
						</table>
						<?php
						}
						else
							echo "<div class='row col-12'><h3>No reports to display!!!</h3></div>";
						?>
					</div>
				</div>
				<div id="upload_report" class="tab-pane fade">
					<div class="row text-white-50">
						<h1>Clearance Reports</h1>
					</div>
					<form class="row container-fluid text-light" method="post" enctype="multipart/form-data">
						<div class="row col-sm-12"><h4>Upload Report</h4></div>
						<div class="row col-sm-9 m-2">
							<div class="col-sm-2 p-2">
								Bin ID: 
								<select name="bid" class="form-control" onblur="checkBinId(this.value)">
									<option id="dflt_opt" value="" selected>-Select-</option>
								<?php
									$select="SELECT bid FROM bin";
									$rs=mysqli_query($link,$select)or die(mysqli_error($link));
									while($row=mysqli_fetch_assoc($rs))
									{
								?>
										<option value="<?php echo $row['bid'];?>"><?php echo $row['bid'];?></option>
								<?php
									}
								?>
								</select>
							</div>
							<div class="col-sm-6 p-2">
								Image:
								<div class="custom-file">
									Image: 
									<input type="file" class="custom-file-input" id="customFile" name="pic" onchange="setFile(this.files[0])"/>
									<label class="custom-file-label" for="customFile"></label>
								</div>
							</div>
							<div class="col-sm-2 p-2 mt-4">
								<input type="button" name="upload" value="Upload" class="btn btn-primary">
							</div>
						</div>
						<script>
							var file=null;
							$("input").prop('required',true);
							$(".custom-file-input").on("change", function() {
								var fileName = $(this).val().split("\\").pop();
								$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
							});
							function checkBinId(id)
							{
								var xhttp=new XMLHttpRequest();
								xhttp.onreadystatechange=function(){
									if(this.readyState==4 && this.status==200)
									{
										if(this.responseText=="Found")
										{
											alert("Cannot upload report for bin that has not been approved.\nContact Administrator");
											$("#dflt_opt").prop('selected',true);
										}
									}
								};
								xhttp.open("GET","idinreport.php?bid="+id,true);
								xhttp.send();
							}
							function setFile(f)
							{
								file=f;
							}
							$("input[name='upload']").click(function(){
								var bid=$("select[name='bid']").val();
								if(bid=="")
								{
									alert("Please Enter a Bin Id");
									return;
								}
								if(file==null)
								{
									alert("Please select a file");
									return;
								}
								var fdata=new FormData();
								fdata.append('bid',bid);
								fdata.append('pic',file);
								var xhttp=new XMLHttpRequest();
								xhttp.onreadystatechange=function(){
									if(this.readyState==4 && this.status==200)
										alert(this.responseText);
								};
								xhttp.open("POST","uploadreport.php");
								//xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhttp.send(fdata);
							});
						</script>
					</form>
				</div>
			</div>
		</div>
<?php
	}
	else
	{
		require('loginform.php');
		require('regform.php');
	}
?>
<div class="modal fade" id="report">
	<div class="modal-dialog">
		<div class="modal-content">
							
			<!-- Modal Header -->
			<div class="modal-header">
			<h4 class="modal-title" id="mhead">Proof</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
						
			<!-- Modal body -->
			<div class="modal-body" id="mbody">
			</div>
								
			<!-- Modal footer -->
			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>			
		</div>
	</div>
</div>
</body>
</html>