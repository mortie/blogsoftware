
<!--start of newcomment.php-->
<div id='newComment' class='section'>
	<div class='container'>
		<form method='post' <?php echo "action='".$GLOBALS['settings']['scripts_dir']."postcomment.php'" ?>>
			<textarea name='post' class='hidden'><?php echo $GLOBALS['post'] ?></textarea>
			<textarea name='page' class='hidden'><?php echo $GLOBALS['page'] ?></textarea>

			<label class='nameLabel'>Name: </label>
			<input name='ggggnamos' type='text' class='nameArea'>

			<label class='commentLabel'>Comment: </label>
			<textarea name='ffffcommentos' class='commentArea'></textarea>

			<button>Submit</button>
		</form>
	</div>
</div>
<script>
	if (window.location.hash == "#comments") {
		document.getElementById("newComment").scrollIntoView();
	}
</script>
<!--end of newcomment.php-->
