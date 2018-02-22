<?php
	
	$response = array();
	include '../includes/Faculty_Operations.php';

	$db = new FaluctyOperation();



	$result = $db->createStudent($_POST['Email'],$_POST['Password'],$_POST['Name'],$_POST['CollegeCode'],$_POST['MobileNo'],$_POST['Dob'],$_POST['Gender'],$_POST['Dept'],$_POST['Sem'],$_POST['TgEmail'],$_POST['Enrollment'],$_POST['StudentPhoto']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "Student Registered Successfuly....";
	}else if($result==2){

		$response['error']= true;
		$response['message'] = "Its Seems Student already Registered Check Email";		
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}


echo json_encode($response);






