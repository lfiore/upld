<?php 
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
if (file_exists("./lang/".LANGUAGE.".php")) {
	include ("./lang/".LANGUAGE.".php");
}else{
	include ("./lang/en.php");
}
?>