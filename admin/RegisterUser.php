<?php
session_start();

include('config.php');

if (!isset($_SESSION['aus'])) {

	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Karachi');
	$currentTime = date('d-m-Y h:i:s A', time());

	$username = $_SESSION['aus'];

	$query1 = mysqli_query($con, "select * from user");
	$query2 = mysqli_query($con, "select * from course");

	if(mysqli_num_rows($query1) === 0) {
		$_SESSION['msg1'] = "<strong>Note!</strong> There are no users to select!";
	}

	if(mysqli_num_rows($query2) === 0) {
		$_SESSION['msg2'] = "<strong>Note!</strong> There are no courses to select!";
	}

	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id'];
		$course_id = $_POST['course_id'];
		$status = intval($_POST['status']);

		$query = mysqli_query($con, "select * from user_reg_courses where user_id = $user_id and course_id = $course_id");

		if(mysqli_num_rows($query) === 1) {
			$query3 = mysqli_query($con, "update user_reg_courses set subscription_status=$status where user_id = $user_id and course_id = $course_id") or die("Update Unsuccessful Retry");

			if($query3) {
				$_SESSION['update'] = "<strong>Update!</strong> The selected user's subscription status has successfully updated to " . $status;
			}
		}

		else {
			$query3 = mysqli_query($con, "INSERT INTO user_reg_courses (user_id, course_id, subscription_status) VALUES ($user_id, $course_id, $status)") or die("Add Unsuccessful Retry");

			if($query3) {
				$_SESSION['add'] = "<strong>Success!</strong> The selected user has been successfully registered into the selected course";
			}
		}
	}
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Register User</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> -->
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!------ Include the above in your HEAD tag ---------->

		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
								<li><a href="DeleteCourse.php"><i class="menu-icon icon-tasks"></i>View Courses</a></li>
								
								<li><a href="AddCourseContent.php"><i class="menu-icon icon-table"></i>Add Course Content </a></li>
								<li><a href="DeleteCourseContent.php"><i class="menu-icon icon-table"></i>View Course Content</a></li>
                                
                                <li><a href="UserDetails.php"><i class="menu-icon icon-table"></i>User Course Details </a></li>
                                <li><a href="RegisterUser.php"><i class="menu-icon icon-table"></i>Register User Course </a></li>
                                <li><a href="ViewUsers.php"><i class="menu-icon icon-table"></i>View Users </a></li>
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
									<h3>Register User Course</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_SESSION['msg1'])) { ?>
										<div class="alert alert-warning">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['msg1']; ?>
											<?php unset($_SESSION['msg1']); ?>
										</div>
									<?php }

									if (isset($_SESSION['msg2'])) { ?>
										<div class="alert alert-warning">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['msg2']; ?>
											<?php unset($_SESSION['msg2']); ?>
										</div>
									<?php }

									if (isset($_SESSION['update'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['update']; ?>
											<?php unset($_SESSION['update']); ?>
										</div>
									<?php }

									if (isset($_SESSION['add'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo $_SESSION['add']; ?>
											<?php unset($_SESSION['add']); ?>
										</div>
									<?php }


									?>

									<br />

									<?php if(mysqli_num_rows($query1) > 0 and mysqli_num_rows($query2) > 0) { ?>

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
										<div class="control-group" style="margin-bottom: 3%;">
											<label class="control-label" for="basicinput">Select User</label>
											<div class="controls">
												<select class="form-control select2" name = "user_id" required>
													<option disabled="true" selected="true" value = "">Select</option>
													<?php while($result = mysqli_fetch_assoc($query1)) { ?>
													<option value = "<?php echo $result['user_id']?>"><?php echo nl2br($result['fullname'] .'<br/> ' .$result['email']);  ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<script>
											$('.select2').select2();
										</script>

										<div class="control-group" style="margin-bottom: 3%;">
											<label class="control-label" for="basicinput">Select Course Name</label>
											<div class="controls">
												<select class="form-control select2" name = "course_id" required>
													<option disabled="true" selected="true" value = "">Select</option>
													<?php while($result = mysqli_fetch_assoc($query2)) { ?>
													<option value = "<?php echo $result['course_id']; ?>"><?php echo $result['course_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<script>
											$('.select2').select2();
										</script>

										<div class="control-group">
											<label class="control-label" for="basicinput">Select Subscription Status </label>
											<div class="controls">
												<select name="status" id="category" required>


													<option value="1">Yes</option>
													<option value="0">No</option>

												</select>
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn btn-success">Register Course</button>
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


				<b class="copyright">&copy; 2020 Doctor's Lab</b>
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