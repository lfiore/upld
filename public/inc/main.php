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
			<p class="title"><?php echo WELCOME_MAIN_TITLE; ?></p>
			<ul>
				<li><span class="black"><?php echo SITE_NAME; ?></span> <?php echo WELCOME_MAIN_DESC_1;?></li>
				<li><?php echo WELCOME_MAIN_DESC_2;?></li>
			</ul>
		</div>
		<div class="box">
			<p class="title"><?php echo WHY_USE_TITLE; ?></p>
			<ul>
				<li><?php echo WHY_USE_GRATIS;?></li>
				<li><?php echo WHY_USE_ACCOUNT;?></li>
<?php
if (ALLOW_REMOTE === true)
{
?>
				<li><?php echo WHY_USE_REMOTE_UPLOAD;?></li>
<?php
}
?>
				<li><?php echo WHY_USE_FILE_EXT_ALLOWED; ?> <span class="black">PNG, JPG, GIF, WEBP</span></li>
				<li><?php echo WHY_USE_MAX_SIZE;?> <span class="black"><?php echo $size ?>B</span></li>
<?php
if (FRIENDLY_URLS === true)
{
?>
				<li><?php echo WHY_USE_FRIENDLY_URL;?></li>
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
			<?php echo UPLOAD_BUTTON;?>		</div>
		<form id="upload-form" class="hidden" name="upload" method="POST" action="upload.php" enctype="multipart/form-data">
			<input id="image-input" name="image" type="file" required />
		</form>
		<div id="cancel-image" class="hidden">
			<span><?php echo UPLOAD_BUTTON_CANCEL; ?></span>
		</div>
<?php
	if (ALLOW_REMOTE === true)
	{
?>
		<form id="url-form" name="remote-url" method="POST" action="upload.php">
			<div id="download-url" class="box">
				<input id="image-url-submit" type="submit" value="<?php echo UPLOAD_REMOTE_BUTTON; ?>" />
			</div>
			<div id="select-url" class="box">
				<input id="select-url-input" name="url" type="text" placeholder="<?php echo UPLOAD_REMOTE_PLACEHOLDER;?>" />
			</div>
		</form>
<?php
	}
}
else
{
?>
		<div class="box"><?php echo NO_ANON_UPLOAD;?></div>
<?php
}
?>