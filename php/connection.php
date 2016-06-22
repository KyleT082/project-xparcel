<?php
/* function is used to connect to the users database*/

	function connect(){
		try {
				# MySQL with PDO_MYSQL                                           
				$DBH = new PDO("mysql:host=127.0.0.1;dbname=xparceldb", 'root', '');	
			} 
			catch(PDOException $e) {
				die("ERROR : " .$e->getMessage());
			}
		//returns the PDO connection to be used in other functions
		return $DBH;
	}
?>