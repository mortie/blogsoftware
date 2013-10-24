
<!--start of comments.php-->
<?php
	$commentsPath = $GLOBALS['path']."comments";
	if (is_dir($commentsPath)) {?>
<div id='comments' class='section'>
	<div class='container'>
	<?php
		$comments = scandir($commentsPath);
		arsort($comments);
		echo "\r\n";
		foreach ($comments as $comment) {
			if (!in_array($comment, $GLOBALS['settings']['excluded_names'])) {
				$cPath = $GLOBALS['path']."comments/".$comment."/";
				$cSettings = parse_ini_file($cPath."meta.ini");
				$content = file_get_contents($cPath."index");
							
				echo "<span class='commentName'>".htmlentities($cSettings['name'])."</span>\r\n";
				echo "<span class='commentContent'>".htmlentities($content)."</span>\r\n";
				echo "<hr class='commentSeparator'>\r\n";
			}
		}?>
	</div>
</div><?php
	}
	?>
<!--end of comments.php-->
