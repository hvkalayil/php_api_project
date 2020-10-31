<?php
require '../dbconnect.php';
	if ($_REQUEST['apiKey']==$API_KEY) {
        $mobile = $_REQUEST['mobile'];
        $query = mysqli_query($con,"SELECT * from user WHERE mobile=$mobile");
		if(mysqli_num_rows($query) == 0){
            $name = $_REQUEST['name'];
            $gender = $_REQUEST['gender'];
            $dob = $_REQUEST['dob'];
			$city = $_REQUEST['city'];
			$user_type = $_REQUEST['user_type'];
            $medical_number = $_REQUEST['medical_number'];
            $hospital_name = $_REQUEST['hospital_name'];
            $email = $_REQUEST['email'];
        
            $insertQuery = mysqli_query($con, "INSERT INTO user
             (name , gender , mobile , dob , user_type , city , medical_number , hospital_name , email) 
             VALUES 
             ('$name' , '$gender' , '$mobile' , '$dob' , '$user_type' , '$city' , '$medical_number' , '$hospital_name' , '$email')");

			if(mysqli_affected_rows($con) == 1){			
				if($user_type == 'Doctor'){
					$getIdQuery = mysqli_query($con,"SELECT id from user WHERE mobile=$mobile");
					$data = mysqli_fetch_assoc($getIdQuery);
					$id = $data['id'];
					$insertDoctor = mysqli_query($con,"INSERT INTO allowed_doctors 
					(user_id) VALUES ($id)");
					if(mysqli_affected_rows($con) == 1){
						$status = 200;
						$msg = "Success - User was registered";
					}
					else{
						$status = 201;
						$msg = "Error - Database error in allowed_doctors";
					}
				}
			}else{
                echo $insertQuery;
				$status = 202;
				$msg = "Error - Database error while inserting record";
			}
		}
		else{
			$status = 203;
			$msg = "Error - This user is already registered";
		}
	} 
	else {
        $status = 203;
	    $msg = "Error - Invalid API Key";
	}

	echo makeJSON($status,$msg);
	?>