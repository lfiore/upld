<?php

if (!isset($in_script))
{
	exit('you are not allowed to access this page directly');
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