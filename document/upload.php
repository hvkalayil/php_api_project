<?php

require "../dbConnect.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inputs 

$MAXIMUM_FILE_SIZE_ALLOWED_MB = 10;
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = intval($file['size']/1024);
$fileError = $file['error'];
$fileType = $file['type'];

$fileExtList = explode('.', $fileName);
$fileExt = strtolower(end( $fileExtList ));
$allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
$documentId = 0;

if($_REQUEST['apiKey'] == $API_KEY){
	if (in_array($fileExt, $allowed)) {
		if($fileError === 0){
			if ($fileSize < $MAXIMUM_FILE_SIZE_ALLOWED_MB * 1000) {
				$storedDocumentName = strtotime("now") . '-' . $fileName;
		  
				$findIdQuery = mysqli_query($con, "SELECT count(id) as cnt from document");
				$nextDocumentId = mysqli_fetch_assoc($findIdQuery)['cnt']+1;
		  
				$fileDestination = SITE_ROOT . '\\files\\' . $storedDocumentName;
				if(move_uploaded_file($fileTmpName, $fileDestination)){

					$insertQuery = mysqli_query($con,"INSERT INTO document 
					(original_document_name, saved_document_location, file_size) VALUES
					('$fileName', '$storedDocumentName', '$fileSize')");

					if(mysqli_affected_rows($con) == 1){
					  $status = 200;
					  $msg = "Success - The file was uploaded successfully";
					  $documentId = $nextDocumentId;
					}else {
						$status = 201;
						$msg = "Error - Database error while inserting";
					}

				}else{
					$status = 202;
					$msg = "Error - Upload error while uploading file";
				} 
			} else {
				  $status = 203;
				  $msg = "Error - This file is too big";
				}
		}else{
			$status = 204;
			$msg = "Error - Error while uploading file";
		}
	} else {
		$status = 205;
		$msg = "Error - This file extension is not allowed";
	}
}else{
	$status = 206;
	$msg = "Error - Invalid API key";
}

echo  json_encode(array('status' => $status, 'msg' => $msg , 'documentId' => $documentId));
?>