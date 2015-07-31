<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

$i = 0;
$allowed_size = ALLOWED_SIZE;

while ($allowed_size >= 1000)
{
	$allowed_size = ($allowed_size / 1000);
	++$i;
}

$units = array('', 'K', 'M');

$size = round($allowed_size, 1) . $units[$i];

?>

<div class="box">

	<p class="title">FAQs</p>

	<ul id="faq">

		<li>Is <?php echo SITE_NAME; ?> really free?</li>
		<li>Yes! It is 100% free to use</li>

		<li>Which types of image can I upload?</li>
		<li>You can upload images with the following extensions: <span class="black">PNG, JPG, GIF</span></li>

		<li>Can I upload big images?</li>
		<li>Yes! You can upload any image up to <span class="black"><?php echo $size; ?>B</span> in size</li>

		<li>Will you delete my image after X days?</li>
		<li>Nope. We will only delete your image if it is against our terms &amp; conditions</li>

		<li>Can people browse through uploaded images?</li>
		<li>Nope. Every upload is given a random, non-sequential ID</li>

	</ul>

</div>