<?php
/*file is responsible for retrieving the longatide and latitude of the
currently selected package*/

	include "connectionMock.php";
	if(session_id()){

	}else{
		session_start();
	}

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
		if(isset($_POST['method'])&&($_POST['method'])=='locatePack'){

			fetchCo_Ords();
		}
	}
	//fetches the selected packages cordinates from the Mock Database
	function fetchCo_Ords(){

		$DBH = connectMock();

		$sql = $DBH->prepare("SELECT `latitude`,`longitude` FROM `packagerecords` WHERE `trackingNum` = :trackingNum;");

		$sql->bindValue(':trackingNum',$_POST['trackNum']);
		$sql->execute();

		$gfh = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($gfh as $result){
			$lat = $result['latitude'];
			$long = $result['longitude'];
		}

		echo $lat."/".$long;
	}
?>