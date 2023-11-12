<?php
	/* Database connection settings */
	session_start();
	define('ROOT_URL', 'http://localhost/rabbit2/');
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'rabbit';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

 	// $coordinates = array();
 	// $latitudes = array();
 	// $longitudes = array();

	// // Select all the rows in the markers table
	// $query = "SELECT  `locationLatitude`, `locationLongitude` FROM `location_tab` ";
	// $result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);

 	// while ($row = mysqli_fetch_array($result)) {

	// 	$latitudes[] = $row['locationLatitude'];
	// 	$longitudes[] = $row['locationLongitude'];
	// 	$coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
	// }

	// //remove the comaa ',' from last coordinate
	// $lastcount = count($coordinates)-1;
	// $coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	

	//script gets all id of the location
	$client = $mysqli->query("select * from users inner join location_tab on users.location = location_tab.ID where users.id=".$_SESSION['user-id']);
	$row = $client->fetch_assoc();
	$address = $row['address'];
	
	//if the user has no location yet, set the default location
	if($row == 0){
		$lat = 13.6973;
		$lng = 123.4886;
	} else {
		$lat = $row['locationLatitude'];
		$lng = $row['locationLongitude'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
		<title>Map | View</title>
	</head>

	<body>
	    <nav>  
			<ul> 
				<li class="active"><a href="#"><img src="img/map.png"></a></li>
				<li><a href="<?= ROOT_URL ?>breeder/index.php"><img src="img/logout.png"></a></li>
			</ul> 
		</nav>
		<!-- search a location -->
		<p id="address"><?php echo $address; ?></p>
		<p hidden id="name"><?php echo ucfirst($row['firstname']).' '.ucfirst($row['lastname']); ?></p>
		<!-- save the location -->
		<form action="saveMap.php" method="post">
			<input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
			<input type="hidden" id="lng" name="lng" value="<?php echo $lng; ?>">
			<input type="hidden" id="location" name="locationID" value="<?php echo $row['ID'] ?>">
			<input type="submit" name="save" value="Save">
		</form>

		 <div class="outer-scontainer">
	        <div class="row">
	            <!-- <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data"> -->
	            	<div class="form-area">	      
    					<button onclick="reloadMap()" name="import" class="btn-submit">RELOAD DATA</button><br />
					</div>
	            <!-- </form> -->
	        </div>
		<input type="hidden" id="lat" value="<?php echo $row['locationLatitude'] ?>">
		<input type="hidden" id="lng" value="<?php echo $row['locationLongitude']; ?>">
		<div id="map" style="width: 100%; height: 80vh;"></div>
<!-- 
		<script>

			function initMap() {
			  var mapOptions = {
			    zoom: 18,
			    center: {}, //{lat: --- , lng: ....}
			    mapTypeId: google.maps.MapTypeId.SATELITE
			  };

			  var map = new google.maps.Map(document.getElementById('map'),mapOptions);

			  var RouteCoordinates = [
			  	
			  ];

			  var RoutePath = new google.maps.Polyline({
			    path: RouteCoordinates,
			    geodesic: true,
			    strokeColor: '#1100FF',
			    strokeOpacity: 1.0,
			    strokeWeight: 10
			  });

			  mark = 'img/mark.png';

			  startPoint = {};
			  endPoint = {};

			  var marker = new google.maps.Marker({
			  	position: startPoint,
			  	map: map,
			  	icon: mark,
			  	title:"Start point!",
			  	animation: google.maps.Animation.BOUNCE
			  });

			  var marker = new google.maps.Marker({
			  position: endPoint,
			   map: map,
			   icon: flag,
			   title:"End point!",
			   animation: google.maps.Animation.DROP
			});

			  RoutePath.setMap(map);
			}

			google.maps.event.addDomListener(window, 'load', initialize);
    	</script>

    	remenber to put your google map key-->
	    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script> -->

	</body>
</html>
<script>
//function to reload the map
function reloadMap() {
	location.reload();
}

var lat = document.getElementById('lat').value;
var lng = document.getElementById('lng').value;
// Initialize the map and set its center and zoom level
var map = L.map('map').setView([lat,lng], 13);

//sets the name of the breeder
var name = document.getElementById('name').innerHTML;
var address = document.getElementById('address').innerHTML;

// Add a tile layer (basemap) to the map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Add a marker to the map
var marker = L.marker([lat,lng]).addTo(map);

// Add a popup to the marker
marker.bindPopup("<b>"+name+"</b><br>"+address+"<br>").openPopup();

//mark a location and the map and save it into database as new latitude and longitude
map.on('click', function(e) {
	var coord = e.latlng;
	var lat = coord.lat;
	var lng = coord.lng;
	marker.setLatLng([lat,lng]);
	document.getElementById('lat').value = lat;
	document.getElementById('lng').value = lng;
});

// Attach the geocodeAndDisplayLocation function to the button click event
document.getElementById('searchButton').addEventListener('click', geocodeAndDisplayLocation);


</script>