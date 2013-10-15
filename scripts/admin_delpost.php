<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	include 'api.php';
	
	$view = $_POST['view'];
	$slug = $_POST['slug'];
	
	if ($view == 'post') {
		$tDir = $settings['content_dir']."posts/";
	} else {
		$tDir = $settings['content_dir']."pages/";
	}
	$dir = $tDir.$slug.'/';
	
	function rrmdir($dir) {
	    foreach(glob($dir . '*') as $file) { 
			if(is_dir($file)) rrmdir($file); else unlink($file); 
	    } rmdir($dir); 
	}
	rrmdir($dir);
	
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>