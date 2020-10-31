<?php

require '../dbconnect.php';

$id = $_REQUEST['user_id'];

if ($_REQUEST['apiKey']==$API_KEY) {
    $users = array();
    $user=array();
    
   $query = mysqli_query($con, "SELECT * FROM patient WHERE user_id=$id");
   $status = 200;
   $msg = 'Success - Patients found.';
   $i=0;
    while($row = mysqli_fetch_assoc($query)){
        $user['id'] = $row['id'];
        $user['user_id'] = $row['user_id'];
        $user['patient_name'] = $row['patient_name'];
        $user['patient_mobile'] = $row['patient_mobile'];
        $user['category'] = $row['category'];
        $user['sub_category'] = $row['sub_category'];
        $user['document_ids'] = $row['document_ids'];
        $users[$i] = $user;
        $i++;
    }
    echo json_encode(array('status' => $status, 'msg' => $msg, 'users' =>$users));
} 
else {
    $status = 201;
    $msg = "Error -Invalid API Key";
    echo makeJSON($status,$msg);
}
?>