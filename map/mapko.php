<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Map Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="map" style="width: 600px; height: 400px;"></div>
</body>
</html>
<script>
    // Initialize the map and set its center and zoom level
    var map = L.map('map').setView([13.6968,123.4891], 13);

    // Add a tile layer (basemap) to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add a marker to the map
    var marker = L.marker([13.6968,123.4891]).addTo(map);

    // Add a popup to the marker
    marker.bindPopup("<b>Hello, Leaflet!</b><br>This is a sample popup.").openPopup();
</script>