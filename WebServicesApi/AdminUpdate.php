<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$result = $db->updateAdmin($_POST['Email'],$_POST['CollegeCode'],$_POST['Type'],$_POST['Data']);
	if($result==1)
	{
		
		$response['error'] = false;
		$response['message'] = " Profile Updated Successfuly....";
		

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






