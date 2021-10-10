<?php
require('config.php');
require('common.php');
$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
if (!isset($_SESSION['user']))
{
	exit_message(NOT_ADMIN);
}
$user = $_SESSION['user'];
require('db.php');
//change password
if (isset($_POST["submit_new_password"])){
	if (!isset($_POST["password"]) or !isset($_POST["new_password"]) or !isset($_POST["new_password-confirm"])) {
		exit_message(REGISTER_ALL_FIELD_NEEDED);
	}
	if ($_POST["new_password"] != $_POST["new_password-confirm"]){
		exit_message(PSWS_NOT_IDENTICAL);
	}
	$new_password = mysqli_real_escape_string($db, $_POST['new_password']);	
	$salt = uniqid(true);
	$password_hashed = hash("sha256",$salt.$new_password);	
	mysqli_query($db,"UPDATE users SET salt=\"$salt\",password=\"$password_hashed\" WHERE id = $user;");
	exit_message(PSW_CHANGED);
}
//change email
if (isset($_POST["submit_new_email"])){
	if (!isset($_POST["email"]) or !isset($_POST["new_email"]) or !isset($_POST["new_email-confirm"])) {
		exit_message(REGISTER_ALL_FIELD_NEEDED);
	}
	if ($_POST["new_email"] != $_POST["new_email-confirm"]){
		exit_message(MAILS_NOT_IDENTICAL);
	}
	$email = mysqli_real_escape_string($db,$_POST["new_email"]);	
	mysqli_query($db,"UPDATE users SET email=\"$email\" WHERE id = $user;");
	exit_message(EMAIL_CHANGED);
}
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
			exit_message(INVALID_PAGE_NUMBER);
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
		exit_message(NO_IMAGE_LIST);
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
		exit_message(NO_IMAGE_LIST);
	}
	mysqli_stmt_bind_result($images, $id, $ext, $time);
}
require('inc/header.php');
require('inc/account.php');
require('inc/footer.php');