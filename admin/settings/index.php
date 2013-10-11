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
			$alternate = false;
			foreach (parse_ini_file('userSettings.ini') as $key=>$value) {
				if ($alternate) {
					$trClass = "tr1";
				} else {
					$trClass = "tr2";
				}
				$prettifiedKey = str_replace("_", " ", $key);
				
 				echo "<tr class='$trClass'>";
				echo "<td class='key'>".$prettifiedKey."</td>";
				echo "<td class='value'><input class='settingInput' name='$key' value='$value'></td>";
				echo "</tr>".PHP_EOL;
				
				$alternate = !$alternate;
			}
			?>
		</table>
		<button>Submit</button>
	</form>
</body>
</html>