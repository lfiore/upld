<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo REGISTER_PAGE_TITLE;?></p>
	<p><?php echo REGISTER_PAGE_DESC;?></p>
	<form name="register" method="POST" action="register.php">
		<input name="email" type="text" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_MAIL;?>" />
		<input name="email-confirm" type="text" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_MAIL_CONFIRM;?>" />
		<input name="password" type="password" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_PSW;?>" />
		<input name="password-confirm" type="password" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_PSW_CONFIRM;?>" />
		<input name="disagio_pw" type="password" placeholder="Password di sblocco" />
		<input name="submit" type="submit" value="<?php echo REGISTER_LABEL_REGISTER_BUTTON;?>" />
	</form>
</div>