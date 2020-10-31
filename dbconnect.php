<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$servername = "localhost";
$dbname = "eyedocs";
$username = "root";
$password = "";
$API_KEY = "GIVE_YOUR_API_KEY_HERE";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
	die('Could not connect: ' . mysqli_error());
}

function makeJSON($status, $msg){
	return json_encode(array('status' => $status, 'msg' => $msg));
}

?>