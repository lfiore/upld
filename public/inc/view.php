<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div id="sidebar">

	<ul id="links" class="box sidebar-box">
		<li>preview link (email &amp; chat)</li>
		<li><input type="text" value="<?php echo VIEW_URL . $id; ?>" readonly /></li>
		<li>direct link (websites &amp; backgrounds)</li>
		<li><input type="text" value="<?php echo IMAGES_URL . $id . '.' . $ext; ?>" readonly /></li>
		<li>html code (websites)</li>
		<li><input type="text" size="25" value="<img src=&#34;<?php echo IMAGES_URL . $id . '.' . $ext; ?>&#34; alt=&#34;<?php echo $id; ?>&#34; />" readonly /></li>
		<li>bb code (forums)</li>
		<li><input type="text" size="25" value="[img]<?php echo IMAGES_URL . $id . '.' . $ext; ?>[/img]" readonly /></li>
		<li>linked bb code (forums)</li>
		<li><input type="text" size="25" value="[url=<?php echo VIEW_URL . $id; ?>][img]<?php echo IMAGES_URL . $id . '.' . $ext; ?>[/img][/url]" readonly /></li>
	</ul>

	<ul id="info" class="box sidebar-box">
		<li>image ID: <?php echo $id; ?></li>
		<li>image dimensions: <?php echo $dimensions[0] . 'x' . $dimensions[1]; ?></li>
		<li>image size: <?php echo ($size > 1024 ? round(($size / 1024), 1) . 'MB' : round($size, 1) . 'KB' ); ?></li>
		<li>image type: <?php echo $ext; ?></li>

<?php

if (isset($_SESSION['admin']))
{

?>

		<li>upload time: <?php echo $time; ?></li>
		<li>uploader IP: <?php echo $ip; ?></li>

<?php

}

?>

	</ul>

	<ul id="report">

<?php

if (isset($_SESSION['admin']) || (isset($_SESSION['user']) && ($_SESSION['user'] === $user)))
{

?>

		<li><a class="delete" href="delete.php?id=<?php echo $id . '&csrf=' . $_SESSION['csrf']; ?>">DELETE this image</a></li>

<?php

}

else
{

?>

		<li><a href="report.php?id=<?php echo $id; ?>">report this image</a></li>

<?php

}

if (isset($_SESSION['admin']))
{

?>

		<li><a id="ban" href="ban.php?id=<?php echo $user . '&csrf=' . $_SESSION['csrf']; ?>">BAN user and DELETE ALL IMAGES</a></li>
		<li><a id="moderate-user" href="moderate.php?id=<?php echo $user; ?>">view user's other uploaded images</a>
		<li><a id="moderate-ip" href="moderate.php?ip=<?php echo $ip; ?>">view all images uploaded with this IP address</a>

<?php

}

?>

	</ul>

</div>

<div id="image" class="box">
	<img src="<?php echo IMAGES_URL . $id . '.' . $ext; ?>" />
</div>

