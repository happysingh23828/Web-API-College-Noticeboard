<?php 
	
	$response = array();
	include '../includes/Student_Operation.php';

	$db = new StudentOperation();

	$Notice = $db->GetTgNotice($_POST['Email']);
    if($Notice != null){
		    	$response['error'] = false;
		    $response['Id'] = $Notice['id'];
		    $response['CollegeCode'] = $Notice['collegecode'];
		    $response['AuthorEmail'] = $Notice['authoremail'];
		    $response['Time'] = $Notice['time'];
		    $response['Title'] = $Notice['title'];
		    $response['Dept'] = $Notice['dept'];
		    $response['String'] = $Notice['String'];
		    $response['Image'] = $Notice['Image'];
    }
    else{
    	$response['error']= true;
		$response['message'] = "Result not Found";
    }

echo json_encode($response);