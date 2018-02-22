<?php
	
	$response = array();
	include '../includes/Admin_Operations.php';

	$db = new AdminOperation();

	
	$db->deleteAdmin($_POST['CollegeCode']);
	$response['error']= false;
	$response['message'] = "Account Deleted Successfuly..";




echo json_encode($response);






