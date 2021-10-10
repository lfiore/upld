<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div class="box">
	<p class="title"><?php echo TC_PAGE_TITLE;?></p>
	<p><?php echo TC_PAGE_TERMS_DESC;?></p>
	<ul class="tc">
		<li><?php echo TC_PAGE_NO_COPYRIGHT_IMG;?></li>
		<li><?php echo TC_PAGE_NO_ILLEGAL_IMAGE;?></li>
	</ul>
	<p><?php echo TC_PAGE_INFO_DESC;?></p>
	<ul class="tc">
		<li><?php echo TC_PAGE_IP_NOTICE;?></li>
		<li><?php echo TC_PAGE_IMG_DEL_NOTICE;?></li>
	</ul>
</div>