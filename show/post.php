
<!--start of post.php-->
<div id='content' class='section'>
	<div class='container'>
<?php
	$param = "?".$GLOBALS['settings']['paramPost']."=".$POST;
	echo "<span class='postTitle'><a href=\"$param\">";
	echo $GLOBALS['pMeta']['name'];
	echo "</a></span>";
	
	echo "<span class='date'>";
	echo date("M jS Y", $GLOBALS['pMeta']['dateSeconds']);
	echo "</span>";
	
	include $GLOBALS['path']."index";
	echo "\r\n";
?>
	</div>
</div>
<!--end of post.php-->