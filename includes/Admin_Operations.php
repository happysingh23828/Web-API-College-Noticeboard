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

		function createAdmin($Email,$Password,$Name,$CollegeCode,$MobileNo,$Dob,$Gender,$CollegeName,$CollegeCity,$CollegeState,$CollegeLogo,$AdminPhoto){

			if($this->isAdminExist($Email,$CollegeCode))
			{
				return 2;
			}

			else
			{	
					

					if(file_put_contents('../Storage/AdminProfiles/Admin'.$CollegeCode.'.png',base64_decode($AdminPhoto)))
					{

						if(file_put_contents('../Storage/CollegeIcons/Logo'.$CollegeCode.'.png',base64_decode($CollegeLogo)))
						{
							$Password = md5($Password);
							$AdminPhotoName = 'Admin'.$CollegeCode.'.png';
							$CollegeIconName = 'Logo'.$CollegeCode.'.png';
							$stmt = $this->con->prepare('INSERT INTO `admin` (`email`, `name`, `collegecode`, `password`, `mobileno`, `dob`, `gender`, `profilephoto`, `collegelogo`, `collegename`, `collegecity`, `collegestate`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);');

							$stmt->bind_param("ssssssssssss",$Email,$Name,$CollegeCode,$Password,$MobileNo,$Dob,$Gender,$AdminPhotoName,$CollegeIconName,$CollegeName,$CollegeCity,$CollegeState);

							if($stmt->execute())
							{
								return 1;
							}
							else
								return 0;		

						}else 
							return 0;
					}else 
						return 0;

			}

		}

		public function isAdminExist($Email,$CollegeCode) // Function For Checking Admin Already Exist OR not......
		{
				
			$stmt = $this->con->prepare('select * from admin where email = ? OR collegecode = ? ;');
			$stmt->bind_param("ss",$Email,$CollegeCode);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}

		public function addPerson($Email,$Password,$Name,$CollegeCode,$MobileNo,$Dob,$Gender,$PersonPhoto,$Role,$Dept,$TgFlag,$TgSem)
		{
			
			if($this->isPersonExist($Email))
			{
				return 2;
			}

			else
			{	
					

					if(file_put_contents('../Storage/PersonProfiles/Person'.$Email.'.png',base64_decode($PersonPhoto)))
					{

							$Password = md5($Password);
							$PersonPhotoName = 'Person'.$Email.'.png';
							$stmt = $this->con->prepare('INSERT INTO `person` (`email`, `password`, `name`, `mobileno`, `dob`, `gender`, `collegecode`, `personprofile`, `tgflag`, `tgsem`, `dept`, `role`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);');

							$stmt->bind_param("ssssssssssss",$Email,$Password,$Name,$MobileNo,$Dob,$Gender,$CollegeCode,$PersonPhotoName,$TgFlag,$TgSem,$Dept,$Role);

							if($stmt->execute())
							{
								return 1;
							}
							else
								return 0;		

					}else 
						return 0;

			}


		}

		public function isPersonExist($Email) // Function For Checking Admin Person Exist OR not......
		{
				
			$stmt = $this->con->prepare('select * from person where email = ? ;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}

		public function adminLogin($Email,$Password)
		{
			
			if($this->checkAdminInDB($Email))
			{

				$Password = md5($Password);
				$stmt = $this->con->prepare('select * from admin where email = ? AND password = ?;');
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

		public function getAdminDetailsByEmail($Email)
		{
			$stmt = $this->con->prepare('SELECT * from admin where email = ?;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();

			return $stmt->get_result()->fetch_assoc();
		}

		public function checkAdminInDB($Email) // Function For Checking Admin Person Exist OR not......
		{
				
			$stmt = $this->con->prepare('select * from admin where email = ? ;');
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}

		public function updateAdmin($Email,$CollegeCode,$type,$data)
		{
			
			if($type=="CollegeLogo")
			{

				if(file_put_contents('../Storage/CollegeIcons/Logo'.$CollegeCode.'.png',base64_decode($data)))
				{
					$CollegeLogoName = 'Logo'.$CollegeCode.'.png';
					$stmt = $this->con->prepare('UPDATE admin SET collegelogo=?  WHERE email=? AND collegecode=?;');
					$stmt->bind_param("sss",$CollegeLogoName,$Email,$CollegeCode);
				}

			}
			else if ($type=="Email")
			 {
					$stmt = $this->con->prepare('UPDATE admin SET email=?  WHERE email=? AND collegecode=?;');
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
					$CollegePhotoName = 'Admin'.$CollegeCode.'.png';
					$stmt = $this->con->prepare('UPDATE admin SET profilephoto=?  WHERE email=? AND collegecode=?;');
					$stmt->bind_param("sss",$CollegePhotoName,$Email,$CollegeCode);
				}
			}

			if($stmt->execute())
			{
				return 1;
			}
			else
				return 0;	
		}


		public function deleteAdmin($CollegeCode)
		{
			$stmt = array();
			$stmt[0] = $this->con->prepare("DELETE FROM admin WHERE collegecode=?;");
			$stmt[1] = $this->con->prepare("DELETE FROM person WHERE collegecode=?;");
			$stmt[2] = $this->con->prepare("DELETE FROM student WHERE collegecode=?;");
			$stmt[3]= $this->con->prepare("DELETE FROM content WHERE collegecode=?;");
			$stmt[4]= $this->con->prepare("DELETE FROM notice_college WHERE collegecode=?;");
			$stmt[5]= $this->con->prepare("DELETE FROM notice_dept WHERE collegecode=?;");
			$stmt[6]= $this->con->prepare("DELETE FROM notice_tg WHERE collegecode=?;");
			$stmt[7]= $this->con->prepare("DELETE FROM college_time_table WHERE collegecode=?;");
			$stmt[8]= $this->con->prepare("DELETE FROM academic_calender WHERE collegecode=?;");

			for ($i=0; $i <9 ; $i++) { 

				$stmt[$i]->bind_param("s",$CollegeCode);

			}

			for ($i=0; $i <9 ; $i++) { 

				$stmt[$i]->execute();

			}

		}

		public function deletePerson($Email)
		{
			if($this->isPersonExist($Email))
			{
				$stmt = $this->con->prepare("DELETE FROM person WHERE email=?;");
            	$stmt->bind_param("s",$Email);

				   	if($stmt->execute())
					{
						return 1;
					}
					else
						return 0;
			}

			else 
			{
				return 2;
			}
		}








		
		

		
 }

