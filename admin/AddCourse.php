<?php
session_start();

include('config.php');

if (!isset($_SESSION['aus'])) {

    header('location:index.php');
} 

else {
    date_default_timezone_set('Asia/Karachi');
    $currentTime = date('d-m-Y h:i:s A', time());

    $username = $_SESSION['aus'];

    if (isset($_POST['submit'])) {
    	$course_name = mysqli_real_escape_string($con, $_POST['coursename']);
		$course_instructor = mysqli_real_escape_string($con, $_POST['courseinstructor']);
		$course_fee = $_POST['coursefee'];
		$course_description = mysqli_real_escape_string($con, $_POST['coursedescription']);
		$starting_date = mysqli_real_escape_string($con, $_POST['startingdate']);
		$course_cover_image = mysqli_real_escape_string($con, $_FILES["coursecoverimage"]["name"]);

		$course_cover_image = str_replace(" ", "_", $course_cover_image);

		//for getting cause id
		$query = mysqli_query($con, "Select max(course_id) as pid from course");
		$result = mysqli_fetch_assoc($query);
		$course_id = $result['pid'] + 1;
		$dir = "course_cover_images/$course_id";
		if (!is_dir("course_cover_images/$course_id")) {
			mkdir("course_cover_images/$course_id", 0777, true);
		}

		move_uploaded_file($_FILES["coursecoverimage"]["tmp_name"], "course_cover_images/$course_id/$course_cover_image");
		$query = "INSERT INTO course (course_id,course_name,course_instructor,course_fee,course_description,starting_date,course_cover_image) VALUES ('$course_id','$course_name','$course_instructor','$course_fee','$course_description','$starting_date','$course_cover_image')";
		$sql = mysqli_query($con, $query) or die("Unsuccessful Retry");
		$_SESSION['msg'] = "<strong>Well done! </strong>Course Inserted Successfully!!!";
    }
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Add Course</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> -->
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>
   		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container" style="margin-top:1%">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<i class="icon-reorder shaded"></i>
					</a>

                    <a class="brand" href="index.php" style="margin-bottom:2%">
					Doctor's Lab | Admin
                        </a>
						<a href=""style="margin-left:19%">
						<img src="images/LOGO1.png" style="width:250px;height:70px;" alt="">
					</a>

					<div class="nav-collapse collapse navbar-inverse-collapse">
						<ul class="nav pull-right">
							<li><a href="#">
									Admin
								</a></li>
							<li class="nav-user dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="images/admin.png" class="nav-avatar" />
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="changepassword.php">Change Password</a></li>
									<li class="divider"></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.nav-collapse -->
				</div>
			</div><!-- /navbar-inner -->
		</div><!-- /navbar -->


		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="span3">
						<div class="sidebar">
						<ul class="widget widget-menu unstyled" style="background-color: white">
								<li><a href="AddCourse.php"><i class="menu-icon icon-tasks"></i>Add Course</a></li>
								<li><a href="DeleteCourse.php"><i class="menu-icon icon-tasks"></i>Delete Course</a></li>
								
								<li><a href="AddCourseContent.php"><i class="menu-icon icon-table"></i>Add Course Content </a></li>
								<li><a href="DeleteCourseContent.php"><i class="menu-icon icon-table"></i>Delete Course Content</a></li>
                                
                                <li><a href="UserDetails.php"><i class="menu-icon icon-table"></i>User Course Details </a></li>
                                <li><a href="RegisterUser.php"><i class="menu-icon icon-table"></i>Register User Course </a></li>
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout</a></li>
		
							</ul>
						</div>
						<!--/.sidebar-->
					</div>
					<!--/.span3-->

					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Add Course</h3>
								</div>
								<div class="module-body">

									<?php if(isset($_SESSION['msg'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['msg']; ?>
											<?php unset($_SESSION['msg']); ?>
										</div>
									<?php } 
										

									?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
										<div class="control-group">
											<label class="control-label" for="basicinput">Course Name</label>
											<div class="controls">
												<input type="text" name="coursename" placeholder="Enter Course Name" class="span8 tip" required>
											</div>
                                        </div>
                                        
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Course Instructor</label>
											<div class="controls">
												<input type="text" name="courseinstructor" placeholder="Enter Course Instructor" class="span8 tip" required>
											</div>
                                        </div>
                                        
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Course Fee</label>
											<div class="controls">
												<input type="number" name="coursefee" placeholder="Enter Course Fee" class="span8 tip" required>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Course Description</label>
											<div class="controls">
												<textarea name="coursedescription" placeholder="Enter Course Description" rows="6" class="span8 tip"></textarea>
											
											</div>
										</div>

										
										<div class="control-group">
											<label class="control-label" for="basicinput">Starting Date</label>
											<div class="controls">
												<input type="date" name="startingdate" class="span8 tip" id="startingdate" onchange = "myFunction()" required>
											</div>
										</div>

										<!-- <div class="control-group">
											<label class="control-label" for="basicinput">Ending Date</label>
											<div class="controls">
												<input disabled="true" type="date" name="endingdate" class="span8 tip" id="endingdate" required>
											</div>
										</div> -->


										<div class="control-group">
											<label class="control-label" for="basicinput">Course Cover Image</label>
											<div class="controls">
												<input type="file" accept="image/*" name="coursecoverimage" id="productimage1" value="" class="span8 tip" required>
											</div>
										</div>


										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn btn-success">Add</button>
											</div>
										</div>

										

									</form>
								</div>
							</div>





						</div>
						<!--/.content-->
					</div>
					<!--/.span9-->
				</div>
			</div>
			<!--/.container-->
		</div>
		<!--/.wrapper-->

		<div class="footer">
			<div class="container">


				<b class="copyright">&copy; 2020 Doctor's Lab</b>
			</div>
		</div>

		<script type="text/javascript">
			function myFunction()
			    {
			        var input = document.getElementById('startingdate')
			        var div = document.getElementById('endingdate');
			        var val = new Date();
			        // val.setDate(input + 14);
			        div.value = (new Date(input.value), "yyyy-MM-dd");
			    }
		</script>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
	<?php } ?>