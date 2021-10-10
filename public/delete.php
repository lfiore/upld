<?php
require('config.php');
require('common.php');
if ($_SESSION['csrf'] !== $_GET['csrf'])
{
	exit_message(CSRF_ERROR);
}
// make sure user is logged in (for non-admins, we will verify their ID later)
if (!isset($_SESSION['user']))
{
	exit_message(NOT_ADMIN);
}
// make sure ID is valid
if (!ctype_alnum($_GET['id']) || (strlen($_GET['id']) !== 5))
{
	exit_message(IMAGE_ID_NOT_VALID);
}
$id = $_GET['id'];
require('db.php');
$exists = mysqli_prepare($db, 'SELECT `ext`, `user` FROM `images` WHERE `id` = ?');
// query DB to see if ID exists
mysqli_stmt_bind_param($exists, 's', $id);
mysqli_stmt_execute($exists);
++$db_queries;
mysqli_stmt_store_result($exists);
if (mysqli_stmt_num_rows($exists) === 0)
{
	exit_message(DELETE_NO_IMAGE);
}
mysqli_stmt_bind_result($exists, $ext, $user);
mysqli_stmt_fetch($exists);
mysqli_stmt_close($exists);
if (!isset($_SESSION['admin']) && ($_SESSION['user'] !== $user))
{
	exit(CSRF_ERROR);
}
unlink('images/' . $id . '.' . $ext);
$thumb = 'thumbs/' . $id . '.jpg';
if (file_exists($thumb))
{
	unlink($thumb);
}
$delete = mysqli_prepare($db, 'UPDATE `images` SET `removed` = "1" WHERE `id` = ?');
mysqli_stmt_bind_param($delete, 's', $id);
mysqli_stmt_execute($delete);
++$db_queries;
mysqli_stmt_close($delete);
// check if image has been reported
// if it has, set to actioned
$reported = mysqli_prepare($db, 'SELECT EXISTS(SELECT 1 FROM `reports` WHERE `id` = ?)');
// query DB to see if ID exists
mysqli_stmt_bind_param($reported, 's', $id);
mysqli_stmt_execute($reported);
++$db_queries;
mysqli_stmt_bind_result($reported, $result);
mysqli_stmt_fetch($reported);
mysqli_stmt_close($reported);
// update report to actioned
if ($result === 1)
{
	$actioned = mysqli_prepare($db, 'UPDATE `reports` SET `actioned` = "1" WHERE `id` = ?');
	mysqli_stmt_bind_param($actioned, 's', $id);
	mysqli_stmt_execute($actioned);
	++$db_queries;
	mysqli_stmt_close($actioned);
}
mysqli_close($db);
exit_message(DELETE_IMAGE_SUCCESS ." ".$_GET['id']);