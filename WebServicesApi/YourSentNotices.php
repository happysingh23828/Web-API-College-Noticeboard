<?php 
	
	$response = array();
	include '../includes/Student_operation.php';

	$db = new StudentOperation();



	$result= $db->getYourSentNotices($_POST['Email'],$_POST['Type']);
	
	
		
		$postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
	
		
echo json_encode($postdata);
