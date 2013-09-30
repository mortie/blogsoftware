<?php	
	$settings = parse_ini_file('settings.ini');
	
	$page = $_GET[$settings['paramPage']];
	$post = $_GET[$settings['paramPost']];
	if (strlen($page) == 0 && $POST == "") {
		$page = $settings['defaultPage'];
	}
	
	if ($page != "") {
		$path = $settings['pagesDir'].$page."/";
		$view = "PAGE";
	} else if ($post != "") {
		$path = $settings['postsDir'].$post."/";
		$view = "POST";
	}
	
	$pMeta = parse_ini_file($path."meta.ini");
	
	function show($file) {
		include ($GLOBALS['settings']['showDir'].$file);
	}
	
	show ("html.php");
?>
