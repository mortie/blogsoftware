
<!--start of allposts.php-->
<?php
	$postsPath = $GLOBALS['settings']['postsDir'];

	$posts = scandir($postsPath);

	$sortedPosts = array();

	foreach ($posts as $post) {
		if (!in_array($post, $GLOBALS['settings']['excludedNames'])) {
			$metaPath = $GLOBALS['settings']['postsDir'].$post."/meta.ini";
			$pMeta = parse_ini_file($metaPath);

			$sortedPosts[$pMeta['sort']] = $post;
		}
	}

	for ($i=sizeof($sortedPosts)-1; $i>=0; --$i) {
		$post = $sortedPosts[$i];

		$metaPath = $GLOBALS['settings']['postsDir'].$post."/meta.ini";
		$pMeta = parse_ini_file($metaPath);
		
		if ($pMeta['list']) {
			$param = "?".$GLOBALS['settings']['paramPost']."=".$post;
			echo "<span class='postTitle'><a href=\"$param\">";
			echo $pMeta['name'];
			echo "</a></span>";

			echo "<span class='date'>";
			echo date("M jS Y", $pMeta['dateSeconds']);
			echo "</span>";

			include $postsPath.$post."/index";

			if ($i != 0) {
				echo "<hr class='postSeparator'>";
			}
		}
	}
?>
<!--end of allposts.php-->
