<?php
require '../dbconnect.php';

$id = $_REQUEST['user_id'];
	if ($_REQUEST['apiKey']==$API_KEY) {
        $query = mysqli_query($con,"SELECT * from user where id = $id");
        
        if(mysqli_num_rows($query)){
            $userData = mysqli_fetch_assoc($query);
            $user = array(
                "id" =>$userData["id"],
                "name"=>$userData["name"],
                "gender"=>$userData["gender"], 
                "mobile"=>$userData["mobile"],
                "dob"=>$userData["dob"],
                "city"=>$userData["city"],
                "medical_number"=>$userData["medical_number"],
                "hospital_name"=>$userData["hospital_name"],
                "email"=>$userData["email"]
            );
            $status = 200;
            $msg = "Success - User found";
        
            echo json_encode(array('status' => $status, 'msg' => $msg , 'user' => $user));
        }
        else{
            $status = 201;
            $msg = "Error - Database error user not found.";
            echo makeJSON($status,$msg);
        }
	}else {
	    $status = 202;
        $msg = "Error - Invalid API Key";
        echo makeJSON($status,$msg);
	}
	?>