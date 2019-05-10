<?php 
	session_start();

	session_destroy();

	header('Location: ../bg/home');
?>