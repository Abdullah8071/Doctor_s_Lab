<?php

session_start();

include('config.php');

if(!isset($_SESSION['id'])) {
  header('Location: index.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctor's Lab | My Courses</title>
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
              <a href="logout.php" class="small mr-3"><span class="icon-unlock-alt"></span> Log Out</a>
            </div>
          </div>
        </div>
      </div>
      <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
  
        <div class="container">
          <div class="d-flex align-items-center">
            <div class="site-logo">
              <a href="courses.php" class="d-block">
                <img src="images/logo.jpg" alt="Image" class="img-fluid">
              </a>
            </div>
            <div class="mr-auto">
              <nav class="site-navigation position-relative text-right" role="navigation">
                <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                  <li>
                    <a href="courses.php" class="nav-link text-left">Home</a>
                  </li>
                  <li>
                    <a href="mycourses.php" class="nav-link text-left">My Courses</a>
                </ul>                                                                                                                                                                                                                                                                                          </ul>
              </nav>
  
            </div>
          </div>
        </div>
  
      </header>

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">My Courses</h2>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="courses.php">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">My Courses</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">

          <?php
            $id = $_SESSION['id'];
            // echo $username;
            $query = "SELECT * FROM course where course_id IN (SELECT course_id from user_reg_courses where user_id = $id and subscription_status = 1)";
            $rows = mysqli_query($con, $query) or die("error");
          
            if(mysqli_num_rows($rows) > 0) {
              echo '<div class="row">';
              while($row = mysqli_fetch_assoc($rows)) { 
                  $id = $row['course_id'];
                  $course_cover_image = $row['course_cover_image'];
                  // $_SESSION[$id] = $id;
                  // echo $_SESSION[$id];
                ?>
                
                    <div class="col-lg-4 col-md-6 mb-4">
                      <div class="course-1-item">
                          <figure class="thumnail">
                                  <a href="coursematerial.php?id=<?php echo $id ?>"><img style = "width: 100%; height: 250px; object-fit: cover;" src="admin/course_cover_images/<?php echo $id ?>/<?php echo $course_cover_image ?>" alt="<?php echo $row['course_cover_image']; ?>" class="img-fluid"></a>
                          <div class="price"> £ <?php echo $row['course_fee']; ?></div>
                          <!-- <div class="category"><h3>Mobile Application</h3></div>   -->
                          </figure>
                          <div class="course-1-content pb-4">
                            <h2><strong><?php echo $row['course_name']; ?></strong></h2>
                            <h2><?php echo $row['course_instructor']; ?></h2>
                            <!-- <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p> -->
                            <p><a href="coursematerial.php?id=<?php echo $id ?>" class="btn btn-primary rounded-0 px-4">Go To Course</a></p>
                          </div>
                      </div>
                  </div>

             <?php } echo '</div>';
            }


          else { ?>
            <div class="row">
                <div class="col-md-12 form-group">
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo "<strong>You Have Not Registered Any Course</strong>"; ?>
                  </div>
                </div>
              </div>
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