<!DOCTYPE html>
<html>
	<head>
		<title>
		<?php
			show ("title.php");
		?>
		</title>
		<meta charset='UTF-8'>
		<?php
			$themePath = $GLOBALS['settings']['themesDir'].$GLOBALS['settings']['theme']."/";
			$stylesheets = scandir($themePath);
			
			foreach ($stylesheets as $stylesheet) {
				if (!in_array($stylesheet, $GLOBALS['settings']['excludedNames'])) {
					echo "<link rel='stylesheet' href='$themePath$stylesheet'>";
				}
			}
		?>
	</head>
	<body>
	<?php
		show ("menu.php");
	
		if ($GLOBALS['view'] == "PAGE") {
			show ("page.php");
		} else {
			show ("post.php");
		}
		
		if ($GLOBALS['pMeta']['comments']) {
			show ("newcomment.php");
			show ("comments.php");
		}
	?>
	</body>
</html>