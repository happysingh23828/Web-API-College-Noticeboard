<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$result = $db->updateAdminImage($_POST['CollegeCode'],$_POST['Data'],$_POST['Email']);
	if($result==1)
	{
		
		$response['error'] = false;
		$response['message'] = " Profile Updated Successfuly....";
		

	}
	else
	{
		$response['error']= true;
		$response['message'] = "Not updated...";
	}




echo json_encode($response);


