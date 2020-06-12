<?php
    $dlat=$_GET['dlat'];
    $dlng=$_GET['dlng'];
?>
<!doctype html>
<html>
<head>
<style>
    #map{
        height:768px;
        width:100%;
        margin:0px;
    }
</style>

</head>
<body>
<div id="map"></div>
<script>
let source={
    lat:0,
    lng:0,
    setCoords:function (x,y){
        this.lat=x;
        this.lng=y;
    }
};
let dest={
    lat:<?php echo $dlat;?>,
    lng:<?php echo $dlng;?>
};
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getLocation);
} else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
}
function getLocation(position)
{
    source.setCoords(position.coords.latitude,position.coords.longitude);
}
function initMap(){
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    let options={
        zoom:16,
        center:source
    };
    let map=new google.maps.Map(document.getElementById('map'),options);
    directionsRenderer.setMap(map);
    let smarker=new google.maps.Marker({
        position:source,
        map:map,
        title:'My Location'
    });
    let dmarker=new google.maps.Marker({
        position:dest,
        map:map,
        title:'Fuel Theft'
    });
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDigq-X4wXVFdwv8RM2yHNLtP2NdADvHaw&callback=initMap">
    </script>
</body>
</html>