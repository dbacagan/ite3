<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>devForum</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="img/favicon.ico" rel="shortcut icon"/>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/style.css"/>

	<style>
	.pimg1{
		position:relative;
		opacity:0.70;
		background-position:center;
		background-size:cover;
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-image:url('images/4.jpg');
		min-height: 400px;
	}

	.section{
		text-align:center;
		padding:50px 80px;
	}	

	</style>
</head>
<body>
	<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-3">
					<div class="logo">
						<h2 class="site-logo">devForum</h2>
					</div>
				</div>
				<div class="col-lg-8 col-md-9">
					<?php 
					if(!$user->is_logged_in()){ 
						echo '<a href="admin/login.php" class="site-btn header-btn">Log-in</a>';
				    } else {
						echo '<a href="admin/logout.php" class="site-btn header-btn">Log-out</a>';
					}
					?>
					
					<nav class="main-menu">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="discussions.php">Discussions</a></li>
							<li><a href="recentposts.php">Recent Posts</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
	</header>

	<section class="intro-section">
		<div class="container text-center">
			<div class="row">
				<div class="col-xl-10 offset-xl-1">
					<h2 class="section-title">Let's talk about the latest web developments.</h2>
				</div>
				<section class="section">
					<p>Join a community of like-minded web developers from around the world. It is a place to collaborate, discuss new web trends, get feedback, and share your ideas.
					</p>
					<a href="discussions.php" class="site-btn">Discuss</a>
				</section>
			</div>
		</div>
	</section>

	<div class="pimg1">
	</div>

	<section class="section">

	</section>

	<section class="portfolio-section">
		<div class="container">
			<p>Discuss the latest developments.</p>
		</div> 
		<div class="container">                      
			<div class="row">
				<div class="col-md-4">
					<img src="images/1.jpg">
					<br>
				</div>
				<div class="col-md-4">
					<img src="images/2.jpg">
				</div>
				<div class="col-md-4">
					<img src="images/3.jpg">
				</div>
			</div>
		</div>
	</section>
		
</body>
</html>