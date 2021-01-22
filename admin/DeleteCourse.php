<?php
session_start();

include('config.php');

if (!isset($_SESSION['aus'])) {

    header('Location: index.php');
} 

else {
    date_default_timezone_set('Asia/Karachi');
    $currentTime = date('d-m-Y h:i:s A', time());

    $username = $_SESSION['aus'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | View Courses</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container" style="margin-top:1%">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i>
                    </a>

                    <a class="brand" href="index.php"  style="margin-bottom:2%">
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
                                    <h3>View Courses</h3>
                                </div>
                                <div class="module-body table">
                                    <?php if (isset($_SESSION['delmsg'])) { ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo $_SESSION['delmsg']; ?>
                                            <?php unset($_SESSION['delmsg']);?>

                                        </div>
                                    <?php } ?>

                                    <br />

                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Course Instructor</th>
                                                <th>Course Fee</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $query = mysqli_query($con, "select * from course");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $row['course_id']; ?></td>
                                                    <td><?php echo $row['course_name']; ?></td>
                                                    <td><?php echo $row['course_instructor']; ?></td>
                                                    <td><?php echo '£ . ' . $row['course_fee']; ?></td>
                                                    <td>
                                                        <a href="Del.php?id=<?php echo $row['course_id'] ?>&del=wer62yror82" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
                                                </tr>
                                            <?php $cnt = $cnt + 1;
                                                } ?>
                                    </table>
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