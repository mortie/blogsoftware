<?php
	$settings = [];
	$settings = array_merge($settings, parse_ini_file('settings.ini'), parse_ini_file('userSettings.ini'));
	date_default_timezone_set($settings['time_zone']);
	
	$page = $_GET[$settings['param_page']];
	$post = $_GET[$settings['param_post']];
	$admin = $_GET[$settings['param_admin']];
	
	if (empty($page) && empty($post) && empty($admin)) {
		$page = $settings['default_page'];
	}
	
	if (!empty($page)) {
		$path = $settings['content_dir']."pages/".$page."/";
		$view = "PAGE";
	} else if (!empty($post)) {
		$path = $settings['content_dir']."posts/".$post."/";
		$view = "POST";
	} else if (!empty($admin)) {
		$path = $settings['admin_dir'].$admin."/";
		$view = "ADMIN";
	}
	
	if ($view == 'POST' || $view == 'PAGE') {
		$pMeta = parse_ini_file($path."meta.ini");
	}
	
	$timestamp = time();
	
	function show($file, $arg=0) {
		$showDir = $GLOBALS['settings']['themes_dir'].$GLOBALS['settings']['theme']."/";
		$showFile = $showDir.'show/'.$file;
		if (file_exists($showFile)) {
			return (include ($showFile));
		}
		return (include ($GLOBALS['settings']['show_dir'].$file));
	}
?>
