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

		
		

		
 }

