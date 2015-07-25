<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

<div class="box">

	<p class="title">Terms &amp; Conditions</p>

	<p>You must not use <?php echo SITE_NAME; ?> to upload any of the following:</p>

	<ul class="tc">
		<li>Copyrighted images (images owned by someone else) unless you have explicit permission</li>
		<li>Images which are considered illegal</li>
	</ul>

	<p>Things to note when using <?php echo SITE_NAME; ?>:</p>

	<ul class="tc">
		<li>When uploading an image, your IP address will be stored. We will not provide this information to anybody unless requested by law enforcement authorities.</li>
		<li><?php echo SITE_NAME; ?> has the right to remove any images at it's discretion</li>
	</ul>

</div>