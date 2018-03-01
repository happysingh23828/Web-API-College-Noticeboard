<?php 
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	$result = $db->deleteStudent($_POST['Email']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Student Deleted Successfuly....";
	}
	else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured While Deleting";
	}

echo json_encode($response);