<?php 
	session_start();

	require_once('../../config/competition_winners.php');
	require_once('../../lib/pdo_db.php');
	require_once('../../models/Winner.php');

	if (isset($_SESSION['logged_in'])) {
		$winner = new Winner;

		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			$single = $winner->getSingleWinner($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Record</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<section class="pb-5 off-white">
	<a class="btn btn-primary" href="winners">< Back</a>
		<div class="container">
			<h2 class="display-4 text-center">Edit Record</h2>
			<div class="card my-4">
				<div class="card-body">
					<h4 class="card-title text-center mb-4">Edit Record Form</h4>
					<form action="edit.php" method="post">
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="name">Name: </label>
							</div>
							<div class="col col-md-9">
								<?php echo "<input id='name' name='name' type='text' class='form-control' value='$single->name'>"; ?>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="country">Country: </label>
							</div>
							<div class="col col-md-9">
								<input id="country" name="country" type="text" class="form-control" value=<?php echo $single->country; ?>>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="work">Work: </label>
							</div>
							<div class="col col-md-9">
								<?php echo "<input id='work' name='work' type='text' class='form-control' value='$single->work'>"; ?>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="category">Category: </label>
							</div>
							<div class="col col-md-9">
								<input id="category" name="category" type="text" class="form-control" value=<?php echo $single->category; ?>>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="prize">Prize: </label>
							</div>
							<div class="col col-md-9">
								<?php echo "<input id='prize' name='prize' type='text' class='form-control' value='$single->prize'>"; ?>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col col-md-3">
								<label for="edition">Edition: </label>
							</div>
							<div class="col col-md-9">
								<input id="edition" name="edition" type="number" class="form-control" value=<?php echo $single->edition; ?>>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<input type="hidden" name="id" value=<?php echo $single->id; ?>>
						<div class="row">
							<button name="update" type="submit" class="btn btn-block btn-success px-0">Update Record</button>
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
		} else {
			header('Location: winners');
		}

		if (isset($_POST['update'])) {

			$name = $_POST['name'];
			$country = $_POST['country'];
			$work = $_POST['work'];
			$category = $_POST['category'];
			$prize = $_POST['prize'];
			$edition = $_POST['edition'];
			$id = $_POST['id'];

			$updateRecordData = [
				'name' => $name,
				'country' => $country,
				'work' => $work,
				'category' => $category,
				'prize' => $prize,
				'edition' => $edition,
				'id' => $id
			];

			$result = $winner->updateWinner($updateRecordData);
			var_dump($result);

			header('Location: winners');
		}

	} else {
		header('Location: ../../home');
	}
?>