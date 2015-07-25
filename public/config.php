<?php

define('SITE_NAME', 'My awesome upload site'); // site name displayed in the header and FAQ/ToS

define('SITE_URL', 'mydomain.com'); // the domain ONLY for your site (i.e. without the "upld" folder)
define('SCRIPT_PATH', 'upld'); // folder where the script is located (leave blank if it's in the root directory)

// admin username
define('ADMIN_USERNAME', 'admin');

// admin password and salt - use "pass.html" in the "misc" folder to generate these values
define('ADMIN_SALT', '');
define('ADMIN_PASSWORD', '');

// email for contact page
define('CONTACT_EMAIL', 'contact@domain.com'); // the email on the contact page
// email to get reports
define('REPORT_EMAIL', 'reports@domain.com'); // where emails should be sent if someone reports an image

// use domain.com/imageID and i.domain.com/imageID.ext instead of domain.com/view.php?id=imageID and domain.com/images/imageID.ext for shorter URLs?
// WARNING: ONLY enable this if you have configured your webserver to rewrite URLs - see README.txt
define('FRIENDLY_URLS', false);

define('DB_SERVER', 'localhost');
define('DB_USER', 'test');
define('DB_PASS', 'password');
define('DB_NAME', 'upld');
define('DB_PORT', 3306); // usually 3306 by default. If you don't know what this is, leave it alone and ask your hosting company if it doesn't work

// allow remote downloads? GD (php5-gd) MUST be enabled for this to work
define('ALLOW_REMOTE', true);

// max size in bytes - remember that you might need to change this in your PHP config file too
define('ALLOWED_SIZE', 2000000); // 1000 = 1 kilobyte, 1000000 = 1 megabyte

