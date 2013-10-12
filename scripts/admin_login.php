<?php
	chdir ('..');
	
	include 'api.php';
	
	$view = $_POST['view'];
	$slug = $_POST['slug'];
	$content = $_POST['content'];
	
	$comments = $_POST['comments'];
	$list = $_POST['list'];
	$title = $_POST['title'];
	
	if ($view == 'post') {
		$dir = $settings['content_dir']."posts/".$slug.'/';
	} else {
		$dir = $settings['content_dir']."pages/".$slug.'/';
	}
	
	if (!isset($dir)) {
		mkdir($dir, 0777);
	}
	
	$file = fopen($dir.'index', "w");
	fwrite($file, $content);
	fclose($file);
	
	$file = fopen($dir.'meta.ini', "w");
	fwrite($file, 'comments = '.$comments.PHP_EOL);
	fwrite($file, 'list = '.$list.PHP_EOL);
	fwrite($file, 'name = "'.$title.'"'.PHP_EOL);
	fwrite($file, 'dateSeconds = '.time().PHP_EOL);	
	fwrite($file, 'sort = '.'2'.PHP_EOL);
	
?>