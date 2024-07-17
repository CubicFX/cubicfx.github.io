<?php
$uuid = $_GET['uuid'];
$channel = $_GET['channel'];
$message = $_GET['message'];

// Read the current URLs from the JSON file
$url_file = 'user_urls.json';
$urls = [];
if (file_exists($url_file)) {
    $json = file_get_contents($url_file);
    $urls = json_decode($json, true);
}

// Check if the UUID exists in our stored URLs
if (!isset($urls[$uuid])) {
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "No URL found for this UUID"));
    exit;
}

$url = $urls[$uuid];

$data = array('uuid' => $uuid, 'channel' => $channel, 'message' => $message);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    http_response_code(500);
    echo json_encode(array("status" => "error", "message" => "Failed to send message to Second Life"));
} else {
    echo json_encode(array("status" => "success", "message" => "Message sent to Second Life"));
}
?>