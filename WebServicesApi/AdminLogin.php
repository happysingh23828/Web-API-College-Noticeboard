<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$result = $db->adminLogin($_POST['Email'],$_POST['Password']);
	if($result==1)
	{
		$Admin = $db->getAdminDetailsByEmail($_POST['Email']);
		$response['error'] = false;
		$response['message'] = " Login Successfuly....";

	}
	else if($result==2)
	{
		$response['error']= true;
		$response['message'] = "Email Not Found";
	}else
	{
		$response['error']= true;
		$response['message'] = "Incorrect Password";
	}




echo json_encode($response);






