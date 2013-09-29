<!DOCTYPE html>
<html>
	<head>
		<title>
		<?php
			require "show/title.php";
		?>
		</title>
		<meta charset='UTF-8'>
		<?php
			$themePath = $SETTINGS['themesDir'].$SETTINGS['theme']."/";
			$stylesheets = scandir($themePath);
			
			foreach ($stylesheets as $stylesheet) {
				if (!in_array($stylesheet, $SETTINGS['excludedNames'])) {
					echo "<link rel='stylesheet' href='$themePath$stylesheet'>";
				}
			}
		?>
	</head>
	<body>
	<?php
		require "show/menu.php";
	
		if ($VIEW == "PAGE") {
			require "show/page.php";
		} else {
			require "show/post.php";
		}
		
		if ($PMETA['comments']) {
			require "show/newcomment.php";
			require "show/comments.php";
		}
	?>
	</body>
</html>