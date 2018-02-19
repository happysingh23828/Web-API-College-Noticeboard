<?php 
 class CommonOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}

		public function isExist($Email)
		{
			$stmt = $this->con->prepare('select * from Admin where email = ?;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;


		}


		/*All Oprations Realted To Faculty*/

 }
