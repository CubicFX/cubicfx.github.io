<?php
$uuid = $_GET['uuid'];
$channel = $_GET['channel'];
$message = $_GET['message'];

$url = "http://simhost-06c9a56af17a2102e.agni.secondlife.io:12046/cap/ef6c9ad6-ea27-add1-9395-21c8e9fd4e57";  // Replace with your actual cap URL
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

echo $result;
?>