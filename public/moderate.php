<?php

require('config.php');
require('common.php');

// make sure user is logged in (for non-admins, we will verify their ID later)
if (!isset($_SESSION['admin']))
{
	exit_message('You are not authorised to perform this action. Please log in.');
}

$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));

// make sure ID is valid
if (isset($_GET['id']))
{
	if (!ctype_digit($_GET['id']))
	{
		exit_message('Oops, that ID appears to be invalid. User IDs should be numberic');
	}
	$search_term = $_GET['id'];
	$type = ['user', 'id'];
}
elseif (isset($_GET['ip']))
{
	if (!filter_var($_GET['ip'], FILTER_VALIDATE_IP))
	{
		exit_message('Oops, that IP address appears to be invalid');
	}
	$search_term = $_GET['ip'];
	$type = ['ip', 'ip'];
}
else
{
	exit_message('no ID or IP address specified');
}

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

	$image_count = mysqli_prepare($db, 'SELECT COUNT(`id`) FROM `images` WHERE `' . $type[0] . '` = ? AND `removed` = "0"');

	mysqli_stmt_bind_param($image_count, 'i', $search_term);
	mysqli_stmt_execute($image_count);
	++$db_queries;
	mysqli_stmt_bind_result($image_count, $count);
	mysqli_stmt_fetch($image_count);
	mysqli_stmt_close($image_count);

	$start = (($page - 1) * $max_pages);

	$pages_count = ceil($count / $max_pages);

	$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `' . $type[0] . '` = ? AND `removed` = "0" ORDER BY `time` DESC LIMIT ?, ?');

	mysqli_stmt_bind_param($images, 'sii', $search_term, $start, $max_pages);
	mysqli_stmt_execute($images);
	++$db_queries;
	mysqli_stmt_store_result($images);

	if (mysqli_stmt_num_rows($images) === 0)
	{
		exit_message('No images found for this user');
	}

	mysqli_stmt_bind_result($images, $id, $ext, $time);

}
else
{
	$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `' . $type[0] . '` = ? AND `removed` = "0" ORDER BY `time` DESC');

	mysqli_stmt_bind_param($images, 's', $search_term);
	mysqli_stmt_execute($images);
	++$db_queries;
	mysqli_stmt_store_result($images);

	if (mysqli_stmt_num_rows($images) === 0)
	{
		exit_message('No images found for this user');
	}

	mysqli_stmt_bind_result($images, $id, $ext, $time);
}

require('inc/header.php');
require('inc/moderate.php');
require('inc/footer.php');

