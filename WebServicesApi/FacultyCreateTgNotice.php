<?php 
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();

	$result = $db->createNoticeTg($_POST['CollegeCode'],$_POST['AuthorEmail'],$_POST['Time'],$_POST['Title'],$_POST['Dept'],$_POST['Sem'],$_POST['String'],$_POST['Image'],$_POST['AuthorName'],$_POST['AuthorType']);

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