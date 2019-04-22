<?php

require('config.php');
require('common.php');

// make sure user is logged in (for non-admins, we will verify their ID later)
if (!isset($_SESSION['admin']))
{
	exit_message('You are not authorised to perform this action. Please log in.');
}

// make sure ID is valid
if (isset($_GET['id']))
{
	if (!ctype_digit($_GET['id']))
	{
		exit_message('Oops, that ID appears to be invalid. User IDs should be numberic');
	}
	$search_term = $_GET['id'];
	$type = 'user';
}
elseif (isset($_GET['ip']))
{
	if (!filter_var($_GET['ip'], FILTER_VALIDATE_IP))
	{
		exit_message('Oops, that IP address appears to be invalid');
	}
	$search_term = $_GET['ip'];
	$type = 'ip';
}
else
{
	exit_message('no ID or IP address specified');
}

require('db.php');

$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `' . $type . '` = ? AND `removed` = "0" ORDER BY `time` ASC');

mysqli_stmt_bind_param($images, 's', $search_term);
mysqli_stmt_execute($images);
++$db_queries;
mysqli_stmt_store_result($images);

if (mysqli_stmt_num_rows($images) === 0)
{
	exit_message('No images found for this user');
}

mysqli_stmt_bind_result($images, $id, $ext, $time);

require('inc/header.php');
require('inc/moderate.php');
require('inc/footer.php');

