<?php
require('config.php');
require('common.php');
// see if anonymous uploads has been disabled, and check if the user is logged in
if (ANON_UPLOADS === false && !isset($_SESSION['user']))
{
	exit_message(NO_ANON_UPLOAD);
}
// both image and url submitted. wtf, let's get the hell out of here!
if (isset($_FILES['image']) && isset($_POST['url']))
{
	exit_message(ONLY_ONE_UPLOAD_METHOD);
}
// neither submitted - inform user and exit
if (!isset($_FILES['image']) && !isset($_POST['url']))
{
	exit_message(NO_IMAGE_SELECTED);
}
$allowed_ext = [
	'png',
	'jpg',
	'jpeg',
	'tiff',
	'webp',
	'svg',
	'svg',
	'gif',
	'webp'
];
// user must have submitted either an image or URL
// check which one and make sure it's valid
// check for an uploaded image first
if (isset($_FILES['image']))
{
if ($_FILES['image']['error'] == 0)
	{
		// user wants to upload via browser
		// set variables - will check after
		$size = $_FILES['image']['size'];
		$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	}
	else
	{
		exit_message(UPLOAD_ERROR." ".$_FILES['image']['error'] . '<br /><br />'.ERROR_CODE_WEBSITE);
	}
}
elseif (isset($_POST['url']))
{
	// user wants to download a remote image
	// make sure URL is valid and set variables - will check after
	// is remote downloading enabled in conf.php?
	if (ALLOW_REMOTE !== true)
	{
		// remote downloading is disabled - error and exit
		exit_message(NO_REMOTE_UPLOAD);
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
		exit_message(NOT_VALID_URL);
	}
	// if whitelisting is enabled, make sure it's an allowed domain
	if ((URL_WHITELIST === true) && (!in_array(parse_url($_POST['url'], PHP_URL_HOST), $allowed_urls)))
	{
		exit_message(DOMAIN_NOT_PERMITTED);
	}
	// looks good so far, download the image and make sure it's valid
	$size = get_headers($_POST['url'], 1)['Content-Length'];
    $tmp_ext = getimagesize($_POST['url']);
	$ext = $tmp_ext['mime'];
	$ext = str_replace("image/", "", $ext);
}
// OK, everything checks out so far
// check size/ext
if ($size > ALLOWED_SIZE)
{
	// file is too big
	exit_message(TOO_BIG_FILE);
}
// size is OK, make sure EXT is allowed
if (!in_array($ext, $allowed_ext))
{
	// ext not allowed
	exit_message(INVALID_EXTENSION);
}
// size and ext are fine
// let's set $image to either $_FILES['image'] or $_POST['url'] and check if they're valid
if (isset($_FILES['image']))
{
	if (!getimagesize($_FILES['image']['tmp_name']))
	{
		exit_message(INVALID_IMAGE);
	}
	$image = $_FILES['image']['tmp_name'];
}
elseif (isset($_POST['url']))
{
	if(!isset($size)) $size = 3756608;
	$image = file_get_contents($_POST['url'], NULL, NULL, NULL, $size);
	if (!imagecreatefromstring($image))
	{
		exit_message(INVALID_IMAGE);
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
if (isset($_SESSION['user']))
{
	if (isset($_FILES['image']))
	{
		// set source for thumb
		switch ($ext)
		{
			case 'jpeg':
			case 'jpg':
				$thumb = imagecreatefromjpeg($image_path);
			break;
			case 'png':
				$thumb = imagecreatefrompng($image_path);
			break;
			case 'webp':
				$thumb = imagecreatefromwebp($image_path);
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
	if ($width > 200 || $height > 200)
	{
		if ($width > $height)
		{
			$new_width = 200;
			// if image height is below 300, don't bother resizing
			$new_height = floor($height * ($new_width / $width));
		}
		else
		{
			$new_height = 200;
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
			imagealphablending($new_thumb, TRUE);
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
if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
{
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
}
else
{
	$ip = $_SERVER['REMOTE_ADDR'];
} 
// insert data
mysqli_stmt_execute($query);
++$db_queries;
mysqli_stmt_close($query);
// close connection
mysqli_close($db);
header('location: ' . VIEW_URL . $id);