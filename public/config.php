<?php

define('SITE_NAME', 'yoursite.com'); // site name displayed in the header and FAQ/ToS

define('SITE_URL', 'admin@email.com'); // the domain ONLY for your site (i.e. without the "upld" folder)
define('SCRIPT_PATH', ''); // folder where the script is located (leave blank if it's in the root directory)

// email for contact page
define('CONTACT_EMAIL', 'contact@yoursite.com'); // the email on the contact page
// email to get reports
define('REPORT_EMAIL', 'reports@yoursite.com'); // where emails should be sent if someone reports an image

// use domain.com/imageID and i.domain.com/imageID.ext instead of domain.com/view.php?id=imageID and domain.com/images/imageID.ext for shorter URLs?
// WARNING: ONLY enable this if you have configured your webserver to rewrite URLs - see INSTALL.txt
define('FRIENDLY_URLS', false);

define('DB_SERVER', 'localhost');
define('DB_USER', 'username');
define('DB_PASS', 'password');
define('DB_NAME', 'upld');
define('DB_PORT', 3306); // usually 3306 by default. If you don't know what this is, leave it alone and ask your hosting company if it doesn't work

// allow remote downloads? GD (php5-gd) MUST be enabled for this to work
define('ALLOW_REMOTE', true);

// max size in bytes - remember that you might need to change this in your PHP config file too
define('ALLOWED_SIZE', 2000000); // 1000 = 1 kilobyte, 1000000 = 1 megabyte

// allow anonymous uploads? set to 0 false to only allow logged in members to upload
define('ANON_UPLOADS', true);

// set to true if you are using cloudflare, otherwise you may end up with cloudflare IP addresses rather than the user's real address
// setting this to true will block all traffic that doesn't originate from cloudflare to prevent spoofing, but that's how cloudflare works and shouldn't cause any problems
define('CLOUDFLARE', false);

// by default thumbnails are only created when a logged in user uploads something
// this means that if you view images uploaded by IP address, some thumbnails won't show up, because the user wasn't logged in
// having this set to true will create thumbnails when you moderate a user
// this could take a little while depending on the amount of images the user has, and the power of the server, so you can disable this if needed, you will still be able to view uploads
define('CREATE_THUMBS_IP', true);

// how many images to display per page
// set to 0 to disable
define('PAGINATION', 15);

// set to true to only allow image downloads from whitelisted URLs (below)
define('URL_WHITELIST', false);

$allowed_urls = [
	'i.imgur.com',
	'i.upld.eu'
];