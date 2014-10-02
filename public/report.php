<?php

$start = microtime(true);

require('conf.php');
require('common.php');
require('inc/header.php');

if (!ctype_alnum($_GET['id']) || (strlen($_GET['id']) !== 5))
{
	$message = 'Oops, that ID appears to be invalid. IDs should have 5 characters and contain letters and numbers only.';
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}

require('db.php');

$image_query = mysqli_query($db, 'SELECT COUNT(*) FROM `images` WHERE `id` = "' . $_GET['id'] . '"');
++$db_queries;

if (mysqli_fetch_row($image_query)[0] === 0)
{
	$message = 'Hmm, no image exists with that ID. Maybe it was deleted or you typed in the URL incorrectly? IDs should have 5 characters and contain letters and numbers only.';
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}

$report_query = mysqli_query($db, 'SELECT `actioned` FROM `reports` WHERE `id` = "' . $_GET['id'] . '"');
++$db_queries;

if (mysqli_num_rows($report_query) === 0)
{
	mysqli_query($db, 'INSERT INTO `reports` (`id`, `ip`) VALUES ("' . $_GET['id'] . '", "' . $_SERVER['REMOTE_ADDR'] . '")');

	mail($report_email, 'An image has been reported (' . $_GET['id'] . ')', 'The following image has been reported: ' . $view_url . $_GET['id'], 'FROM: reports <reports@' . $site_url . '>');
	$message = 'This image has been reported and will be reviewed. Thank you.';
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}

if (mysqli_fetch_row($report_query)[0] === '0')
{
	$message = 'This image has already been reported and is currently under review. Thank you.';
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}

$message = 'This image has already been reported, and after review was deemed to be acceptable.';
require('inc/message.php');
require('inc/footer.php');
exit;

