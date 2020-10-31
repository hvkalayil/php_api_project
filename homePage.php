<?php
require 'dbconnect.php';

$id = $_REQUEST['user_id'];
if ($_REQUEST['apiKey']==$API_KEY) {
    $users = array();
    $user=array();
    
    // Find latest 5 history
    $query = mysqli_query($con, "SELECT * FROM patient WHERE user_id=$id AND active=TRUE ORDER BY added_at DESC");
    if(mysqli_num_rows($query)){
        $i=0;
        $ids = '';
        while($row = mysqli_fetch_assoc($query)){
            if($i == 5){ break; }
            $user['id'] = $row['id'];
            $user['user_id'] = $row['user_id'];
            $user['patient_name'] = $row['patient_name'];
            $user['patient_mobile'] = $row['patient_mobile'];
            $user['category'] = $row['category'];
            $user['sub_category'] = $row['sub_category'];
            $user['document_ids'] = $row['document_ids'];
            $users[$i] = $user;
            $i++;
            $ids = $user['document_ids'] . "," . $ids;
        }

        // Finding Size
        $docIds = explode("," , $ids);
        $totalSpaceInKB = 0;
        foreach($docIds as $docId){
            if(is_numeric($docId)){
                $selectFileQuery = mysqli_query($con,"SELECT file_size FROM document WHERE id = $docId");
                $fileData = mysqli_fetch_assoc($selectFileQuery);
                $totalSpaceInKB = $totalSpaceInKB + $fileData["file_size"];
            }
        }
        $totalSpaceInMB = $totalSpaceInKB / 1024;
        $status = 200;
        $msg = "Success - Data found";
        echo json_encode(array('status' => $status, 'msg' => $msg, 'users' => $users , 'size_used'=> $totalSpaceInMB));
    }
    else{
        $status = 201;
        $msg = "Error - No patients added.";
        echo makeJSON($status,$msg);
    }

}else {
    $status = 202;
    $msg = "Error - Invalid API Key";
    echo makeJSON($status,$msg);
}
?>