<?php
	require_once '../includes/Faculty_Operations.php';
    
	
	$response = array();


	$db = new FaluctyOperation();


    $result=$db->getStudentList($_POST['TgEmail']);

    $postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
	
				
		

		

echo json_encode($postdata);			