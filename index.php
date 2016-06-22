<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    //used for the google OAuth 2.0
    include "php/googleSign.php";
    ?>
    <meta charset="UTF-8">
    <title>Xparcel Tracking</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class = "bodytest">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <!-- Login Dropdown - Facebook and Twitter -->
          <div class="login">
            <?php
            //set the error message if login is unsuccessfull
            if(isset($_GET['error'])){
            ?>
            <div id = "loginError">
              <h5>Incorrect Login details!</h5>
            </div>
            <?php
            }
            ?>
            <ul>
              <li class="firstline">Already have an account?</li>
              <li class="dropdown firstline">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                <ul id="login-dp" class="dropdown-menu">
                  <li>
                    <div class="row">
                      <div class="col-md-12">
                        Login via
                        <div class="social-buttons">
                          <a href="facebookAuth.html" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                          <?php
                          //load html for google signin
                          echo $string;
                          ?>
                          <!-- <a href="php/googleSign.php" class="btn btn-tw"><i class="fa fa-twitter"></i>Twitter</a>-->
                        </div>
                        or
                        <form class="form" role="form" method="post" action="php/login.php" accept-charset="UTF-8" id="login-nav">
                          <div class="form-group">
                            <label class="sr-only" for="examplemailAdd">Email address</label>
                            <input type="text" class="form-control" id="examplemailAdd" name = "emailAdd" placeholder="Email address" required>
                          </div>
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                            <input type="password" name = "pwd" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                            <div class="help-block text-right"><a href="">Forget the password?</a></div>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value ="Sign in">
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> keep me logged-in
                            </label>
                          </div>
                        </form>
                      </div>
                      <div class="bottom text-center">
                        Join now <a href="registrationPage.php"><b>Register here</b></a>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="about.php" >About Us</a></li>
          </ul>
        </div>
      </nav>
    </body>
    <div id="box">
      
      <img class="absolute" src="img/xparcelLogo.png" alt="">
    </div>
    <div class="container-fluid devices">
      <div class="row-eq-height">
        <div class="col-sm-6 cell1">
          <img src="img/electronicImg.png" alt="">
        </div>
        <div class="col-sm-6 cell2">
          <div class="row textid">
            <div class="col-sm-12"><h3>Electronic ID</h3>
              <br>
              <p>Help identify yourself when you don't have any id with you.
              You can send your electronic signture in just one click.</p>
            </div>
            
            <div class="col-sm-12 how">
              <img src="img/howTo.png" alt="">
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid pack">
      <div class="row-eq-height">
        <div class="col-sm-6 cell1">
          <div class="textid"> <h3>Manage Your Parcels</h3>
            <br>
            <p>Different parcels from different websites? Something happened and you need to change the date ,time or location? No problem! Xparcel Package managment system can handle more than one parcel and allow you to convieniantly control your delivery</p>
          </div>
        </div>
        <div class="col-sm-6 cell2">
          <img src="img/parcel.png" alt="">
        </div>
      </div>
    </div>
    
    <div class="container" id="googlemap">
      <div class="row">
        <div class="live no650">
          <i class="fa fa-map-marker fa-5x"></i><h3>Live</h3>
        </div>
        <div id="locationboard">
          <img src="img/iphone.png" alt="">
          </div><div id="dark"></div>
          <div class="track no650">
            <i class="fa fa-search fa-5x"></i><h3>Tracking</h3>
          </div>
          
          <div id="map">
            
          </div>
        </div>
      </div>
      <div class="container-fluid gray">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 face"><i class="fa fa-facebook fa-5x"></i></div>
            <div class="col-sm-4 twit"><i class="fa fa-twitter fa-5x"></i></div>
            <?php
            //calls google signin auth url
             echo $string2; ?>
            <!--<div class="col-sm-4 plus"><a href =""><i class="fa fa-google-plus fa-5x"></i></a></div>-->
          </div>
        </div>
      </div>
      <div class="container-fluid about">
        <div class="row ">
          <div class="col-sm-4 textabout">
            <h3>About Us</h3>
            <p>Xparcel Managment System is a unique tool focused to increase customer service and also reduce CO2 emissions.</p>
          </div>
          <div class="col-sm-4 textabout">
            <h3>Who are we?</h3>
            <p>We are a group of 3rd year students, enrolled at Collage of Computer Technology</p>
          </div>
          <div class="col-sm-4 textabout">
            <h3>Who do we want to be?</h3>
            <p>Greater, better and simpler</p>
          </div>
        </div>
      </div>
      <!-- Latest compiled and minified JavaScript -->
      <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      
      <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
      
      
      
      <script type="text/javascript">
      // When the window has finished loading create our google map below
      google.maps.event.addDomListener(window, 'load', init);
      
      function init() {
      // Basic options for a simple Google Map
      // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
      var mapOptions = {
      // How zoomed in you want the map to start at (always required)
      zoom: 15,
      disableDefaultUI: true,
            navigationControl : false,
        scrollwheel : false,
      // The latitude and longitude to center the map (always required)
      center: new google.maps.LatLng(53.3494, -6.2603), // New York
      // How you would like to style the map.
      // This is where you would paste any style found on Snazzy Maps.
      styles: [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#b5cbe4"}]},{"featureType":"landscape","stylers":[{"color":"#efefef"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#83a5b0"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bdcdd3"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e3eed3"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}]
      };
      // Get the HTML DOM element that will contain your map
      // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');
        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
        position: new google.maps.LatLng(53.3494, -6.2603),
        map: map,
        title: 'Xparcel'
        });
        }
        </script>
        
        
        <!-- JavaScript for Login Dropdown - Facebook and Twitter -->
        <script type="text/javascript">
          window.alert = function(){};
          var defaultCSS = document.getElementById('bootstrap-css');
          function changeCSS(css){
              if(css)
                 $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
              else 
                $('head > link').filter(':first').replaceWith(defaultCSS);
          }
          $( document ).ready(function() {
              var iframe_height = parseInt($('html').height());
              window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
          });
        </script>
    </div>    
  </body>
</html>