<!DOCTYPE html>
<html>
	<head>
		<title>
		<?php
			require "show/title.php";
		?>
		</title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style/style.css'>
		<link rel='stylesheet' href='style/head.css'>
		<link rel='stylesheet' href='style/content.css'>
		<link rel='stylesheet' href='style/comments.css'>
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