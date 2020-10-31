<?php

require '../dbconnect.php';

define ('SITE_ROOT', realpath(dirname(__DIR__)));

$id = $_REQUEST['patient_id'];

if ($_REQUEST['apiKey']==$API_KEY) {
    $deleteQuery = mysqli_query($con,"UPDATE patient SET active = FALSE where id = $id");
    if(mysqli_affected_rows($con)){

        // Getting Doc Ids
        $getDocIdQuery = mysqli_query($con,"SELECT document_ids as docs from patient where id = $id");
        $docIdData = mysqli_fetch_assoc($getDocIdQuery);
        $docIds = explode(",",$docIdData["docs"]);

        // Deleting related files
        foreach($docIds as $docId){
            $selectFileQuery = mysqli_query($con,"SELECT saved_document_location as loc FROM document WHERE id = $docId");
            $fileData = mysqli_fetch_assoc($selectFileQuery);
            $fileUrl =  SITE_ROOT . '\\document\\files\\' . $fileData["loc"];
            unlink($fileUrl);
        }
        $status = 200;
        $msg = "Success - Deletion complete";
    }
    else{
        $status = 201;
        $msg = "Error - Database error Id not found.";
    }
} 
else {
    $status = 202;
    $msg = "Error -Invalid API Key";
}
echo makeJSON($status,$msg);
?>