<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
} 
?>
<div class="box">
	<p class="title"><?php echo ACCOUNT_PAGE_PASSWORD_TITLE;?></p>
	<p><?php echo ACCOUNT_PAGE_PASSWORD_DESC;?></p>
	
	<form name="password_change" method="POST" action="account.php">
		<input name="password" type="password" placeholder="<?php echo PSW_LABEL_PLACEHOLDER;?>" required/>
		<input name="new_password" type="password" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_PSW;?>" required />
		<input name="new_password-confirm" type="password" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_PSW_CONFIRM;?>" required />
		<input name="submit_new_password" type="submit" value="<?php echo CHANGE_PASSWORD;?>" />
	</form>	
</div>
<div class="box">
	<p class="title"><?php echo ACCOUNT_PAGE_EMAIL_TITLE;?></p>
	<p><?php echo ACCOUNT_PAGE_EMAIL_DESC;?></p>
	<form name="email_change" method="POST" action="account.php">
		<input name="email" type="email" placeholder="<?php echo MAIL_LABEL_PLACEHOLDER;?>" required/>
		<input name="new_email" type="email" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_MAIL;?>" required />
		<input name="new_email-confirm" type="email" placeholder="<?php echo REGISTER_LABEL_PLACEHOLDER_MAIL_CONFIRM;?>" required />
		<input name="submit_new_email" type="submit" value="<?php echo CHANGE_EMAIL;?>" />
	</form>	
</div>
<div class="box">
	<p class="title"><?php echo ACCOUNT_PAGE_TITLE;?></p>
	<p><?php echo ACCOUNT_PAGE_DESC;?></p>
<?php
if (PAGINATION > 0)
{
?>
	<div id="pagination">
<?php
if (($page - 1) > 0)
{
	echo '<a href="?page=1">'.PAGINATION_FIRST.'</a> <a href="?page=' . ($page - 1) . '">'.PAGINATION_PREVIOUS.'</a> ';	
}
for ($i = 1; $i <= $pages_count; ++$i)
{
	if ($i == $page)
	{
		echo $page;
	}
	else
	{
		echo '<a href="?page=' . $i . '"> ' . $i . ' </a>';
	}
}
if (($page + 1) <= $pages_count)
{
	echo ' <a href="?page=' . ($page + 1) . '">'.PAGINATION_LAST.'</a> <a href="?page=' . $pages_count . '">'.PAGINATION_LAST.'</a>';
}
?>
	</div>
<?php
}
?>
	<div id="user-images"><!--
<?php
while (mysqli_stmt_fetch($images))
{
?>
		--><div class="user-image-box">
			<a href="<?php echo VIEW_PATH . $id; ?>"><img class="user-image" src="thumbs/<?php echo $id . '.jpg'; ?>" alt="<?php echo $id; ?>" /></a>
			<ul class="image-actions">
				<li><?php echo UPLOAD_TIME." ".$time; ?></li>
				<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>"><?php echo ACCOUNT_DEL_IMAGE; ?></a></li>
			</ul>
		</div><!--
<?php
}
?>
--></div>
<?php
mysqli_stmt_close($images);
mysqli_close($db);
?>
</div>