<html>
   <head>
      <?php
        //load the php to handle the users table contents
        include "php/loadPackages.php ";
        include "php/loadTrack.php";
        //Session start included in loadPackages.php
      ?> 
      <title>Xparcel</title>
      <!-- font awesome css  + Latest Bootstrap JS and CSS-->
      <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type ="text/javascript" src="js/jsbtnFunctions.js"></script>
      <link rel="stylesheet" type="text/css" href="css/manageParcelCSS.css">
      <script src="js/jquery-ui.min.js"></script>
      <link href="css/jquery-ui.min.css" rel="stylesheet">
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXuYRxUQIzziPIRh6N6Fij_r3POQqTcQk"
    async defer></script>
      <script type="text/javascript" src="js/jsGoogleMap.js"></script> 

   </head>
   <body>
      <!-- Nav -->
        <nav id='testDialog'class="navbar navbar-default navbar-fixed-top">
          <div class="navbar-header">
          <img  id = "logo200" src='img/xparcelLogo200px.png' alt=''>
          <label id="userName"><strong>Hello </strong> <?php echo $_SESSION['firstName'];?> </label>
          
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="userProfile.php">Profile</a></li>
              <li><a href="about.php" >About Us</a></li>
              <li><a href="php/logout.php">Log out</a></li>
            </ul>
          </div>
          
       </nav>
       
       <!-- Container / Table and contents display -->
      <div id="table" class = 'container'>
            <ul>
             <li><a href="#packages" title="Manage your packages here">Packages</a></li>
             <li><a href="#liveTrack" title="track your package here">Live Tracking</a></li>
            </ul>
            <div id ="packages" class='table-responsive'>
               <!-- Buttons EDIT / UPDATE / DELETE -->
             <!-- EDIT  -->
              <div id= "btnPosition" class="button">
                  <button href="JavaScript:void(0)" id='btnAdd' type="button" class="btn btn-success">Add a Package</button>                      
                  <!-- UPDATE  -->
                  <button  id = "btnEdit"type="button" class="btn btn-info">Edit Details</button> 
                  
                  <!-- DELETE -->
                  <button id ='btnDel' data-toggle="modal" data-target="#myModal" type="button" class="btn btn-danger">Remove</button>
              </div>
              <!-- Table Titles -->        
              <table  class='table table-hover'>
                  <thead id ='Thead'>  
                    <tr>
                     
                      <th title="Name your Deliveries">Delivery Name</th>
                      <th title="Your Delivies estimated delivery date">Delivery Date</th>
                      <th title = "Package tracking number">Tracking Number</th>
                      <th title = "Status avialablity of live tracking feature">Live Track</th>
                      <th title = "The registered delivery address">Address</th>
                    </tr>
                  </thead>
              
                  <!-- Table Contents -->   
                <tbody id = 'tableBody'>
                   <?php  
                      //called from the loadPackages.php
                      getProfileID();
                   ?>
               </tbody> 
              </table>  
             
              <!-- Success messge if package is found-->
              <div id="PackSuccess" class="alert alert-success fade in">
                <a href="#"  class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Action Successful!</strong> Your Package has been added
             </div>
             <!--Success of package removal-->
             <div id="PackRemoveSuc" class="alert alert-success fade in">
                <a href="#"  class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong> Action Successful!</strong> Your Package has been removed
             </div>
        </div>
         <div id="liveTrack">
          <div id ="menuPosition">
                <select name="selector" id="selectMenu">
                  <option value="0" selected="selected">Select a package</option>
                  <?php findTrackNum(); ?>
                </select>
                <input type="button" id="locateBtn" value="Track">
                <input type="button" id="rmveMarkBtn" value="Clear">
              </div>
         <!--holds GoogleMap-->
          <div id="mapCanvas">
          </div>
             
              
         </div>
      </div> 

      <div id ="Cdialog" title ="Check for Packages">
          <form class="form-horizontal" method="post">
            <div class="form-group form-group-sm">
              <p>Please enter the tracking number linked to the package you wish to add</p>
              <input class="form-control" type="text" id="trackingNum" placeholder="Enter your tracking number here ">
            </div>
          </form>  
      </div>
         <!-- Modal for collecting tracking data-->
      <div id ="updateDialog" title ="Update Delivery Details">
          <form class="form-horizontal" method="post">
            <div class="form-group form-group-sm">
              <div class= "col-xs-10" style="margin-bottom:14px;">
                <label> Package name:</label>
                <input class="form-control" type="text" id="packName" placeholder="Edit package name here.">
              </div>
              <div class= "col-xs-10" style="margin-bottom:14px;">
                <label>Update Delivery Date:<span id="icon-info" title="Please note that delivery date can not be amended after the original delivery date has passed and not after  21:00, two days before the schedualed delivery date. " class="ui-icon ui-icon-info"></span></label>
                <input class="form-control" type="text" id="datepicker" placeholder="Update your delivery date.">
              </div>
               <div class= "col-xs-10" style="margin-bottom:3px;">
                  <label>Delivery Address</label>
               </div>
               <div class= "col-xs-8" style="margin-bottom:14px;">
                <label>Street:</label>
                <input class="form-control" type="text" id="addStreet" placeholder="Add the Street address.">
              </div> 
              <div class= "col-xs-8" style="margin-bottom:14px;">
                <label>City/Town:</label>
                <input class="form-control" type="text" id="addTown" placeholder="Add the City or Town.">
              </div>
              <div class= "col-xs-8" style="margin-bottom:14px;">
                <label>County:</label>
                <input class="form-control" type="text" id="addCount" placeholder="Add the County.">
              </div>
              <div class="col-xs-12">
                 <form>
                  <div id="radio">
                    <input type="radio" id="radio1" name="radio" value="1"><label for="radio1">Primary Address</label>
                    <input type="radio" id="radio2" name="radio" value="2"><label for="radio2">Secondary Address</label>
                    <input type="radio" id="radio3" name="radio" value="3"><label for="radio3">New Address</label>
                  </div>
                </form>
              </div>
            </div>
          </form>  
      </div>
        <!--modal for remove confirmation-->
        <div id ="removeDialog" title ="CAUTION!" src="img/caution-icon.png">
          <form class="form-horizontal" method="post">
            <div class="form-group form-group-sm">
             <img id="cautionImage"src="img/caution-icon.png">
              <p id ='remText'><strong>Are you sure you would like to remove this package?</strong></p>
            </div>
          </form>  
        </div> 
   </body>
</html>

