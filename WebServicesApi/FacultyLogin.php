<?php
	require_once '../includes/Faculty_Operations.php';
    
	
	$response = array();


				$db = new FaluctyOperation();


                $result=$db->userlogin($_POST['Email'],$_POST['Password']);
				
				if($result==1)
				{
					$user = $db->getUserByEMail($_POST['Email']);
					
					$response['error']= false;
					$response['message'] = "Login Successfuly";

					$response['name'] = $user['name'];
					$response['email']= $user['email'];
				    $response['collegecode'] = $user['collegecode']; 
					$response['mobileno'] = $user['mobileno'];
					$response['dob'] = $user['dob'];
					$response['gender'] = $user['gender'];
                    $response['type'] = "other"; 

					$response['role'] = $user['role'];
					$response['personprofile'] = $user['personprofile'];
					

				}else if($result==2){
					$response['error']= true;
		           $response['message'] = "Email Not Found";
				}
				else
				{
					$response['error']= true;
					$response['message'] = "Incorrect Password";
				}

		

echo json_encode($response);			