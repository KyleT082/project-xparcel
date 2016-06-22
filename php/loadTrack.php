<?php
/* This calss is responsible for loading any 
active tracking packages available
*/
	if(session_id()){

	}
	else{
		session_start();
		
	}

	//looks for all active tracking packages user has
	function findTrackNum(){

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `TrackingNum` FROM `packages` WHERE `Status` = 'yes' AND `UserProfileID` = :profileID ;");
		$sql->bindValue(':profileID',$_SESSION['$profileID']);
		$sql->execute();

		$req= $sql->fetchAll(PDO::FETCH_ASSOC);
		$x=1;
		foreach($req as $r){
			
			echo "<option value=".$x.">".$r['TrackingNum']."</option>"; 
		}
	}
?>