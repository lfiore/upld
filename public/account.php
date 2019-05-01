<?php

require('config.php');
require('common.php');

$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));

if (!isset($_SESSION['user']))
{
	exit_message('You are no authorised to access this page. Please log in.');
}

$user = $_SESSION['user'];

require('db.php');

if (PAGINATION > 0)
{
	$max_pages = PAGINATION;

	if (!isset($_GET['page']))
	{
		$page = 1;
	}
	else
	{
		if (ctype_digit($_GET['page']))
		{
			$page = $_GET['page'];
		}
		else
		{
			exit_message('Invalid page number');
		}
	}

	$image_count = mysqli_prepare($db, 'SELECT COUNT(`id`) FROM `images` WHERE `user` = ? AND `removed` = "0"');

	mysqli_stmt_bind_param($image_count, 'i', $user);
	mysqli_stmt_execute($image_count);
	++$db_queries;
	mysqli_stmt_bind_result($image_count, $count);
	mysqli_stmt_fetch($image_count);
	mysqli_stmt_close($image_count);

	$start = (($page - 1) * $max_pages);

	$pages_count = ceil($count / $max_pages);

	$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `user` = ? AND `removed` = "0" ORDER BY `time` DESC LIMIT ?, ?');
	mysqli_stmt_bind_param($images, 'iii', $user, $start, $max_pages);
	mysqli_stmt_execute($images);
	++$db_queries;
	mysqli_stmt_store_result($images);

	if (mysqli_stmt_num_rows($images) === 0)
	{
		exit_message('You haven\'t uploaded any images yet!');
	}

	mysqli_stmt_bind_result($images, $id, $ext, $time);

}
else
{
	$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `user` = ? AND `removed` = "0" ORDER BY `time` DESC');

	mysqli_stmt_bind_param($images, 'i', $user);
	mysqli_stmt_execute($images);
	++$db_queries;
	mysqli_stmt_store_result($images);

	if (mysqli_stmt_num_rows($images) === 0)
	{
		exit_message('You haven\'t uploaded any images yet!');
	}

	mysqli_stmt_bind_result($images, $id, $ext, $time);
}

require('inc/header.php');
require('inc/account.php');
require('inc/footer.php');

