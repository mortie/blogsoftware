<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
</head>
<body>
	<form method='post' class='container' action='<?= $GLOBALS['settings']['scripts_dir']."admin_updatesettings.php" ?>'>
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
				echo "<td class='value'><input class='settingInput' name='$key' value=".'"'.$value.'"'."></td>";
				echo "</tr>".PHP_EOL;
				
				$alternate = !$alternate;
			}
			?>
		</table>
		<button>Submit</button>
		<a href='?admin=home'><button type='button'>Home</button></a>
	</form>
</body>
</html>