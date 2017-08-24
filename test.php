<?php
header("Content-type: text/json");
$data = array(
	"hn" 	=> 50999,
	"status" 	=> 'success',
);

// JSON Encode and Echo.
echo json_encode($data);
exit();
?>