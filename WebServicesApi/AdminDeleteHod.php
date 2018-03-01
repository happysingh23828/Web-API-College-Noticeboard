<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	if($db->deleteHod($_POST['Email']))
	{
		$response['error']= false;
		$response['message'] = "Account Deleted Successfuly..";
	}

	else
	{
	$response['error']= true;
	$response['message'] = "Some Error Occured";
	}


	




echo json_encode($response);






