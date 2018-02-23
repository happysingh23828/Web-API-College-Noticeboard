<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
			$pass = md5($password);
			$stmt = $this->con->prepare('SELECT email from person where email = ? AND password = ?;');
			$stmt->bind_param("ss",$email,$password);
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


							$stmt->bind_param("sssssssssss",$Email,$Name,$CollegeCode,$Password,$MobileNo,$Dob,$Gender,$StudentPhotoName,$Dept,$Sem,$TgEmail);

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
				
			$stmt = $this->con->prepare('select * from student where email = ? OR collegecode = ? ;');
			$stmt->bind_param("ss",$Email,$CollegeCode);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}


        public function createNoticeCollege($CollegCode,$AutherEmail,$Time,$Title,$Type,$String,$Image){

	       if(file_put_contents('../Storage/CollegeNotice/Title'.$Title.'.png',base64_decode($Image))){

	       	 $NoticeImage = 'Title'.$Title.'.png';
	         $stmt = $this->con->prepare('INSERT INTO `notice_college`(`collegecode`, `authoremail`, `time`, `title`, `type`, `String`, `Image`) VALUES (?,?,?,?,?,?,?);');



	         $stmt->bind_param("sssssss",$CollegCode,$AutherEmail,$Time,$Title,$Type,$String,$NoticeImage);

	         if($stmt->execute())
			 {
			    return 1;
			 }
			  else
				return 0;
	     }
        }

        public function createNoticeDept($CollegCode,$AutherEmail,$Time,$Title,$Dept,$String,$Image){
         if(file_put_contents('../Storage/DeptNotice/Title'.$Title.'.png',base64_decode($Image))){

		          $stmt = $this->con->prepare('INSERT INTO `notice_dept`(`collegecode`, `authoremail`, `time`, `title`, `dept`, `string`, `image`) VALUES  (?,?,?,?,?,?,?);');



		         $stmt->bind_param("sssssss",$CollegCode,$AutherEmail,$Time,$Title,$Dept,$String,$Image);

		         if($stmt->execute())
				 {
				    return 1;
				 }
				  else
					return 0;
		    }    
        }


        public function createNoticeTg($CollegCode,$AutherEmail,$Time,$Title,$Dept,$sem,$String,$Image){
         if(file_put_contents('../Storage/TgNotice/Title'.$Title.'.png',base64_decode($Image))){

		         $stmt = $this->con->prepare('INSERT INTO `notice_tg`(`collegecode`, `authoremail`, `time`, `title`, `dept`, `sem`, `Image`, `String`) VALUES (?,?,?,?,?,?,?,?);');



		         $stmt->bind_param("ssssssss",$CollegCode,$AutherEmail,$Time,$Title,$Dept,$sem,$String,$Image);

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

                 $stmt = $this->con->prepare("DELETE FROM notice_college WHERE id=?;");
                
		         $stmt->bind_param("s",$Id);

		         if($stmt->execute())
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

        public function deleteStudent($Email,$CollegeCode)
        {
        		
        	$stmt = $this->con->prepare("DELETE FROM student WHERE email=? AND collegecode=?;");
                
		         $stmt->bind_param("ss",$Email,$CollegeCode);

		         if($stmt->execute())
				 {
				 	unlink('../Storage/StudentProfiles/Student'.$Email.'.png');
			
				    return 1;
				 }
				  else
					return 0;
        }

		/*All Oprations Realted To Faculty*/


}

