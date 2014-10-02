<?php

$view_url	= 'http://' . trim($site_url, '/') . '/' . ($script_path ? trim($script_path, '/') . '/' : '') . ($friendly_urls ? '' : 'view.php?id=');

$images_url	= 'http://' . ($friendly_urls ? 'i.' : '') . trim($site_url, '/') . '/' . ($script_path ? trim($script_path, '/') . '/' : '') . ($friendly_urls ? '' : 'images/');

