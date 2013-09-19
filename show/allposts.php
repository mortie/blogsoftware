
<!--start of allposts.php-->
<?php
	$postsPath = $SETTINGS['postsDir'];

	$posts = scandir($postsPath);

	$sortedPosts = array();

	foreach ($posts as $post) {
		if (!in_array($post, $SETTINGS['excludedNames'])) {
			$metaPath = $SETTINGS['postsDir'].$post."/meta.ini";
			$pMeta = parse_ini_file($metaPath);

			$sortedPosts[$pMeta['sort']] = $post;
		}
	}

	for ($i=sizeof($sortedPosts)-1; $i>=0; --$i) {
		$post = $sortedPosts[$i];

		$metaPath = $SETTINGS['postsDir'].$post."/meta.ini";
		$pMeta = parse_ini_file($metaPath);

		$param = "?".$SETTINGS['paramPost']."=".$post;
		echo "<span class='postTitle'><a href=\"$param\">";
		echo $pMeta['name'];
		echo "</a></span>";

		echo "<span class='date'>";
		$timeStamp = $pMeta['dateMilliseconds']/1000;
		echo date("M jS Y", $timeStamp);
		echo "</span>";

		include $postsPath.$post."/index";

		if ($i != 0) {
			echo "<hr class='postSeparator'>";
		}
	}
?>
<!--end of allposts.php-->
