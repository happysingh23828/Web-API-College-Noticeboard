<?php 
 class StudentOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}

        public function GetCollegeNotice($CollegeCode,$Type)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_college WHERE collegecode=? AND type=?");
                 $stmt->bind_param("ss",$CollegeCode,$type);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;
                 
        } 

        public function GetDeptNotice($CollegeCode,$Dept)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_dept WHERE collegecode=? AND dept=?");
                 $stmt->bind_param("ss",$CollegeCode,$Dept);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;

        } 

        public function GetTgNotice($TgEmail)
        {
            
                 $stmt = $this->con->prepare("SELECT * FROM notice_tg WHERE tgemail=?");
                 $stmt->bind_param("s",$TgEmail);
			     $stmt->execute();
                 if($stmt->num_rows > 0)
			        return $stmt->get_result()->fetch_assoc();
                 else
                 	return null;

        } 

        public function updateStudent($Email,$CollegeCode,$type,$data)
        {
            if ($type=="Email")
             {
                    $stmt = $this->con->prepare('UPDATE student SET email=?  WHERE email=? AND collegecode=?;');
                    $stmt->bind_param("sss",$data,$Email,$CollegeCode);

            }
            else if ($type=="Password") 
            {
                    $data= md5($data);
                    $stmt = $this->con->prepare('UPDATE admin SET password=?  WHERE email=? AND collegecode=?;');
                    $stmt->bind_param("sss",$data,$Email,$CollegeCode);

            }
            elseif ($type=="ProfilePhoto")
            {
                if(file_put_contents('../Storage/AdminProfiles/Admin'.$CollegeCode.'.png',base64_decode($data)))
                {
                    $ProfilePhoto = 'Admin'.$CollegeCode.'.png';
                    $stmt = $this->con->prepare('UPDATE admin SET studentprofile=?  WHERE email=? AND collegecode=?;');
                    $stmt->bind_param("sss",$ProfilePhoto,$Email,$CollegeCode);
                }
            }

            if($stmt->execute())
            {
                return 1;
            }
            else
                return 0;   
        }

		/*All Oprations Realted To Student*/

 }

