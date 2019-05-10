<?php 

	require_once('../config/competition_winners.php');
	require_once('../lib/pdo_db.php');
	require_once('../models/Winner.php');

	$winner = new Winner;
	$rows = $winner->getDistinctEditions();
?>

<?php include_once('../includes/head_bg.php'); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">

		<button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#mainNavigation" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>

	  	<div class="container">
	  		<div class="collapse navbar-collapse" id="mainNavigation">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item">
			        <a class="nav-link" href="home">Начало</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#requirements">Условия за участие</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#jury">Жури</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#prizes">награди</a>
			      </li>
			      <li class="nav-item active">
			        <a class="nav-link" href="winners">Победители</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="contact">Контакт</a>
			      </li>
			      <li class="nav-item d-lg-none">
			        <a class="nav-link" href="apply">Записване</a>
			      </li>
			    </ul>
	      		<a href="apply" class="btn btn-secondary my-2 my-sm-0 d-none d-lg-block">Записване</a>
	      		<a href="../en/winners" class="text-white ml-2 d-none d-lg-block">EN</a>
	      		<a href="../bg/winners" class="text-white ml-3 d-none d-lg-block">BG</a>
	  		</div>
	  	</div>
	  	
	</nav>
	<section class="mt-extra pt-3 pt-md-5 pb-2 off-white">
		<div class="container">
			<form action="winners" method="post">
				<div class="row">
					<div class="form-group col col-12 col-md-5 flex">
						<label for="category">Категория: </label>
						<select class="form-control" name="category">
							<option value="A">A</option>
							<option value="B">Б</option>
						</select>
					</div>
					<div class="form-group col col-12 col-md-5 flex">
						<label for="edition">Издание: </label>
						<select class="form-control" name="edition">
						<?php 
							for ($i=0; $i<count($rows); $i++) { 
								$suffix;
								if ($i == 0) {
									$suffix = 'во';
								} elseif ($i == 1) {
									$suffix = 'ро';
								} elseif ($i == 6 || $i == 7) {
									$suffix = 'мо';
								} else {
									$suffix = 'то';
								} ?>
								<option value=<?php echo $rows[$i]->edition; ?>><?php echo $rows[$i]->edition.$suffix; ?> издание</option>
							<?php }	?>
						</select>
					</div>
					<div class="col col-12 col-md-2">
						<button class="btn btn-block btn-primary" name="submit">Покажи</button>
					</div>
				</div>
			</form>
		</div>

	</section>
	<section class="py-3 py-md-5">
		<div class="container">

			<?php 
				if (isset($_POST['submit'])) {
					$category = $_POST['category'];
					$edition = $_POST['edition'];

					$results = $winner->getWinners($category, $edition); 

					if ($edition == 1) {
							$suffix = 'во';
						} elseif ($edition == 2) {
							$suffix = 'ро';
						} elseif ($edition == 7 || $edition == 8) {
							$suffix = 'мо';
						} else {
							$suffix = 'то';
						}
			?>
					<h2 class="pb-4">Победители от <?php echo $edition; ?><sup><?php echo $suffix; ?></sup> издание в категория <?php echo $category; ?></h2>
			<?php
				} else {
					$results = $winner->getWinners('A', count($rows)); ?>
					<h2 class="pb-4">Победители от <?php echo count($rows); ?><sup>то</sup> издание в категория А</h2>
					<?php
				} ?>

					<table id="winners" class="table table-striped px-3 px-sm-0">
						<thead>
							<tr>
								<th class="text-dark">Награда</th>
								<th class="text-dark">Име</th>
								<th class="text-dark">Държава</th>
								<th class="text-dark">Творба</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($results as $result): ?>
							
							<tr>
								<td><?php echo $result->prize; ?></td>
								<td><?php echo $result->name; ?></td>
								<td><?php echo $result->country; ?></td>
								<td><?php echo $result->work; ?></td>
							</tr>

						<?php endforeach; ?>
						</tbody>

					</table>
		</div>
	</section>
	<?php include_once('../includes/footer_bg.php'); ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>