<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = 'Service Unavailable';
http_response_code(503);
echo json_encode($returnObject);
exit();
?>