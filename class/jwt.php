<?php 
// Example to Create AccessToken
date_default_timezone_set('Asia/Bangkok');
include_once'jwt.class.php';
$jwt = new Jwt();
$token = $jwt->createToken('app_token', '{app_token}');
$data = (string) $token;
echo $data . "<br/><br/>";
echo $jwt->verify($data);
