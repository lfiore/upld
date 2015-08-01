<?php

require('config.php');
require('common.php');

// make sure user is logged in (for non-admins, we will verify their ID later)
if (!isset($_SESSION['admin']))
{
	exit_message('You are not authorised to perform this action. Please log in.');
}

// make sure ID is valid
if (!ctype_digit($_GET['id']))
{
	exit_message('Oops, that ID appears to be invalid. User IDs should be numberic');
}

$id = $_GET['id'];

require('db.php');

$exists = mysqli_prepare($db, 'SELECT EXISTS(SELECT 1 FROM `users` WHERE `id` = ?)');

// query DB to see if ID exists
mysqli_stmt_bind_param($exists, 'i', $id);
mysqli_stmt_execute($exists);
++$db_queries;
mysqli_stmt_bind_result($exists, $result);
mysqli_stmt_fetch($exists);
mysqli_stmt_close($exists);

if ($result === 0)
{
	exit_message('No accounts exist with that user ID');
}

// ban user in DB
$ban = mysqli_prepare($db, 'UPDATE `users` SET `banned` = "1" WHERE `id` = ?');
mysqli_stmt_bind_param($ban, 'i', $id);
mysqli_stmt_execute($ban);
++$db_queries;
mysqli_stmt_close($ban);

// get list of images uploaded by that user (so we can delete the files)
$images = mysqli_prepare($db, 'SELECT `id`, `ext` FROM `images` WHERE `user` = ?');
mysqli_stmt_bind_param($images, 'i', $id);
mysqli_stmt_execute($images);
++$db_queries;
mysqli_stmt_bind_result($images, $image_id, $ext);

while (mysqli_stmt_fetch($images))
{
	unlink('images/' . $image_id . '.' . $ext);

	if (file_exists('thumbs/' . $image_id . '.jpg'))
	{
		unlink('thumbs/' . $image_id . '.jpg');
	}
}

mysqli_stmt_close($images);

// delete images in the DB
$delete = mysqli_prepare($db, 'UPDATE `images` SET `removed` = "1" WHERE `user` = ?');
mysqli_stmt_bind_param($delete, 'i', $id);
mysqli_stmt_execute($delete);
++$db_queries;
mysqli_stmt_close($delete);

mysqli_close($db);

exit_message('User has been banned and all data has been removed');

