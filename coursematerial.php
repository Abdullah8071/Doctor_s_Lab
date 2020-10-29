<?php

session_start();

include('config.php');

if(!isset($_SESSION['id']) or !isset($_GET['id'])) {
  header('Location: index.php');
}

if (isset($_GET['id'])) {
  date_default_timezone_set('Europe/London');
  $currentTime = date('d-m-Y h:i:s A', time());
  $current_date = date('d-m-Y');

	$_SESSION['cid'] = $_GET['id'];
	$id = $_GET['id'];
	$userid = $_SESSION['id'];
	// echo $username . '<br>';
	// echo $id . '<br>';
	$query = "SELECT * from user_reg_courses where user_id = $userid and course_id = $id and subscription_status = 1";
	$row = mysqli_query($con, $query) or die("Not registered");

	if(mysqli_num_rows($row)) {
		$query = "SELECT * from course_content where course_id = $id";
		$rows = mysqli_query($con, $query) or die("Course content not found");

		$query1 = "SELECT * from course where course_id = $id";
		$rows1 = mysqli_query($con, $query1) or die("Course not found");
		$row1 = mysqli_fetch_assoc($rows1);
    if(mysqli_num_rows($rows1) === 0) {
      header('Location: courses.php');
    }
	}
	else {

		header('Location: courses.php');
	}
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctor's Lab | Course</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/accordian.css">

  <!-- Video css -->
  <link href="https://vjs.zencdn.net/5.10.4/video-js.css" rel="stylesheet">

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
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a> -->
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
              </ul>
              </ul>
            </nav>

          </div>
        </div>
      </div>

    </header>


    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-7">
            <h2 class="mb-0"><?php echo $row1['course_name']; ?></h2>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">

          <div class="col-4" style="margin-left: -5%;">
            <div class="list-group" id="list-tab" role="tablist">

              <?php 

              $date = strtotime($row1['starting_date']); 
              $dates = array();
              $date = date("d-m-Y", $date);
              $dates[0] = $current_date;

              $cnt = 1;
              while($cnt <= 15) {  
              	$row = mysqli_fetch_assoc($rows);
              	$href = "#list-day" . $cnt; $ac = "day" . $cnt; $aid = "list-day" . $cnt . "-list";  ?>
              	<a class="<?php if($cnt === 1) { echo "list-group-item list-group-item-action active"; } else { echo "list-group-item list-group-item-action"; }?>" id="<?php echo $aid ?>" data-toggle="list"
                href="<?php echo $href; ?>" role="tab" aria-controls="<?php echo $ac; ?>"><i class="fa fa-check-circle" style="font-size:20px" aria-hidden="true"></i> 

                Day<?php echo $cnt . ' ∴ ';
                		echo $date; 
                    $dates[$cnt] = $date;
                		$date = strtotime("1 day", strtotime($date)); 
                		$date = date("d-m-Y", $date);
                		?>
                </a>
              <?php $cnt += 1;

          	  }
              ?>

            </div>
          </div>


          <div class="col-8">
            <div class="tab-content" id="nav-tabContent">



              <?php  
                $cnt = 1;
                while($cnt <= 15) {  $lid = "list-day" . $cnt; $aid = "list-day" . $cnt . "-list";
              ?>
            	
              <div class="<?php if($cnt === 1) { echo "tab-pa ne fade show active collapse"; } else { echo "tab-pa ne fade collapse"; }?>" id="<?php echo $lid; ?>" role="tabpanel" aria-labelledby="<?php echo $aid; ?>" data-toggle = "collapse">

              	<?php
                    $id = $_SESSION['cid'];
                    $d = 'Day_' . $cnt;
                  	$query2 = "SELECT * from course_content where course_day = '$d' and course_id = $id";
					$rows2 = mysqli_query($con, $query2) or die("not working");

					$row2 = mysqli_fetch_assoc($rows2);

					if(mysqli_num_rows($rows2) === 1) {
                  ?>

                <div id="accordion" class="panel-group">
                  <h2 style="text-align: center;color: black; font-weight: bold;"><?php echo $row2['lecture_name'] ?></h2>

                  <?php
                    $date1 = date_create($dates[0]);
                    $date2 = date_create($dates[$cnt]);
                    $diff=date_diff($date1,$date2);

                   
                    // echo intval($diff->format("%R%a"));
                    if(intval($diff->format("%R%a")) === 0) {


                  ?>
                  <div class="panel">
                  	<?php 

                      	if($row2['video_1_name'] !== "") { ?>
			                <div class="panel-heading">
			                  <h4 class="panel-title">
			                  	
			                  		<a href="#panelBodyOne" class="accordion-toggle collapsed" data-toggle="collapse"
			                      data-parent="#accordion"><?php  echo $row2['video_1_name']; ?></a>
			                  	
			                    
			                  </h4>
			                </div>
                    <?php }                      	

                      	?>
                    <div id="panelBodyOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <video width="730" controls poster="images/play.jpg">

                        	<?php 
                            $vid = "video_1";
                          	$vid = "video_1" . $row2['video_1'];
                          ?>

                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_1/<?php echo $vid; ?>" type="video/mp4">
                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_1/<?php echo $vid; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>

                <?php }if(intval($diff->format("%R%a")) === 0) { ?>

                  <div class="panel">
                  	<?php 

                      	if($row2['video_2_name'] !== "") { ?>
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	

                        <a href="#panelBodyTwo" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion"><?php  echo $row2['video_2_name']; ?></a>
                      	
                      </h4>
                    </div>
                    <?php }                      	

                      	?>
                    <div id="panelBodyTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        <video width="730" controls poster="images/play.jpg">
                          <?php 
                            $vid = "video_2";
                          	$vid = "video_2" . $row2['video_2'];
                          ?>

                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_2/<?php echo $vid; ?>" type="video/mp4">
                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_2/<?php echo $vid; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>

                <?php } if(intval($diff->format("%R%a")) === 0) {?>

                  <div class="panel">
                  	<?php 

                      	if($row2['video_3_name'] !== "") { ?>
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	
                      		<a href="#panelBodyThree" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion"><?php  echo $row2['video_3_name']; ?></a>
                      	
                        
                      </h4>
                    </div>
                    <?php }                      	

                      	?>
                    <div id="panelBodyThree" class="panel-collapse collapse">
                      <div class="panel-body">
                        <video width="730" controls poster="images/play.jpg">
                          <?php 
                            $vid = "video_3";
                          	$vid = "video_3" . $row2['video_3'];
                          ?>

                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_3/<?php echo $vid; ?>" type="video/mp4">
                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_3/<?php echo $vid; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>

                <?php } if(intval($diff->format("%R%a")) === 0) { ?>

                  <div class="panel">
                  	<?php 

                      	if($row2['video_4_name'] !== "") { ?>
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	
                      		<a href="#panelBodyFour" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion"><?php  echo $row2['video_4_name']; ?></a>
                      	
                        
                      </h4>
                    </div>
                    <?php }                      	

                      	?>
                    <div id="panelBodyFour" class="panel-collapse collapse">
                      <div class="panel-body">
                        <video width="730" controls poster="images/play.jpg">
                          <?php 
                            $vid = "video_4";
                          	$vid = "video_4" . $row2['video_4'];
                          ?>

                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_4/<?php echo $vid; ?>" type="video/mp4">
                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_4/<?php echo $vid; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>

                <?php }if(intval($diff->format("%R%a")) === 0) { ?>

                  <div class="panel">
                  	<?php 

                      	if($row2['video_5_name'] !== "") { ?>
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	
                      		<a href="#panelBodyFive" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion"><?php  echo $row2['video_5_name']; ?></a>
                      	
                        
                      </h4>
                    </div>
                    <?php }                      	

                      	?>
                    <div id="panelBodyFive" class="panel-collapse collapse">
                      <div class="panel-body">
                        <video width="730" controls poster="images/play.jpg">
                          <?php 
                            $vid = "video_5";
                          	$vid = "video_5" . $row2['video_5'];
                          ?>

                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_5/<?php echo $vid; ?>" type="video/mp4">
                          <source src="admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/videos/video_5/<?php echo $vid; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>

                <?php } if(intval($diff->format("%R%a")) <= 0) {


                  ?>

                  <div class="panel">
                  <?php 

                      	if($row2['lecture_document'] !== "") { ?>
                  
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	
                      		<a href="#panelBodySix" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion">Lecture Material</a>
                      	
                        
                      </h4>
                    </div>

                    <?php }                      	

                      	?>
                    <div id="panelBodySix" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div>
                          <?php 
                            $doc = "lecture_document";
                          	$doc = mysqli_real_escape_string($con, "lecture_document" . $row2['lecture_document']);
                          ?>
                          <a href="download.php?file=admin/course_content/<?php echo $_SESSION['cid']; ?>/<?php echo $d; ?>/lecture_document/<?php echo $doc; ?>" style="color: blue;">

                            <!-- <img src="admin/course_content/<?php //echo $cid ?>/Day_1/lecture_document" alt="Lecture Document" width="70" height="80" download="C_Lecture Document_Day_1"> -->
                            <img src="images/file.png" alt="" width="70" height="80">
                            Lecture Document for Day <?php echo $cnt; ?>
                          </a>

                        </div>
                      </div>
                    </div>
                  </div>


                  <?php } if(intval($diff->format("%R%a")) === 0) {


                  ?>

                  <div class="panel">
                  <?php 

                      	if($row2['zoom_link'] !== "") { ?>
                  
                    <div class="panel-heading">
                      <h4 class="panel-title">
                      	
                      		<a href="#panelBodySeven" class="accordion-toggle collapsed" data-toggle="collapse"
                          data-parent="#accordion">Zoom Link</a>
                      	
                        
                      </h4>
                    </div>

                    <?php }                      	

                      	?>
                    <div id="panelBodySeven" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div>
                          <a href="<?php echo $row2['zoom_link'] ?>" target = "_blank" style="color: blue;">
                            <img src="images/zoom.png" alt="" width="70" height="70">
                            <?php echo $row2['zoom_link'] ?>
                          </a>

                        </div>
                      </div>
                    </div>
                  </div>

                <?php }  if(intval($diff->format("%R%a")) > 0) { ?>



                  <div class="row">
                    <div class="col-md-12 form-group">
                      <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Note!</strong> The Course Content for this Day would be Avaiable on the Specified Day
                      </div>
                    </div>
                  </div>

                <?php } ?>


                </div>

                <?php } 

          else { ?>

          	<div class="row">
                <div class="col-md-12 form-group">
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo "<strong>No Course Material Found Related To Day</strong>  " . $cnt; ?>
                  </div>
                </div>
              </div>

          <?php }

          ?>

              </div>

              <?php $cnt += 1;

              }
              ?>

          

              

            </div>
          </div>

        </div>
      </div>
    </div>
    <script>$('#myList a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
      })</script>





    
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
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#51be78" /></svg></div>

  <!-- Video js -->
  <script src="https://vjs.zencdn.net/5.10.4/video.js"></script>

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