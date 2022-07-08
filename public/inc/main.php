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

			<p class="title">Welcome to <?php echo SITE_NAME; ?></p>

			<ul>
				<li><span class="black"><?php echo SITE_NAME; ?></span> is a free, online image host. Simply click the button below to start uploading!</li>
				<li>Before uploading, you can register an account (or log in if you already have one) and manage your uploads later</li>
			</ul>

		</div>

		<div class="box">

			<p class="title">Why use <?php echo SITE_NAME; ?>?</p>

			<ul>
				<li>It's completely <span class="black">free</span>!</li>
				<li>You can create an account and <span class="black">manage all of your uploads</span></li>
<?php

if (ALLOW_REMOTE === true)
{

?>

				<li><span class="black">Download files remotely!</span></li>

<?php

}

?>

				<li>The following image types are allowed: <span class="black">PNG, JPG, GIF</span></li>
				<li>The files may be up to <span class="black"><?php echo $size ?>B</span> in size</li>
<?php

if (FRIENDLY_URLS === true)
{

?>

				<li><span class="black">Short, easy to remember</span> URLs!</li>

<?php

}

?>

				<li></li>
			</ul>
		</div>

<?php

if ((ANON_UPLOADS === true) || ((ANON_UPLOADS === false) && (isset($_SESSION['user']))))
{

?>

		<div id="select-image" class="box">
			click here to select an image
		</div>

		<form id="upload-form" class="hidden" name="upload" method="POST" action="upload.php" enctype="multipart/form-data">
			<input id="image-input" name="image" type="file" />
		</form>

		<div id="cancel-image" class="hidden">
			<span>wait, I want to upload something else!</span>
		</div>

<?php

	if (ALLOW_REMOTE === true)
	{

?>

		<form id="url-form" name="remote-url" method="POST" action="upload.php">

			<div id="download-url" class="box">
				<input id="image-url-submit" type="submit" value="download remote image" />
			</div>

			<div id="select-url" class="box">
				<input id="select-url-input" name="url" type="text" placeholder="Want to download your image remotely? Paste the link here (http://)" />
			</div>
		</form>

<?php

	}

}
else
{

?>

		<div class="box">Anonymous uploads have been disabled, please <a href="register.php">create an account</a> or <a href="login.php">log in</a> to upload</div>

<?php

}

?>
