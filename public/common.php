<?php

session_start();

$start = microtime();

$db_queries = 0;

if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] == 443))
{
        define('PROTOCOL', 'https://');
}
else
{
        define('PROTOCOL', 'http://');
}

define('MAIN_SITE_URL', trim(SITE_URL, '/') . '/');

define('MAIN_SCRIPT_PATH', (SCRIPT_PATH ? trim(SCRIPT_PATH, '/') . '/' : ''));

define('VIEW_PATH', (FRIENDLY_URLS ? '' : 'view.php?id='));

define('VIEW_URL', PROTOCOL . MAIN_SITE_URL . MAIN_SCRIPT_PATH . VIEW_PATH);

define('IMAGES_URL', PROTOCOL . (FRIENDLY_URLS ? 'i.' : '') . MAIN_SITE_URL . (FRIENDLY_URLS ? '' : MAIN_SCRIPT_PATH . 'images/'));

define('IN_SCRIPT', true);

// server is using cloudflare, check for spoofed IP
if (CLOUDFLARE === true)
{
	require('lib/ip_in_range.php');
	
	// cloudflare IP ranges
	$cf_ipv4 = explode("\n", file_get_contents('https://www.cloudflare.com/ips-v4'));
	$cf_ipv6 = explode("\n", file_get_contents('https://www.cloudflare.com/ips-v6'));

	// check to make sure that the IP is valid, if the server is behind cloudflare
	if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
	{

		// assume IP is invalid
		$valid = false;

		// ipv4 or ipv6?
		if (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
			foreach ($cf_ipv4 as $range)
			{
				if (ipv4_in_range($_SERVER['REMOTE_ADDR'], $range))
				{
					$valid = true;
					define('IP', $_SERVER['HTTP_CF_CONNECTING_IP']);
					break;
				}
			}
		}
		elseif (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
		{
			foreach ($cf_ipv6 as $range)
			{
				if (ipv6_in_range($_SERVER['REMOTE_ADDR'], $range))
				{
					$valid = true;
					define('IP', $_SERVER['HTTP_CF_CONNECTING_IP']);
					break;
				}
			}
		}
		else
		{
			exit_message('IP address error');
		}

		if ($valid === false)
		{
			exit_message('ip spoofing detected');
		}
	}
}
else
{
	define('IP', $_SERVER['REMOTE_ADDR']);
}

function exit_message($message)
{
	require('inc/header.php');
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}
