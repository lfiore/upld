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

	<p>The images on this page are low quality thumbnails (just to avoid how much you need to download when viewing the page)</p>

	<div id="user-images"><!--

<?php

while (mysqli_stmt_fetch($images))
{

?>

		--><div class="user-image-box">
			<img class="user-image" src="thumbs/<?php echo $id . '.jpg'; ?>" alt="<?php echo $id; ?>" />
			<ul class="image-actions">
				<li><a href="<?php echo VIEW_PATH . $id; ?>">view full image</a></li>
				<li>uploaded <?php echo $time; ?></li>
				<li><a class="delete" href="delete.php?id=<?php echo $id; ?>">DELETE image</a></li>
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

