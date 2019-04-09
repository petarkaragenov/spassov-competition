<?php 
	require_once('../../config/competition_winners.php');
	require_once('../../lib/pdo_db.php');
	require_once('../../models/Winner.php');

	session_start();

	if (isset($_SESSION['logged_in'])) {
		$winner = new Winner;

		if (isset($_POST['delete_id'])) {
			$id = $_POST['delete_id'];
			$winner->deleteWinner($id);
			header('Location: winners');
		} else {
			header('Location: winners');
		}
	} else {
		header('Location: ../../home');
	}
?>