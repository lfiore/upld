<?php
$start = microtime();
include('db.php');
if (COOKIE_SESSION == true) {
	/* Cookie Session */
	if (isset($_COOKIE["Session"]) AND !isset($_SESSION["user"])) {
		$cookie = mysqli_real_escape_string($db, $_COOKIE["Session"]);
		$query = mysqli_query($db,"SELECT id FROM session WHERE session_hash = '$cookie' AND data_ora >= (CURDATE() - INTERVAL 30 DAY);") or die("Errore:".mysqli_error($query));
		++$db_queries;
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$_SESSION["user"] = $row["id"];
			}
			$query_adm = mysqli_query($db,"SELECT admin FROM users WHERE id = ".$_SESSION["user"].";") or die("Errore:".mysqli_error($query));
			++$db_queries;
			while ($row_adm = mysqli_fetch_array($query_adm, MYSQLI_ASSOC)) {
				if ($row_adm["admin"] == 1) $_SESSION['admin'] = true;
			}
		}
	}
}
$db_queries = 0;
define('MAIN_SITE_URL', trim(SITE_URL, '/') . '/');
define('MAIN_SCRIPT_PATH', (SCRIPT_PATH ? trim(SCRIPT_PATH, '/') . '/' : ''));
define('VIEW_PATH', (FRIENDLY_URLS ? '' : 'view.php?id='));
define('VIEW_URL', 'https://' . MAIN_SITE_URL . MAIN_SCRIPT_PATH . VIEW_PATH);
define('IMAGES_URL', 'https://' . (FRIENDLY_URLS ? 'i.' : '') . MAIN_SITE_URL . (FRIENDLY_URLS ? '' : MAIN_SCRIPT_PATH . 'images/'));
define('IN_SCRIPT', true);
include ("language_switch.php");
function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_%$£!";
    return substr(str_shuffle($chars),0,$length);
}
function exit_message($message)
{
	require('inc/header.php');
	require('inc/message.php');
	require('inc/footer.php');
	exit;
}