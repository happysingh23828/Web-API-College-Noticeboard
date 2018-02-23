<?php 
	
	$response = array();
	include '../includes/Student_Operation.php';

	$db = new StudentOperation();



	$result= $db->GetCollegeNotice($_POST['CollegeCode'],$_POST['Type']);
	
	if($result==2)
	{
		$postdata['error'] = true;
		$postdata['message'] = "There Is No Notices";
		 
	}

	else
	{
		$postdata = array();
		while($row=mysqli_fetch_assoc($result))
		{
			$postdata[] = $row;
		}
		$resultdata = array($postdata);
			
	}
   
		
echo json_encode($postdata);
