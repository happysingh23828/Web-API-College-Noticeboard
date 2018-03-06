<?PHP
require_once '../includes/Faculty_Operations.php';


$db = new FaluctyOperation();
 

if($_POST['Type']=="Dept")
{
	$result = $db->getAllDeptTokens($_POST['CollegeCode'],$_POST['Data']);
}
else if($_POST['Type']=="TG")
{
	$result = $db->getAllTgTokens($_POST['CollegeCode'],$_POST['Data']);
}
else
{
	$result = $db->getAllTokens($_POST['CollegeCode']);
}



$Token_array = array();


while($row = mysqli_fetch_array($result))
{
    $Token_array[] = $row['token'];
}






	function sendMessage(){

		$Tokens = $GLOBALS['Token_array'];

		$content = array(
			"en" => 'Notice Sent By '. $_POST['Name'],
			);
			
		$headings = array(
		    
		    "en" => 'You Got a '. $_POST['Type'].' Notice',
		    );
		    
	   
		
		$fields = array(
			'app_id' => "40d9613c-e107-4fdb-b97a-888d94c77fe2",
			'include_android_reg_ids' =>  $Tokens,
      		'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $headings,
			'large_icon' => 'http://edukationdreams.com/images/bcdnotice.png',
			'android_sound' => 'alerttone'
			
			
		);
		
		$fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MWZjMDRkYTgtMGVmMC00YzBmLWE3MTktOTA3NzA5YjZiY2Fl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
  print("\n\nJSON received:\n");
	print($return);
  print("\n");
?>