<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../includes/Constants.php';

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
			if($this->checkStudentInDB($email))
            {
			
					$pass = md5($password);
					$stmt = $this->con->prepare('select * from person where email = ? AND password = ?;');
				    
					$stmt->bind_param("ss",$email,$pass);
					$stmt->execute();
					$stmt->store_result();
					return $stmt->num_rows > 0; 
			}
			else{
				return 2;
			}

		}

		public function checkStudentInDB($Email) // Function For Checking Admin Person Exist OR not......
        {
                
            $stmt = $this->con->prepare('select * from person where email = ? ;');
            $stmt->bind_param("s",$Email);
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

        public function createStudent($Email,$Password,$Name,$CollegeCode,$MobileNo,$Dob,$Gender,$Dept,$Sem,$TgEmail,$Enrollment,$StudentPhoto)
        {
        	if($this->isStudentExist($Email,$CollegeCode))
			{
				return 2;
			}

			else
			{	
					

					if(file_put_contents('../Storage/StudentProfiles/Student'.$Email.'.png',base64_decode($StudentPhoto)))
					{

							$Password = md5($Password);
							$StudentPhotoName = 'Student'.$Email.'.png';
							$stmt = $this->con->prepare('INSERT INTO `student` (`email`, `name`, `collegecode`, `password`, `mobileno`, `dob`, `gender`, `studentprofile`, `dept`, `sem`, `tgemail`, `enrollment`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);');


							$stmt->bind_param("ssssssssssss",$Email,$Name,$CollegeCode,$Password,$MobileNo,$Dob,$Gender,$StudentPhotoName,$Dept,$Sem,$TgEmail,$Enrollment);

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

        public function isStudentExist($Email,$CollegeCode) // Function For Checking Admin Already Exist OR not......
		{
				
			$stmt = $this->con->prepare('select * from student where email = ? AND collegecode = ? ;');
			$stmt->bind_param("ss",$Email,$CollegeCode);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}


        public function createNoticeCollege($CollegCode,$AuthorName,$AutherEmail,$Time,$Title,$Type,$String,$Image,$Authortype){

	       if(file_put_contents('../Storage/CollegeNotice/Title'.$Title.'.png',base64_decode($Image))){

	       	 $NoticeImage = 'Title'.$Title.'.png';
	         $stmt = $this->con->prepare('INSERT INTO `notice_college`(`collegecode`, `authoremail`,`authorname`, `time`, `title`, `type`, `String`, `Image`,`authortype`) VALUES (?,?,?,?,?,?,?,?,?);');



	         $stmt->bind_param("sssssssss",$CollegCode,$AutherEmail,$AuthorName,$Time,$Title,$Type,$String,$NoticeImage,$Authortype);

	         if($stmt->execute())
			 {
			    return 1;
			 }
			  else
				return 0;
	     }
        }

        public function createNoticeDept($CollegCode,$AutherEmail,$Title,$Dept,$Time,$String,$Image,$AuthorName,$Authortype){

        	
         if(file_put_contents('../Storage/DeptNotice/Title'.$Title.'.png',base64_decode($Image))){

         		  $Image = 'Title'.$Title.'.png';	
		          $stmt = $this->con->prepare('INSERT INTO `notice_dept`(`collegecode`, `authoremail`, `time`, `title`, `dept`, `string`, `image`,`authorname`,`authortype`) VALUES  (?,?,?,?,?,?,?,?,?);');



		         $stmt->bind_param("sssssssss",$CollegCode,$AutherEmail,$Time,$Title,$Dept,$String,$Image,$AuthorName,$Authortype);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
		    }    
        }


        public function createNoticeTg($CollegCode,$AutherEmail,$Time,$Title,$Dept,$sem,$String,$Image,$AuthorName,$Authortype){
         if(file_put_contents('../Storage/TgNotice/Title'.$Title.'.png',base64_decode($Image))){

         		$NoticeImage = 'Title'.$Title.'.png';
		         $stmt = $this->con->prepare('INSERT INTO `notice_tg`(`collegecode`, `authoremail`, `time`, `title`, `dept`, `sem`, `image`, `string`,`authorname`,`authortype`) VALUES (?,?,?,?,?,?,?,?,?,?);');



		         $stmt->bind_param("ssssssssss",$CollegCode,$AutherEmail,$Time,$Title,$Dept,$sem,$NoticeImage,$String,$AuthorName,$Authortype);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          }     
        }


        public function UpdateCollegeNotice($id,$CollegCode,$AutherEmail,$Time,$Title,$Type,$String,$Image){
         if(file_put_contents('../Storage/TgNotice/Title'.$Title.'.png',base64_decode($Image))){

                 $stmt = $this->con->prepare("UPDATE notice_college SET id=?,collegecode=?,authoremail=?,time=?,title=?,type=?,String=?,Image=? WHERE id=?;");
                
		         $stmt->bind_param("sssssssss",$id,$CollegCode,$AutherEmail,$Time,$Title,$Type,$String,$Image,$id);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          }  
        }

         public function UpdateDeptNotice($id,$CollegCode,$AutherEmail,$Time,$Title,$Dept,$String,$Image){
         if(file_put_contents('../Storage/TgNotice/Title'.$Title.'.png',base64_decode($Image))){

                 $stmt = $this->con->prepare("UPDATE notice_dept SET id=?,collegecode=?,authoremail=?,time=?,title=?,dept=?,string=?,image=? WHERE id=?;");
                
		         $stmt->bind_param("sssssssss",$id,$CollegCode,$AutherEmail,$Time,$Title,$Dept,$String,$Image,$id);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          }  
        }

        public function UpdateTgNotice($id,$CollegCode,$AutherEmail,$Time,$Title,$Dept,$Sem,$String,$Image){
         if(file_put_contents('../Storage/TgNotice/Title'.$Title.'.png',base64_decode($Image))){

                 $stmt = $this->con->prepare("UPDATE notice_tg SET id=?,collegecode=?,authoremail=?,time=?,title=?,dept=?,sem=?,string=?,image=? WHERE id=?;");
                
		         $stmt->bind_param("ssssssssss",$id,$CollegCode,$AutherEmail,$Time,$Title,$Dept,$Sem,$String,$Image,$id);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          }  
        }
        
        public function DeleteCollegeNotice($Id){

                 $stmt = $this->con->prepare("DELETE FROM notice_college WHERE contentid=?;");
                
		         $stmt->bind_param("s",$Id);

		         $result = $stmt->execute();

		         if($result)
				 {
				 	
				    return 1;
				 }
				  else
					return 0;
          
        }

        public function DeleteDeptNotice($Id){

                 $stmt = $this->con->prepare("DELETE FROM notice_dept WHERE id=?;");
                
		         $stmt->bind_param("s",$Id);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          
        }

         public function DeleteTgNotice($Id){

                 $stmt = $this->con->prepare("DELETE FROM notice_tg WHERE id=?;");
                
		         $stmt->bind_param("s",$Id);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
          
        }

        public function deleteStudent($Email)
        {
        		
        	$stmt = $this->con->prepare("DELETE FROM student WHERE email=?");
                
		         $stmt->bind_param("s",$Email);

		         if($stmt->execute())
				 {
				 	unlink('../Storage/StudentProfiles/Student'.$Email.'.png');
			
				    return 1;
				 }
				  else
					return 0;
        }

        public function getStudentList($TgEmail)
        {
        			$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                    $query="SELECT * FROM student WHERE tgemail='$TgEmail'";
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

        public function getTgStudent($Email)
        {
        	  	$stmt = $this->con->prepare("SELECT token FROM student WHERE tgemail = ?");
		        $stmt->bind_param("s",$Email);
		        $stmt->execute(); 
		        $result = $stmt->get_result()->fetch_assoc();
		        return array($result['token']);   	
        }

          public function getAllDeptTokens($CollegeCode,$Dept)
        {

        		$stmt = $this->con->prepare("SELECT token FROM student WHERE collegecode = ? AND dept = ? UNION SELECT token FROM person WHERE collegecode = ? AND dept = ? UNION SELECT token FROM hod WHERE collegecode = ? AND dept = ?");

		        $stmt->bind_param("ssssss",$CollegeCode,$Dept,$CollegeCode,$Dept,$CollegeCode,$Dept);
		        $stmt->execute(); 
		        $result = $stmt->get_result();
		        return $result; 
        	  	 	
        }

         public function getAllTokens($CollegeCode)
			{
				$stmt = $this->con->prepare("SELECT token FROM student WHERE collegecode = ?
					UNION SELECT token FROM person WHERE collegecode = ? UNION SELECT token FROM hod WHERE collegecode = ? UNION SELECT token FROM admin WHERE collegecode = ?");
		        $stmt->bind_param("ssss",$CollegeCode,$CollegeCode,$CollegeCode,$CollegeCode);
		        $stmt->execute(); 
		        $result = $stmt->get_result();
		        return $result; 



			}

		public function getAllTgTokens($CollegeCode,$Email)
			{
					$stmt = $this->con->prepare("SELECT token FROM student WHERE collegecode = ? AND tgemail = ? ");

		        $stmt->bind_param("ss",$CollegeCode,$Email);
		        $stmt->execute(); 
		        $result = $stmt->get_result();
		        return $result; 
        	  	 						
			}	

	

         public function updateFaculty($Email,$type,$data)
        {
             if ($type=="name")
             {
                    $stmt = $this->con->prepare('UPDATE person SET name=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
            
            else if ($type=="email") 
            {
                   
                   
		           $stmt = $this->con->prepare('UPDATE person SET email=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      {
                      	$stmt1 = $this->con->prepare('UPDATE student SET tgemail=?  WHERE tgemail=?;');
                        $stmt1->bind_param("ss",$data,$Email);
                        $stmt1->execute();

                        $stmt2 = $this->con->prepare('UPDATE notice_dept SET authoremail=?  WHERE authoremail=?;');
                        $stmt2->bind_param("ss",$data,$Email);
                        $stmt2->execute();
                         
                        $stmt3 = $this->con->prepare('UPDATE notice_tg SET authoremail=?  WHERE authoremail=?;');
                        $stmt3->bind_param("ss",$data,$Email);
                        $stmt3->execute();
                         return 1;

                      }
                    else
                      return 0;        

                    

            }
            elseif ($type=="mobileno")
            {
                 
                    $stmt = $this->con->prepare('UPDATE person SET mobileno=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    if($stmt->execute())
                      return 1;
                    else
                      return 0; 
                   
            }
            elseif ($type=="gender")
            {
                 
                    $stmt = $this->con->prepare('UPDATE person SET gender=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    if($stmt->execute())
                      return 1;
                    else
                      return 0; 
                   
            }
            else if($type=="dob"){
            
                    $stmt = $this->con->prepare('UPDATE person SET dob=?  WHERE email=?;');
                    $stmt->bind_param("ss",$data,$Email);
                    
                    if($stmt->execute())
                      return 1;
                    else
                      return 0;
            }
        }


       public function updateFacultyImage($CollegeCode,$data,$email)
		{
              if(file_put_contents('../Storage/PersonProfiles/Person'.$email.'.png',base64_decode($data))){
                   return 1;
              }    
              else
              	 return 0;
		}


		/*All Oprations Realted To Faculty*/


}

