<?php
	chdir ('..');
	include "api.php";
	
	//somewhat odd post variable names may help against spam. Trust me, it makes sense..
	$page = $_POST['page'];
	$post = $_POST['post'];
	$name = $_POST['ggggnamos'];
	$comment = $_POST['ffffcommentos'];
	
	if (!empty($page)) {
		$slug = $page;
	} else if (!empty($post)) {
		$slug = $post;
	}
	
	if (empty($name) || empty($post)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	$preg = '/[^A-Za-z0-9_]+/';
	if (preg_match($preg, $slug)) {
		die('Bad slug. Contact the webmaster.');
	}
	
	if (!empty($page)) {
		$PATH = $settings['content_dir']."pages/".$slug."/";
	} else if (!empty($post)) {
		$PATH = $settings['content_dir']."posts/".$slug."/";
	}
	
	if (!is_dir($PATH)) {
		die('Bad slug. Contact the webmaster.');
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
	
	$headers = 'From: '.$settings['email_from']."\r\n";
	$headers .= 'Reply-To: '.$settings['email_reply_to']."\r\n";
	mail($settings['admin_email'], "New comment from $name", "comment on $slug: ".htmlentities($comment), $headers);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>