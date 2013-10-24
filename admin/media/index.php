<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
	<script src='<?=$GLOBALS['path']."script.js" ?>'></script>
</head>
<body>
	<div class='container'>
		<table id='settings'>
		<?php
			echo PHP_EOL;
			$alternate = false;
		
			$arr = scandir($GLOBALS['settings']['content_dir'].'media');	
			$arr = array_diff($arr, $GLOBALS['settings']['excluded_names']);
		
			foreach ($arr as $value) {
				if ($alternate) {
					$trClass = "tr1";
				} else {
					$trClass = "tr2";
				}
				?>
 				<tr class='<?=$trClass?>'>
				<td class='value'>
					<?=$value ?> - 
					<a href='<?=$GLOBALS['settings']['content_dir'].'media/'.$value ?>'>view</a> - 
					<a href='<?=$GLOBALS['settings']['scripts_dir']."admin_delmedia.php?file=$value" ?>'>delete</a>
				</td>
				</tr>
				
				<?php
				$alternate = !$alternate;
			}
		?>
		</table>
		<form id='uploadForm' method='post' enctype="multipart/form-data" action='<?=$GLOBALS['settings']['scripts_dir']."admin_uploadmedia.php" ?>'>
			<button onclick='sUpload()' type='button'>Upload</button>
			<input class="hidden" type="file" name="file" id="upload" onchange="sSubmit()"></input>
		</form>
		<a href='?admin=home'><button type='button'>Home</button></a>
	</div>
</body>
</html>