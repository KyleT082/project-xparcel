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
    <link rel="stylesheet" href="css/about.css">
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
            <li class="active"><a href="index.php">Home</a></li>
            
          </ul>
        </div>
        
      </nav>  
     </body> 
    
    <!-- About Us-->
    <div class="containerz">
      <div id="containerdiv"> 
        <img id="cornerimage" src="img/xparcelLogo.png"> 
      </div>     
      <div id="avia_textblock" itemprop="text">
        <p style="text-align: center;"><strong>About US</strong></p>
        <p class="p1"><span class="s1">Xparcel is a revolutionary parcel delivery service.</span></p>
        <p class="p1">Founded in 2015 by a student body as 3rd year project. We are offering an enhancement to the Irish tracking and delivery market.</p>
        <p class="p1"><span class="s1">We are a team of four people; </span>Thiago Murphy, Kyle Truebody, Wade Williamson, and Varadane Calleemootoo<span class="s1">. </span></p>
        <p class="p1"><span class="s1">We offer a number of new features. Customers can customize the delivery date to suit there own timetable. The customer will be able to change the delivery address for there parcel after placeing thier iniatial order. Live parcel tracking feature for customers to monitor the delivery progress in real time.</span></p>
        <p class="p1"><span class="s1">These innovative services are in place for the convenience of the users. </span></p>
      </div>
    </div>
     
    <!-- -->
    
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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