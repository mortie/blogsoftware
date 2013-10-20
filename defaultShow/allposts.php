
<!--start of allposts.php-->
<?php
	$postsPath = $GLOBALS['settings']['content_dir']."posts/";

	$posts = scandir($postsPath);

	$sortedPosts = array();

	foreach ($posts as $post) {
		if (!in_array($post, $GLOBALS['settings']['excluded_names'])) {
			$metaPath = $GLOBALS['settings']['content_dir']."posts/".$post."/meta.ini";
			$pMeta = parse_ini_file($metaPath);

			$sortedPosts[$pMeta['sort']] = $post;
		}
	}
	
	for ($i=max(array_keys($sortedPosts)); $i>=0; --$i) {
		$post = $sortedPosts[$i];
		
		if (isset($post)){
			$metaPath = $GLOBALS['settings']['content_dir']."posts/".$post."/meta.ini";
			$pMeta = parse_ini_file($metaPath);

			if ($pMeta['list']) {
				$param = "?".$GLOBALS['settings']['param_post']."=".$post;
				echo "<article class='post'>";
				echo "<span class='postTitle'><a href=\"$param\">";
				echo $pMeta['name'];
				echo "</a></span>";

				echo "<span class='date'>";
				echo date("M jS Y", $pMeta['dateSeconds']);
				echo "</span>";

				include $postsPath.$post."/index";
				
				echo "<a href='$param#comments'>Comments</a>";
				
				if ($i!=0) {
					echo "<hr class='postSeparator'>";
				}
				echo "</article>";
			}
		}
	}
?>
<!--end of allposts.php-->
