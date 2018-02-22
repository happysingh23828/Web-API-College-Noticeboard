<?php
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	$result = $db->UpdateTgNotice($_POST['Id'],$_POST['College_Code'],$_POST['Author_Email'],$_POST['Time'],$_POST['Title'],$_POST['Dept'],$_POST['Sem'],$_POST['String'],$_POST['Image']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Notice Updated Successfuly....";
	}
	else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}

echo json_encode($response);