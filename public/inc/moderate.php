<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Account moderation for <?php echo $type; ?>: <?php echo $search_term; ?></p>

<?php

if ($type === 'user')
{

?>

	<p><a id="ban" href="ban.php?id=<?php echo $search_term . '&csrf=' . $_SESSION['csrf']; ?>">Click here to ban this user and delete all images</p>

<?php

}
else
{

?>

	<p>These are all of the images uploaded with the specified IP address</p>

<?php

}

?>

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

