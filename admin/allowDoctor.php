<?php

require '../dbconnect.php';
	if ($_REQUEST['apiKey']==$API_KEY) {
        $id = $_REQUEST['user_id'];
        
		$query = mysqli_query($con,"UPDATE allowed_doctors SET is_allowed = TRUE WHERE user_id = $id");
		if(mysqli_affected_rows($con) > 0){
            $status = 200;
	        $msg = "Success - Doctor is allowed to use app";
        }
        else{
            $status = 201;
	        $msg = "Error - Database error while updating allowed_doctors";
        }
	} 
	else {
	    $status = 202;
	    $msg = "Error -Invalid API Key";
	}

	echo makeJSON($status,$msg);
?>