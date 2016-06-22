<?php

	if(session_id()){
	}
	else{
		session_start();
	}
	include "connection.php";

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
		if(isset($_POST['method']) && ($_POST['method']) == "Delete"){

			$trackingNum = $_POST['selTrackNum'];

			$DBH =connect();

			$sql = "DELETE FROM `Packages` WHERE TrackingNum = :trackingNum;";
			$query =$DBH->prepare($sql);

			$query->bindValue(':trackingNum',$trackingNum);
			$query->execute();

		}
	}
?>