<?php

require('config.php');
require('common.php');

if (!isset($_POST['submit']))
{
	require('inc/header.php');
	require('inc/login.php');
	require('inc/footer.php');
	exit;
}

if (empty($_POST['email']) || empty($_POST['password']))
{
	exit_message('Please make sure you enter both an email address and password');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	exit_message('Please enter a valid email address');
}

// user has entered a valid email and a password
$email = $_POST['email'];
$password = $_POST['password'];

require('db.php');

$user = mysqli_prepare($db, 'SELECT `id`, `salt`, `password`, `admin`, `banned` FROM `users` WHERE `email` = ?');
mysqli_stmt_bind_param($user, 's', $email);
mysqli_stmt_execute($user);
++$db_queries;
mysqli_stmt_store_result($user);

if (mysqli_stmt_num_rows($user) ===0)
{
	exit_message('Sorry, either no account exists with this email or the password is incorrect');
}

mysqli_stmt_bind_result($user, $id, $salt, $password, $admin, $banned);
mysqli_stmt_fetch($user);
mysqli_stmt_close($user);
mysqli_close($db);

if ($banned === '1')
{
	// user is banned ($banned will return 1);
	exit_message('This account has been banned');
}

$hashed_password = hash('sha256', $salt . $_POST['password']);

if ($password !== $hashed_password)
{
	exit_message('Sorry, either no account exists with this email or the password is incorrect');
}
else
{
	$_SESSION['user'] = $id;
}


if ($admin === '1')
{
	// ONLY set this variable if user is an admin ($admin will return 1)
	$_SESSION['admin'] = true;
}

exit_message('You have been logged in');

