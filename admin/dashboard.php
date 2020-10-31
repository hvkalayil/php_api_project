<?php
require '../dbconnect.php';

$id = $_REQUEST['user_id'];
	if ($_REQUEST['apiKey']==$API_KEY) {
		$users = array();
		$user=array();	
		
		$query = mysqli_query($con,"SELECT user_id FROM allowed_doctors WHERE is_allowed IS TRUE");
		$i = 0;
		while($row = mysqli_fetch_assoc($query)){
			$id = $row['user_id'];
			$selectUserQuery = mysqli_query($con,"SELECT * FROM user WHERE id = $id");

			$data = mysqli_fetch_assoc($selectUserQuery);

			$user['name'] = $data['name'];
			$user['gender'] = $data['gender'];
			$user['mobile'] = $data['mobile'];
			$user['dob'] = $data['dob'];
			$user['city'] = $data['city'];
			$user['medical_number'] = $data['medical_number'];
			$user['hospital_name'] = $data['hospital_name'];
			$user['email'] = $data['email'];

			$users[$i] = $user;
			$i++;
		}
		$status = 200;
        $msg = "Success - Data found.";
	}else {
	    $status = 201;
        $msg = "Error - Invalid API Key";
	}
	echo json_encode(array('status' => $status, 'msg' => $msg, 'allowed_doctors' =>$users));
	?>