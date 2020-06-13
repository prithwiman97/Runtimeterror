<?php
    require("config.php");
    require("controllers.php");
?>
<!doctype html>
<html>
<head>
    <script src="jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
</head>
<body>
<form class="container-fluid col-8" action="addloc.php" method="POST">
    <div class="row">
        <div class="col-3">
            Name:
            <input type="text" name="name" class="form-control" pattern="[A-Za-z 0-9.]+" required>
        </div>
        <div class="col-3">
            Latitude:
            <input type="number" name="lat" class="form-control" step=0.00001 min=-90 max=90 required>
        </div>
        <div class="col-3">
            Longitude:
            <input type="number" name="lng" class="form-control" step=0.00001 min=-180 max=180 required>
        </div>
        <div class="col-3 mt-4">
            <input type="submit" name="addloc" class="btn btn-primary" value="Add Location">
        </div>
    </div>
</form>
<form class="container-fluid col-6" action="addbin.php" method="POST">
    <div class="row">
        <div class="col-3">
            Bin Id:
            <input type="number" name="bid" class="form-control">
        </div>
        <div class="col-5">
            Location:
            <select name=loc class="form-control">
            <?php
            $lm=new LocationManager();
            $rs=$lm->getLocations();
            while($row=mysqli_fetch_assoc($rs))
            {
            ?>
                <option value=<?php echo $row['locid'];?>><?php echo $row['name'];?></option>
            <?php
            }
            ?>
            </select>
        </div>
        <div class="col-4 mt-4">
            <input type="submit" name="add" class="btn btn-primary" value="Add">
        </div>
    </div>
</form>
<div class="container-fluid col-8 m-5">
    <table class="table table-striped table-bordered table-dark">
        <thead>
            <th>Bin Id</th>
            <th>Location</th>
            <th>Status</th>
        </thead>
        <tbody>
        <?php
        $select="SELECT * FROM bin b JOIN location l ON b.locid=l.locid";
        $rs=mysqli_query($link,$select)or die(mysqli_error($link));
        while($row=mysqli_fetch_assoc($rs))
        {
        ?>
            <tr>
                <td><?php echo $row['bid'];?></td>
                <td><?php echo $row['name'];?></td>
                <td>
                    <input type="range" id="<?php echo $row['bid'];?>stat" min=0 max=100 step=0.1 value=<?php echo $row['status'];?>>
                    <span id="<?php echo $row['bid'];?>disp"><?php echo $row['status'];?>%</span>
                </td>
            </tr>
            <script>
                $("#<?php echo $row['bid'];?>stat").change(function(){
                    var val=this.value;
                    $("#<?php echo $row['bid'];?>disp").html(val+"%");
                    var xhttp=new XMLHttpRequest();
                    xhttp.onreadystatechange=function(){
                        if(this.readyState==4 && this.status==200)
                        {
                            //alert(this.responseText);
                        }
                    };
                    xhttp.open("GET","update.php?bid=<?php echo $row['bid'];?>&stat="+val+"&clr=YES",true);
                    xhttp.send();
                });
            </script>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>