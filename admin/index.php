<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: login.php');
	die();
}
header('Location: profile.php');
die();