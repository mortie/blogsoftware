
<!--start of post.php-->
<div id='content' class='section'>
	<div class='container'>
<?php
	$param = "?".$SETTINGS['paramPost']."=".$POST;
	echo "<span class='postTitle'><a href=\"$param\">";
	echo $PMETA['name'];
	echo "</a></span>";
	
	echo "<span class='date'>";
	$timeStamp = $PMETA['dateMilliseconds']/1000;
	echo date("M jS Y", $timeStamp);
	echo "</span>";
	
	include $PATH."index";
	echo "\r\n";
?>
	</div>
</div>
<!--end of post.php-->