<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
</head>
<body>
	<div class='container'>
		<table>
		<?php
		$link = [];
		$link['Settings'] = "?admin=settings";
		$link['Stats'] = "?admin=stats";
		$link['Pages'] = "?admin=pages";
		$link['Posts'] = "?admin=posts";
		$link['Media'] = "?admin=media";
	
		$alternate = false;
		foreach ($link as $key=>$value) {
			if ($alternate) {
				$trClass = "tr1";
			} else {
				$trClass = "tr2";
			}
	
			echo "<tr class='$trClass'>";
			echo "<td class='key'><a href='$value'>$key</a></td>";
			echo "</tr>".PHP_EOL;
	
			$alternate = !$alternate;
		}
		?>
		</table>
		<a href='?'><button type='button'>Back to site</button></a>
	</div>
</body>
</html>