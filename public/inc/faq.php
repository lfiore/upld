<div class="box">

	<p class="title">FAQs</p>

	<ul id="faq">

		<li>Is <?php echo $site_name; ?> really free?</li>
		<li>Yes! It is 100% free to use</li>

		<li>Which types of image can I upload?</li>
		<li>You can upload images with the following extensions: <span id="allowed-ext" class="black"><?php echo implode(', ', $allowed_ext); ?></span></li>

		<li>Can I upload big images?</li>
		<li>Yes! You can upload any image up to <span class="black"><?php while ($allowed_size >= 1000) { $allowed_size = ($allowed_size / 1000); ++$i; } $units = array('', 'K', 'M'); echo round($allowed_size, 1) . $units[$i]; ?>B</span> in size</li>

		<li>Will you delete my image after X days?</li>
		<li>Nope. We will only delete your image if it is against our terms &amp; conditions</li>

		<li>Can people browse through uploaded images?</li>
		<li>Nope. Every upload is given a random, non-sequential ID</li>

	</ul>

</div>