<?php
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();



	$result = $db->createNoticeCollege($_POST['CollegeCode'],$_POST['AuthorName'],$_POST['AuthorEmail'],$_POST['Time'],$_POST['Title'],$_POST['Type'],$_POST['String'],$_POST['Image']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Notice Published Successfuly";
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}


echo json_encode($response);
