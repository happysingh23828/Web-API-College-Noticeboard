<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	

	$result = $db->AddPerson($_POST['Email'],$_POST['Password'],$_POST['Name'],$_POST['CollegeCode'],$_POST['MobileNo'],$_POST['Dob'],$_POST['Gender'],$_POST['PersonPhoto'],$_POST['Role'],$_POST['Dept'],$_POST['TgFlag'],$_POST['TgSem']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = $_POST['Role']." Registered Successfuly....";
	}else if($result==2){

		$response['error']= true;
		$response['message'] = "Its Seems He or She already Registered Check Email";		
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}


echo json_encode($response);






