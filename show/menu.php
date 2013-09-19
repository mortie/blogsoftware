
<!--start of menu.php-->
<?php
	$pages = scandir ($SETTINGS['pagesDir']);
	$linkArray = array();
	$sortArray = array();

	foreach ($pages as $page) {
		if (!in_array($page, $SETTINGS['excludedNames'])) {

			if ($PAGE == $page) {
				$class = "currentButton button";
			} else {
				$class = "button";
			}

			$pageIni = $SETTINGS['pagesDir'].$page."/meta.ini";
			$pageSettings = parse_ini_file ($pageIni);

			array_push ($sortArray, $pageSettings['sort']);
			array_push ($linkArray, "<a href='?".$SETTINGS['paramPage']."=$page' class='$class'>$page</a>");
		}
	}
	
	$sorted = array();
	foreach ($sortArray as $item) {
		$sorted[] = $linkArray[$item];
	}

	foreach ($sorted as $link) {
		echo $link;
	}
	echo "\r\n";
?>
<!--end of menu.php-->
