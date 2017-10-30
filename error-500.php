<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = 'Internal Server Error';
http_response_code(500);
echo json_encode($returnObject);
exit();
?>