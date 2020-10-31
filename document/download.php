<?php

require "../dbConnect.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inputs API KEY , ID
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$documentId = $_REQUEST['id'];

if($_REQUEST['apiKey'] == $API_KEY){
	$findQuery = mysqli_query($con,"SELECT * from document where id = $documentId");
	if(mysqli_num_rows($findQuery)){
		$data = mysqli_fetch_assoc($findQuery);
		$status = 200;
		$msg = "Success - File found";
		$link = SITE_ROOT . '\\files\\' . $data["saved_document_location"];
		$originalName = $data["original_document_name"];
		echo  json_encode(array('status' => $status, 'msg' => $msg , 'download_link' => $link , 'original_name' => $originalName));
	}
	else{
		$status = 201;
		$msg = "Error - Database error file not found";
		echo makeJSON($status,$msg);
	}
}else{
	$status = 202;
	$msg = "Error - Invalid API key";
	echo makeJSON($status,$msg);
}
?>