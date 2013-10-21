<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' href='<?=$GLOBALS['settings']['admin_dir']."style.css" ?>'>
</head>
<body>
	<div class='container'>
		<table>
		<?php
		$statsDir = $GLOBALS['settings']['content_dir']."stats/";

		function tryRead($file) {
			if (file_exists($file)) {
				return file_get_contents($file);
			} else {
				return 0;
			}
		}

		$stats = [];
		$stats['today visits'] = tryRead($statsDir."visits/".date("m-j-Y", $timestamp));
		$stats['today visitors'] = tryRead($statsDir."visitors/".date("m-j-Y", $timestamp));
		$stats['total visits'] = tryRead($statsDir."visits/"."total");
		$stats['total visitors'] = tryRead($statsDir."visitors/"."total");
	
		$alternate = false;
		foreach ($stats as $key=>$value) {
			if ($alternate) {
				$trClass = "tr1";
			} else {
				$trClass = "tr2";
			}
	
			echo "<tr class='$trClass'>";
			echo "<td class='key'>$key</td><td class='value'>$value</td>";
			echo "</tr>".PHP_EOL;
	
			$alternate = !$alternate;
		}
		?>
		</table>
		
		<p>Visitors and visits last 10 days:
		<canvas class='chart' id='visitDataChart' width='650px' height='600px'></canvas></p>
		
		Referrers:
		<table>
		<?php
		$file = $GLOBALS['settings']['content_dir']."stats/refs/total";
		$refsRaw = explode("\r\n", tryRead($file));
		foreach ($refsRaw as $entry) {
			list($k, $v) = explode(' ', $entry);
			$refs[ $k ] = $v;
		}
		arsort($refs);
		
		$alternate = false;
		foreach ($refs as $key=>$value) {
			if ($alternate) {
				$trClass = "tr1";
			} else {
				$trClass = "tr2";
			}
	
			echo "<tr class='$trClass'>";
			echo "<td class='key'>$value</td><td class='value'><a href='$key'>$key</a></td>";
			echo "</tr>".PHP_EOL;
	
			$alternate = !$alternate;
		}
		?>
		</table>
		
		<a href='?admin=home'><button type='button'>Home</button></a>
	</div>
	<script src='<?=$GLOBALS['path']."Chart.min.js" ?>'></script>
	<script>
		<?php include $GLOBALS['path']."jscript.php" ?>		
	</script>
</body>
</html>