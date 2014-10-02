<?php

$start = microtime(true);

session_start();

require('conf.php');
require('common.php');
require('inc/header.php');

if (($admin_username === '') || ($admin_salt === '') || ($admin_password === ''))
{
	$message = 'Login not allowed, please set login details in conf file';
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}

if (isset($_POST['username']) && isset($_POST['password']))
{
	if (($_POST['username'] === $admin_username) && (hash('sha256', $admin_salt . $_POST['password']) === $admin_password)) {
		$_SESSION['admin'] = true;
		$message = 'You have now been logged in. You can delete images with the red text under the "info" box on an image\'s page';
		require('inc/message.php');
		require('inc/footer.php');
		exit;
	}
}

require('inc/login.php');
require('inc/footer.php');

