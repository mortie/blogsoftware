<?php
	chdir ('..');
	include "api.php";
	
	//somewhat odd post variable names may help against spam. Trust me, it makes sense..
	$page = $_POST['page'];
	$post = $_POST['post'];
	$name = $_POST['ggggnamos'];
	$comment = $_POST['ffffcommentos'];
	
	if (empty($name) || empty($post)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	if (!empty($page)) {
		$PATH = $settings['content_dir']."pages/".$page."/";
	} else if (!empty($post)) {
		$PATH = $settings['content_dir']."posts/".$post."/";
	}
	$PATH = $PATH."comments/";
	
	if (!is_dir($PATH)) {
		mkdir($PATH, 0777, true);
	}
	
	$comments = [];
	$dir = scandir($PATH);
	foreach ($dir as $entry) {
		if (!in_array($entry, $settings['excluded_names'])) {
			array_push($comments, $entry);
		}
	}
	$newNum = sizeof($comments);
	
	$newPath = $PATH.$newNum."/";
	mkdir($newPath);
	
	$file = fopen($newPath."index", 'w+');
	fwrite($file, htmlentities($comment));
	fclose($file);
	
	$file = fopen($newPath."meta.ini", 'w+');
	fwrite($file, "name = ".htmlentities($name).PHP_EOL);
	fwrite($file, "dateSeconds = ".time().PHP_EOL);
	fclose($file);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>