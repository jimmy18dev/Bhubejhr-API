<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = 'Unauthorized';
http_response_code(401);
echo json_encode($returnObject);
exit();
?>