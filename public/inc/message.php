<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo MESSAGE_TITLE; ?></p>
	<p><?php echo $message; ?></p>
</div>