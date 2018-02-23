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
                    $connection=mysqli_connect('localhost','root','','college_noticeboard');
                    $query="SELECT * FROM notice_college WHERE collegecode='$CollegeCode' AND type='$Type'";
                    $result=mysqli_query($connection,$query);
                    
                    
                   if (mysqli_num_rows($result)==0) 
                    {
                        mysqli_close($connection);
                        return 2; 
                    }             
                    else
                    {
                        return $result;
                    }
                 
        } 

        public function GetDeptNotice($CollegeCode,$Dept)
        {
                    
                    $connection=mysqli_connect('localhost','root','','college_noticeboard');
                    $query="SELECT * FROM notice_dept WHERE collegecode='$CollegeCode' AND dept='$Dept'";
                    $result=mysqli_query($connection,$query);
                    
                    
                    if (mysqli_num_rows($result)==0) 
                    {
                        mysqli_close($connection);
                        return 2; 
                    }             
                    else
                    {
                        return $result;
                    }

        } 

        public function GetTgNotice($TgEmail)
        {
            
                    $connection=mysqli_connect('localhost','root','','college_noticeboard');
                    $query="SELECT * FROM notice_tg WHERE authoremail='$TgEmail';";
                    $result=mysqli_query($connection,$query);
                    
                    if (mysqli_num_rows($result)==0) 
                    {
                        mysqli_close($connection);
                        return 2; 
                    }             
                    else
                    {
                        return $result;
                    }

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

