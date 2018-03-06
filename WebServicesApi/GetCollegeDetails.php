<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$admin=$db->getCollege($_POST['CollegeCode']);

   
		
		$response['error'] = false;
		$response['message'] = " Login Successfuly....";

		$response['name'] = $admin['name'];
		$response['email'] = $admin['email'];
		$response['collegecode'] = $admin['collegecode'];
		$response['mobileno'] = $admin['mobileno'];
		$response['dob'] = $admin['dob'];
		$response['gender'] = $admin['gender'];
        $response['type'] = "admin";
		$response['profilephoto'] = $admin['profilephoto'];
		$response['collegelogo'] = $admin['collegelogo'];
		$response['collegename'] = $admin['collegename'];
		$response['collegecity'] = $admin['collegecity'];
		$response['collegestate'] = $admin['collegestate'];

	
	echo json_encode($response);