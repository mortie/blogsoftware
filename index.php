<?php
	include "api.php";
	session_start();

	//stat counter stuff
	function incrementFile($file) {
		if (!file_exists($file)) {
			touch($file);
			chmod($file, 0777);
		}
		$count = file_get_contents($file);
		if (empty($count)) {$count=0;};
		
		$fileHandler = fopen($file, "w");
		fwrite($fileHandler, $count+1);
		fclose($fileHandler);
	}
	
	//increment visits if user hasn't visited before
	if ($_SESSION['visited'] != true) {
		incrementFile($settings['content_dir']."stats/visitors/total");
		incrementFile($settings['content_dir']."stats/visitors/".date("m-j-Y", $timestamp));
		$_SESSION['visited'] = true;
	}
	
	//increment visitors
	incrementFile($settings['content_dir']."stats/visits/total");
	incrementFile($settings['content_dir']."stats/visits/".date("m-j-Y", $timestamp));
	
	if ($view == "ADMIN") {
		if ($_SESSION['isAdmin'] == true) {
			include ($path.'index.php');
		} else {
			include ($settings[admin_dir].'login/index.php');
		}
	} else {
		show ("html.php");
	}
?>
