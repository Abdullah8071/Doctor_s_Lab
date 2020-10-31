<?php 


session_start();

include('config.php');

if (!isset($_SESSION['aus'])) {

    header('location:index.php');
}

if(isset($_GET['userid']) and isset($_GET['email'])) {
    $userid = $_GET['userid'];
    $email = $_GET['email'];

    $query = mysqli_query($con, "DELETE FROM user WHERE user_id = $userid and email = '$email'");   

    if($query) {
        $_SESSION['udelmsg'] = '<strong>Oh snap!</strong> The selected user against the selected course has been deleted successfully!!!';

        header('Location: ViewUsers.php');
    }   
}

if(isset($_GET['userid']) and isset($_GET['courseid'])) {
    $userid = $_GET['userid'];
    $courseid = $_GET['courseid'];

    $query = mysqli_query($con, "DELETE FROM user_reg_courses WHERE user_id = $userid and course_id = $courseid");   

    if($query) {
        $_SESSION['ucdelmsg'] = '<strong>Oh snap!</strong> The selected user against the selected course has been deleted successfully!!!';

        header('Location: UserDetails.php');
    }
}

if(isset($_GET['id']) and isset($_GET['del'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM course WHERE course_id = $id");
    if($query) {
        $_SESSION['delmsg'] = '<strong>Oh snap!</strong> The selected course has been deleted successfully!!!';

        function recurseRmdir($dir) {
          $files = array_diff(scandir($dir), array('.','..'));
          foreach ($files as $file) {
            (is_dir("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
          }
          return rmdir($dir);
        }

        $dir_name = "course_cover_images/$id/";
        $dir = "course_content/$id/";
        if(is_dir($dir_name)) {
        	$files = glob($dir_name . '*', GLOB_MARK);
		    foreach ($files as $file) {
		        if (is_dir($file)) {
		            self::deleteDir($file);
		        } else {
		            unlink($file);
		        }
		    }
		    rmdir($dir_name);
        }

        

        if(is_dir($dir)) {
            recurseRmdir($dir);
        }

        header('Location: DeleteCourse.php');
    }
}

if(isset($_GET['id']) and isset($_GET['day'])) {
    $id = $_GET['id'];
    $day = str_replace(" ", "_", $_GET['day']);

    $query = mysqli_query($con, "DELETE FROM course_content WHERE course_id = $id and course_day = '$day'");
    if($query) {
        function recurseRmdir($dir) {
          $files = array_diff(scandir($dir), array('.','..'));
          foreach ($files as $file) {
            (is_dir("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
          }
          return rmdir($dir);
        }
        $dirr = "course_content/$id/$day/";
        $_SESSION['delconmsg'] = '<strong>Oh snap!</strong> The desired course content has been deleted successfully!!!';
        echo $dirr;
        if(is_dir($dirr)) {
            recurseRmdir($dirr);
        }

    header('Location: DeleteCourseContent.php');
    }
}


?>