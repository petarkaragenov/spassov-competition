<?php 
	session_start();

	require_once('../config/db.php');
	require_once('../lib/pdo_db.php');
	require_once('../models/Transaction.php');

	if (isset($_SESSION['logged_in'])) {
		$transaction = new Transaction;

		$transactions = $transaction->getTransactions(); ?>

		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>View Transactions</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
			<link rel="stylesheet" href="../css/style.css">
		</head>
		<body>
			<div class="btn-group" role="group">
				<a class="btn btn-secondary" href="participants">Participants</a>
				<a class="btn btn-secondary" href="winners/winners">Winners</a>
				<a class="btn btn-primary" href="transactions">Transactions</a>
				<a class="btn btn-secondary" href="logout">Logout</a>
			</div>
			<h2 class="mt-4">Transactions</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th nowrap>Transaction ID</th>
						<th nowrap>Participant ID</th>
						<th nowrap>Amount</th>
						<th nowrap>Status</th>
						<th nowrap>Created At</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($transactions as $transaction): ?>
						<tr>
							<td><?php echo $transaction->t_id; ?></td>
							<td nowrap><?php echo $transaction->t_participant_id ?></td>
							<td><?php echo $transaction->t_amount; ?></td>
							<td><?php echo $transaction->t_status; ?></td>
							<td nowrap><?php echo $transaction->t_created_at; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</body>
		</html>

		<?php
	} else {
		header('Location: index.php');
	}
	
?>