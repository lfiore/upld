<?php

$start = microtime(true);

function create_id()
{
	$i = '';
	$chars = 'ACDEFHJKLMNPQRTUVWXYZabcdefghijkmnopqrstuvwxyz23479';
	for ($i = 0; $i < 5; ++$i)
	{
		$id .= $chars[mt_rand(0, 50)];
	}
	return $id;
}

require('conf.php');
require('common.php');

$image = $_FILES['image'];
$ext = pathinfo($image['name'], PATHINFO_EXTENSION);

if ($image['size'] > $allowed_size)
{
	$messsage = 'Hmm, the image you have selected is too large.';
	require('inc/header.php');
	require('inc/messsage.php');
	require('inc/footer.php');
	exit;
}

if (!in_array($ext, $allowed_ext))
{
	$messsage = 'Hmm, the image you uploaded has an incorrect extension and is not allowed.';
	require('inc/header.php');
	require('inc/messsage.php');
	require('inc/footer.php');
	exit;
}

require('db.php');

do
{
	$id = create_id();
	$exists = mysqli_query($db, 'SELECT EXISTS(SELECT 1 FROM `images` WHERE `id` = "' . $id . '")');
	++$db_queries;
}
while (mysqli_fetch_assoc($exists) === 1);

mysqli_free_result($exists);

move_uploaded_file($image['tmp_name'], 'images/' . $id . '.' . $ext);

mysqli_query($db, 'INSERT INTO `images` (`id`, `ext`, `ip`) VALUES ("' . $id . '", "' . $ext . '", "' . $_SERVER['REMOTE_ADDR'] . '")');
++$db_queries;

header('location: ' . $view_url . $id);

