<?php
if ($_SESSION['isAdmin'] == true) {
	header('Location: ?admin=home');
}
?>

<html>
<head>
	<meta charset='UTF-8'>
	<link rel='stylesheet' <?="href='".$GLOBALS['settings']['admin_dir']."style.css'" ?>>
</head>
<body>
	<div class='container'>
		<form action='<?=$GLOBALS['settings']['scripts_dir']."admin_login.php" ?>' method='post'>
			Username: <input name='uname'><br>
			Password: <input type='password' name='pass'>
			<button>Login</button>
			<a href='?'><button type='button'>Back to site</button></a>
		</form>
	</div>
</body>
</html>