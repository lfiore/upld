<?php

if (!isset($in_script))
{
	exit('you are not allowed to access this page directly');
}

?>

		<div class="box">
			Welcome to <span class="black"><?php echo $site_name; ?></span>, the free online image host. Simply click the button below to start uploading!
		</div>

		<div class="box">

			<p class="title">Why use <?php echo $site_name; ?>?</p>

			<ul>
				<li>It's completely <span class="black">free</span>!</li>
				<li>The following image types are allowed: <span id="allowed-ext" class="black"><?php echo implode(', ', $allowed_ext); ?></span></li>
				<li>The files may be up to <span class="black"><?php $i = 0; while ($allowed_size >= 1000) { $allowed_size = ($allowed_size / 1000); ++$i; } $units = array('', 'K', 'M'); echo round($allowed_size, 1) . $units[$i]; ?>B</span> in size</li>
				<li><span class="black">Short, easy to remember</span> URLs!</li>
				<li></li>
			</ul>
		</div>

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

if ($allow_remote === true)
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

?>