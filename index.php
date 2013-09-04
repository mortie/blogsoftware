<html>
	<head>
		<title>
		<?php
			$settings = parse_ini_file("settings.ini");
			echo $settings['title'];
		?>
		</title>
		<link rel="stylesheet" href="style.css"></link>
	</head>
	<body>
		<div id="menu">
			<div id="container">
				<span id="header">
					<a href="?">
					<?php
						$settings = parse_ini_file('settings.ini');
						echo $settings['header'];
					?>
					</a>
				</span>
				<br>
				<span id="links">
					<?php
						require "misc.php";
						$settings = parse_ini_file('settings.ini');
						$pages = scandir ($settings['pagesDir']);
						$linkArray = array();
						$sortArray = array();
						
						foreach ($pages as $page) {
							if (!in_array($page, $settings['excludedNames'])) {
								$p = $_GET['p'];

								if ($page == $p || (strlen($p) == 0 && $page == $settings['defaultPage'])) {
									$class = "currentButton button";
								} else {
									$class = "button";
								}
								
								$pageIni = $settings['pagesDir']."/".$page."/meta.ini";
								$pageSettigns = parse_ini_file($pageIni);
								echo $pageIni;
								
								array_push ($sortArray, $pageSettings['sort']);
								array_push ($linkArray, "<a href='?p=$page' class='$class'>$page</a>");
							}
						}
						$sorted = sort_by_array($linkArray, $sortArray);
						
						foreach ($sorted as $link) {
							echo $link;
						}
						printf("\n");
					?>
				</span>
				<span id="separator">
					<hr>
				</span>
			</div>
		</div>
		<div id="content">
			<div id="container">
<?php
	$settings = parse_ini_file('settings.ini');
	$page = $_GET['p'];
		
	if (strlen($page) == 0) {
		$page = $settings['defaultPage'];
	}
	
	$path = $settings['pagesDir']."/".$page."/".index;
				
	include $path;
	printf("\n");
?>
			</div>
		</div>
	</body>
</html>