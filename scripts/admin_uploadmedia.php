<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	include 'api.php';
	
	$targetPath = $GLOBALS['settings']['content_dir']."media/".basename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>