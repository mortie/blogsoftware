<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
</head>
<body>
	<div class='container'>
		<?php
			$newWhatsnew = explode(PHP_EOL, str_replace('"', '\"', file_get_contents($GLOBALS['settings']['update_URL']."whatsnew.txt")));
			if (file_exists("whatsnew.txt")) {
				$oldWhatsnew = explode(PHP_EOL, str_replace('"', '\"', file_get_contents("whatsnew.txt")));
			} else {
				$oldWhatsnew[0] = 0.0;
			}
			
			if ($newWhatsnew[0] > $oldWhatsnew[0]) {?>
				<p>There's a new version available!</p>
				
				<p>You're running version <?=$oldWhatsnew[0] ?>.<br>
					
				Version <?=$newWhatsnew[0] ?> is available.</p>
				
				<strong>New features in <strong><?=$newWhatsnew[0] ?></strong>:</strong>
				<div>
					<?php
						for ($i=1; $i<sizeof($newWhatsnew); ++$i) {
							echo $newWhatsnew[$i];
						}
					?>
				</div>
				<form method='post' action='<?= $GLOBALS['settings']['scripts_dir']."admin_softwareupdate.php" ?>'>
					<button>Update</button>
				</form>
			<?php } else {?>
				<p>You are running the latest version (<strong><?=$oldWhatsnew[0] ?>)</strong>.</p>
				
				<strong>Features added in <?=$oldWhatsnew[0] ?>:</strong>
				<div>
					<?php
						for ($i=1; $i<sizeof($newWhatsnew); ++$i) {
							echo $oldWhatsnew[$i];
						}
					?>
				</div>
			<?php }
		?>
		<a href='?admin=home'><button type='button'>Home</button></a>
	</div>
</body>
</html>