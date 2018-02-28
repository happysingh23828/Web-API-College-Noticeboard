<?php
	require_once '../includes/Admin_Operations.php';
    
	
	$response = array();


	$db = new AdminOperation();


    $result=$db->getHodList($_POST['CollegeCode']);

    $postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
	
				
	

echo json_encode($postdata);			