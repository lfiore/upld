<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo MODERATE_PAGE_TITLE." ".$type[0]; ?>: <?php echo $search_term; ?></p>
<?php
if ($type === 'user')
{
?>
	<p><a id="ban" href="ban.php?id=<?php echo $search_term . '&csrf=' . $_SESSION['csrf']; ?>"><?php echo BAN_USER; ?></a></p>
<?php
}
else
{
?>
	<p><?php echo IMAGES_LIST_IP; ?></p>
<?php
}
if (PAGINATION > 0)
{
?>
	<div id="pagination">
<?php
if (($page - 1) > 0)
{
	echo '<a href="?' . $type[1] . '=' . $search_term . '&page=1">'.PAGINATION_FIRST.'</a> <a href="?' . $type[1] . '=' . $search_term . '&page=' . ($page - 1) . '">'.PAGINATION_PREVIOUS.'</a>';	
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
	echo '<a href="?' . $type[1] . '=' . $search_term . '&page=' . ($page + 1) . '">'.PAGINATION_NEXT.'</a> <a href="?' . $type[1] . '=' . $search_term . '&page=' . $pages_count . '">'.PAGINATION_LAST.'</a>';
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
				case 'webp':
					$thumb = imagecreatefromwebp($image_path);
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
			$new_thumb = imagecreatetruecolor($new_width, $new_height);
			switch ($ext)
			{
				case 'png':
					imagefill($new_thumb, 0, 0, imagecolorallocate($new_thumb, 255, 255, 255));
					imagealphablending($new_thumb, TRUE);
				break;
				case 'gif':
					$new_thumb = imagecolorallocate($thumb, 0, 0, 0);
					imagecolortransparent($thumb, $new_thumb);
				break;
			}
			imagecopyresized($new_thumb, $thumb, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagedestroy($thumb);	
			imagejpeg($new_thumb, 'thumbs/' . $id . '.jpg', 30);
			imagedestroy($new_thumb);
		}
	}
?>
		<div class="user-image-box">
			<a href="<?php echo VIEW_PATH . $id; ?>"><img class="user-image" src="thumbs/<?php echo $id . '.jpg'; ?>" alt="<?php echo $id; ?>" /></a>
			<ul class="image-actions">
				<li><?php echo UPLOAD_TIME." ".$time; ?></li>
				<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>"><?php echo ACCOUNT_DEL_IMAGE;?></a></li>
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