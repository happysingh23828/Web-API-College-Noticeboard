<?php 
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	$result = $db->DeleteDeptNotice($_POST['Id']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Notice Delete Successfuly....";
	}
	else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}

echo json_encode($response);