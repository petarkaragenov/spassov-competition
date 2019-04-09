<?php 
	session_start();

	require_once('../../config/competition_winners.php');
	require_once('../../lib/pdo_db.php');
	require_once('../../models/Winner.php');

	if (isset($_SESSION['logged_in'])) {
		$winner = new Winner;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New record</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<section class="pb-5 off-white">
	<a class="btn btn-primary" href="winners">< Back</a>
		<div class="container">
			<h2 class="display-4 text-center">Add Record</h2>
			<div class="card my-4">
				<div class="card-body">
					<h4 class="card-title text-center mb-4">Add Record Form</h4>
					<form action="add.php" method="post">
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="name">Name: </label>
							</div>
							<div class="col col-md-9">
								<input id="name" name="name" type="text" class="form-control" placeholder="Georgi Ivanov">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="country">Country: </label>
							</div>
							<div class="col col-md-9">
								<input id="country" name="country" type="text" class="form-control" placeholder="Bulgaria">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="work">Work: </label>
							</div>
							<div class="col col-md-9">
								<input id="work" name="work" type="text" class="form-control" placeholder="Piano Sonata">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="category">Category: </label>
							</div>
							<div class="col col-md-9">
								<input id="category" name="category" type="text" class="form-control" placeholder="A">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="prize">Prize: </label>
							</div>
							<div class="col col-md-9">
								<input id="prize" name="prize" type="text" class="form-control" placeholder="1. Prize">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="edition">Edition: </label>
							</div>
							<div class="col col-md-9">
								<input id="edition" name="edition" type="number" class="form-control" placeholder="8">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row">
							<button name="submit" class="btn btn-block btn-success px-0">Add Record</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="../../lib/validation.js"></script>
	<script src="js/validateForm.js"></script>
		
</body>
</html>


<?php 
	
		if (isset($_POST['submit'])) {

			$name = $_POST['name'];
			$country = $_POST['country'];
			$work = $_POST['work'];
			$category = $_POST['category'];
			$prize = $_POST['prize'];
			$edition = $_POST['edition'];

			$newRecordData = [
				'name' => $name,
				'country' => $country,
				'work' => $work,
				'category' => $category,
				'prize' => $prize,
				'edition' => $edition
			];

			$winner->addWinner($newRecordData);
			header('Location: winners');
		}

	} else {
		header('Location: ../../home');
	}
?>