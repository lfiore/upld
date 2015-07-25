<?php

if (!defined('IN_SCRIPT'))
{
	header('location: ../index.php');
	exit;
}

?>

	</div>

	<div id="footer">
		<a href="login.php">Admin login</a>
		<!-- page generated in <?php echo round((microtime(true) - $start), 5); ?> seconds with <?php echo ($db_queries ? $db_queries : '0'); ?> DB quer<?php echo ($db_queries === 1 ? 'y' : 'ies'); ?> -->
	</div>

	<script src="js/jquery.min.js" type="text/javascript"></script>	
	<script src="js/upload.js" type="text/javascript"></script>

</body>
</html>