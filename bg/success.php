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
	<title>Международен конкурс Проф. Иван Спасов</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark bg-primary">
	  <div class="container">
	  	<a class="navbar-brand" href="home">Home</a>
	  </div>
	</nav>
	<div class="container">
		<h2 class="mt-4">Благодарим за вашето заявление за участие!</h2>
		<hr>
		<p>ID номерът на вашата трансакция е <?php echo $tid; ?></p>
		<p>Очаквайте допълнителна информация на Вашия Email адрес.</p>
		<p><a href="home" class="btn btn-light mt-2">Назад</a></p>
	</div>
</body>
</html>