<?php
	require_once '../includes/Faculty_Operations.php';

	$response = array();
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
			if(
			isset($_POST['email']) and 
				isset($_POST['password']))
			{
				$db = new FaluctyOperation();



				if($db->userlogin($_POST['email'],$_POST['password']))
				{
					$user = $db->getUserByEMail($_POST['email']);
					$response['error']= false;
					$response['Email']= $user['email'];
					$response['Name'] = $user['name'];
					$response['Password'] = $user['password'];
					$response['Dob'] = $user['dob'];
					$response['Role'] = $user['role'];
					$response['message'] = "Login Successfuly";

				}else{
					$response['error']= true;
					$response['message'] = "Invalid Username Or Password";
				}


			}else{

				$response['error']= true;
				$response['message'] = "Invalid Request";

			}

		}

echo json_encode($response);			