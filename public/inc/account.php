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

<?php

if (PAGINATION > 0)
{

?>

	<div id="pagination">

<?php

if (($page - 1) > 0)
{
	echo '<a href="?page=1">First</a> <a href="?page=' . ($page - 1) . '">Previous</a> ';	
}

for ($i = 1; $i <= $pages_count; ++$i)
{
	if ($i == $page)
	{
		echo $page;
	}
	else
	{
		echo '<a href="?page=' . $i . '"> ' . $i . ' </a>';
	}
}

if (($page + 1) <= $pages_count)
{
	echo ' <a href="?page=' . ($page + 1) . '">Next</a> <a href="?page=' . $pages_count . '">Last</a>';
}

?>
	</div>

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

