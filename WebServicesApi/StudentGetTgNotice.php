<?php 
	
	$response = array();
	include '../includes/Student_operation.php';

	$db = new StudentOperation();

    $a = $_POST['TgEmail'];

	$result= $db->GetTgNotice($a);
	
	   
		$postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
	
		
echo json_encode($postdata);
