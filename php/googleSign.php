<?php

	//*********************************defining*************************************
	include "connection.php";
	//this stores the google client credentails and the vender path location for updates
	require_once __DIR__.'/gplus_lib/vendor/autoload.php';
	const CLIENT_ID = '782605975680-81lcv2pm6voi6hk7andb7fig4ksqmi5h.apps.googleusercontent.com';
	const CLIENT_SECRET = '5Z18fd3FHTP4GB83Kz_nUF37';
	const REDIRECT_URI = 'http://localhost/xparcel/php/googleSign.php';

	//FUTURE keep me logged in
	if(session_id()){
	}
	else{
		session_start();
	}
	//****************************Initialization******************************
	//Application client details and authenication
	$client = new Google_Client();

	//
	$client->setClientId(CLIENT_ID);
	$client->setClientSecret(CLIENT_SECRET);
	$client->setRedirectUri(REDIRECT_URI);
	$client->setScopes('email');

	$plus = new Google_Service_Plus($client);


//*********************Actual process**********************************

	//checking  for logout action
	if(isset($_REQUEST['logout'])){
		session_unset();
	}
	//check for google URL written from the Google server
	else if(isset($_GET['code'])){
		$client->authenticate($_GET['code']);
		//get the access token
		$_SESSION['access_token'] = $client->getAccessToken();

		$redirect = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		header('location:'.filter_var($redirect,FILTER_SANITIZE_URL));

	}

	if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
		$client->setAccessToken($_SESSION['access_token']);
		$me = $plus->people->get('me');

	    //stores all the available variables provided by the google+ account
		$id = $me['id'];
		$name = $me['displayName'];
		$email = $me['emails'][0]['value'];
		$profile_image_url = $me['image']['url'];
		$cover_image_url = $me['cover']['coverphoto']['url'];
		$profile_url = $me['url'];

	}
	else{
		$authUrl=$client->createAuthUrl();
	}


	//if the auth account is not set go back to the sign in page.
	if(isset($authUrl)){
		//for the index page google login button
		$string = "<a href='".$authUrl."' class='button red'><img src ='img/g_sign.png'>Sign in</a>";
		//for the register page google signin button
		$string1 ="<a class='btn btn-danger' href='".$authUrl."' style='width:13em;'> Sign up using Google</a>";
		//
		$string2 = "<a href ='".$authUrl."''><div class='col-sm-4 plus'><i class='fa fa-google-plus fa-5x'></i></div></a>";
	}else{

		//to keep the button visible on index.page after signin
		$string = "<a href='#' class='btn btn-tw'><i class='fa fa-twitter'></i>Twitter</a>";

	    //checks if the account is already in the database
	    $alive = checkExsistance($email);

	    //split the Google namedisplay 
	    $fullName = explode(" ", $name);

	    //stored in session to fill out reg form
	    $_SESSION['firstName'] = $fullName[0];
	    $_SESSION['lastName']  = $fullName[1];
	    
	    //if the account is alive
	    if($alive == TRUE){

	    	//return the usersID
	    	returnID($email);
	    	$_SESSION['$email'] = $email;
	    	//send to manage.php page
	    	header("location:http://localhost/xparcel/manageParcel.php?");

	    }
	    else if($alive == FALSE){

	    	//add Google details to DB
	    	addGgleAccDB($email,$id);
	    	$_SESSION['$email'] = $email;

	    	//send to the register page
	    	header("location:http://localhost/xparcel/gRegistrationPage.php?");
	    }

	   //display the logout button 
	   echo "<a class = 'logout' href = 'logout.php'><button>Logout</button></a>";
	}


	//get the current users loginID
	function returnID($email){

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `UserID` FROM `directlogin` WHERE Email = :email LIMIT 1;");
		$sql->bindValue(':email', $email);
		$sql->execute();

		$result = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $r ){

			$_SESSION['$userID'] = $r['UserID'];
		}
	}

	//looks for the exsistance of the email address in the database
	function checkExsistance($email){

		$flagCheck = null;

		$DBH = connect();

		$sql = $DBH->prepare("SELECT `Email` FROM `directlogin` WHERE Email = :email LIMIT 1;");
		$sql->bindValue(':email', $email);
		$sql->execute();

		$check = $sql->fetch(PDO::FETCH_ASSOC);

		if(!empty($check)){

			$flagCheck = TRUE;
		}
		else{	
			$flagCheck = FALSE;
		}

		return $flagCheck;
	}

	//add the google account to the sites database
	function addGgleAccDB($email,$id){

		$userID = null;

		$DBH = connect();

		$sql = "INSERT INTO `directlogin` (`UserID`,`Email`,`Password`) VALUES (?,?,?);";

		$sth = $DBH->prepare($sql);

		$sth->bindParam(1,$userID,PDO::PARAM_INT);
		$sth->bindParam(2,$email,PDO::PARAM_INT);
		$sth->bindParam(3,md5($id),PDO::PARAM_INT);

		$sth->execute();

		$user = $DBH->lastInsertId();

		//used for identifying user through outa session
		$_SESSION['$userID'] = $user;
		
	}
?>
