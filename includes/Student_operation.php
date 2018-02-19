<?php 
 class StudentOperation{

    
     private $con;

		function __construct()
		{
			require_once dirname(__FILE__).'/Db_connect.php';

			$db = new Db_connect();

			$this->con = $db->connect();
		}



		/*All Oprations Realted To Student*/

 }

