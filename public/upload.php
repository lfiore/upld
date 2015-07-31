<?php

require('config.php');
require('common.php');

// both image and url submitted. wtf, let's get the hell out of here!
if (isset($_FILES['image']) && isset($_POST['url']))
{
	exit_message('Please only choose one image to upload.');
}

// neither submitted - inform user and exit
if (!isset($_FILES['image']) && !isset($_POST['url']))
{
	exit_message('Please choose either an image on your computer to upload or a remote image to download.');
}

$allowed_ext = [
	'png',
	'jpg',
	'gif'
];

// user must have submitted either an image or URL
// check which one and make sure it's valid
// check for an uploaded image first
if (isset($_FILES['image']))
{
	// user wants to upload via browser
	// set variables - will check after
	$size = $_FILES['image']['size'];
	$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
}

elseif (isset($_POST['url']))
{
	// user wants to download a remote image
	// make sure URL is valid and set variables - will check after
	// is remote downloading enabled in conf.php?
	if (ALLOW_REMOTE !== true)
	{
		// remote downloading is disabled - error and exit
		exit_message('Remote downloading is not enabled on this installation');
	}

	// allowed URL schemes
	$allowed_schemes = [
		'http',
		'https'
	];

	// check if URL is valid and http/https only
	if (!filter_var($_POST['url'], FILTER_VALIDATE_URL) || (!in_array(parse_url($_POST['url'], PHP_URL_SCHEME), $allowed_schemes)))
	{
		// not a valid URL
		exit_message('Sorry, this URL is invalid');
	}

	// looks good so far, download the image and make sure it's valid
	$size = get_headers($_POST['url'], 1)['Content-Length'];
	$ext = end(explode('.',$_POST['url']));
}

// OK, everything checks out so far
// check size/ext
if ($size > ALLOWED_SIZE)
{
	// file is too big
	exit_message('Sorry, this file is too big');
}

// size is OK, make sure EXT is allowed
if (!in_array($ext, $allowed_ext))
{
	// ext not allowed
	exit_message('Sorry, this extension is not allowed.');
}

// size and ext are fine
// let's set $image to either $_FILES['image'] or $_POST['url'] and check if they're valid
if (isset($_FILES['image']))
{
	if (!getimagesize($_FILES['image']['tmp_name']))
	{
		exit_message('Sorry, this does not appear to be a valid image');
	}

	$image = $_FILES['image']['tmp_name'];
}

elseif (isset($_POST['url']))
{
	$image = file_get_contents($_POST['url'], NULL, NULL, NULL, $size);

	if (!imagecreatefromstring($image))
	{
		exit_message('Sorry, this does not appear to be a valid image');
	}
}

// everything looks good so far! images are valid, size and ext check out
// generate an ID, move files and insert into DB

// generate ID (and make sure it doesn't exist)
require('db.php');

// prepare query
$exists = mysqli_prepare($db, 'SELECT EXISTS(SELECT 1 FROM `images` WHERE `id` = ?)');

// create ID and check if it exists in the DB
do
{
	// create ID
	$id = '';
	$chars = 'ACDEFHJKLMNPQRTUVWXYZabcdefghijkmnopqrstuvwxyz23479';
	for ($i = 0; $i < 5; ++$i)
	{
		$id .= $chars[mt_rand(0, 50)];
	}
	// $id is now set to a randomly generated ID

	// query DB to see if ID exists
	mysqli_stmt_bind_param($exists, "s", $id);
	mysqli_stmt_execute($exists);
	++$db_queries;
	mysqli_stmt_bind_result($exists, $result);
	mysqli_stmt_fetch($exists);
	mysqli_stmt_close($exists);
}
while ($result === 1);

// write image (this is different depending on whether it's an upload or remote download)
if (isset($_FILES['image']))
{
	$image_path = 'images/' . $id . '.' . $ext;

	// write image
	move_uploaded_file($image, $image_path);
}
else if (isset($_POST['url']))
{
	// write image
	file_put_contents('images/' . $id . '.' . $ext, $image);
}

// create thumbnail (only bother if user is logged in)
if ($_SESSION['user'])
{
	if (isset($_FILES['image']))
	{
		// set source for thumb
		switch ($ext)
		{
			case 'jpg':
				$thumb = imagecreatefromjpeg($image_path);
			break;

			case 'png':
				$thumb = imagecreatefrompng($image_path);
			break;

			case 'gif':
				$thumb = imagecreatefromgif($image_path);
			break;
		}
	}
	else if (isset($_POST['url']))
	{
		// set source for thumb
		$thumb = imagecreatefromstring($image);
	}

	$width = imagesx($thumb);
	$height = imagesy($thumb);

	if ($width > 300 || $height > 300)
	{
		if ($width > $height)
		{
			$new_width = 300;
			// if image height is below 300, don't bother resizing
			$new_height = floor($height * ($new_width / $width));
		}
		else
		{
			$new_height = 300;
			// if image width is below 300, don't bother resizing
			$new_width = floor($width * ($new_height / $height));
		}
	}
	else
	{
		$new_height = $height;
		$new_width = $width;
	}

	$new_thumb = imagecreatetruecolor($new_width, $new_height);

	switch ($ext)
	{
		case 'png':
			imagefill($new_thumb, 0, 0, imagecolorallocate($new_thumb, 255, 255, 255));
			imagealphablending($background, TRUE);
		break;

		case 'gif':
			$new_thumb = imagecolorallocate($thumb, 0, 0, 0);
			imagecolortransparent($thumb, $new_thumb);
		break;
	}
	
	imagecopyresized($new_thumb, $thumb, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	imagedestroy($thumb);	

	imagejpeg($new_thumb, 'thumbs/' . $id . '.jpg', 30);
	imagedestroy($new_thumb);
}

// check if user is logged in or not and write info to DB
if (!isset($_SESSION['user']))
{
	$query = mysqli_prepare($db, 'INSERT INTO `images` (`id`, `ext`, `ip`) VALUES (?, ?, ?)');
	mysqli_stmt_bind_param($query, 'sss', $id, $ext, $ip);
}
else
{
	$query = mysqli_prepare($db, 'INSERT INTO `images` (`id`, `ext`, `user`, `ip`) VALUES (?, ?, ?, ?)');
	mysqli_stmt_bind_param($query, 'ssis', $id, $ext, $user, $ip);
}

// set data for query
$user = $_SESSION['user'];
$ip = $_SERVER['REMOTE_ADDR'];

// insert data
mysqli_stmt_execute($query);
++$db_queries;
mysqli_stmt_close($query);

// close connection
mysqli_close($db);

header('location: ' . VIEW_URL . $id);