<?php

if(session_id()){

}else{
	session_start();
}

	include "connection.php";
	include "connectionMock.php";

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
		if(isset($_POST['method'])&&($_POST['method'])=='update'){
			updateUserPro();
		}
	}
	//update details on the users DB and interface
	function updateUserPro(){ 

		$DBH = connect();
		$trackNum = $_POST['trackingNum'];
		//get the package id
		$sql=$DBH->prepare("SELECT `PackageID` FROM `packages` WHERE `TrackingNum` = :trackNum LIMIT 1;");
		$sql->bindValue(':trackNum',$trackNum,PDO::PARAM_STR);
		$sql->execute();
		$packID = $sql->fetchAll();
		foreach($packID as $r){
			$packageID = $r['PackageID'];
		}

		$date = strtotime($_POST['delivDate']);
		$formatDate= date('Y-m-d',$date);

		//updating the delivery date and the packageName
		$sql1 = $DBH->prepare("UPDATE `packages` SET `packageName` = :packName, `DeliveryDate` = :deliveryDate WHERE `TrackingNum` = :trackNum;");

		$sql1->bindValue(':packName',$_POST['packName'],PDO::PARAM_STR);
		$sql1->bindValue(':deliveryDate',$formatDate,PDO::PARAM_STR);
		$sql1->bindValue(':trackNum',$trackNum ,PDO::PARAM_STR);
		$sql1->execute();

		//update the delivery address
		$sql2=$DBH->prepare("UPDATE `pdestination` SET `Address`= :address WHERE `PackageID` = :packid");
		$sql2->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
		$sql2->bindValue(':packid',$packageID,PDO::PARAM_INT);
		$sql2->execute();
		
		echo $_POST['packName']."/".$formatDate."/".$trackNum."/".$_POST['address'];
	}

	//update details for the company interface
	function updateMockDB(){
		$DBH = connectMock();
	}
?>