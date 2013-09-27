
<!--start of comments.php-->
<div id='comments' class='section'>
	<div class='container'><?php
		$commentsPath = $PATH."comments";
		if (is_dir($commentsPath)) {
			$comments = scandir($commentsPath);
			sort($comments);
			echo "\r\n";
			foreach ($comments as $comment) {
				if (!in_array($comment, $SETTINGS['excludedNames'])) {
					$cPath = $PATH."comments/".$comment."/";
					$cSettings = parse_ini_file($cPath."meta.ini");
					$content = file_get_contents($cPath."index");
					
					echo "		<span class='commentName'>".htmlentities($cSettings['name'])."</span>\r\n";
					echo "		<span class='commentContent'>".htmlentities($content)."</span>\r\n";
					echo "		<hr class='commentSeparator'>\r\n";
				}
			}
		}
	?>
	</div>
</div>
<!--end of comments.php-->
