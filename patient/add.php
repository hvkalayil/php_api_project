<?php

require '../dbconnect.php';

$user_id     = $_REQUEST['user_id'];
$name        = $_REQUEST['name'];
$mobile      = $_REQUEST['mobile'];
$category    = $_REQUEST['category'];
$subCategory = $_REQUEST['subCategory'];
$doc_ids     = $_REQUEST['doc_ids'];


$patientId = 0;
if ($_REQUEST['apiKey']==$API_KEY) {

    $findIdQuery = mysqli_query($con, "SELECT count(id) as cnt from patient");
    $nextPatientId = mysqli_fetch_assoc($findIdQuery)['cnt']+1;
    
    $insertQuery = mysqli_query($con, "INSERT INTO patient 
    (user_id , patient_name , patient_mobile , category , sub_category , document_ids)
    VALUES ('$user_id', '$name', '$mobile', '$category', '$subCategory', '$doc_ids' )
    ");
    if(mysqli_affected_rows($con) == 1){
        $status = 200;
        $msg    = "Success - Patient Added";
        $patientId = $nextPatientId;
    }
    else{
        $status = 201;
        $msg    = "Error - Database error while adding patient";
    }
} 
else {
    $status = 202;
    $msg = "Error -Invalid API Key";
}

echo json_encode(array('status' => $status, 'msg' => $msg , 'patient_id' => $patientId));
?>