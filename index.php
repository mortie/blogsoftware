<?php
	chdir ('/var/www/mort/static/website/blogsoftware');
	
	$SETTINGS = parse_ini_file('settings.ini');
	
	$PAGE = $_GET[$SETTINGS['paramPage']];
	$POST = $_GET[$SETTINGS['paramPost']];
	if (strlen($PAGE) == 0 && $POST == "") {
		$PAGE = $SETTINGS['defaultPage'];
	}
	
	if ($PAGE != "") {
		$PATH = $SETTINGS['pagesDir'].$PAGE."/";
		$VIEW = "PAGE";
	} else if ($POST != "") {
		$PATH = $SETTINGS['postsDir'].$POST."/";
		$VIEW = "POST";
	}
	
	$PMETA = parse_ini_file($PATH."meta.ini");
	
	require "show/html.php";
?>
