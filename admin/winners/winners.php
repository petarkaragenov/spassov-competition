<?php 
	session_start();

	require_once('../../config/competition_winners.php');
	require_once('../../lib/pdo_db.php');
	require_once('../../models/Winner.php');

	if (isset($_SESSION['logged_in'])) {
		$winner = new Winner;

		$rows = $winner->getDistinctEditions();

		$winners = $winner->getAllWinners(); ?>

		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>View Winners</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
			<link rel="stylesheet" href="../../css/style.css">
		</head>

		<body>
			<div class="btn-group" role="group">
				<a class="btn btn-secondary" href="../participants">Participants</a>
				<a class="btn btn-primary" href="winners">Winners</a>
				<a class="btn btn-secondary" href="../transactions">Transactions</a>
				<a class="btn btn-secondary" href="../logout">Logout</a>
			</div>
			<section class="off-white pt-4 pb-2">
				<div class="container">
					<form action="winners" method="post">
						<div class="row">
							<div class="form-group col col-md-5 flex">
								<label for="category">Category: </label>
								<select class="form-control" name="category">
									<option value="A">A</option>
									<option value="B">B</option>
								</select>
							</div>
							<div class="form-group col col-md-5 flex">
								<label for="edition">Edition: </label>
								<select class="form-control" name="edition">
								<?php 
									for ($i=0; $i<count($rows); $i++) { 
										$suffix;
										if ($i == 0) {
											$suffix = 'st';
										} elseif ($i == 1) {
											$suffix = 'nd';
										} elseif ($i == 2) {
											$suffix = 'rd';
										} else {
											$suffix = 'th';
										} ?>
										<option value=<?php echo $rows[$i]->edition; ?>><?php echo $rows[$i]->edition.$suffix; ?> Edition</option>
									<?php }	?>
								</select>
							</div>
							<div class="col col-2">
								<button class="btn btn-primary" name="submit">Show</button>
							</div>
						</div>
					</form>
				</div>
			</section>
			
			<section class="py-5">
			<?php
				if (isset($_POST['submit'])) {
					$category = $_POST['category'];
					$edition = $_POST['edition'];

					$results = $winner->getWinners($category, $edition); 

					if ($edition == 1) {
							$suffix = 'st';
						} elseif ($edition == 2) {
							$suffix = 'nd';
						} elseif ($edition == 3) {
							$suffix = 'rd';
						} else {
							$suffix = 'th';
						}
			?>
					<h2 class="pb-4">Winners of the <?php echo $edition; ?><sup><?php echo $suffix; ?></sup> Edition in Category <?php echo $category; ?></h2>
			<?php
				} else {
					$results = $winner->getAllWinners(); ?>
					<h2 class="pb-4">All Winners</h2>
					<?php
				} ?>
					<div class="py-3 clearfix">
						<a href="add" class="btn btn-success text-white float-right">Add New Record</a>
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="text-dark">ID</th>
								<th class="text-dark">Name</th>
								<th class="text-dark">Country</th>
								<th class="text-dark">Work</th>
								<th class="text-dark">Prize</th>
								<th class="text-dark">Edition</th>
								<th colspan="2" class="text-dark">Controls</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($results as $result): ?>
							
							<tr>
								<td><?php echo $result->id; ?></td>
								<td><?php echo $result->name; ?></td>
								<td><?php echo $result->country; ?></td>
								<td><?php echo $result->work; ?></td>
								<td><?php echo $result->prize; ?></td>
								<td><?php echo $result->edition; ?></td>
								<td><a href=<?php echo "edit?id=".$result->id; ?> class="btn btn-info text-white">Edit</a></td>
								<td>
									<form id="deleteForm" action="delete" method="post">
										<input name="delete_id" value=<?php echo $result->id; ?> type="hidden">
										<button class="btn btn-danger">Delete</button>
									</form>
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>

					</table>
			</section>
			<script src="js/confirm.js"></script>
		</body>
		</html>

		<?php
	} else {
		header('Location: ../index');
	}
	
?>