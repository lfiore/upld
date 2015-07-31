<?php

require('config.php');
require('common.php');

if (!isset($_SESSION['user']))
{
	exit_message('You are no authorised to access this page. Please log in.');
}

$user = $_SESSION['user'];

require('db.php');

$images = mysqli_prepare($db, 'SELECT `id`, `ext`, `time` FROM `images` WHERE `user` = ? AND `removed` = "0" ORDER BY `time` ASC');

mysqli_stmt_bind_param($images, 'i', $user);
mysqli_stmt_execute($images);
++$db_queries;
mysqli_stmt_store_result($images);

if (mysqli_stmt_num_rows($images) === 0)
{
	exit_message('You haven\'t uploaded any images yet!');
}

mysqli_stmt_bind_result($images, $id, $ext, $time);

require('inc/header.php');
require('inc/account.php');
require('inc/footer.php');

