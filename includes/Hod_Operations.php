<?php 

 class HodOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}


      public function checkHodInDB($Email) // Function For Checking Admin Person Exist OR not......
		{
				
			$stmt = $this->con->prepare('select * from hod where email = ? ;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}


		public function hodLogin($Email,$Password)
		{
			
			if($this->checkHodInDB($Email))
			{

				$Password = md5($Password);
				$stmt = $this->con->prepare('select * from hod where email = ? AND password = ?;');
				$stmt->bind_param("ss",$Email,$Password);
				$stmt->execute();
				$stmt->store_result();
				return $stmt->num_rows > 0;
			}

			else
			{
				return 2;
			}

		}

		public function getHodByEMail($email)
		{
			$stmt = $this->con->prepare('SELECT * from hod where email = ?;');
			$stmt->bind_param("s",$email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();	
		}

	}
?>