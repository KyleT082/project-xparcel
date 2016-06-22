<?php

	include "connection.php";

	session_start();

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){

		if(isset($_POST['method']) && ($_POST['method']) == "test"){

			//intialate database connection
			$DBH = connect();
			
			//add loginddetails
			DBloginJect($DBH);
			//add user details
			DBProfileJect($DBH);
			//add address's
			DBPrimAddJect($DBH);

			DBSecAddJect($DBH);

			//echo "Account creatation successfully";

		}
		else if(isset($_POST['method']) && ($_POST['method']) == "test1"){

			//intialate database connection
			$DBH = connect();

			//add user details
			DBProfileJect($DBH);
			//add address's
			DBPrimAddJect($DBH);

			DBSecAddJect($DBH);

			//echo "Account creatation successfully";
		}
	}

	//Inject Login details to Directlogin database.
	function DBloginJect($DBH){

		$userID = null;
		$email  = ($_POST['email']);
		$pwd  	= md5($_POST['pwd']);

		$sql = "INSERT INTO `directlogin` (`UserID`,`Email`,`Password`) VALUES (?,?,?);";

		$sth = $DBH->prepare($sql);

		$sth->bindParam(1, $userID, PDO::PARAM_INT);
		$sth->bindParam(2, $email, PDO::PARAM_INT);
		$sth->bindParam(3, $pwd, PDO::PARAM_INT);

		$sth->execute();
		
		$userID = $DBH->lastInsertId();

		//used for identifying user through out session
		$_SESSION['$userID'] = $userID;
		$_SESSION['$email'] = $email;

	}

	//Inject User profile details to User database.
	function DBProfileJect($DBH){

		$profileID = null;
		$name 	   = ($_POST['firstName']) ." ". ($_POST['lastName']);
		$mobileNum = ($_POST['mobileNum']);
		$DOB 	   = ($_POST['DOB_Yr'])."/".($_POST['DOB_Mon'])."/".($_POST['DOB_Day']);
		//save the users name for when they are recognized.
		$_SESSION['firstName'] = $_POST['firstName'];
		
		$sql = "INSERT INTO `user` (`ProfileID`,`UserID`,`UserName`,`mobileNum`,`Email`,`DOB`) VALUES (?,?,?,?,?,?);";

		$sth = $DBH->prepare($sql);

		$sth->bindParam(1, $profileID, PDO::PARAM_INT);
		$sth->bindParam(2, $_SESSION['$userID'], PDO::PARAM_INT);
		$sth->bindParam(3, $name, PDO::PARAM_INT);
		$sth->bindParam(4, $mobileNum, PDO::PARAM_INT);
		$sth->bindParam(5, $_SESSION['$email'], PDO::PARAM_INT);
		$sth->bindParam(6, $DOB, PDO::PARAM_INT);

		$sth->execute();

		$_SESSION['$profileID'] = $DBH->lastInsertId();

		//used for identifying user through out session
		

	}

	//inject Primary Address in to UserAdd database
	function DBPrimAddJect($DBH){

		$AddressID = null;
		//track the address priority
		$priority = 1;

		$prim_Address = ($_POST['prim_Street']) .",". ($_POST['prim_City']) .",". ($_POST['prim_Count']);

		$sql = "INSERT INTO `useradd` (`AddressID`,`ProfileID`,`Priority`,`Address`) VALUES (?,?,?,?);";

		$sth = $DBH->prepare($sql);

		$sth->bindParam(1, $AddressID,PDO::PARAM_INT);
		$sth->bindParam(2, $_SESSION['$profileID'],PDO::PARAM_INT);
		$sth->bindParam(3, $priority,PDO::PARAM_INT);
		$sth->bindParam(4, $prim_Address, PDO::PARAM_INT);

		$sth->execute();

	}

	//inject Secondary Address in to UserAdd database
	function DBSecAddJect($DBH){

		$AddressID = null;
		//track address priority
		$priority = 2;

		$sec_Address = ($_POST['sec_Street']) .",". ($_POST['sec_City']) .",". ($_POST['sec_Count']);

		$sql = "INSERT INTO `useradd` (`AddressID`,`ProfileID`,`Priority`,`Address`) VALUES (?,?,?,?);";

		$sth = $DBH->prepare($sql);

		$sth->bindParam(1, $AddressID,PDO::PARAM_INT);
		$sth->bindParam(2, $_SESSION['$profileID'],PDO::PARAM_INT);
		$sth->bindParam(3, $priority,PDO::PARAM_INT);
		$sth->bindParam(4, $sec_Address, PDO::PARAM_INT);

		$sth->execute();
		
	}

?>