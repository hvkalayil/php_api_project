<?php

require '../dbconnect.php';
	$user = array();
	if ($_REQUEST['apiKey']==$API_KEY) {
		$mobile = $_REQUEST['mobile'];
		$otp = $_REQUEST['otp'];
		//Selecting user with corresponding mobile number
		$query = mysqli_query($con,"SELECT * from user WHERE mobile=$mobile");
		if(mysqli_num_rows($query)){
			$userData = mysqli_fetch_assoc($query);
			if($otp == $userData["otp"]){
				$status = 200;
				$msg = "Success - OTP is correct";
				$updateQuery = mysqli_query($con,"UPDATE user SET otp=''");
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
			}else{
				$status = 201;
				$msg = "Error - OTP is incorrect";
			}
		}
		else{
			$status = 202;
			$msg = "Error - This number does not exist in database";
		}
	} 
	else {
	    $status = 203;
	    $msg = "Error - Invalid API Key";
	}

	echo json_encode(array('status' => $status, 'msg' => $msg , 'user' => $user));
	?>