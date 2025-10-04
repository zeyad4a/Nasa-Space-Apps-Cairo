<?php
require_once 'config.php';
setupSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Earth Cast</title>
  <link rel="stylesheet" href="./nasa/bootstrap-5.3.8/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    .dashboard-form-container {
      border: 2px solid #0d6efd;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    #map {
      width: 100%;
      height: 450px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<!-- Header -->
<div class="text-center bg-primary text-white py-4">
  <h1>NASA Earth Observation Dashboard</h1>
  <p>Analyze weather condition probabilities using NASA's Earth observation data</p>
</div>

<!-- Form Container -->
<div class="container mt-4 dashboard-form-container">
  <h3>Weather Analysis Query</h3>
  <p>Enter location, date, and select a condition to analyze probability</p>

<form class="row px-0" method="POST" action="results.php" id="weatherForm">
    <div class="col-12 col-lg-3 mb-2">
      <label for="place">Location</label><br>
      <input type="text" id="place" name="place" placeholder="City name or coordinates" class="form-control" required>
    </div>
    <div class="col-12 col-lg-3 mb-2">
      <label for="targetDate">Date</label><br>
      <input type="date" id="targetDate" name="targetDate" class="form-control" required>
    </div>
    <div class="col-12 col-lg-3 mb-2">
      <label for="condition">Weather Condition</label><br>
      <select id="condition" name="condition" class="form-control" required>
        <option value="">Select condition</option>
        <option value="very-hot">Very Hot</option>
        <option value="very-cold">Very Cold</option>
        <option value="very-wet">Very Wet</option>
        <option value="very-windy">Very Windy</option>
        <option value="very-uncomfortable">Very Uncomfortable</option>
      </select>
    </div>

    <!-- Hidden fields for lat/lon -->
    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lon" name="lon">

    <div class="col-12 col-md-6 col-lg-3 mt-4">
      <button href="./results.php" type="submit" class="btn btn-primary w-100">Get Results</button>
    </div>
  </form>
</div>

<!-- Map Section -->
<div class="container dashboard-form-container">
  <h3>Interactive Location Map</h3>
  <p>Click anywhere on the map to select a location</p>
  <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('map').setView([26.8206, 30.8025], 5);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  var marker;

  map.on('click', function(e) {
      var lat = e.latlng.lat.toFixed(5);
      var lon = e.latlng.lng.toFixed(5);

      document.getElementById("lat").value = lat;
      document.getElementById("lon").value = lon;
      document.getElementById("place").value = lat + ", " + lon;

      if (marker) {
          map.removeLayer(marker);
      }

      marker = L.marker([lat, lon]).addTo(map);
  });
</script>
<script src="./bootstrap-5.3.8/dist/js/bootstrap.js"></script>
</body>
</html>
