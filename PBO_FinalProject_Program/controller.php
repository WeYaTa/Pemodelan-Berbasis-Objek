<?php
	include("objects.php");
	session_start();
	
	if(!isset($_GET['param'])) $_GET['param'] = "login";
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>FULCRUM - Log In</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/nice-select.css">					
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		  <header id="header" id="home">
		    <div class="container">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="index.php"><img src="img/Logo/Logo-02.png" width="270" height="45" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
					<?php
					  
					  
					  	if(isset($_SESSION['user']) || isset($_SESSION['fl'])){
							  echo "<li class='menu-active'><a href='controller.php?param=home'>Home</a></li>";
							echo " <li><a href='controller.php?param=listjob'>Jobs List</a></li>";
						} 
							 	if(isset($_SESSION['user'])){
									echo " <li><a href='controller.php?param=postjob'>Post Job</a></li>";
								} 
							  
							 	
					?>
				         
					  <?php
							if($_GET['param'] == "login"){ ?>
			          	<li><a class="ticker-btn" href="controller.php?param=signup">Signup</a></li>			          				  
							<?php } 
								else if($_GET['param'] == "signup") {
							?>	<li><a class="ticker-btn" href="controller.php?param=login">Login</a></li>			          				  
							<?php } 
								else {
									if(isset($_SESSION['user'])){
										echo "<li><a class='ticker-btn' href='controller.php?param=login'>Log Out : ".$_SESSION['user']->username."</a></li>";
									}
									else if(isset($_SESSION['fl'])){
										echo "<li><a class='ticker-btn' href='controller.php?param=login'>Log Out : ".$_SESSION['fl']->username."</a></li>";
									}
									
								}?>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>
		    </div>
		  </header>
<?php
			// echo "<script>alert(\"User\");</script>";
	if($_GET['param'] == "login") {
		session_destroy();
		session_start();
		REQUIRE("login.html");
	}
	else if($_GET['param'] == "signup") REQUIRE("signup.html");
	else if($_GET['param'] == "home" && isset($_SESSION['fl'])) REQUIRE("index.php");
	else if($_GET['param'] == "home" && isset($_SESSION['user'])) REQUIRE("index(user).php");
	else if($_GET['param'] == "listjob" && isset($_SESSION['fl'])) REQUIRE("listjobfreelancer.php");
	else if($_GET['param'] == "listjob" && isset($_SESSION['user'])) REQUIRE("listjobuser.php");
	else if($_GET['param'] == "postjob") REQUIRE("postjob.php");

	if(isset($_POST['login'])){
		$user = new User();
		$fl = new Freelancer();
		
		if($user->fetchUser($_POST['username'],$_POST['password'])) {
			$_SESSION['user'] = $user;
			header('Location: controller.php?param=home');
		}
		else if($fl->fetchFL($_POST['username'],$_POST['password'])){
			echo"<script>alert(\"".$_POST['username'].$_POST['password']."\");</script>";
			$_SESSION['fl'] = $fl;
			header('Location: controller.php?param=home');
		}
		else {
			echo"<script>alert(\"Username or Password wrong ! Probably not registered yet !\");</script>";
		}
	}

	if(isset($_POST['signup'])){
		if($_POST['check'] == "User") {
			$user = new User($_POST['username'], $_POST['name'], $_POST['password'],$_POST['email'],$_POST['institution']);
			
			if($user->createUser()) {
				echo"<script>alert(\"User Created!\");</script>";
				
			}
			else  echo"<script>alert(\"Username taken !\");</script>";
		}
		else if($_POST['check'] == "Freelancer") {
			$fl = new Freelancer($_POST['username'], $_POST['name'], $_POST['password'],$_POST['email'],$_POST['experience']);
			if($fl->createFL()) {
				echo"<script>alert(\"FreeLancer Created!\");</script>";	
			}
				
			else  echo"<script>alert(\"Username taken !\");</script>";
		}
	}

	if(isset($_POST['postjob'])){
		//echo "<script>alert(\"Masok !\");</script>";
		// echo "<script>alert(\"".$_POST['category'].$_POST['desc'].$_POST['budget'].$_SESSION['user']->username."\");</script>";
		$newjob = new Job("",$_POST['category'],$_POST['desc'],$_POST['budget'],$_SESSION['user']->username,"");
		$user = $_SESSION['user'];
		
		if($user->createJob($newjob)){
			echo "<script>alert(\"Job posted !\");</script>";
		}

	}

	if(isset($_GET['action']) && isset($_GET['id'])){
		if($_GET['action'] == "takejob") {
			$_SESSION['fl']->takeJob($_GET['id']);
			echo "<script>alert(\"Job taken!\");</script>";
		}
	}
?>
			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>		
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>



