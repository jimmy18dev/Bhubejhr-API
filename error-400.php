<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = 'Not Found';
http_response_code(400);
echo json_encode($returnObject);
exit();
?>