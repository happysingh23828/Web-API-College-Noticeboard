<?php 
 class AdminOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}



		/*All Oprations Realted To Admin*/

		function createAdmin($Email,$Password,$Name,$CollegeCode){

			if($this->isAdminExist($Email))
			{
				return 2;
			}

			else
			{	

					$Password = md5($Password);
					$stmt = $this->con->prepare('INSERT INTO `Admin` (`email`,`name`, `password`, `collegecode`) VALUES (?, ?, ?, ?);');

					$stmt->bind_param("ssss",$Email,$Name,$Password,$CollegeCode);

					if($stmt->execute())
					{
						return 1;
					}
					else
						return 0;

			}

		}

		public function isAdminExist($Email)
		{
			$stmt = $this->con->prepare('select * from Admin where email = ?;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;


		}
 }

