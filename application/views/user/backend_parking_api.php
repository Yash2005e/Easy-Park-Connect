<?php
// backend_parking_api.php

// Allow cross-origin requests (for local dev)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Get parameters from frontend (lat/lng)
$lat = isset($_GET['lat']) ? $_GET['lat'] : null;
$lng = isset($_GET['lng']) ? $_GET['lng'] : null;

if (!$lat || !$lng) {
    echo json_encode(['error' => 'Missing lat/lng']);
    exit;
}

// Build Overpass API query to find parking within 2km radius
$overpassQuery = <<<EOT
[out:json];
(
  node["amenity"="parking"](around:2000,{$lat},{$lng});
  way["amenity"="parking"](around:2000,{$lat},{$lng});
  relation["amenity"="parking"](around:2000,{$lat},{$lng});
);
out center;
EOT;

// Overpass API endpoint
$url = "https://overpass-api.de/api/interpreter";

// Fetch data using POST (Overpass prefers POST for complex queries)
$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query(['data' => $overpassQuery]),
        'timeout' => 30
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    echo json_encode(['error' => 'Unable to fetch parking data from OpenStreetMap']);
    exit;
}

// Pass through to frontend
echo $response;
?>
