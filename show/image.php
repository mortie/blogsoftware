
<!--start of image.php-->
<?php
	$path = $SETTINGS['mediaDir'].$img;
	echo "<div class='image'>";
	echo "<a href='$path'><img src='$path' title='$alt' alt='$alt'></a>";
	echo "<span class='alt'>$alt</span>";
	echo "</div>\r\n";
?>
<!--end of image.php-->
