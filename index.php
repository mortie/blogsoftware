<?php
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
	
	echo "
<!DOCTYPE html>
<html>
	<head>
		<title>";
			require "show/title.php";
		echo "
		</title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style/style.css'>
		<link rel='stylesheet' href='style/head.css'>
		<link rel='stylesheet' href='style/content.css'>
		<link rel='stylesheet' href='style/comments.css'>
	</head>
	<body>
		<div id='menu' class='section'>
			<div class='container'>
				<span id='header'>
					<a href='?'>";
						require "show/header.php";
					echo "
					</a>
				</span>
				<br>
				<span id='links'>";
					require "show/menu.php";
				echo "
				</span>
				<hr id='separator'>
			</div>
		</div>
		<div id='content' class='section'>
			<div class='container'>";
				if ($VIEW == "PAGE") {
					require "show/page.php";
				} else {
					require "show/post.php";
				}
			echo "
			</div>
		</div>";
		if ($PMETA['comments']) {
			echo "
			<div id='comments' class='section'>
				<div class='container'>";
					require "show/comments.php";
				echo "
				</div>
			</div>";
		}
		echo "
		</div>
	</body>
</html>";
?>
