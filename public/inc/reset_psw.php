<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo PSW_RESET_PAGE_TITLE;?></p>
	<p><?php echo PSW_RESET_PAGE_DESC;?></p>
	<form name="reset_psw" method="POST" action="reset_psw.php">
		<input name="email" type="text" placeholder="<?php echo PSW_RESET_EMAIL_PLACEHOLDER;?>" />
		<input name="submit" type="submit" value="<?php echo PSW_RESET_CONFIRM;?>" />
	</form>
</div>