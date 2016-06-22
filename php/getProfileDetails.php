<?php
	if(session_id()){
	}
	else{
		session_start();
	}
	include "connection.php";

	

	

	function appendTable(){
		$name;
		$contact;
		$email;
		$Add1;
		$Add2;
		

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `Username`, `mobileNum`,`Email` FROM `user` WHERE `ProfileID` = :profileID;");

		$sql->bindValue(':profileID',$_SESSION['$profileID']);

		$sql->execute();

		$result = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $r){
			$name = $r['Username'];
			$contact = $r['mobileNum'];
			$email = $r['Email'];
		}

		//get primary address
		$sql1 = $DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 1");
		//get secondary address
		$sql2 = $DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 2");

		$sql1->bindValue(':profileID',$_SESSION['$profileID']);
		$sql1->execute();
		$sql2->bindValue(':profileID',$_SESSION['$profileID']);
		$sql2->execute();

		$res = $sql1->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $rr){
			$Add1 = $rr['Address'];
		}

		$res2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
		foreach($res2 as $q){
			$Add2 = $q['Address'];	
		}

		echo "
			<table class='table'>
                    <tr class='info'>
                      <td><Strong>Name :</Strong></td>
                      <td>".$name."</td>
                    </tr>
                    <tr class='info'>
                       <td><strong>Contact :</strong></td>
                       <td>". $contact."</td>
                    </tr>
                    <tr class='info'>
                      <td><strong>Email :</strong></td>
                      <td>".$email."</td>
                    </tr>
                    <tr class='info'>
                       <td><strong>Primary Address :</strong></td>
                       <td>".$Add1."</td>
                    </tr>
                    <tr class='info'>
                       <td><strong>Secondary Address :</strong></td>
                       <td>".$Add2."</td>
                    </tr>
                  </table>
		";

	}
	
	//get the users names + details
	function getUser(){

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `Username`, `mobileNum`,`Email` FROM `user` WHERE `ProfileID` = :profileID;");

		$sql->bindValue(':profileID',$_SESSION['$profileID']);

		$sql->execute();

		$result = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $r){
			$name = $r['Username'];
			$contact = $r['mobileNum'];
			$email = $r['Email'];
		}
	}

	function getAddresses(){

		$DBH = connect();

		//get primary address
		$sql1 = $DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 1");
		//get secondary address
		$sql2 = $DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 2");

		$sql1->bindValue(':profileID',$_SESSION['$profileID']);
		$sql1->execute();
		$sql2->bindValue(':profileID',$_SESSION['$profileID']);
		$sql2->execute();

		$res = $sql1->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $r){
			$Add1 = $r['Address'];
		}

		$res2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
		foreach($res2 as $q){
			$Add2 = $q['Address'];	
		}
	}
?>
