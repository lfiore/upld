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
	exit_message(ERROR_NO_MAIL_OR_PSW);
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	exit_message(NOT_VALID_MAIL);
}
// user has entered a valid email and a password
$email = $_POST['email'];
$password = $_POST['password'];
$user = mysqli_prepare($db, 'SELECT `id`, `admin`, `banned` FROM `users` WHERE `email` = ? AND `password` = SHA2(CONCAT(`salt`, ?), 256)');
mysqli_stmt_bind_param($user, 'ss', $email, $password);
mysqli_stmt_execute($user);
++$db_queries;
mysqli_stmt_store_result($user);
if (mysqli_stmt_num_rows($user) ===0)
{
	exit_message(INVALID_LOGIN);
}
mysqli_stmt_bind_result($user, $id, $admin, $banned);
mysqli_stmt_fetch($user);
if ($banned === '1')
{
	// user is banned ($banned will return 1);
	exit_message(BANNED_USER_LOGIN);
}
$_SESSION['user'] = $id;
$session_query = mysqli_prepare($db, 'INSERT INTO session (session_hash, id) VALUES (?,?)');
$session_id = hash('sha256', $id.time());
mysqli_stmt_bind_param($session_query, 'si', $session_id, $id);
mysqli_stmt_execute($session_query);
++$db_queries;
mysqli_stmt_store_result($session_query);
mysqli_stmt_fetch($session_query);
setcookie("Session", $session_id, time()+2592000);
if ($admin === '1')
{
	// ONLY set this variable if user is an admin ($admin will return 1)
	$_SESSION['admin'] = true;
}
mysqli_stmt_close($user);
mysqli_close($db);
exit_message(LOGIN_SUCCESS);