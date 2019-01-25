<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Your account</p>

	<p>Welcome to your account. You can view all of your uploads here, see the upload time and delete them</p>

	<div id="user-images"><!--

<?php

while (mysqli_stmt_fetch($images))
{

?>

		--><div class="user-image-box">
			<a href="<?php echo VIEW_PATH . $id; ?>"><img class="user-image" src="thumbs/<?php echo $id . '.jpg'; ?>" alt="<?php echo $id; ?>" /></a>
			<ul class="image-actions">
				<li>uploaded <?php echo $time; ?></li>
				<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>">DELETE image</a></li>
			</ul>
		</div><!--

<?php

}

?>

--></div>

<?php

mysqli_stmt_close($images);
mysqli_close($db);

?>

</div>

