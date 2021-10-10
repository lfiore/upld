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
	<p class="title"><?php echo FAQ_TITLE;?></p>
	<ul id="faq">
		<li><?php echo FAQ_Q1;?></li>
		<li><?php echo FAQ_A1;?></li>
		<li><?php echo FAQ_Q2;?></li>
		<li><?php echo FAQ_A2;?></li>
		<li><?php echo FAQ_Q3;?></li>
		<li><?php echo FAQ_A3;?> <span class="black"><?php echo $size; ?>B</span></li>
		<li><?php echo FAQ_Q4;?></li>
		<li><?php echo FAQ_A4;?></li>
		<li><?php echo FAQ_Q5;?></li>
		<li><?php echo FAQ_A5;?></li>
	</ul>
</div>