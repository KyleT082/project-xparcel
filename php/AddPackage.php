<?php
	if(session_id()){
	}
	else{
		session_start();
		include "connection.php";
	}
	//if a post has occured
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
		//if the post method is testing the tracking number
		if(isset($_POST['method']) && ($_POST['method'])=="testTrackNum"){
			$trackingNum = $_POST['trackingNum'];

			//returns true or false
			$Exsists = validateTrackNum();			
			//send info for client to validate and /or add to user DB
			if($Exsists){
				setPackageDetails();
			}
			else{
				echo False;
			}
		}
	}

	//get the details related to the tracking number
	function getPackageDetails(){

		include_once "connectionMock.php";
		//connect to mock database
		$DBH = connectMock();

		$trackingNum = $_POST['trackingNum'];

		$sql = $DBH->prepare("SELECT * FROM `packagerecords` WHERE `trackingNum` = :trackingnum LIMIT 1;");

		$sql->bindValue(':trackingnum',$trackingNum);
		$sql->execute();

		return $sql;
	}

	//checks if the trtacking number exsistes in the mock database
	function validateTrackNum(){

		//returns details related to the tracking number
		$sql = getPackageDetails();

		$r = $sql->fetchAll(PDO::FETCH_NUM);

		//if the tracking number exsists return...
		if(!empty($r)){
			return True;
		}
		else{
			return False;
		}
	}
	//link the package details to the users account
	function setPackageDetails(){

		$sql = getPackageDetails();

		//get the details of the package from MockDB
		$detail = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($detail as $result){
			$add = $result['address'];
			$date = $result['deliverydate'];
		}
		$packageID = null;
		//MUST CHANGE, NEED TO ADD STATUS TO MOCK DB !!!
		$status = "no";
		$trackingNum = $_POST['trackingNum'];

		//adds the verified details to the users account
		$DBH = connect();

		//insert details into PACKAGES Relation 
		$sql = ("INSERT INTO `packages` (`PackageID`,`UserProfileID`,`deliverydate`,`Status`,`TrackingNum`) VALUES (?,?,?,?,?);");
		$sth = $DBH->prepare($sql);
		$sth->bindParam(1,$packageID,PDO::PARAM_INT);
		$sth->bindParam(2,$_SESSION['$profileID'],PDO::PARAM_INT);
		$sth->bindParam(3,$date,PDO::PARAM_INT);
		$sth->bindParam(4,$status,PDO::PARAM_INT);
		$sth->bindParam(5,$trackingNum,PDO::PARAM_INT);

		$sth->execute();

		$PackageID = $DBH->lastInsertId();
		
		//insert the packages registered delivery destination
		$sql2 = ("INSERT INTO `pdestination` (`PackageID`,`Address`) VALUES (?,?);");
		$sth2= $DBH->prepare($sql2);
		$sth2->bindParam(1,$PackageID,PDO::PARAM_INT);
		$sth2->bindParam(2,$add,PDO::PARAM_INT);

		$sth2->execute();

		//returns to js/jsbtnFunction.js to add to table of contents
		echo "Success";


	}
?>