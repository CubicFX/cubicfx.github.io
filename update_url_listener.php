<?php
require_once 'session_manager.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    
    if (isset($data['url']) && isset($data['owner'])) {
        $newUrl = $data['url'];
        $owner = $data['owner'];
        
        $manager = new SessionManager();
        $manager->saveUrl($owner, $newUrl);
        
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