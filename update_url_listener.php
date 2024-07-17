<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function updateUrlFile($owner, $newUrl) {
    $filename = 'user_urls.json';
    $data = [];
    if (file_exists($filename)) {
        $json = file_get_contents($filename);
        $data = json_decode($json, true);
    }
    $data[$owner] = $newUrl;
    file_put_contents($filename, json_encode($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    
    if (isset($data['url']) && isset($data['owner'])) {
        $newUrl = $data['url'];
        $owner = $data['owner'];
        updateUrlFile($owner, $newUrl);
        http_response_code(200);
        echo json_encode(array("status" => "success", "message" => "URL updated successfully for owner: " . $owner));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "URL or owner not provided in the request"));
    }
} else {
    http_response_code(405);
    echo json_encode(array("status" => "error", "message" => "Method not allowed"));
}
?>