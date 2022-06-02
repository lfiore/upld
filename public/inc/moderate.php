<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Account moderation for <?php echo $type[0]; ?>: <?php echo $search_term; ?></p>

<?php

if ($type === 'user')
{

?>

	<p><a id="ban" href="ban.php?id=<?php echo $search_term . '&csrf=' . $_SESSION['csrf']; ?>">Click here to ban this user and delete all images</a></p>

<?php

}
else
{

?>

	<p>These are all of the images uploaded with the specified IP address</p>

<?php

}

if (PAGINATION > 0)
{

?>
	<div id="pagination">

<?php

if (($page - 1) > 0)
{
	echo '<a href="?' . $type[1] . '=' . $search_term . '&page=1">First</a> <a href="?' . $type[1] . '=' . $search_term . '&page=' . ($page - 1) . '">Previous</a>';	
}

for ($i = 1; $i <= $pages_count; ++$i)
{
	if ($i == $page)
	{
		echo $page;
	}
	else
	{
		echo '<a href="?' . $type[1] . '=' . $search_term . '&page=' . $i . '"> ' . $i . ' </a>';
	}
}

if (($page + 1) <= $pages_count)
{
	echo '<a href="?' . $type[1] . '=' . $search_term . '&page=' . ($page + 1) . '">Next</a> <a href="?' . $type[1] . '=' . $search_term . '&page=' . $pages_count . '">Last</a>';
}

?>
	</div>

<?php

}

?>

	<div id="user-images">

<?php

while (mysqli_stmt_fetch($images))
{

	if (CREATE_THUMBS_IP === true)
	{
		if (!file_exists('thumbs/' . $id . '.jpg'))
		{

			// set image path
			$image_path = 'images/' . $id . '.' . $ext;

			// set source for thumb
			switch ($ext)
			{
				case 'jpg':
				case 'jpeg':
					$thumb = imagecreatefromjpeg($image_path);
				break;

				case 'png':
					$thumb = imagecreatefrompng($image_path);
				break;

				case 'gif':
					$thumb = imagecreatefromgif($image_path);
				break;
			}

			$width = imagesx($thumb);
			$height = imagesy($thumb);

			if ($width > 200 || $height > 200)
			{
				if ($width > $height)
				{
					$new_width = 200;
					// if image height is below 300, don't bother resizing
					$new_height = floor($height * ($new_width / $width));
				}
				else
				{
					$new_height = 200;
					// if image width is below 300, don't bother resizing
					$new_width = floor($width * ($new_height / $height));
				}
			}
			else
			{
				$new_height = $height;
				$new_width = $width;
			}

			// create thumb with white background
			$new_thumb = imagecreatetruecolor($new_width, $new_height);
			imagefill($new_thumb, 0, 0, imagecolorallocate($new_thumb, 255, 255, 255));
			
			// resize and copy original image
			imagecopyresized($new_thumb, $thumb, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagedestroy($thumb);
		
			// save thumbnail to thumbnails folder
			imagejpeg($new_thumb, 'thumbs/' . $id . '.jpg', 30);
			imagedestroy($new_thumb);
		}
	}

?>

		<div class="user-image-box">
			<a href="<?php echo VIEW_PATH . $id; ?>"><img class="user-image" src="thumbs/<?php echo $id . '.jpg'; ?>" alt="<?php echo $id; ?>" /></a>
			<ul class="image-actions">
				<li>uploaded <?php echo $time; ?></li>
				<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>">DELETE image</a></li>
			</ul>
		</div>

<?php

}

?>

</div>

<?php

mysqli_stmt_close($images);
mysqli_close($db);

?>

</div>

