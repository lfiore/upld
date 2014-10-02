<?php

if (!isset($in_script))
{
	exit('you are not allowed to access this page directly');
}

?>

<div class="box">

	<p class="title">Message</p>

	<p><?php echo $message; ?></p>

</div>