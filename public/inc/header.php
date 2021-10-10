<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?></title>
	<link href="css/upload.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.min.js" type="text/javascript"></script>	
	<script src="js/upload.js" type="text/javascript"></script>
</head>
<script>
$( document ).ready(function() {
   [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
         img.setAttribute('src', img.getAttribute('data-src'));
         img.onload = function() {
            img.removeAttribute('data-src');
         };
   });
});
</script>	
<body>
	<div id="header">
		<ul id="navbar">
			<!-- need to use a dirty hack here to avoid whitespace in between navbar buttons  -->
			<li><a href="index.php"><?php echo GO_UPLOAD;?></a></li><!--
<?php
if (isset($_SESSION['user'])) 
{
?>
			--><li><a href="account.php"><?php echo YOUR_ACCOUNT;?></a></li><!--
			--><li><a href="logout.php"><?php echo GO_LOGOUT;?></a></li>
<?php
}
else
{
?>
			--><li><a href="login.php"><?php echo GO_LOGIN;?></a></li><li><a href="register.php"><?php echo GO_REGISTER;?></a></li>
<?php
}
?>
		</ul>
		<div id="logo"><?php echo SITE_NAME; ?></div>
	</div>
	<div id="main">