<?php 
	
	$response = array();
	include '../includes/Student_Operation.php';

	$db = new StudentOperation();

	$Notice = $db->GetDeptNotice($_POST['CollegeCode'],$_POST['Dept']);
    if($Notice != null){
		    	$response['error'] = false;
		    $response['Id'] = $Notice['id'];
		    $response['CollegeCode'] = $Notice['collegecode'];
		    $response['AuthorEmail'] = $Notice['authoremail'];
		    $response['Time'] = $Notice['time'];
		    $response['Title'] = $Notice['title'];
		    $response['Type'] = $Notice['dept'];
		    $response['String'] = $Notice['string'];
		    $response['Image'] = $Notice['image'];
    }
    else{
    	$response['error']= true;
		$response['message'] = "Result not Found";
    }

echo json_encode($response);