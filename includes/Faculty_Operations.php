<?php 
 class FaluctyOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}

        
		public function userlogin($email,$password)
		{
			$pass = md5($password);
			$stmt = $this->con->prepare('SELECT email from person where email = ? AND password = ?;');
			$stmt->bind_param("ss",$email,$password);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0; 

		}

		public function getUserByEMail($email)
		{
			$stmt = $this->con->prepare('SELECT * from person where email = ?;');
			$stmt->bind_param("s",$email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();	
		}



		/*All Oprations Realted To Faculty*/

 }

