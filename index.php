<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Travel Agency</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	include_once('pages/functions.php');
	?>
    <header class="col-sm-12 col-md-12 col-lg-12">
<!--        --><?php
        //
        //        include_once("pages/login.php");
        //
        //        ?>
    </header>
	<nav  class="navbar navbar-default">
            <?php
            include_once('pages/menu.php');
            include_once("pages/login.php");
            ?>

	</nav>
	<div class="content">
		<?php
		if(isset( $_GET['page'] ))
		{
		    $radmin = $_SESSION['radmin'];
			$page=$_GET['page'];
			if($page == 1) include_once("pages/tours.php");
			if($page == 2) include_once("pages/comments.php");
			if($page == 3) include_once("pages/register.php");

            if(isset($_SESSION['radmin']))
            {
                if($page == 4) include_once("pages/countries.php");

                if($page == 5) include_once("pages/hotels.php");

                if($page == 6) include_once("pages/admin.php");

                if($page==7) include_once("pages/private.php");
            }
		}
		?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>