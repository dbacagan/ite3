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
							<li><a href="index.php">Home</a></li>
							<li><a href="discussions.php">Discussions</a></li>
							<li><a href="#">Recent Posts</a></li>
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
					<h2 class="section-title">Recent Posts</h2>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
	<?php
		try {
			$stmt = $db->query('SELECT * FROM post ORDER BY postID LIMIT 5');
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
</body>
</html>