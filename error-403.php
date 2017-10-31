<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");
$returnObject['error'] = 'Forbidden';
http_response_code(403);
echo json_encode($returnObject);
exit();
?>