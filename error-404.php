<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = '404 Not Found';
http_response_code(404);
echo json_encode($returnObject);
exit();
?>