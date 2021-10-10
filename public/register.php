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
	exit_message(REGISTER_ALL_FIELD_NEEDED);
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	exit_message(REGISTER_MAIL_NOT_VALID);
}
if ($_POST['email'] !== $_POST['email-confirm'])
{
	exit_message(MAILS_NOT_IDENTICAL);
}
if (strlen($_POST['password']) < 8)
{
	exit_message(PSW_TOO_SHORT);
}
if ($_POST['password'] !== $_POST['password-confirm'])
{
	exit_message(PSWS_NOT_IDENTICAL);
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
	exit_message(MAIL_ALREADY_IN_USE);
}
// account doesn't exist
// generate salt, hash password and insert info into DB
$query = mysqli_prepare($db, 'INSERT INTO `users` (`email`, `salt`, `password`, `ip`) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($query, 'ssss', $email, $salt, $password, $ip);
// set data for query
$salt = uniqid(true);
$password = hash('sha256', $salt . $_POST['password']);
if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
{
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
}
else
{
	$ip = $_SERVER['REMOTE_ADDR'];
}
// insert data
mysqli_stmt_execute($query);
++$db_queries;
mysqli_stmt_close($query);
// get user's ID
$id = mysqli_insert_id($db);
// close connection
mysqli_close($db);
$_SESSION['user'] = $id;
exit_message(ACCOUNT_CREATED);