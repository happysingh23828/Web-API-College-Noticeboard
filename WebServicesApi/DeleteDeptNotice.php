<?php 
	
	$response = array();
	include '../includes/Student_Operation.php';

	$db = new StudentOperation();



	$result= $db->deleteNotice($_POST['Type'],$_POST['Id']);
	
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
   
		
echo json_encode($result);
