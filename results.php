<?php
// Start session if needed
session_start();

// Get form values (with basic sanitization)
$place     = htmlspecialchars($_POST['place'] ?? '');
$date      = htmlspecialchars($_POST['targetDate'] ?? '');
$condition = htmlspecialchars($_POST['condition'] ?? '');
$lat       = htmlspecialchars($_POST['lat'] ?? '');
$lon       = htmlspecialchars($_POST['lon'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Prediction Results</title>
  <link rel="stylesheet" href="./bootstrap-5.3.8/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    .result-card {
      border: 2px solid #198754;
      border-radius: 10px;
      padding: 20px;
      margin-top: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    #map {
      width: 100%;
      height: 400px;
      border-radius: 10px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <div class="text-center bg-success text-white py-3 rounded">
    <h2>Prediction Request Summary</h2>
  </div>

  <div class="result-card mt-4">
    <h4>Submitted Information</h4>
    <ul class="list-group">
      <li class="list-group-item"><strong>Location:</strong> <?= $place ?></li>
      <li class="list-group-item"><strong>Date:</strong> <?= $date ?></li>
      <li class="list-group-item"><strong>Condition:</strong> <?= $condition ?></li>
      <li class="list-group-item"><strong>Latitude:</strong> <?= $lat ?></li>
      <li class="list-group-item"><strong>Longitude:</strong> <?= $lon ?></li>
    </ul>

    <?php if ($lat && $lon): ?>
      <div id="map"></div>
    <?php endif; ?>
  </div>
</div>

<?php if ($lat && $lon): ?>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('map').setView([<?= $lat ?>, <?= $lon ?>], 8);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  L.marker([<?= $lat ?>, <?= $lon ?>]).addTo(map)
    .bindPopup("<?= $place ?>").openPopup();
</script>
<?php endif; ?>
<script src="./bootstrap-5.3.8/dist/js/bootstrap.js"></script>
</body>
</html>
