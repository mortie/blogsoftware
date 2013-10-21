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
	
	function updateRefs() {
		if (!empty($_SERVER['HTTP_REFERER']) && !preg_match('/'.$_SERVER['HTTP_HOST'].'/', $_SERVER['HTTP_REFERER'])) { 
			$dir = $GLOBALS['settings']['content_dir']."stats/refs/";
			$file = $dir."total";
			
			if (!is_dir($dir)) {
				mkdir($dir);
			}
			
			if (!file_exists($file)) {
				touch($file);
				chmod($file, 0777);
			}
	
			$fContentRaw = explode("\r\n", file_get_contents($file));
			foreach ($fContentRaw as $entry) {
				list($k, $v) = explode(' ', $entry);
				$fContent[ $k ] = $v;
			}
	
			$fContent[$_SERVER['HTTP_REFERER']] += 1;
	
			$fHandle = fopen($file, "w+");
			foreach ($fContent as $key=>$value) {
				if (!empty($key) && !empty($value)) {
					fwrite($fHandle, "$key $value\r\n");
				}
			}
			fclose($fHandle);
		}
	}
	
	if ($view == "ADMIN") {
		if ($_SESSION['isAdmin'] == true) {
			include ($path.'index.php');
		} else {
			include ($settings[admin_dir].'login/index.php');
		}
	} else {
		show ("html.php");
		
		//increment visits if user hasn't visited before
		if ($_SESSION['visited'] != true) {
			incrementFile($settings['content_dir']."stats/visitors/total");
			incrementFile($settings['content_dir']."stats/visitors/".date($settings['log_file_structure'], $timestamp));
			$_SESSION['visited'] = true;
		}
	
		//increment visitors
		incrementFile($settings['content_dir']."stats/visits/total");
		incrementFile($settings['content_dir']."stats/visits/".date($settings['log_file_structure'], $timestamp));
	
		//update referrers
		updateRefs();
	}
?>
