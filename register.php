<?php

session_start();

include('config.php');

if($con) {
  if(isset($_POST['submit'])) {
    // $username = mysqli_real_escape_string($con, $_POST['username']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    
    // $query = "SELECT * FROM user WHERE username = '$username'";

    // $rows = mysqli_query($con, $query);
    
    // if(mysqli_num_rows($rows) > 0) {
    //    $_SESSION['error'] = 1;
    //    $_SESSION['u_error'] = "<strong>Error!</strong> Username has Already been Taken";
    // }

    // Validate Email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error'] = 1;
      $_SESSION['e_error'] = "<strong>Error!</strong> This email seems to be invalid";
    }

    $query = "SELECT * FROM user WHERE email = '$email'";

    $rows = mysqli_query($con, $query);
    
    if(mysqli_num_rows($rows) > 0) {
       $_SESSION['error'] = 1;
       $_SESSION['ee_error'] = "<strong>Error!</strong> This email has already been registered";
    }

    if($password !== $cpassword) {
      $_SESSION['error'] = 1;
      $_SESSION['p_error'] = "<strong>Note!</strong> Password and re-type password don't match";
    }

    if(!isset($_SESSION['error'])) {
      $password = md5($password);
      $query = "INSERT INTO user (fullname, email, password, phone) VALUES ('$fullname', '$email', '$password', '$phone')";
      $add = mysqli_query($con, $query);
      
      if($add) {
        // $query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
        // $rows = mysqli_query($con, $query);
        // $row = mysqli_fetch_assoc($rows);
        
        // if(mysqli_num_rows($rows) === 1) {
          // echo $user_id;
          // echo $username;
          // echo $email;
          // echo $password;
        // echo $_SESSION['aus'];
        unset($_SESSION['ee_error']);
        unset($_SESSION['e_error']);
        unset($_SESSION['p_error']);
        unset($_SESSION['error']);
        $_SESSION['register'] = "register";
        header('Location: index.php');
        // }
      }
    }
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctor's Lab | Register</title>
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
              <h2 class="mb-0">Register</h2>
              <p>Welcome to Doctor's Lab </p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.php">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Register</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">


            <form class="row justify-content-center" method = "post">
                <div class="col-md-5">

                    <?php if (isset($_SESSION['u_error'])) { ?>
                            <div class="row">
                              <div class="col-md-12 form-group">
                                <div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <?php echo $_SESSION['u_error']; ?>
                                  <?php unset($_SESSION['u_error']); ?>
                                  <?php unset($_SESSION['error']); ?>
                                </div>
                              </div>
                            </div>
                    <?php } ?>

                    <?php if (isset($_SESSION['ee_error'])) { ?>
                            <div class="row">
                              <div class="col-md-12 form-group">
                                <div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <?php echo $_SESSION['ee_error']; ?>
                                  <?php unset($_SESSION['ee_error']); ?>
                                  <?php unset($_SESSION['error']); ?>
                                </div>
                              </div>
                            </div>
                    <?php } ?>

                    <?php if (isset($_SESSION['e_error'])) { ?>
                            <div class="row">
                              <div class="col-md-12 form-group">
                                <div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <?php echo $_SESSION['e_error']; ?>
                                  <?php unset($_SESSION['e_error']); ?>
                                  <?php unset($_SESSION['error']); ?>
                                </div>
                              </div>
                            </div>
                    <?php } ?>

                    <?php if (isset($_SESSION['p_error'])) { ?>
                            <div class="row">
                              <div class="col-md-12 form-group">
                                <div class="alert alert-warning">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <?php echo $_SESSION['p_error']; ?>
                                  <?php unset($_SESSION['p_error']); ?>
                                  <?php unset($_SESSION['error']); ?>
                                </div>
                              </div>
                            </div>
                    <?php } ?>



                    <div class="row">
                        <!-- <div class="col-md-12 form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" required>
                        </div> -->
                        <div class="col-md-12 form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                          <label for="phone">Phone</label>
                          <input type="text" id="phone" name="phone" class="form-control form-control-lg" required>
                      </div>
                        <div class="col-md-12 form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="cpassword">Re-type Password</label>
                            <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Register" class="btn btn-primary btn-lg px-5" name="submit">
                        </div>
                    </div>
                </div>
            </form>
            

          
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