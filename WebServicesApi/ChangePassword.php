<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	if($db->changePassword($_POST['Email'],$_POST['NewPassword'],$_POST['PersonType']))
	{
		$response['error']= false;
		$response['message'] = "Password Changed Successfuly";
	}
	else
	{
	$response['error']= true;
	$response['message'] = "Some Error Occured";
	}


	




echo json_encode($response);






