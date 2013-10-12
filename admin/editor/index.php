<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
	<script <?php echo "src='".$GLOBALS['path']."script.js'" ?>></script>
</head>
<body onload='init()'>
	<form method='post' id='editor' class='container' action='<?php echo $GLOBALS['settings']['scripts_dir']."newpost.php"?>'>
	
		<label class='editorLabel' id='titleLabel'>Title</label>
		 
		<input oninput='updateSlug(this)' name='title' type='text' value='<?php 
if ($_GET['view'] == "post") {
	$dir = $GLOBALS['settings']['content_dir']."posts/".$_GET['slug'].'/';
	$pMeta = parse_ini_file($dir.'meta.ini');
} else if ($_GET['view'] == "page") {
	$dir = $GLOBALS['settings']['content_dir']."pages/".$_GET['slug'].'/';
	$pMeta = parse_ini_file($dir.'meta.ini');
}
echo $pMeta['name'];
?>'>
	
		<label class='editorLabel' id='slugLabel'>Slug</label>
		<input id='slug' name='slug' type='text' value='<?php echo $_GET['slug'] ?>'>
		<label><input type='checkbox' id='slugAutoUpdate' <?php if (!$_GET['view']){echo "checked";} ?>>Automatically update slug</label>
	
		<label class='editorLabel' id='contentLabel'>Content</label>
<textarea oninput='updatePreview(this.id)' id='content' name='content' type='text'>
<?php
if ($_GET['view'] == "post") {
	$dir = $GLOBALS['settings']['content_dir']."posts/".$_GET['slug'].'/';
	echo file_get_contents($dir.'index');
} else if (($_GET['view'] == "page")) {
	$dir = $GLOBALS['settings']['content_dir']."pages/".$_GET['slug'].'/';
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
		
		<input class='hidden' name='list' value='On'>
		<input class='hidden' name='comments' value='On'>
		
		<button>Submit</button>
		<a href='?admin=home'><button type='button'>Home</button></a>
		
		<div id='preview'></div>
	</form>
</body>
</html>