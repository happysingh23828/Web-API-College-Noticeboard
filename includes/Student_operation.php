<?php 
 class StudentOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}

        public function GetCollegeNotice($Id)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_college WHERE id=?");
                 $stmt->bind_param("s",$Id);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;
                 
        } 

        public function GetDeptNotice($Id)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_dept WHERE id=?");
                 $stmt->bind_param("s",$Id);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;

        } 

        public function GetTgNotice($Id)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_tg WHERE id=?");
                 $stmt->bind_param("s",$Id);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;

        } 

		/*All Oprations Realted To Student*/

 }

