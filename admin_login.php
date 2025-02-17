<?php

include './database/config.php';
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: admin/dashboard.php");
}

if (isset($_POST['submit'])) {

    $error = "";
    $cls="";

	$username = $_POST['username'];
	$password = $_POST['password'];
    $date= date("l jS \of F Y h:i:s A");

    
	$sql = "SELECT * FROM admin WHERE username='$username'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {

        $sql = "SELECT * FROM admin WHERE `password`='$password'";
        $result = mysqli_query($conn, $sql);
    
        if ($result->num_rows > 0) {
            $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
        
            if ($result->num_rows > 0) {
                $_SESSION['adminname'] = $_POST['username'];

                $sql = "INSERT INTO recent(`image`, `name`, `role`,date) VALUES ((SELECT `admin_img` FROM admin WHERE username='$username'), '$username', 'Admin','$date')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    header("Location: admin/dashboard.php");
                }
                
            } else {
                $error="Woops! Someting Went Wrong.";
                $cls="danger";

            }
    
        } else {
            $error= "Woops! Password is Incorrect.";
            $cls="danger";

        }

	} else {
		$error= "Woops! Username is Incorrect.";
        $cls="danger";

	}
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>EveCode | Admin Login</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="dashboard/css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="dashboard/css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="dashboard/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="dashboard/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="dashboard/css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="light" style="margin: 0; height: 100%; overflow: hidden">
    <div class="wrapper vh-100" style="">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto" action="" method="POST">


                <h1 class="h1 mb-3 text-center" style="padding-bottom:20px;">Sign in</h1>
                <div class="alert alert-<?php echo $cls;?>"style="font-size:15px;">
                    <?php 
                        if (isset($_POST['submit'])){
                            echo $error;
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Username</label>
                    <input type="text" id="inputEmail" name="username" class="form-control form-control-lg" placeholder="Username"
                        required>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control form-control-lg"
                        placeholder="Password" required>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Stay logged in </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Let me in</button>

                <p class="mt-5 mb-3 text-muted text-center">Copyright © EveCode 2022</p>
            </form>
        </div>
    </div>
    <script src="dashboard/js/jquery.min.js"></script>
    <script src="dashboard/js/popper.min.js"></script>
    <script src="dashboard/js/moment.min.js"></script>
    <script src="dashboard/js/bootstrap.min.js"></script>
    <script src="dashboard/js/simplebar.min.js"></script>
    <script src='dashboard/js/daterangepicker.js'></script>
    <script src='dashboard/js/jquery.stickOnScroll.js'></script>
    <script src="dashboard/js/tinycolor-min.js"></script>
    <script src="dashboard/js/config.js"></script>
    <script src="dashboard/js/apps.js"></script>
    
</body>

</html>
</body>

</html>