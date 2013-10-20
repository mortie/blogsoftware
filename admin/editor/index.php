<?php
$slug = $_GET['slug'];

if ($_GET['view'] == "post") {
	$tDir = $GLOBALS['settings']['content_dir']."posts/";
} else if (($_GET['view'] == "page")) {
	$tDir = $GLOBALS['settings']['content_dir']."pages/";
}

if ($slug) {
	$dir = $tDir.$_GET['slug'].'/';
	$pMeta = parse_ini_file($dir.'meta.ini');
	$sort = $pMeta['sort'];
} else {
	$files = scandir($tDir);
	$files = array_diff($files, $GLOBALS['settings']['excluded_names']);
	$sort = sizeof($files);
}
?>

<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' href='<?= $GLOBALS['settings']['admin_dir']."style.css" ?>'>
	<script src='<?= $GLOBALS['path']."script.js'" ?>'></script>
</head>
<body onload='init()'>
	<div id='editor' class='container'>
		<form method='post' action='<?= $GLOBALS['settings']['scripts_dir']."admin_newpost.php"?>'>
	
			<label class='editorLabel' id='titleLabel'>Title</label>
		 
			<input oninput='updateSlug(this)' name='title' type='text' value="<?php 
if ($slug) {
	echo $pMeta['name'];
}
?>">
	
			<label class='editorLabel' id='slugLabel'>Slug</label>
			<input id='slug' name='slug' type='text' value='<?= $_GET['slug'] ?>'>
			<label><input type='checkbox' id='slugAutoUpdate'<?php if (!$slug){echo " checked";}?>>Automatically update slug</label>
	
			<label class='editorLabel' id='contentLabel'>Content</label>
<textarea oninput='updatePreview(this.id)' id='content' name='content' type='text'>
<?php
if ($slug) {
	echo file_get_contents($dir.'index');
}
?>
</textarea>
			<?php if (isset($_GET['view'])) {
				echo "<input class='hidden' name='view' value='".$_GET['view']."'>";
			} else {
				echo "<label><input type='radio' name='view' value='page' checked>Page</label><br>".PHP_EOL;
				echo "<label><input type='radio' name='view' value='post'>Post</label><br>".PHP_EOL;
			} ?>
		
			<label>Display: <input type='checkbox' name='list'<?php if ($pMeta['list']){echo " checked";}?>></label><br>
			<label>Comments: <input type='checkbox' name='comments'<?php if ($pMeta['comments']){echo " checked";}?>></label><br>
			<label>Sort: <input type="number" name='sort' value='<?= $sort ?>'></label><br>
		
			<button>Submit</button>
			<a href='?admin=home'><button type='button'>Home</button></a>
			<?php
				if ($slug) {?>
					<a href='?<?=$_GET['view']."=$slug"?>'><button type='button'>View <?=$_GET['view']?></button></a>
			<?php } ?>
		</form>
		<form method='post' action='<?= $GLOBALS['settings']['scripts_dir']."admin_delpost.php"?>'>
			<input class='hidden' name='slug' value='<?= $_GET['slug'] ?>'>
			<input class='hidden' name='view' value='<?= $_GET['view'] ?>'>
			<button>Delete</button>
		</form>
		<div id='preview'></div>
	</div>
</body>
</html>