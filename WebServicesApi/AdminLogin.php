<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$result = $db->adminLogin($_POST['Email'],$_POST['Password']);
	if($result==1)
	{
		$admin = $db->getAdminDetailsByEmail($_POST['Email']);
		
		$response['error'] = false;
		$response['message'] = " Login Successfuly....";

		$response['name'] = $admin['name'];
		$response['email'] = $admin['email'];
		$response['collegecode'] = $admin['collegecode'];
		$response['mobileno'] = $admin['mobileno'];
		$response['dob'] = $admin['dob'];
		$response['gender'] = $admin['gender'];
        $response['type'] = "other";
		
		$response['profilephoto'] = $admin['profilephoto'];
		$response['collegelogo'] = $admin['collegelogo'];
		$response['collegename'] = $admin['collegename'];
		$response['collegecity'] = $admin['collegecity'];
		$response['collegestate'] = $admin['collegestate'];

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






