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
			$themePath = $GLOBALS['settings']['themes_dir'].$GLOBALS['settings']['theme']."/";
			$stylesheets = scandir($themePath);
			
			foreach ($stylesheets as $stylesheet) {
				if (!in_array($stylesheet, $GLOBALS['settings']['excluded_names'])) {
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
	<div class='footer'>
		<a href='?admin=home'>Admin</a>
	</div>
	</body>
</html>