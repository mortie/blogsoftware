<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	include 'api.php';
	
	$file = $_GET['file'];
	unlink($GLOBALS['settings']['content_dir'].'media/'.$file);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>