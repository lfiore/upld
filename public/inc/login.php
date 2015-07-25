<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Admin login</p>

	<form name="login" method="POST" action="login.php">
		<input name="username" type="text" size="40" placeholder="username..." />
		<input name="password" type="password" size="40" placeholder="password..." />
		<input type="submit" value="Log in" />
	</form>

</div>