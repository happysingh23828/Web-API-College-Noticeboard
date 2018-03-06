<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();



	$result = $db->createAdmin($_POST['Email'],$_POST['Password'],$_POST['Name'],$_POST['CollegeCode'],$_POST['MobileNo'],$_POST['Dob'],$_POST['Gender'],$_POST['CollegeName'],$_POST['CollegeCity'],$_POST['CollegeState'],$_POST['CollegeLogo'],$_POST['AdminPhoto']);

	if($result==1)
	{
		$response['error'] = false;
		$response['message'] = "You Registered Successfuly....";

		$admin = $db->getAdminDetailsByEmail($_POST['Email']);
		
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

	}else if($result==2){

		$response['error']= true;
		$response['message'] = "Its Seems You are already Registered Check College Code OR Email";		
	}else
	{
		$response['error']= true;
		$response['message'] = "Some Error Occured...";
	}


echo json_encode($response);






