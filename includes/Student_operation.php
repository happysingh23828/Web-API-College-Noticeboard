<?php 

include '../includes/Constants.php';
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
                    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
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
                    
                    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
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
            
                    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                    $query="SELECT * FROM notice_tg where authoremail='$TgEmail';";
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

        public function updateStudent($Email,$type,$data)
        {
            $stmt = null;
            if ($type=="name")
             {
                    $stmt = $this->con->prepare('UPDATE student SET name=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
           
            else if ($type=="email") 
            {
                    
                    $stmt = $this->con->prepare('UPDATE student SET email=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;

            }
            elseif ($type=="mobileno")
            {
                 
                    $stmt = $this->con->prepare('UPDATE student SET mobileno=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    if($stmt->execute())
                      return 1;
                    else
                      return 0; 
                   
            }
            elseif ($type=="gender")
            {
                 
                    $stmt = $this->con->prepare('UPDATE student SET gender=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    if($stmt->execute())
                      return 1;
                    else
                      return 0; 
                   
            }
            else if($type=="dob"){
            
                    $stmt = $this->con->prepare('UPDATE student SET dob=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }

               
        }

        
        public function studentLogin($Email,$Password)
        {
            
            if($this->checkStudentInDB($Email))
            {

                $Password = md5($Password);
                $stmt = $this->con->prepare('select * from student where email = ? AND password = ?;');
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

        public function getStudentDetailsByEmail($Email)
        {
            $stmt = $this->con->prepare('SELECT * from student where email = ?;');
            $stmt->bind_param("s",$Email);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc();
        }

        public function checkStudentInDB($Email) // Function For Checking Admin Person Exist OR not......
        {
                
            $stmt = $this->con->prepare('select * from student where email = ? ;');
            $stmt->bind_param("s",$Email);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;

        }

        public function getYourSentNotices($Email,$Type)
        {
           

                    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                    $query="SELECT * FROM notice_college where authoremail='$Email' AND type='$Type';";
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

        public function getYourDeptNotices($Email)
        {
           
                    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

                    $query="SELECT * FROM notice_dept where authoremail='$Email';";
                
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

        public function deleteDeptNotice($Id)
        {
            
             $stmt = $this->con->prepare("DELETE FROM notice_dept WHERE id=?;");

                 $stmt->bind_param("s",$Id);

                 if($stmt->execute())
                 {
                    
                    return 1;
                 }
                  else
                    return 0;
        }

        public function sendTokenToserver($Email,$Token,$Type)
        {
            $stmt;
            if($Type=="admin")
            {
                    $stmt = $this->con->prepare("UPDATE `admin` SET `token` = ? WHERE `email` = ?;");

            }

             if($Type=="student")
            {
                $stmt = $this->con->prepare("UPDATE `student` SET `token` = ? WHERE `email` = ?;");

            }

             if($Type=="hod")
            {
                $stmt = $this->con->prepare("UPDATE `hod` SET `token` = ? WHERE `email` = ?;");

            }


             if($Type=="other")
            {
                $stmt = $this->con->prepare("UPDATE `person` SET `token` = ? WHERE `email` = ?;");

            }

            
                 $stmt->bind_param("ss",$Token,$Email);

                 if($stmt->execute())
                 {
                    
                    return 1;
                 }
                  else
                    return 0;
        }

    public function updateStudentImage($CollegeCode,$data,$email)
    {
              if(file_put_contents('../Storage/StudentProfiles/Student'.$email.'.png',base64_decode($data))){
                   return 1;
              }    
              else
                 return 0;
    }

		/*All Oprations Realted To Student*/

 }

