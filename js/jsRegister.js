/*
	Document is responsible for handeling the 'post' functions 
	to the regPost.php and the post.php page to log new users details
	weather they register via Google OAuth or direct registration.	
*/


$(document).ready(function () {

	$flag = false;

	//When the Create Account button is pressed
	$('#submitForm').click(function() {

		//Personal Information Validation

		$firstName = $('#FirstName').val();
		if($firstName === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$LastName = $('#LastName').val();
		if($LastName === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		//NOT WORKING PROPERLY -- ACCEPTING CHAR
		$MobileNum = $('#MobileNum').val();
		if($MobileNum === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		//BIRTH DATE VALIDATION
		$DOB_Day = $('#DOB_Day').val();
		if($DOB_Day ===''){
			$flag = true;
		}else{
			$flag = false;
		}

		$DOB_Mon = $('#DOB_Mon').val();
		if($DOB_Mon === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$DOB_Yr = $('#DOB_Yr').val();
		if($DOB_Yr === ''){
			$flag = true;
		}else{
			$flag = false;
		}


		//Delivery Information Validation

		$Prim_Street = $('#Prim_Street').val();
		if($Prim_Street === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$Prim_City = $('#Prim_City').val();
		if($Prim_City === ''){
			$flag = true;
		}else{
			$flag = false;
		}


		$Prim_Count = $('#Prim_Count').val();
		if($Prim_Count === ''){
			$flag = true;
		}else{
			$flag = false;
		}


		//Account Information Validation

		$email = $('#email').val();
		if($email === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$pwd = $('#pwd').val();
		$Con_pwd = $('#Con_pwd').val();
		if($pwd != $Con_pwd){
			$flag = false;
		}else{
			$flag = true;
		}

		if($pwd === '' || $Con_pwd === ''){
			$flag = true;
		}else{
			$flag = false;
		}



		if($flag){
			alert("Some details are incorrect or missing!");
		}else{

			$.post('/xparcel/php/regPost.php', {

				firstName 	: $('#FirstName').val(),
				lastName  	: $('#LastName').val(),
				mobileNum 	: $('#MobileNum').val(),
				DOB_Day   	: $('#DOB_Day').val(),
				DOB_Mon   	: $('#DOB_Mon').val(),
				DOB_Yr    	: $('#DOB_Yr').val(),

				prim_Street : $('#Prim_Street').val(),
				prim_City 	: $('#Prim_City').val(),
				prim_Count 	: $('#Prim_Count').val(),

				sec_Street  : $('#Sec_Street').val(),
				sec_City 	: $('#Sec_City').val(),
				sec_Count 	: $('#Sec_Count').val(),

				email 		: $('#email').val(),
				pwd 		: $('#pwd').val(),

				method 		: "test"

			}, function() {
				window.location ="http://localhost/xparcel/manageParcel.php";
				
			}); //end callback

		}// end of if statement

	}); //end click

	
	//handels the post for the google register page
	$('#glSubmitForm').click(function() {

		//Personal Information Validation

		$firstName = $('#FirstName').val();
		if($firstName === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$LastName = $('#LastName').val();
		if($LastName === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		//NOT WORKING PROPERLY -- ACCEPTING CHAR
		$MobileNum = $('#MobileNum').val();
		if($MobileNum === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		//BIRTH DATE VALIDATION
		$DOB_Day = $('#DOB_Day').val();
		if($DOB_Day === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$DOB_Mon = $('#DOB_Mon').val();
		if($DOB_Mon === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$DOB_Yr = $('#DOB_Yr').val();
		if($DOB_Yr === ''){
			$flag = true;
		}else{
			$flag = false;
		}


		//Delivery Information Validation

		$Prim_Street = $('#Prim_Street').val();
		if($Prim_Street === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		$Prim_City = $('#Prim_City').val();
		if($Prim_City === ''){
			$flag = true;
		}else{
			$flag = false;
		}


		$Prim_Count = $('#Prim_Count').val();
		if($Prim_Count === ''){
			$flag = true;
		}else{
			$flag = false;
		}

		if($flag){
			alert("Some details are incorrect or missing!");
		}else{
			$.post('/xparcel/php/regPost.php', {

				firstName 	: $('#FirstName').val(),
				lastName  	: $('#LastName').val(),
				mobileNum 	: $('#MobileNum').val(),
				DOB_Day   	: $('#DOB_Day').val(),
				DOB_Mon   	: $('#DOB_Mon').val(),
				DOB_Yr    	: $('#DOB_Yr').val(),

				prim_Street : $('#Prim_Street').val(),
				prim_City 	: $('#Prim_City').val(),
				prim_Count 	: $('#Prim_Count').val(),

				sec_Street  : $('#Sec_Street').val(),
				sec_City 	: $('#Sec_City').val(),
				sec_Count 	: $('#Sec_Count').val(),

				method 		: "test1"

			}, function() {
				
				window.location = "http://localhost/xparcel/manageParcel.php";
			}); //end callback
		}// end of if statement

	}); //end click

});
