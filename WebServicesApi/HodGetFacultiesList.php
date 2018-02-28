<?php
	require_once '../includes/Hod_Operations.php';
    
	
	$response = array();


	$db = new HodOperation();


    $result=$db->getFacultiesList($_POST['CollegeCode'],$_POST['Dept']);

    $postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
	
				
		

		

echo json_encode($postdata);			