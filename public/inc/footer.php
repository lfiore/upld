<?php
if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}
?>
	</div>
	<div id="footer">
		<a href="faq.php"><?php echo GO_FAQ;?></a>|<a href="tc.php"><?php echo GO_TC;?></a>|<a href="contact.php"><?php echo GO_CONTACT;?></a>
	</div>
	<script src="js/jquery.min.js" type="text/javascript"></script>	
	<script src="js/upload.js" type="text/javascript"></script>
<script>
$( document ).ready(function() {
   [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
         img.setAttribute('src', img.getAttribute('data-src'));
         img.onload = function() {
            img.removeAttribute('data-src');
         };
   });
});
</script>	
</body>
</html>