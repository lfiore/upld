<?php

require('config.php');
require('common.php');

$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));

if (!ctype_alnum($_GET['id']) || (strlen($_GET['id']) !== 5))
{
	exit_message('Oops, that ID appears to be invalid. IDs should have 5 characters and contain letters and numbers only.');
}

// ID supplied by user is safe (5 chars alphanumeric)
$id = $_GET['id'];

require('db.php');

$image = mysqli_prepare($db, 'SELECT `ext`, `time`, `user`, `ip`, `removed` FROM `images` WHERE `id` = ?');
mysqli_stmt_bind_param($image, 's', $id);
mysqli_stmt_execute($image);
++$db_queries;
mysqli_stmt_store_result($image);

if (mysqli_stmt_num_rows($image) === 0)
{
	exit_message('Hmm, no image exists with that ID. Maybe it was deleted or you typed in the URL incorrectly?');
}

mysqli_stmt_bind_result($image, $ext, $time, $user, $ip, $removed);
mysqli_stmt_fetch($image);

if ($removed === '1')
{
	exit_message('This image has been deleted.');
}

mysqli_stmt_close($image);
mysqli_close($db);

$dimensions = getimagesize('images/' . $id . '.' . $ext);
$size = (filesize('images/' . $id . '.' . $ext) / 1024);

require('inc/header.php');
require('inc/view.php');
require('inc/footer.php');
