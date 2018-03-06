<?php 

include '../includes/Constants.php';

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

		public function getFacultiesList($CollegeCode,$Dept)
		{

					$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            
				if($Dept=="admin")
				{
					$query="SELECT * FROM person WHERE collegecode='$CollegeCode'";
                    
				}
				else
				{
					$query="SELECT * FROM person WHERE collegecode='$CollegeCode' AND dept='$Dept'";
                    
				}

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


		public function updateHod($Email,$type,$data)
        {
        	$stmt = null;
            if ($type=="name")
             {
                    $stmt = $this->con->prepare('UPDATE hod SET name=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
            else if($type=="gender"){
            
                    $stmt = $this->con->prepare('UPDATE hod SET gender=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
            else if($type=="mobileno"){
            
                    $stmt = $this->con->prepare('UPDATE hod SET mobileno=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
            else if($type=="dob"){
            
                    $stmt = $this->con->prepare('UPDATE hod SET dob=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
            else if ($type=="email") 
            {
                   
                   
		           $stmt = $this->con->prepare('UPDATE hod SET email=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      {
                      	
                        $stmt2 = $this->con->prepare('UPDATE notice_dept SET authoremail=?  WHERE authoremail=?;');
                        $stmt2->bind_param("ss",$data,$Email);
                        $stmt2->execute();
                         
                         return 1;

                      }
                    else
                      return 0;        

                    

            }
           
        }

    public function updateHodImage($CollegeCode,$data,$email)
    {
              if(file_put_contents('../Storage/HodProfiles/Hod'.$email.'.png',base64_decode($data))){
                   return 1;
              }    
              else
                 return 0;
    }
		

	}
?>