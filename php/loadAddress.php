<?php
	if(session_id()){

	}else{
		session_start();
	}

	include "connection.php";

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
		if(isset($_POST['method'])&&($_POST['method'])=='loadPrim'){
			loadPrimAdd();
		}
		else if(isset($_POST['method'])&&($_POST['method'])=='loadSecond'){
			loadSecAdd();
		}
	}

	function loadPrimAdd(){

		$DBH= connect();

		$sql =$DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 1;");
		$sql->bindValue(':profileID',$_SESSION['$profileID']);
		$sql->execute();

		$req = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($req as $result){
			$proAdd = $result['Address'];
		}
		echo $proAdd;	
	}

	function loadSecAdd(){

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `Address` FROM `useradd` WHERE `ProfileID` = :profileID AND `Priority` = 2;");
		$sql->bindValue(':profileID',$_SESSION['$profileID']);
		$sql->execute();

		$req = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($req as $result){
			$proAdd = $result['Address'];
		}
		echo $proAdd;
	}
?>