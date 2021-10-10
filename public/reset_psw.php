<?php
require('config.php');
require('common.php');
if (!isset($_POST['submit']))
{
	require('inc/header.php');
	require('inc/reset_psw.php');
	require('inc/footer.php');
	exit;
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	exit_message(NOT_VALID_MAIL);
}
$email = $_POST['email'];
$salt = uniqid(true);
$password = rand_string(rand(8,14));
$password_hashed = hash("sha256",$salt.$password);
mysqli_query($db,"UPDATE users SET salt=\"$salt\",password=\"$password_hashed\" WHERE email = \"$email\";");
$headers = 'From: '.RESET_PSW_EMAIL . "\r\n" .
		'Reply-To: '.RESET_PSW_EMAIL . "\r\n" .
		'Content-type: text/plain; charset=UTF-8' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		mail($email, PSW_RESET_MAIL_TITLE,PSW_RESET_MAIL_TEXT. $password, $headers);
mysqli_close($db);
exit_message(PSW_RESET_NOTICE);