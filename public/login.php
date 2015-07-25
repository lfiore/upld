<?php

$start = microtime(true);

session_start();

require('config.php');
require('common.php');

if ((ADMIN_USERNAME === '') || (ADMIN_SALT === '') || (ADMIN_PASSWORD === ''))
{
	exit_message('Login not allowed, please set login details in conf file');
}

if (isset($_POST['username']) && isset($_POST['password']))
{
	if (($_POST['username'] === ADMIN_USERNAME) && (hash('sha256', ADMIN_SALT . $_POST['password']) === ADMIN_PASSWORD)) {
		$_SESSION['admin'] = true;
		exit_message('You have now been logged in. You can delete images with the red text under the "info" box on an image\'s page');
	}
}

require('inc/header.php');
require('inc/login.php');
require('inc/footer.php');

