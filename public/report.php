<?php

$start = microtime(true);

require('config.php');
require('common.php');

if (!ctype_alnum($_GET['id']) || (strlen($_GET['id']) !== 5))
{
	exit_message('Oops, that ID appears to be invalid. IDs should have 5 characters and contain letters and numbers only.');
}

require('db.php');

$image_query = mysqli_query($db, 'SELECT COUNT(*) FROM `images` WHERE `id` = "' . $_GET['id'] . '"');
++$db_queries;

if (mysqli_fetch_row($image_query)[0] === 0)
{
	exit_message('Hmm, no image exists with that ID. Maybe it was deleted or you typed in the URL incorrectly? IDs should have 5 characters and contain letters and numbers only.');
}

$report_query = mysqli_query($db, 'SELECT `actioned` FROM `reports` WHERE `id` = "' . $_GET['id'] . '"');
++$db_queries;

if (mysqli_num_rows($report_query) === 0)
{
	mysqli_query($db, 'INSERT INTO `reports` (`id`, `ip`) VALUES ("' . $_GET['id'] . '", "' . $_SERVER['REMOTE_ADDR'] . '")');

	mail(REPORT_EMAIL, 'An image has been reported (' . $_GET['id'] . ')', 'The following image has been reported: ' . VIEW_URL . $_GET['id'], 'FROM: reports <reports@' . SITE_URL . '>');
	exit_message('This image has been reported and will be reviewed. Thank you.');
}

if (mysqli_fetch_row($report_query)[0] === '0')
{
	exit_message('This image has already been reported and is currently under review. Thank you.');
}

exit_message('This image has already been reported, and after review was deemed to be acceptable.');
