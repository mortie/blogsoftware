
<!--start of menu.php-->
<div id='menu' class='section'>
	<div class='container'>
		<span id='header'>
			<a href='?'>
			<?php
				echo $GLOBALS['settings']['header']."\r\n";
			?>
			</a>
		</span>
		<br>
		<span id='links'>
		<?php
			$pages = scandir ($GLOBALS['settings']['content_dir']."pages/");

			$sortedPages = array();
			foreach ($pages as $page) {
				if (!in_array($page, $GLOBALS['settings']['excluded_names'])) {
					$metaPath = $GLOBALS['settings']['content_dir']."pages/".$page."/meta.ini";
					$pMeta = parse_ini_file($metaPath);

					$sortedPages[$pMeta['sort']] = $page;
				}
			}
			
			for ($i=0; $i<=max(array_keys($sortedPages)); ++$i) {
				$page = $sortedPages[$i];
				
				if (isset($page)) {			
					$metaPath = $GLOBALS['settings']['content_dir']."pages/".$page."/meta.ini";
					$pMeta = parse_ini_file($metaPath);
					if ($pMeta['list']) {
						if ($GLOBALS['page'] == $page) {
							$class = "currentButton button";
						} else {
							$class = "button";
						}
						
						echo "<a href='?".$GLOBALS['settings']['param_page']."=$page' class='$class'>".$pMeta['name']."</a>";
					}
				}
			}
			echo "\r\n";
		?>
		</span>
		<hr id='separator'>
	</div>
</div>
<!--end of menu.php-->
