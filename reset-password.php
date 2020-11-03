<?php

session_start();

include('config.php');

if(!isset($_SESSION['user_id']) or !isset($_GET['token'])) {
	header('Location: index.php');
}

if($con) {
  date_default_timezone_set('Europe/London');
  $tkn_decode = base64_decode($_GET['token']);
  $user_id = $_SESSION['user_id'];

  // echo $tkn_decode . '<br>';

  $array = explode("~", $tkn_decode);

  if(count($array) === 3) {
    // echo $array[0] . '<br>';
    // echo $array[1] . '<br>';
    // echo $array[2] . '<br>';

    if($array[0] === $_SESSION['user_id'] and sha1($_SESSION['email']) === $array[1]) {
      if(strtotime($array[2]) >= strtotime(date("d-m-Y h:i:s", time()))) {
        if(isset($_POST['submit'])) {
          $password = mysqli_real_escape_string($con, $_POST['password']);
          $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

          if($password === $cpassword) {
            $password = md5($password);
            $query3 = mysqli_query($con, "update user set password= '$password' where user_id = $user_id") or die("Update Unsuccessful Retry");

            if($query3) {
              $_SESSION['rp_success'] = "<strong>Update!</strong> Your password has successfully been updated ";
            }
            // unset($_SESSION['user_id']);
            // unset($_SESSION['email']);
            unset($_SESSION['rp_error']);
          }
          else {
            $_SESSION['rp_error'] = "<strong>Error!</strong> Your new password and confirm password doesn't match";
          }
        }
      }
      else {
        $_SESSION['exp_tkn'] = "<strong>Error!</strong> Token expired";
      }
    }
    else {
      $_SESSION['inv_tkn'] = "<strong>Error!</strong> Invalid token";
    }
  }
  else {
    $_SESSION['inv_tkn'] = "<strong>Error!</strong> Invalid token";
  }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctor's Lab | Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <!-- <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a>  -->
            <!-- <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a>  -->
          </div>
          <div class="col-lg-3 text-right">
            <a href="index.php" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
            <a href="register.php" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
          </div>
        </div>
      </div>
    </div>


    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="" class="d-block">
            <img src="images/logo.png" alt="Image" height="100px" width=" 270px" class="img-fluid">
            </a>
          </div>
        </div>
      </div>

    </header>

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Reset Password</h2>
              <p>Reset Your Password!</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.php">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="index.php">Login</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="forgot-password.php">Forgot Password</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Reset Password</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <?php if (isset($_SESSION['inv_tkn'])) { ?>
                  <div class="row">
              <div class="col-md-12 form-group">
                            <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?php echo $_SESSION['inv_tkn']; ?>
                  <?php unset($_SESSION['inv_tkn']); ?>
                </div>
                          </div>
                      </div>
          <?php } else if (isset($_SESSION['exp_tkn'])) { ?>
                  <div class="row">
              <div class="col-md-12 form-group">
                            <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?php echo $_SESSION['exp_tkn']; ?>
                  <?php unset($_SESSION['exp_tkn']); ?>
                </div>
                          </div>
                      </div>                 

          <?php } else { ?>

            <form class="row justify-content-center" method = "post">
              <div class="col-md-5">
                  
                <?php if (isset($_SESSION['rp_error'])) { ?>
                  <div class="row">
              <div class="col-md-12 form-group">
                            <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?php echo $_SESSION['rp_error']; ?>
                  <?php unset($_SESSION['rp_error']); ?>
                </div>
                          </div>
                      </div>
          <?php } ?>

          <?php if (isset($_SESSION['rp_success'])) { ?>
                  <div class="row">
              <div class="col-md-12 form-group">
                            <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?php echo $_SESSION['rp_success']; ?>
                  <?php unset($_SESSION['rp_success']); ?>
                </div>
                          </div>
                      </div>
          <?php } ?>

                  <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" id="password" name="cpassword" class="form-control form-control-lg" required>
                    </div>
                  </div>

                    <div class="row">
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary btn-lg px-5" name="submit">Reset</button>
                        </div>
                    </div>
                  </div>
                </form>

         <?php }

          ?>
          
            

        </div>
    </div>

    

    <div class="footer">
        <div class="container">

  
          <div class="row">
            <div class="col-12">
              <div class="copyright">
              <p>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Doctor's Lab Copyright  &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="icon-heart" aria-hidden="true"></i><a href="www.skynners.com" target="_blank" > </a>
                      <a href="https://www.skynners.com/" style="color: white;"> Developed by Skynners (Private) Limited </a>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>