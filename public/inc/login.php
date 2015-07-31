<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Log in</p>

	<p>Log in to your account to manage your uploads</p>

	<form name="login" method="POST" action="login.php">
		<input name="email" type="text" placeholder="email..." />
		<input name="password" type="password" placeholder="password..." />
		<input name="submit" type="submit" value="Log in" />
	</form>

</div>