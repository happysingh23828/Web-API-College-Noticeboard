<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	if($db->deletePerson($_POST['Email'])==1)
	{
		$response['error']= false;
		$response['message'] = "Account Deleted Successfuly..";
	}

	else if ($db->deletePerson($_POST['Email'])==2) {
		
	$response['error']= true;
	$response['message'] = "Faculty Not Found";
	}
	else
	{
	$response['error']= true;
	$response['message'] = "Some Error Occured";
	}


	




echo json_encode($response);






