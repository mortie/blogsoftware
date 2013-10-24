
<!--start of image.php-->
<?php
	$path = $GLOBALS['settings']['content_dir']."media/".$arg[0];
	echo "<div class='image'>";
	echo "<a href='$path'><img src='$path' title='".$arg[1]."' alt='".$arg[1]."'></a>";
	echo "<span class='alt'>".$arg[1]."</span>";
	echo "</div>\r\n";
?>
<!--end of image.php-->
