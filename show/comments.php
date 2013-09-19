
<!--start of comments.php-->
<?php
	$commentsPath = $PATH."comments";
	if (is_dir($commentsPath)) {
		$comments = scandir($commentsPath);
		sort($comments);
	
		foreach ($comments as $comment) {
			if (!in_array($comment, $SETTINGS['excludedNames'])) {
				$cPath = $PATH."comments/".$comment."/";
				$cSettings = parse_ini_file($cPath."meta.ini");
				$content = file_get_contents($cPath."index");
				
				echo "<span class='commentName'>".htmlentities($cSettings['name'])."</span>\r\n";
				echo "<span class='commentContent'>".htmlentities($content)."</span>\r\n";
				echo "<hr class='commentSeparator'>\r\n";
			}
		}
	}
?>
<!--end of comments.php-->
