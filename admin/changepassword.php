<?php
session_start();

include('config.php');

if (!isset($_SESSION['aus'])) {

    header('Location: index.php');
} 

else {
    date_default_timezone_set('Europe/London');
    $currentTime = date('d-m-Y h:i:s A', time());

    // echo $_SESSION['aus'];

    if (isset($_POST['submit'])) {
        $username = $_SESSION['aus'];
        $password = md5($_POST['password']);

        $query =  "SELECT * FROM  login where Password='$password' && Username='$username'";
        $sql = mysqli_query($con, $query);
        $num = mysqli_fetch_assoc($sql);
        if (mysqli_num_rows($sql) === 1) {
            $newpassword = md5($_POST['newpassword']);
            $con = mysqli_query($con, "update login set password='$newpassword' where username='$username'");
            $_SESSION['s_msg'] = "Password Changed Successfully!!!";
        } else {
            $_SESSION['d_msg'] = "Old Password not match!!!";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Change Password</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.password.value == "") {
                    alert("Current Password Filed is Empty !!");
                    document.chngpwd.password.focus();
                    return false;
                } else if (document.chngpwd.newpassword.value == "") {
                    alert("New Password Filed is Empty !!");
                    document.chngpwd.newpassword.focus();
                    return false;
                } else if (document.chngpwd.confirmpassword.value == "") {
                    alert("Confirm Password Filed is Empty !!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                } else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
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
                                    <h3>Admin Change Password</h3>
                                </div>
                                <div class="module-body">
                                    <?php if (isset($_SESSION['d_msg'])) { ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo htmlentities($_SESSION['d_msg']); ?>
                                            <?php unset($_SESSION['d_msg']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['s_msg'])) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo htmlentities($_SESSION['s_msg']); ?>
                                            <?php unset($_SESSION['s_msg']); ?>
                                        </div>
                                    <?php } ?>
                                    <br />

                                    <form class="form-horizontal row-fluid" name="chngpwd" method="post" onSubmit="return valid();">

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Current Password</label>
                                            <div class="controls">
                                                <input type="password" placeholder="Enter your current Password" name="password" class="span8 tip" required>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">New Password</label>
                                            <div class="controls">
                                                <input type="password" placeholder="Enter your new current Password" name="newpassword" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Confirm Password</label>
                                            <div class="controls">
                                                <input type="password" placeholder="Enter your new Password again" name="confirmpassword" class="span8 tip" required>
                                            </div>
                                        </div>






                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
			<b class="copyright">&copy; 2020 Doctor's Lab </b>
		</div>
	</div>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    </body>
<?php } ?>