<?php
	require_once '../includes/Hod_Operations.php';
    
	
	$response = array();


				$db = new HodOperation();


                $result=$db->hodlogin($_POST['Email'],$_POST['Password']);
				
				if($result==1)
				{
					$user = $db->getHodByEMail($_POST['Email']);
					
					$response['error']= false;
					$response['message'] = "Login Successfuly";

					$response['name'] = $user['name'];
					$response['email']= $user['email'];
				    $response['collegecode'] = $user['collegecode']; 
					$response['mobileno'] = $user['mobileno'];
					$response['dob'] = $user['dob'];
					$response['gender'] = $user['gender'];
                    $response['type'] = "hod"; 
                    $response['dept'] = $user['dept'];
					$response['personphoto'] = $user['personphoto'];
					

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