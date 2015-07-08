<?php

$main_site_url = trim($site_url, '/') . '/';

$main_script_path = ($script_path ? trim($script_path, '/') . '/' : '');

$view_url = 'http://' . $main_site_url . $main_script_path . ($friendly_urls ? '' : 'view.php?id=');

$images_url = 'http://' . ($friendly_urls ? 'i.' : '') . $main_site_url . ($friendly_urls ? '' : $main_script_path . 'images/');

$in_script = true;

