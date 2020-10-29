<?php

session_start();

include('config.php');

if(isset($_SESSION['aus'])) {
	header('Location: home.php');
}

if($con) {
	if(isset($_POST['submit'])) {
		if(!empty($_POST['username']) and !empty($_POST['password'])) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$query = "SELECT * FROM login WHERE Username = '$username' and Password = '$password' LIMIT 1";
			$rows = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($rows);
			
			if(mysqli_num_rows($rows) === 1) {
				$_SESSION['aus'] = $row['Username'];
				// echo $_SESSION['aus'];
				unset($_SESSION['up_error']);
				header('Location: home.php');
			}
			else {
				$_SESSION['up_error'] = "<strong>Error!</strong> Username or Password is Incorrect ";
			}
		}
	}
}

else {
	echo "Connection with the DataBase couldn't be Established!!!";
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Doctor's Lab | Admin login</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"style="margin-top:1%">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.php"  style="margin-bottom:2%">
                  Doctor's Lab | Admin
                  </a>
				  <a href=""style="margin-left:23%">
                  <img src="images/LOGO1.png" style="width:200px;height:60px;" alt="">
                </a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
						
					</ul> 
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<!-- <span style="color:red;" ></span> -->
						<div class="module-body">
							<?php if (isset($_SESSION['up_error'])) { ?>
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo $_SESSION['up_error']; ?>
									<?php unset($_SESSION['up_error']); ?>
								</div>
							<?php } ?>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputUsername" name="username" placeholder="Username" required>
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
								<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password" required>
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

        <b class="copyright">&copy; 2020 Doctor's Lab </b>
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>