<?php
$uuid = $_GET['uuid'];
$channel = $_GET['channel'];
$message = $_GET['message'];

$url = "http://cubicfx.studio:12345/cap/aa45e181-2bf9-5697-2931-086833208dd7";  // Replace with your actual cap URL
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