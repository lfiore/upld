<?php

require('config.php');
require('common.php');

if (!isset($_POST['submit']))
{
	require('inc/header.php');
	require('inc/register.php');
	require('inc/footer.php');
	exit;
}

if (empty($_POST['email']) || empty($_POST['email-confirm']) || empty($_POST['password']) || empty($_POST['password-confirm']))
{
	exit_message('Please make sure all fields are filled in');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	exit_message('The email you entered is invalid');
}

if ($_POST['email'] !== $_POST['email-confirm'])
{
	exit_message('The email and confirmation email do not match');
}

if (strlen($_POST['password']) < 8)
{
	exit_message('Please enter a longer password (8 characters minimum)');
}

if ($_POST['password'] !== $_POST['password-confirm'])
{
	exit_message('The password and confirmation password do not match');
}

// user has filled in all fields, entered a valid email and long enough password
// user has also confirmed his emails and passwords

$email = $_POST['email'];

// check DB for existing account with that password

require('db.php');

$exists = mysqli_prepare($db, 'SELECT EXISTS(SELECT 1 FROM `users` WHERE `email` = ?)');

mysqli_stmt_bind_param($exists, 's', $email);
mysqli_stmt_execute($exists);
++$db_queries;
mysqli_stmt_bind_result($exists, $result);
mysqli_stmt_fetch($exists);
mysqli_stmt_close($exists);

if ($result === 1)
{
	exit_message('An account already exists with that email');
}

// account doesn't exist
// generate salt, hash password and insert info into DB

$query = mysqli_prepare($db, 'INSERT INTO `users` (`email`, `salt`, `password`, `ip`) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($query, 'ssss', $email, $salt, $password, $ip);

// set data for query
$salt = uniqid(true);
$password = hash('sha256', $salt . $_POST['password']);
$ip = IP;

// insert data
mysqli_stmt_execute($query);
++$db_queries;
mysqli_stmt_close($query);

// get user's ID
$id = mysqli_insert_id($db);

// close connection
mysqli_close($db);

$_SESSION['user'] = $id;

exit_message('Your account has been created and you have been logged in');

