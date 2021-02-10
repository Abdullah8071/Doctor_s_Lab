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
  <title>Doctor's Lab | Course Detail</title>
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
            <img src="images/logo.png" alt="Image" height="100px" width=" 270px" class="img-fluid">
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
              </ul>                                                                                                                                                                                                                                                                                          <!-- </ul> -->
            </nav>

          </div>
        </div>
      </div>

    </header>

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <!-- <h2 class="mb-0"><?php echo $row['course_name']; ?></h2> -->

            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="courses.php">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="mycourses.php">Courses</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Course Detail</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
        	<?php
        		if(isset($_GET['id'])) {
        			$id = $_GET['id'];
        			$query = "SELECT * FROM course where course_id = $id";

			    	$rows = mysqli_query($con, $query);

			    	if(mysqli_num_rows($rows) === 1) { 
			    		$row = mysqli_fetch_assoc($rows);
			       		$course_cover_image = $row['course_cover_image'];
			    	?>
			    		<div class="row">
			                <div class="col-md-6 mb-4">
			                    <p>
			                        <img src="admin/course_cover_images/<?php echo $id ?>/<?php echo $course_cover_image ?>" alt="admin/course_cover_images/<?php echo $id ?>/<?php echo $course_cover_image ?>" class="img-fluid">
			                    </p>
			                </div>
			                <div class="col-lg-5 ml-auto align-self-center">
			                        <h2 class="section-title-underline mb-5">
			                            <span><?php echo $row['course_name']; ?></span>
			                        </h2>
			                        
			                        <p><strong class="text-black d-block">Teacher:</strong> <?php echo $row['course_instructor']; ?></p>
			                        <!-- <p><strong class="text-black d-block">Start Date:</strong> <?php $row['starting_date'] = date("d-m-Y", strtotime($row['starting_date'])); echo $row['starting_date']; ?></p>
			                        <p><strong class="text-black d-block">End Date:</strong><?php $date = strtotime("14 day", strtotime($row['starting_date'])); $date = date("d-m-Y", $date); echo $date; ?></p> -->
                              <p><strong class="text-black d-block">Course Duration:</strong> 15 days</p>
			                        <p><strong class="text-black d-block">Course Fee:</strong>£. <?php echo $row['course_fee']; ?></p>
			                        <p><strong class="text-black d-block">Description:</strong></p>
			                        <p style = "white-space: pre-line;"><?php echo $row['course_description']; ?></p>
			    
			     
                              <!-- Add Your Website link here -->
			                        <p>
			                            <a href="https://www.doctorslab.co.uk/product/main-plab2-course/" class="btn btn-primary rounded-0 btn-lg px-5">Register Now</a>
			                        </p>
			    
			                    </div>
			            </div>
			    	
			    	<?php }

			    	else { ?>
			    	<div class="row">
			          <div class="col-md-12 form-group">
			            <div class="alert alert-danger">
			              <button type="button" class="close" data-dismiss="alert">×</button>
			              <?php echo "<strong>Error!</strong> No Course Details Found"; ?>
			            </div>
			          </div>
			        </div>
			    <?php }
        		}
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