<?php
$uuid = $_GET['uuid'];

// Read the current URLs from the JSON file
$url_file = 'user_urls.json';
$urls = [];
if (file_exists($url_file)) {
    $json = file_get_contents($url_file);
    $urls = json_decode($json, true);
}

if (isset($urls[$uuid])) {
    echo json_encode(array("status" => "success", "message" => "User authenticated"));
} else {
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Invalid user ID"));
}
?>