<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Name = $_POST['Name'];
	$CollegeCode = $_POST['CollegeCode'];


	$db = new AdminOperation();

	$result = $db->createAdmin($Email,$Password,$Name,$CollegeCode);

	echo $result;
	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Data Sent";
	}else if($result==2){

		$response['error']= true;
		$response['message'] = "User Exist";		
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error execution";
	}


echo json_encode($response);






