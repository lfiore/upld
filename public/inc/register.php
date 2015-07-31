<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Register</p>

	<p>You can register an account which will allow you to keep track of your uploaded images</p>

	<form name="register" method="POST" action="register.php">
		<input name="email" type="text" placeholder="email..." />
		<input name="email-confirm" type="text" placeholder="confirm email..." />
		<input name="password" type="password" placeholder="password... (8 characters minimum)" />
		<input name="password-confirm" type="password" placeholder="confirm password... (8 characters minimum)" />
		<input name="submit" type="submit" value="Log in" />
	</form>

</div>