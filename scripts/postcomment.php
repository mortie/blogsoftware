<?php
	chdir ('..');
	
	//somewhat odd post variable names may help against spam. Trust me, it makes sense..
	$page = $_POST['page'];
	$post = $_POST['post'];
	$name = $_POST['ggggnamos'];
	$comment = $_POST['ffffcommentos'];
	
	$SETTINGS = parse_ini_file('settings.ini');
	
	if (!empty($page)) {
		$PATH = $SETTINGS['pagesDir'].$page."/";
	} else if (!empty($post)) {
		$PATH = $SETTINGS['postsDir'].$post."/";
	}
	$PATH = $PATH."comments/";
	
	$old_umask = umask(0);
	if (!is_dir($PATH)) {
		mkdir($PATH, 0777, true);
	}
	
	$comments = [];
	$dir = scandir($PATH);
	foreach ($dir as $entry) {
		if (!in_array($entry, $SETTINGS['excludedNames'])) {
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
	
	umask($old_umask);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>