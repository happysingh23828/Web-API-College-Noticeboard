<?php
	
	$response = array();
	include '../includes/Student_Operation.php';

	$db = new StudentOperation();

	
	$result = $db->studentLogin($_POST['Email'],$_POST['Password']);
	if($result==1)
	{
		$student = $db->getStudentDetailsByEmail($_POST['Email']);
		
		$response['error'] = false;
		$response['message'] = " Login Successfuly....";
		
		$response['name'] = $student['name'];
		$response['email'] = $student['email'];
		$response['collegecode'] = $student['collegecode'];
		$response['mobileno'] = $student['mobileno'];
		$response['dob'] = $student['dob'];
		$response['gender'] = $student['gender'];
		$response['type'] = "student";

		$response['studentprofile'] = $student['studentprofile'];
		$response['dept'] = $student['dept'];
		$response['sem'] = $student['sem'];
		$response['tgemail'] = $student['tgemail'];
		$response['enrollment'] = $student['enrollment'];
		

	}
	else if($result==2)
	{
		$response['error']= true;
		$response['message'] = "Email Not Found";
	}else
	{
		$response['error']= true;
		$response['message'] = "Incorrect Password";
	}




echo json_encode($response);






