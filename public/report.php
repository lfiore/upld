<?php
require('config.php');
require('common.php');
if (!ctype_alnum($_GET['id']) || (strlen($_GET['id']) !== 5))
{
	exit_message(IMAGE_ID_NOT_VALID);
}
$id = $_GET['id'];
require('db.php');
$exists = mysqli_prepare($db, 'SELECT EXISTS(SELECT 1 FROM `images` WHERE `id` = ?)');
// query DB to see if ID exists
mysqli_stmt_bind_param($exists, 's', $id);
mysqli_stmt_execute($exists);
++$db_queries;
mysqli_stmt_bind_result($exists, $result);
mysqli_stmt_fetch($exists);
mysqli_stmt_close($exists);
if ($result === 0)
{
	exit_message(DELETE_NO_IMAGE);
}
// check if image has been reported
$reported = mysqli_prepare($db, 'SELECT `actioned` FROM `reports` WHERE `id` = ?');
// query DB to see if ID exists
mysqli_stmt_bind_param($reported, 's', $id);
mysqli_stmt_execute($reported);
++$db_queries;
mysqli_stmt_store_result($reported);
if (mysqli_stmt_num_rows($reported) === 1)
{
	mysqli_stmt_bind_result($reported, $actioned);
	mysqli_stmt_fetch($reported);
	mysqli_stmt_close($reported);
	if ($result === 0)
	{
		exit_message(IMAGE_ALREADY_REPORTED);
	}
	elseif ($result === 1)
	{
		exit_message(IMAGE_ALREADY_CHECKED);
	}
}
$query = mysqli_prepare($db, 'INSERT INTO `reports` (`id`, `ip`) VALUES (?, ?)');
mysqli_stmt_bind_param($query, 'ss', $id, $ip);
// set data for query
$ip = $_SERVER['REMOTE_ADDR'];
// insert data
mysqli_stmt_execute($query);
++$db_queries;
mysqli_stmt_close($query);
// close connection
mysqli_close($db);
mail(REPORT_EMAIL, REPORT_IMAGE_MAIL_TITLE.$id,REPORT_IMAGE_MAIL_TEXT . VIEW_URL . $id, 'FROM: reports <reports@' . SITE_URL . '>');
exit_message(IMAGE_REPORTED_NOTICE);