<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?php echo "href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
</head>
<body>
	<form method='post' class='container' action='updateSettings.php'>
		<table id='settings'>
			<?php
			echo PHP_EOL;
			
			$posts = scandir($GLOBALS['settings']['content_dir'].'posts/');
			
			$alternate = false;
			foreach ($posts as $key=>$value) {
				if (!in_array($value, $GLOBALS['settings']['excluded_names'])) {
					if ($alternate) {
						$trClass = "tr1";
					} else {
						$trClass = "tr2";
					}
					
					$meta = parse_ini_file($GLOBALS['settings']['content_dir']."posts/$value/meta.ini");
					$name = $meta['name'];
					
	 				echo "<tr class='$trClass'>";
					echo "<td class='key'><a href='?admin=editor&view=post&slug=$value'>$name</a></td>";
					echo "</tr>".PHP_EOL;
				
					$alternate = !$alternate;
				}
			}
			?>
		</table>
		<button>Submit</button>
	</form>
</body>
</html>