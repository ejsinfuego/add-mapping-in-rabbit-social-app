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
	
	
	
	$client = $mysqli->query("select * from users inner join location_tab on users.location = location_tab.ID");
	$row = $client->fetch_all(MYSQLI_ASSOC);

	//if the user has no location yet, set the default location
	if($row == 0){
		$lat = 13.6973;
		$lng = 123.4886;
	} else {
		$lat = array();
		foreach($client as $row){
			$lat[] = $row['locationLatitude'];
		}
		$lng = array();
		foreach($client as $row){
			$lng[] = $row['locationLongitude'];
		}
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
				<li><a href="<?= ROOT_URL ?>admin/index.php"><img src="img/logout.png"></a></li>
			</ul>
		</nav>
		<!-- search a location -->
		<?php foreach($client as $row): ?>
		<?php if($row['id'] == $_SESSION['user-id']): ?>
		<p id="address"><?php echo $address; ?></p>
		<p hidden id="name"><?php echo ucfirst($row['firstname']).' '.ucfirst($row['lastname']); ?></p>
		<!-- save the location -->
		<form action="saveMap.php" method="post">
			<input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
			<input type="hidden" id="lng" name="lng" value="<?php echo $lng; ?>">
			<input type="hidden" id="location" name="locationID" value="<?php echo $row['ID'] ?>">
			<input type="submit" name="save" value="Save">
		</form>
		<?php break;
		 endif; ?>
		<?php endforeach; ?>
		<?php foreach($client as $user): ?>
		<div class="user" hidden>
			<?php if($user['address'] == null) : ?>
			<p style="color:black;" class="address">Map Not Set</p>
			<?php else: ?>
			<p style="color:black;" class="address"><?php echo $user['address']; ?></p>
			<?php endif; ?>
			<p style="color:black;" class="username">
			<?php echo $user['firstname']; ?>
			</p>
			<p style="color:black;" class="latitude">
			<?php echo $user['locationLatitude']; ?>
			</p>
			<p style="color:black;" class="longitude">
			<?php echo $user['locationLongitude']; ?>
			</p>
		</div>
		<?php endforeach; ?>
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
const user = document.querySelectorAll('.username');
var address = document.querySelectorAll('.address');
var lat = document.querySelectorAll('.latitude');
var lng = document.querySelectorAll('.longitude');

var newLat = document.getElementById('lat').value;
var newLng = document.getElementById('lng').value;

var sampel_user = L.marker([13.696756233796542, 123.49784517086889]).bindPopup('address');

var cities = L.layerGroup([]);

//foreach loop to user and get their lat and lng that will be used in the map add to littleton variable and add to cities
for(var i = 0; i < user.length; i++){
	var lati = lat[i].innerText;
	var longi = lng[i].innerText;
	var name = user[i].innerText;

	var mark = L.marker([lati,longi]).bindPopup(name+'<br>'+address[i].innerText);
	mark.addTo(cities);
	console.log(mark);
}
// Add a tile layer (basemap) to the map
var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
});

var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});

var map = L.map('map', {
    center: [13.6973,
123.4886],
    zoom: 13,
    layers: [osm, cities]
});

var baseMaps = {
    "OpenStreetMap": osm,
    "OpenStreetMap.HOT": osmHOT
};

var overlayMaps = {
    "Users": cities
};

var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);

var baseMaps = {
    "OpenStreetMap": osm,
    "<span style='color: red'>OpenStreetMap.HOT</span>": osmHOT
};


//sets the name of the breeder
var name = document.getElementById('name').innerHTML;
var address = document.getElementById('address').innerHTML;


var marker = L.marker([newLat,newLng]).addTo(cities);

marker.bindPopup("<b>"+name+"</b><br>"+address+"<br>").openPopup();

//mark a location and the map and save it into database as new latitude and longitude
map.on('click', function(e) {
	var coord = e.latlng;
	var newLat = coord.lat;
	var newLng = coord.lng;
	marker.setLatLng([newLat,newLng]);
	document.getElementById('lat').value = newLat;
	document.getElementById('lng').value = newLng;
});
	
// // Attach the geocodeAndDisplayLocation function to the button click event
// document.getElementById('searchButton').addEventListener('click', geocodeAndDisplayLocation);


</script>