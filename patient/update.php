<?php

require '../dbconnect.php';

$id      = $_REQUEST['patient_id'];
$name    = $_REQUEST['name'];
$mobile  = $_REQUEST['mobile'];
$doc_ids = $_REQUEST['doc_ids'];

if ($_REQUEST['apiKey']==$API_KEY) {
    
    $updateQuery = mysqli_query($con, "UPDATE patient SET 
    patient_name = '$name', 
    patient_mobile = '$mobile', 
    document_ids = '$doc_ids'
    where id = $id
    ");

    if(mysqli_affected_rows($con) == 1){
        $status = 200;
        $msg    = "Success - Patient Updated";
    }
    else{
        $status = 201;
        $msg    = "Error - Database error while updating patient";
    }
} 
else {
    $status = 202;
    $msg = "Error -Invalid API Key";
}

echo makeJSON($status,$msg);
?>