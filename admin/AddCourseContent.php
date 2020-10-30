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
    	$course_name = mysqli_real_escape_string($con, $_POST['course_name']);
		$course_day = mysqli_real_escape_string($con, $_POST['course_day']);
		$lecture_name = mysqli_real_escape_string($con, $_POST['lecture_name']);
		$zoom_link = mysqli_real_escape_string($con, $_POST['zoom_link']);
		$video_1_name = mysqli_real_escape_string($con, $_POST['video_1_name']);
		$video_1 = $_FILES["video_1"]["name"];
		$video_2_name = mysqli_real_escape_string($con, $_POST['video_2_name']);
		$video_2 = $_FILES["video_2"]["name"];
		$video_3_name = mysqli_real_escape_string($con, $_POST['video_3_name']);
		$video_3 = $_FILES["video_3"]["name"];
		$video_4_name = mysqli_real_escape_string($con, $_POST['video_4_name']);
		$video_4 = $_FILES["video_4"]["name"];
		$video_5_name = $_POST['video_5_name'];
		$video_5 = $_FILES["video_5"]["name"];
		$lecture_document = mysqli_real_escape_string($con, $_FILES["lecture_document"]["name"]);


		$video_1 = str_replace(" ", "_", $video_1);
		$course_day = str_replace(" ", "_", $course_day);

		if(!empty($video_2)) {
			$video_2 = str_replace(" ", "_", $video_2);
		}
		if(!empty($video_3)) {
			$video_3 = str_replace(" ", "_", $video_3);
		}
		if(!empty($video_4)) {
			$video_4 = str_replace(" ", "_", $video_4);
		}
		if(!empty($video_5)) {
			$video_5 = str_replace(" ", "_", $video_5);
		}

		$lecture_document = str_replace(" ", "_", $lecture_document);

		//for getting content id
		$query = mysqli_query($con, "Select max(course_content_id) as pid from course_content");
		$result = mysqli_fetch_assoc($query);
		$course_content_id = $result['pid'] + 1;

		//for getting course id
		$query2 = mysqli_query($con, "Select course_id from course where course_name = '$course_name' limit 1");
		$result2 = mysqli_fetch_assoc($query2);
		$course_id = $result2['course_id'];

		$dir = "course_content/$course_id/$course_day";
		if (!is_dir("course_content/$course_id/$course_day")) {
			mkdir("course_content/$course_id/$course_day/videos/video_1", 0777, true);
			mkdir("course_content/$course_id/$course_day/videos/video_2", 0777, true);
			mkdir("course_content/$course_id/$course_day/videos/video_3", 0777, true);
			mkdir("course_content/$course_id/$course_day/videos/video_4", 0777, true);
			mkdir("course_content/$course_id/$course_day/videos/video_5", 0777, true);
			mkdir("course_content/$course_id/$course_day/lecture_document", 0777, true);
		}

		move_uploaded_file($_FILES["video_1"]["tmp_name"], "course_content/$course_id/$course_day/videos/video_1/video_1".$video_1);

		if(!empty($video_2)) {
			move_uploaded_file($_FILES["video_2"]["tmp_name"], "course_content/$course_id/$course_day/videos/video_2/video_2".$video_2);
		}

		if(!empty($video_3)) {
			move_uploaded_file($_FILES["video_3"]["tmp_name"], "course_content/$course_id/$course_day/videos/video_3/video_3".$video_3);
		}

		if(!empty($video_4)) {
			move_uploaded_file($_FILES["video_4"]["tmp_name"], "course_content/$course_id/$course_day/videos/video_4/video_4".$video_4);
		}

		if(!empty($video_5)) {
			move_uploaded_file($_FILES["video_5"]["tmp_name"], "course_content/$course_id/$course_day/videos/video_5/video_5".$video_5);
		}

		move_uploaded_file($_FILES["lecture_document"]["tmp_name"], "course_content/$course_id/$course_day/lecture_document/lecture_document".$lecture_document);


		$query3 = "INSERT INTO course_content (course_content_id, course_id, course_name, course_day, lecture_name, zoom_link, video_1_name, video_1, video_2_name, video_2, video_3_name, video_3, video_4_name, video_4, video_5_name, video_5, lecture_document) VALUES ('$course_content_id', '$course_id', '$course_name', '$course_day', '$lecture_name','$zoom_link', '$video_1_name', '$video_1', '$video_2_name', '$video_2', '$video_3_name', '$video_3', '$video_4_name', '$video_4', '$video_5_name', '$video_5', '$lecture_document')";
		$sql = mysqli_query($con, $query3) or die("Unsuccessful Retry");
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
									<h3>Add Course Content</h3>
								</div>
								<div class="module-body">

									

									<?php 
										$query1 = mysqli_query($con, "Select course_name from course");
										if(mysqli_num_rows($query1) === 0) { 
											echo "<div class='alert alert-warning'>
										<button type='button' class='close' data-dismiss='alert'>×</button>
												<strong>Note!</strong> There are no Courses to select!
											</div>";
										 } else {


										 	 if(isset($_SESSION['msg'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['msg']; ?>
											<?php unset($_SESSION['msg']); ?>
										</div>
									<?php } 
										else { ?>
											<div class="alert alert-warning">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<?php echo "<strong>Note! </strong>please do select the course and it's day carefully"; ?>
											</div>
										<?php }
									
									?>

									<br />

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
                                    
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Select Course</label>
											<div class="controls">
												<select name="course_name" id="category" required>
													<?php
													while($result = mysqli_fetch_assoc($query1)) { ?> 
														<option value = "<?php echo $result['course_name']; ?>"><?php echo $result['course_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div> 
                                        
										<div class="control-group">
											<label class="control-label" for="basicinput">Select Day</label>
											<div class="controls">
												<select name="course_day" id="category" required>
													<option value="Day 1">Day 1</option>
													<option value="Day 2">Day 2</option>
													<option value="Day 3">Day 3</option>
													<option value="Day 4">Day 4</option>
													<option value="Day 5">Day 5</option>
													<option value="Day 6">Day 6</option>
													<option value="Day 7">Day 7</option>
													<option value="Day 8">Day 8</option>
													<option value="Day 9">Day 9</option>
													<option value="Day 10">Day 10</option>
													<option value="Day 11">Day 11</option>
													<option value="Day 12">Day 12</option>
													<option value="Day 13">Day 13</option>
													<option value="Day 14">Day 14</option>
													<option value="Day 15">Day 15</option>
												</select>
											</div>
										</div> 

										<div class="module" style = "margin-top: 25px;">
											<div class="module-head">
												<h3>Enter Course Content For Selected Day</h3>
											</div>
											<div class="module-body">
												<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Name</label>
											<div class="controls">
												<input type="text" name="lecture_name" placeholder="Enter Lecture Name" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Zoom Link</label>
											<div class="controls">
												<input type="text" name="zoom_link" placeholder="Enter Zoom Link" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 1 Name</label>
											<div class="controls">
												<input type="text" name="video_1_name" placeholder="Enter Lecture Video Name" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 1<i class="fas fa-wifi-1    "></i></label>
											<div class="controls">
												<input type="file" accept="video/*" name="video_1" id="productimage1" class="span8 tip" required>
											
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 2 Name (optional)</label>
											<div class="controls">
												<input type="text" name="video_2_name" placeholder="Enter Lecture Video Name" class="span8 tip">
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 2 (optional)</label>
											<div class="controls">
												<input type="file" accept="video/*" name="video_2" id="productimage1" class="span8 tip">
											
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 3 Name (optional)</label>
											<div class="controls">
												<input type="text" name="video_3_name" placeholder="Enter Lecture Video Name" class="span8 tip">
											</div>
										</div>
										
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 3 (optional)</label>
											<div class="controls">
												<input type="file" accept="video/*" name="video_3" id="productimage1" class="span8 tip">
											
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 4 Name (optional)</label>
											<div class="controls">
												<input type="text" name="video_4_name" placeholder="Enter Lecture Video Name" class="span8 tip">
											</div>
										</div>
										
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 4 (optional)</label>
											<div class="controls">
												<input type="file" accept="video/*" name="video_4" id="productimage1" class="span8 tip">
											
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 5 Name (optional)</label>
											<div class="controls">
												<input type="text" name="video_5_name" placeholder="Enter Lecture Video Name" class="span8 tip">
											</div>
										</div>
										
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Video 5 (optional)</label>
											<div class="controls">
												<input type="file" accept="video/*" name="video_5" id="productimage1" class="span8 tip">
											
											</div>
										</div>
                                        
                                        <div class="control-group">
											<label class="control-label" for="basicinput">Lecture Document</label>
											<div class="controls">
												<input type="file" name="lecture_document" id="productimage1" value="" class="span8 tip" required>
											</div>
										</div>


										
											</div>

										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn btn-success">Add</button>
											</div>
										</div>
									</form>

								<?php } ?>
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


				<b class="copyright">&copy; 2020 Doctor's Lab </b>
			</div>
		</div>

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