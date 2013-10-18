<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	include 'api.php';
	
	$view = $_POST['view'];
	$slug = $_POST['slug'];
	$content = $_POST['content'];
	
	$comments = $_POST['comments'];
	$list = $_POST['list'];
	$title = $_POST['title'];
	$sort = $_POST['sort'];
	
	if (!$list) {$list = "off";};
	if (!$comments) {$comments = "off";};
	
	if ($view == 'post') {
		$tDir = $settings['content_dir']."posts/";
	} else {
		$tDir = $settings['content_dir']."pages/";
	}
	$dir = $tDir.$slug.'/';
	
	if (!is_dir($dir)) {
		mkdir($dir, 0777);
	}
	
	$file = fopen($dir."index", "w");
	chmod($dir."index", 0777);
	fwrite($file, $content);
	fclose($file);
	
	$file = fopen($dir."meta.ini", "w");
	fwrite($file, "comments = $comments".PHP_EOL);
	fwrite($file, "list = $list".PHP_EOL);
	fwrite($file, "name = \"$title\"".PHP_EOL);
	fwrite($file, 'dateSeconds = '.time().PHP_EOL);	
	fwrite($file, "sort = $sort".PHP_EOL);
	fclose($file);
	
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>