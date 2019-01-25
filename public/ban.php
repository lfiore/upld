<?php

require('config.php');
require('common.php');

if ($_SESSION['csrf'] !== $_GET['csrf'])
{
	exit_message('CSRF token mismatch');
}

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

// check if user exists and/or is admin
$exists = mysqli_prepare($db, 'SELECT `admin` FROM `users` WHERE `id` = ?');

// query DB to see if ID exists
mysqli_stmt_bind_param($exists, 'i', $id);
mysqli_stmt_execute($exists);
++$db_queries;
mysqli_stmt_store_result($exists);

if (mysqli_stmt_num_rows($exists) === 0)
{
	exit_message('No accounts exist with that user ID');
}

mysqli_stmt_bind_result($exists, $result);
mysqli_stmt_fetch($exists);
mysqli_stmt_close($exists);

if ($result == 1)
{
	exit_message('You cannot ban an admin');
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

