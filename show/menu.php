
<!--start of menu.php-->
<div id='menu' class='section'>
	<div class='container'>
		<span id='header'>
			<a href='?'>
			<?php
				echo $SETTINGS['header']."\r\n";
			?>
			</a>
		</span>
		<br>
		<span id='links'>
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
					if ($pageSettings['list']) {
						array_push ($sortArray, $pageSettings['sort']);
						array_push ($linkArray, "<a href='?".$SETTINGS['paramPage']."=$page' class='$class'>".$pageSettings['name']."</a>");
					}
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
		</span>
		<hr id='separator'>
	</div>
</div>
<!--end of menu.php-->
