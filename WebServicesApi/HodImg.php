<?php
	
	$response = array();
	require_once '../includes/Hod_Operations.php';

	$db = new HodOperation();

	
	$result = $db->updateHodImage($_POST['CollegeCode'],$_POST['Data'],$_POST['Email']);
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

