<?php
//include config
require_once('../includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>devForum</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="portfolio, riddle, onepage, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">

	<link rel="stylesheet" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../css/font-awesome.min.css"/>
	<link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
	
	<!-- header section start -->
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
							<li><a href="../index.php">Home</a></li>
							<li><a href="../discussions.php">Discussions</a></li>
							<li><a href="../recentposts.php">Recent Posts</a></li>
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
					<h2 class="section-title">Discussions</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="page-section">
		<div class="container">
			<?php
			try {
				$selectedThread = $_GET['id'];
				$stmt = $db->query("SELECT threadID, threadSubject, threadDate FROM thread WHERE threadID = '$selectedThread'");
				while($row = $stmt->fetch()){
					echo '<h1>'.$row['threadSubject'].'</h1>';
					echo 'Posted on '.$row['threadDate'];
				}
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

			?>
			</div>
			<div class="container">
				
			<?php
				echo '<a href="add-post.php?='.$selectedThread.'"'.' class="site-btn">Add a Post</a>';
			?>

			<br/><br/>
			<h4>REPLIES</h4>

			<?php
			try{
				$stmt = $db->query("SELECT postID, postTitle, postCont, postDate FROM post WHERE threadID = '$selectedThread'");
				while($row = $stmt->fetch()){
					echo '<br/>';
					echo '<div class="card w-100">';
					echo '<div class="card-body">';
					echo '<h5 class="card-title">'.$row['postTitle'].'</h5>';    
					echo '<p class="card-text">'.$row['postCont'].'</p>';
					echo '<p class="card-text"><small class="text-muted">'.$row['postDate'].'</small></p>';
					echo '</div>';
					echo '</div>';
				}
				
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
			?>
			</div>
		</div>
	</section>
</body>
</html>