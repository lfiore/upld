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

require('config.php');
require('common.php');

$allowed_ext = [
	'png',
	'jpg',
	'gif',
	'bmp'
];

// determine if user selected a local or remote image 
if (isset($_FILES['image']) && !isset($_POST['url']))
{
	// user wants to upload via browser

	// get image info
	$image = $_FILES['image'];

	// check if image is within size limit
	if ($image['size'] <= ALLOWED_SIZE)
	{
		// image is within size limit

		// get image ext
		$ext = pathinfo($image['name'], PATHINFO_EXTENSION);

		// check if image is correct extension
		if (in_array($ext, $allowed_ext))
		{
			// image size and ext are OK
			require('db.php');

			do
			{
				$id = create_id();
				$exists = mysqli_query($db, 'SELECT EXISTS(SELECT 1 FROM `images` WHERE `id` = "' . $id . '")');
				++$db_queries;
			}
			while (mysqli_fetch_assoc($exists) === 1);

			mysqli_free_result($exists);

			// write image
			move_uploaded_file($image['tmp_name'], 'images/' . $id . '.' . $ext);

			// add to DB
			mysqli_query($db, 'INSERT INTO `images` (`id`, `ext`, `ip`) VALUES ("' . $id . '", "' . $ext . '", "' . $_SERVER['REMOTE_ADDR'] . '")');
			++$db_queries;

		}
		else
		{
			exit_message('Hmm, the image you uploaded has an incorrect extension and is not allowed.');
		}
	}
	else
	{
		exit_message('Hmm, the image you have uploaded is too large.');
	}
}
elseif (isset($_POST['url']) && !isset($_FILES['image']))
{
	// user wants to download a remote image
	// is remote downloading enabled in conf.php?
	if (ALLOW_REMOTE === true)
	{
		// remote downloading is enabled

		// check if URL is valid and http/https only
		if (filter_var($_POST['url'], FILTER_VALIDATE_URL) && ((parse_url($_POST['url'], PHP_URL_SCHEME) === 'http') || (parse_url($_POST['url'], PHP_URL_SCHEME) === 'https')))
		{
			// VALID URL SUBMITTED

			// check ext
			$ext = end(explode('.',$_POST['url']));
			if (in_array($ext, $allowed_ext))
			{
				// EXT IS OK

				// check size remotely
				$size = get_headers($_POST['url'], 1)['Content-Length'];
				if ($size <= ALLOWED_SIZE)
				{
					// SIZE IS WITHIN LIMIT

					// download file
					$image = file_get_contents($_POST['url'], NULL, NULL, NULL, $size);

					// check if downloaded data is an image
					if (imagecreatefromstring($image))
					{
						// VALID IMAGE

						// generate ID (and make sure it doesn't exist)
						require('db.php');

						do
						{
							$id = create_id();
							$exists = mysqli_query($db, 'SELECT EXISTS(SELECT 1 FROM `images` WHERE `id` = "' . $id . '")');
							++$db_queries;
						}
						while (mysqli_fetch_assoc($exists) === 1);

						mysqli_free_result($exists);

						// write image
						file_put_contents('images/' . $id . '.' . $ext, $image);

						// add to DB
						mysqli_query($db, 'INSERT INTO `images` (`id`, `ext`, `ip`) VALUES ("' . $id . '", "' . $ext . '", "' . $_SERVER['REMOTE_ADDR'] . '")');
						++$db_queries;
					}
					else
					{
						exit_message('Hmm, the file you submitted does not appear to be a valid image file.');
					}
				}
				else
				{
					exit_message('Hmm, the image you have selected is too large.');
				}
			}
			else
			{
				exit_message('Hmm, the image you selected has an incorrect extension and is not allowed.');
			}
		}
		else
		{
			exit_message('Please submit a valid http/https URL only');
		}
	}
	else
	{
		exit_message('Remote downloading is not enabled');
	}
}
elseif ($_FILES['image'] && $_POST['url'])
{
	exit_message('Please only choose one image to upload.');
}
else
{
	exit_message('Please choose either an image on your computer to upload or a remote image to download.');
}

header('location: ' . VIEW_URL . $id);

