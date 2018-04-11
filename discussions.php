<?php
//include config
require_once('includes/config.php');

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM thread WHERE threadID = :threadID') ;
	$stmt->execute(array(':threadID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 
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

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/style.css"/>
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
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Discussions</a></li>
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
					<h2 class="section-title">Discussions</h2>
					<a href="admin/add-discussion.php" class="site-btn">Add a discussion</a>
				</div>
			</div>
		</div>
	</section>

	<section class="page-section">
		<div class="container">
			<div class="row">
			<?php
			try {

				$stmt = $db->query('SELECT threadID, threadSubject, threadDate FROM thread ORDER BY threadID DESC');
				while($row = $stmt->fetch()){
					echo '<div class="col-sm-6">';
					echo '<div class="card">';
					echo '<div class="card-body">';
					echo '<h5 class="card-title"> #'.$row['threadID'].' '.$row['threadSubject'].'</h5>';
					echo '<a href="admin/posts.php?id='.$row['threadID'].'"'.' class="card-link">View</a>';
					echo '</div>';
					echo '<div class="card-footer text-muted">';
					echo 'Posted on '.$row['threadDate'];
  					echo '</div>';
					echo '</div>';
					echo '<br/>';
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