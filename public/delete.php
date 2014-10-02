<?php

$start = microtime(true);

session_start();

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

if ($_SESSION['admin'] === true)
{
	require('db.php');

	$image_query = mysqli_query($db, 'SELECT `ext` FROM `images` WHERE `id` = "' . $_GET['id'] . '"');
	++$db_queries;

	if (mysqli_num_rows($image_query) === 0)
	{
		$messsage = 'Hmm, that ID does not seem to exist';
		require('inc/message.php');
		require('inc/footer.php');
		exit;
	}

	unlink('images/' . $_GET['id'] . '.' . mysqli_fetch_row($image_query)[0]);

	mysqli_free_result($image_query);

	mysqli_query($db, 'UPDATE `images` SET `removed` = "1" WHERE `id` = "' . $_GET['id'] . '"');
	++$db_queries;

	mysqli_query($db, 'UPDATE `reports` SET `actioned` = "1" WHERE `id` = "' . $_GET['id'] . '"');
	++$db_queries;

	$message = 'The image ' . $_GET['id'] . ' has been removed';
	require('inc/message.php');
	require('inc/footer.php');
}

