<?php

require '../dbconnect.php';
	if ($_REQUEST['apiKey']==$API_KEY) {
		$mobile = $_REQUEST['mobile'];
		//Selecting user with corresponding mobile number
		$query = mysqli_query($con,"SELECT mobile from user WHERE mobile=$mobile");
		if(mysqli_num_rows($query)){
			$otp = 666666;
			$otpQuery = mysqli_query($con,"UPDATE user SET otp = $otp WHERE mobile = $mobile");
			if(mysqli_affected_rows($con) == 1){
				$status = 200;
				$msg = "Success - OTP has been sent";
			}else{
				$status = 201;
				$msg = "Error - while registering OTP";
			}
		}
		else{
			$status = 202;
			$msg = "Error - This number does not exist in database";
		}
	} 
	else {
	    $status = 203;
	    $msg = "Error -Invalid API Key";
	}

	echo makeJSON($status,$msg);
	?>