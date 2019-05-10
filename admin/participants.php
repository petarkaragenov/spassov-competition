<?php 
	session_start();

	require_once('../config/db.php');
	require_once('../lib/pdo_db.php');
	require_once('../models/Participant.php');

	if (isset($_SESSION['logged_in'])) {
		$participant = new Participant;

		if (isset($_POST['submit'])) {
			$status = $_POST['status'];
			$id = $_POST['id'];

			$status = $participant->updateStatus($status, $id);
		}

		$participants = $participant->getParticipants(); ?>

		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>View Participants</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
			<link rel="stylesheet" href="../css/style.css">
		</head>
		<body>
			<div class="btn-group" role="group">
				<a class="btn btn-primary" href="participants">Participants</a>
				<a class="btn btn-secondary" href="winners/winners">Winners</a>
				<a class="btn btn-secondary" href="transactions">Transactions</a>
				<a class="btn btn-secondary" href="logout">Logout</a>
			</div>
			<h2 class="mt-4">Participants</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th nowrap>Participant ID</th>
						<th nowrap>Name</th>
						<th nowrap>Category</th>
						<th nowrap>Date of Birth</th>
						<th nowrap>Email</th>
						<th nowrap>Phone</th>
						<th nowrap>Nationality</th>
						<th nowrap>Address</th>
						<th nowrap>Score 1</th>
						<th nowrap>Score 2</th>
						<th nowrap>Audio</th>
						<th nowrap>Applied on</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($participants as $participant): ?>
						<tr>
							<td><?php echo $participant->p_id; ?></td>
							<td nowrap><?php echo $participant->p_name ?></td>
							<td><?php echo $participant->p_category; ?></td>
							<td><?php echo $participant->p_birth; ?></td>
							<td><?php echo $participant->p_email; ?></td>
							<td><?php echo $participant->p_phone; ?></td>
							<td><?php echo $participant->p_nationality; ?></td>
							<td nowrap><?php echo $participant->p_address; ?></td>
							<td>
								<a href=<?php echo "../upload/".$participant->p_first_score; ?>><?php echo $participant->p_first_score; ?></a>
							</td>
							<td>
								<?php 
									if ($participant->p_second_score !== 'Not Provided') { ?>
										<a href=<?php echo "../upload/".$participant->p_second_score; ?>><?php echo $participant->p_second_score; ?></a>
									<?php } else { ?>
										<?php echo $participant->p_second_score; ?>
									<?php } ?>
								
							</td>
							<td>
								<a href=<?php echo "../upload/".$participant->p_audio; ?>><?php echo $participant->p_audio; ?></a>
							</td>
							<td nowrap><?php echo $participant->p_created_at; ?></td>
							<td>
								<?php 
									if (is_null($participant->p_approved)) { ?>
										<form action="participants.php" method="post">
											<select class="form-control" name="status">
												<option value="approved">approved</option>
												<option value="rejected">rejected</option>
											</select>
											<input name="id" type="hidden" value=<?php echo $participant->p_id; ?>>
											<button name="submit" class="btn btn-success">Update</button>
										</form>
									<?php } else { 
										echo $participant->p_approved;
									}
								?>
							</td>
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