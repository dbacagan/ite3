<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
	<title>devForum</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="img/favicon.ico" rel="shortcut icon"/>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">
	<link rel="stylesheet" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../css/font-awesome.min.css"/>
	<link rel="stylesheet" href="../css/magnific-popup.css"/>
	<link rel="stylesheet" href="../css/style.css"/>
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
					<a href="admin/login.php" class="site-btn header-btn">Log-in</a>
					<nav class="main-menu">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="discussions.php">Discussions</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
	</header>
<div id="wrapper">
	
	<?php include('menu.php');?>

	<h2>Add User</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if($password ==''){
			$error[] = 'Please enter the password.';
		}

		if($passwordConfirm ==''){
			$error[] = 'Please confirm the password.';
		}

		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if(!isset($error)){

			$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO members (username,password) VALUES (:username :password)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword
				));

				//redirect to index page
				header('Location: users.php?action=added');
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

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Password</label><br />
		<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>

		<p><input type='submit' name='submit' value='Add User'></p>

	</form>

</div>
