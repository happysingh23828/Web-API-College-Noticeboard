<?php
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	
	$result = $db->updateFacultyImage($_POST['CollegeCode'],$_POST['Data'],$_POST['Email']);
	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = " Profile Updated Successfuly....";

	}
	else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured While Updating";
	}




echo json_encode($response);