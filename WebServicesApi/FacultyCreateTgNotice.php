<?php 
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	$result = $db->createNoticeTg($_POST['College_Code'],$_POST['Author_Email'],$_POST['Title'],$_POST['Dept'],$_POST['Sem'],$_POST['Time'],$_POST['String'],$_POST['Image']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Notice Added Successfuly....";
	}
	else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}

echo json_encode($response);