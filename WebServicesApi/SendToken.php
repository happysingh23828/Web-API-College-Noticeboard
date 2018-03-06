<?php 
	
	$response = array();
	include '../includes/Student_operation.php';

	$db = new StudentOperation();



	$result= $db->sendTokenToserver($_POST['Email'],$_POST['Token'],$_POST['Type']);

	if($result)
	{
			$response['error'] = false; 
			$response['message'] = 'Token Updated';
	}
	else
	{
			$response['error'] = true;
			$response['message']='Some Error';
	}
	
		
		
		
echo json_encode($response);
