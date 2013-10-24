<?php
	session_start();
	if (!($_SESSION['isAdmin'] == true)) {
		die("not admin");
	}
	chdir ('..');
	
	function unzip($zipfile) {
		$zip = zip_open($zipfile);
		while ($zip_entry = zip_read($zip)) {
			zip_entry_open($zip, $zip_entry);
			if (substr(zip_entry_name($zip_entry), -1) == '/') {
				$zdir = substr(zip_entry_name($zip_entry), 0, -1);
				if (file_exists($zdir)) {
					trigger_error('Directory "<b>' . $zdir . '</b>" exists', E_USER_ERROR);
					return false;
				}
				mkdir($zdir);
			}
			else {
				$name = zip_entry_name($zip_entry);
				if (file_exists($name)) {
					trigger_error('File "<b>' . $name . '</b>" exists', E_USER_ERROR);
					return false;
				}
				$fopen = fopen($name, "w");
				fwrite($fopen, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)), zip_entry_filesize($zip_entry));
			}
			zip_entry_close($zip_entry);
		}
		zip_close($zip);
		return true;
	}
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$files = scandir($dir);
			foreach ($files as $file)
				if ($file != "." && $file != "..")
					rrmdir("$dir/$file");
			rmdir($dir);
		}
		else if (file_exists($dir)) unlink($dir);
	}
	function rcopy($src,$dst) { 
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					rcopy($src . '/' . $file,$dst . '/' . $file); 
				}
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				}
			} 
		}
		closedir($dir); 
	}
	
	include 'api.php';
	
	mkdir ("temp");
	file_put_contents("temp/cms.zip", fopen($GLOBALS['settings']['update_URL']."cms.zip", 'r'));
	
	chdir("temp");
	unzip("cms.zip");
	unlink("cms.zip");
	chdir("..");
	
	$updatedFiles = scandir('temp/src');
	$ignores = [".", "..", "content", "themes", "userSettings.ini"];
	foreach ($updatedFiles as $file) {
		if (!in_array($file, $ignores)) {
			if (is_dir($file)) {
				rrmdir($file);
				rcopy("temp/src/$file", $file);
			} else {
				unlink($file);
				copy("temp/src/$file", $file);
			}
		}
	}
	
	$oldSettings = parse_ini_file("userSettings.ini");
	$newSettings = array_diff_key(parse_ini_file("temp/src/userSettings.ini"), $oldSettings);
	$finalSettings = array_merge($oldSettings, $newSettings);
	
	print_r($newSettings);
		
	$file = fopen("userSettings.ini", "w");
	foreach ($finalSettings as $key=>$value) {
		$value = str_replace('"', '\"', $value);
		fwrite($file, $key.'="'.$value.'"'.PHP_EOL);
	}
	fclose($file);
	
	rrmdir("temp");
	
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>