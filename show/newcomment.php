
<!--start of newcomment.php-->
<div id='newComment' class='section'>
	<div class='container'>
		<form method='post' action='scripts/postcomment.php'>
			<textarea name='post' class='hidden'><?php echo $POST ?></textarea>
			<textarea name='page' class='hidden'><?php echo $PAGE ?></textarea>

			<label class='nameLabel'>Name: </label>
			<input name='ggggnamos' type='text' class='nameArea'>

			<label class='commentLabel'>Comment: </label>
			<textarea name='ffffcommentos' class='commentArea'></textarea>

			<button>Submit</button>
		</form>
	</div>
</div>
<!--end of newcomment.php-->
