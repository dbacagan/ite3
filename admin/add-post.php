<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Post</title>
  	<meta charset="UTF-8">
	<meta name="keywords" content="portfolio, riddle, onepage, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="img/favicon.ico" rel="shortcut icon"/>

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">

	<link rel="stylesheet" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../css/font-awesome.min.css"/>
	<link rel="stylesheet" href="../css/style.css"/>
  	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  	<script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  	</script>
</head>
<body>

<div id="wrapper">
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
					<a href="logout.php" class="site-btn header-btn">Log-out</a>
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
					<h2 class="section-title">Add a Post</h2>
				</div>
			</div>
		</div>
	</section>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);


		//very basic validation
		if($threadSubject ==' '){
			$error[] = 'Please enter the subject.';
		}

		if(!isset($error)){

			try {
				$selectedThread = $_GET['id'];

				$stmt = $db->prepare("INSERT INTO post (postTitle, postCont, postDate, threadID) VALUES (:postTitle, :postCont, :postDate, :threadID)") ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s'),
					':threadID' => $selectedThread
				));

				//redirect to index page
				header('Location: index.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>
	
	<div class="container">
	<form action='' method='post'>
		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>
		<p><label>Content</label><br />
		<textarea  name='postCont' value='<?php if(isset($error)){ echo $_POST['postCont'];}?>'></textarea></p>
		<p><input type='submit' name='submit' value='Submit' class='site-btn'></p>
	</form>
	
</div>
