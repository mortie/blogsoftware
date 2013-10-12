<?php
	chdir ('..');
	
	session_start();
	include 'api.php';
	
	$pass = $_POST['pass'];
	$uname = $_POST['uname'];
	$passHash = md5($pass.$settings['admin_salt']);
	
	if (($passHash == $settings['admin_hash']) && ($uname == $settings['admin_username'])) {
		$_SESSION['isAdmin'] = true;
	} else {
		$_SESSION['isAdmin'] = false;
	}
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>