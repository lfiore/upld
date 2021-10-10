<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo LOGIN_PAGE_TITLE;?></p>
	<p><?php echo LOGIN_PAGE_DESC;?></p>
	<form name="login" method="POST" action="login.php">
		<input name="email" type="text" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_MAIL;?>" />
		<input name="password" type="password" placeholder="<?php echo PSW_LABEL_PLACEHOLDER;?>" />
		<input name="submit" type="submit" value="Log in" />
	</form>
<a href='reset_psw.php'><?php echo FORGOT_PSW;?></a>
</div>