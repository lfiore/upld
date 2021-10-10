<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
<div id="sidebar">
	<ul id="links" class="box sidebar-box">
		<li><?php echo VIEW_LINK;?></li>
		<li><input type="text" value="<?php echo VIEW_URL . $id; ?>" readonly /></li>
		<li><?php echo VIEW_DIRECT_LINK;?></li>
		<li><input type="text" value="<?php echo IMAGES_URL . $id . '.' . $ext; ?>" readonly /></li>
		<li><?php echo VIEW_HTML;?></li>
		<li><input type="text" size="25" value="<img src=&#34;<?php echo IMAGES_URL . $id . '.' . $ext; ?>&#34; alt=&#34;<?php echo $id; ?>&#34; />" readonly /></li>
		<li><?php echo VIEW_BBCODE;?></li>
		<li><input type="text" size="25" value="[img]<?php echo IMAGES_URL . $id . '.' . $ext; ?>[/img]" readonly /></li>
		<li><?php echo VIEW_BBCODE_WITH_LINK;?></li>
		<li><input type="text" size="25" value="[url=<?php echo VIEW_URL . $id; ?>][img]<?php echo IMAGES_URL . $id . '.' . $ext; ?>[/img][/url]" readonly /></li>
	</ul>
	<ul id="info" class="box sidebar-box">
		<li><?php echo VIEW_ID_IMG." ".$id; ?></li>
		<li><?php echo VIEW_IMG_SIZE." ".$dimensions[0] . 'x' . $dimensions[1]; ?></li>
		<li><?php echo VIEW_IMG_WEIGHT." ".($size > 1024 ? round(($size / 1024), 1) . 'MB' : round($size, 1) . 'KB' ); ?></li>
		<li><?php echo VIEW_IMG_TYPE." ".$ext; ?></li>
<?php
if (isset($_SESSION['admin']))
{
?>
		<li><?php echo VIEW_IMG_UPLOAD_TIME." ".$time; ?></li>
		<li><?php echo VIEW_IMG_IP_FROM." ".$ip; ?></li>
<?php
}
?>
	</ul>
	<ul id="report">
<?php
if (isset($_SESSION['admin']) || (isset($_SESSION['user']) && ($_SESSION['user'] === $user)))
{
?>
		<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>"><?php echo DELETE_IMAGE;?></a></li>
<?php
} 
else
{
?>
		<li><a href="report.php?id=<?php echo $id;?>"><?php echo REPORT_IMAGE;?></a></li>
<?php
}
if (isset($_SESSION['admin']))
{
?>
		<li><a id="ban" href="ban.php?id=<?php echo $user . '&csrf=' . $_SESSION['csrf']; ?>"><?php echo BAN_USER;?></a></li>
		<li><a id="moderate-user" href="moderate.php?id=<?php echo $user; ?>"><?php echo VIEW_OTHERS_FROM_SAME_USER;?></a>
		<li><a id="moderate-ip" href="moderate.php?ip=<?php echo $ip; ?>"><?php echo VIEW_OTHERS_FROM_SAME_IP;?></a>
<?php
}
?>
	</ul>
</div>
<div id="image" class="box">
	<img src="<?php echo IMAGES_URL . $id . '.' . $ext; ?>" />
</div>
