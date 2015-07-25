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
		<li><input type="text" value="<?php echo $view_url . $_GET['id']; ?>" readonly /></li>
		<li>direct link (websites &amp; backgrounds)</li>
		<li><input type="text" value="<?php echo $images_url . $_GET['id'] . '.' . $image['ext']; ?>" readonly /></li>
		<li>html code (websites)</li>
		<li><input type="text" size="25" value="<img src=&#34;<?php echo $images_url . $_GET['id'] . '.' . $image['ext']; ?>&#34; alt=&#34;<?php echo $_GET['id']; ?>&#34; />" readonly /></li>
		<li>bb code (forums)</li>
		<li><input type="text" size="25" value="[img]<?php echo $images_url . $_GET['id'] . '.' . $image['ext']; ?>[/img]" readonly /></li>
		<li>linked bb code (forums)</li>
		<li><input type="text" size="25" value="[url=<?php echo $view_url . $_GET['id']; ?>][img]<?php echo $images_url . $_GET['id'] . '.' . $image['ext']; ?>[/img][/url]" readonly /></li>
	</ul>

	<ul id="info" class="box sidebar-box">
		<li>image ID: <?php echo $_GET['id']; ?></li>
		<li>image dimensions: <?php echo $dimensions[0] . 'x' . $dimensions[1]; ?></li>
		<li>image size: <?php echo ($size > 1024 ? round(($size / 1024), 1) . 'MB' : round($size, 1) . 'KB' ); ?></li>
		<li>image type: <?php echo $image['ext']; ?></li>

<?php

if (isset($_SESSION['admin']))
{

?>

		<li>Upload time: <?php echo $image['time']; ?></li>
		<li>Uploader IP: <?php echo $image['ip']; ?></li>

<?php

}

?>

	</ul>

	<ul id="report">

<?php

if (isset($_SESSION['admin'])) {

?>

		<li><a id="delete" href="delete.php?id=<?php echo $_GET['id']; ?>">DELETE this image</a></li>

<?php

}
else
{

?>

		<li><a href="report.php?id=<?php echo $_GET['id']; ?>">report this image</a></li>

<?php

}

?>

	</ul>

</div>

<div id="image" class="box">
	<img src="<?php echo IMAGES_URL . $_GET['id'] . '.' . $image['ext']; ?>" />
</div>

