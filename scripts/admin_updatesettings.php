<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	include 'api.php';
	
	$file = fopen("userSettings.ini", "w");
	foreach ($_POST as $key=>$value) {
		$value = str_replace('"', '\"', $value);
		fwrite($file, $key.'="'.$value.'"'.PHP_EOL);
	}
	fclose($file);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>