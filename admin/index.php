<?php
	session_start();

	require_once('../config/db.php');
	require_once('../lib/pdo_db.php');
	require_once('../models/User.php');

	if (isset($_SESSION['logged_in'])) { 
		header('Location: participants.php');
	} else { 
			if (isset($_POST['username'], $_POST['password'])) {
				$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

				$username = $POST['username'];
				$password = md5($POST['password']);

				if (empty($username) or empty($password)) {
					$error = 'All fields are required';
				} else {
					$userData = [
						'username' => $username,
						'password' => $password
					];

					$admin = new User;
					$num = $admin->getUsers($userData);

					if ($num === 1) {
						$_SESSION['logged_in'] = true;
						header('Location: index.php');
						exit();
					} else {
						$error = 'Incorrect details';
					}
				}
			}
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
			<link rel="stylesheet" href="../css/style.css">
		</head>
		<body>
			<nav class="navbar navbar-dark bg-dark">
			  <div class="container">
			  	<a class="navbar-brand" href="../home">Home</a>
			  </div>
			</nav>
			<div class="card my-4" style="width: 40%">
			  <div class="card-body">
			    <h4 class="card-title text-center mb-4">Login</h4>

			    <?php
					if (isset($error)) { ?>
						<h6 class="card-subtitle mb-4 text-center text-danger"><?php echo $error; ?></h6>
				<?php } ?>

			    <form action="index.php" method="post">
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="username">Username: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="username" id="username">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="password">Password: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="password" class="form-control" name="password" id="password">
					    </div>
					</div>
					<button name="submit" class="btn btn-success btn-block">Login</button>
			    </form>
		</body>
		</html>
	<?php }
?>
