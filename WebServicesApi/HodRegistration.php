<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	

	$result = $db->addHod($_POST['Email'],$_POST['Password'],$_POST['Name'],$_POST['CollegeCode'],$_POST['MobileNo'],$_POST['Dob'],$_POST['Gender'],$_POST['PersonPhoto'],$_POST['Dept']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Registered Successfuly....";
	}else if($result==2){

		$response['error']= true;
		$response['message'] = "Its Seems He or She already Registered Check Email";		
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}


echo json_encode($response);


