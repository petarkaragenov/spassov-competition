<?php 
	if (!empty($_GET['tid'])) {
		$GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
		$tid = $GET['tid'];
	} else {
		header('Location: home');
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
	<nav class="navbar navbar-dark bg-dark bg-primary">
	  <div class="container">
	  	<a class="navbar-brand" href="#">Home</a>
	  </div>
	</nav>
	<div class="container">
		<h2 class="mt-4">Thank you for your application</h2>
		<hr>
		<p>Your transaction ID is <?php echo $tid; ?></p>
		<p>You will be informed of your approval per email.</p>
		<p><a href="home" class="btn btn-light mt-2">Go Back</a></p>
	</div>
</body>
</html>