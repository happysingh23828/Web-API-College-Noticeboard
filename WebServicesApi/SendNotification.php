<?php 


require_once 'Firebase.php';
require_once 'Push.php';
require_once '../includes/Faculty_Operations.php'; 

$db = new FaluctyOperation();

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){	
	//hecking the required params 
	if(isset($_POST['title']) and isset($_POST['message'])) {
		//creating a new push
		$push = null; 
		//first check if the push has an image with it
		if(isset($_POST['image'])){
			$push = new Push(
					$_POST['title'],
					$_POST['message'],
					$_POST['image']
				);
		}else
		{
			//if the push don't have an image give null in place of image
			$push = new Push(
					$_POST['title'],
					$_POST['message'],
					null
				);
		}


		//getting the token from database object 
		
		if($_POST['Type']=="tg")
		{

			$devicetoken = $db->getTgStudent($_POST['Data']);
		}
		else if($_POST['Type']=="dept")
		{
			$devicetoken = $db->getDeptTokens($_POST['Data']);
		}
		else if($_POST['Type']=="all")
		{
			$devicetoken = $db->getAllTokens();
		}

		

		//getting the push from push object
		$mPushNotification = $push->getPush(); 

		

		//creating firebase class object 
		$firebase = new Firebase(); 

		//sending push notification and displaying result 
		echo $firebase->send($devicetoken, $mPushNotification);
	}else{
		$response['error']=true;
		$response['message']='Parameters missing';
	}
}else{
	$response['error']=true;
	$response['message']='Invalid request';
}

echo json_encode($response);