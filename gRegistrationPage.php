<!DOCTYPE html>
<html>
<?php
   session_start();
  
?>
   <head>
     <meta charset="UTF-8">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
      <!-- font awesome css -->
      <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type= "text/javascript" src ="js/jsRegister.js"></script>
      <link rel="stylesheet" type="text/css" href="css/styler.css">
   </head>
   <body>
      <!-- Nav -->
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
         </div>
         <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li class="Home"><a href="index.php">Home</a></li>
               <li><a href="about.php">About Us</a></li>
            </ul>
         </div>
      </nav>
      <!-- Title -->
      <div class="title">
         <h1> We need just a little more of your time </h1>
      </div>
      <!-- Intro / explanation -->
      <div class="intro">
         <h5>Please fill out the information below.</h5>
      </div>
      <br>
      <!-- Personal Information -->
      <!-- Title -->
      <div class="panel-group" id="accordion">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h4 class="panel-title">
                  Personal Information
               </h4>
            </div>
            <div class="panel-body">
               <br>
               <!-- Photo -->
               <div class="userPhoto">
                  <img src="img/Blue.png" class="img-thumbnail" alt="User profile" width="150" height="180">  
               </div>
               <!-- Upload button -->
               <!-- Standard Form -->
               <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
                  <div class="form-inline">
                     <div id="chooseF" class="form-group">
                        <input type="file" name="files[]" id="js-upload-files" multiple>
                     </div>
                     <div id="uploadBtn">
                        <button type="file" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                     </div>
                  </div>
               </form>
               <!-- Info label -->
               <form id="pInfo" class="form-horizontal" method="post" action= "testpost.html">
                  <!-- First Name -->
                  <div class="form-group form-group-sm">
                     <label class="col-sm-6 control-label" for="formGroupInputSmall">First Name</label>
                     <div class="col-sm-6">
                        <input class="form-control" type="text" id="FirstName" value=<?php echo $_SESSION['firstName']; ?>>
                     </div>
                  </div>
                  <!-- Last Name -->
                  <div class="form-group form-group-sm">
                     <label class="col-sm-6 control-label" for="formGroupInputSmall">Last Name </label>
                     <div class="col-sm-6">
                        <input class="form-control" type="text" id="LastName" value=<?php echo $_SESSION['lastName']; ?>>
                     </div>
                  </div>
                  <!-- Mobile Phone -->
                  <div class="form-group form-group-sm">
                     <label class="col-sm-6 control-label" for="formGroupInputSmall">Mobile Phone </label>
                     <div class="col-sm-6">
                        <input class="form-control" type="text" id="MobileNum" placeholder="Ex. +353 82 1234 123">
                     </div>
                  </div>
                  <!-- Date of birth -->
                  <div id="dob" class="form-group form-group-sm">
                     <label class="col-sm-6 control-label" for="formGroupInputSmall">Date of birth </label>
                     <!-- Day -->
                     <div id="day" class="col-sm-2">
                        <input class="form-control" type="text" id="DOB_Day" placeholder="DD">
                     </div>
                     <!-- Month -->
                     <div id="month" class="col-sm-2">
                        <input class="form-control" type="text" id="DOB_Mon" placeholder="MM">
                     </div>
                     <!-- Year -->
                     <div id="year" class="col-sm-2">
                        <input class="form-control" type="text" id="DOB_Yr" placeholder="YYYY">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Delivery Information -->
      <div class="panel panel-default">
         <div class="panel-heading">

            <h4 class="panel-title"> Delivery Information </h4>
              
         </div>
         <div class="panel-body">
            <form class="form-horizontal">

               <!-- Address -->
               <div class="form-group form-group-sm">
                  <label class="col-sm-6 control-label" for="formGroupInputSmall">Primary Address</label>
                  <div class="col-sm-6">
                     <input class="form-control" type="text" id="Prim_Street" placeholder="Ex. 123 somewhere street">
                  </div>
               </div>

               <!-- City / Town -->
               <div class="form-group form-group-sm">
                  <label class="col-sm-6 control-label" for="formGroupInputSmall">City / Town </label>
                  <div class="col-sm-6">
                     <input class="form-control" type="text" id="Prim_City" >
                  </div>
               </div>

               <!-- County -->
               <div class="form-group form-group-sm">
                  <label class="col-sm-6 control-label" for="formGroupInputSmall">County </label>
                  <div class="col-sm-6">
                     <input class="form-control" type="text" id="Prim_Count">
                  </div>
               </div>

               <!-- Postcode -->
               <div class="form-group form-group-sm">
                  <label class="col-sm-6 control-label" for="formGroupInputSmall">Postcode </label>
                  <div class="col-sm-6">
                     <input class="form-control" type="text" id="formGroupInputSmall">
                  </div>
               </div>

               <!-- Secondary Address -->
               <div >
                  <form class="form-horizontal">

                     <!-- Address -->
                     <div class="form-group form-group-sm">
                        <label class="col-sm-6 control-label" for="formGroupInputSmall">Secondary Address</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" id="Sec_Street" placeholder="Ex. 13 here street">
                        </div>
                     </div>
                     <!-- City / Town -->
                     <div class="form-group form-group-sm">
                        <label class="col-sm-6 control-label" for="formGroupInputSmall">City / Town </label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" id="Sec_City" >
                        </div>
                     </div>
                     <!-- County -->
                     <div class="form-group form-group-sm">
                        <label class="col-sm-6 control-label" for="formGroupInputSmall">County </label>
                        <div class="col-sm-6">
                           <input class="form-control" type="text" id="Sec_Count"/>
                        </div>
                     </div>
                     <!-- Postcode -->
                     <div class="form-group form-group-sm">
                        <label class="col-sm-6 control-label" for="formGroupInputSmall">Postcode </label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" id="formGroupInputSmall"/>
                        </div>
                     </div>

                  </form>
               </div>

            </form>
         </div>
      </div>
     
     
      <!-- Term and Conditions -->
      <div class="bottomText">
         <p>By creating an account, you agree with our <a href="#" >Terms & Conditions.</a></p>
      </div>
      <!-- Button - Create account -->
      <div class="createBtn">
         <button id="glSubmitForm" class="btn btn-block btn-lg btn-info">Create Profile</button>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <!--<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <!--<script src="js/bootstrap.min.js"></script>-->    
   </body>
</html>