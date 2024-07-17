<?php
require_once 'session_manager.php';

$uuid = $_GET['uuid'];

$manager = new SessionManager();

if ($manager->userExists($uuid)) {
    echo json_encode(array("status" => "success", "message" => "User authenticated"));
} else {
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Invalid user ID"));
}
?>