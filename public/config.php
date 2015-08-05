<?php

define('SITE_NAME', 'upld.eu'); // site name displayed in the header and FAQ/ToS

define('SITE_URL', 'lfiore.co.uk'); // the domain ONLY for your site (i.e. without the "upld" folder)
define('SCRIPT_PATH', 'upld'); // folder where the script is located (leave blank if it's in the root directory)

// email for contact page
define('CONTACT_EMAIL', 'contact@lfiore.co.uk'); // the email on the contact page
// email to get reports
define('REPORT_EMAIL', 'reports@lfiore.co.uk'); // where emails should be sent if someone reports an image

// use domain.com/imageID and i.domain.com/imageID.ext instead of domain.com/view.php?id=imageID and domain.com/images/imageID.ext for shorter URLs?
// WARNING: ONLY enable this if you have configured your webserver to rewrite URLs - see INSTALL.txt
define('FRIENDLY_URLS', false);

define('DB_SERVER', 'localhost');
define('DB_USER', 'test');
define('DB_PASS', '9cyQmbnUnVSv8erq');
define('DB_NAME', 'upld');
define('DB_PORT', 3306); // usually 3306 by default. If you don't know what this is, leave it alone and ask your hosting company if it doesn't work

// allow remote downloads? GD (php5-gd) MUST be enabled for this to work
define('ALLOW_REMOTE', true);

// max size in bytes - remember that you might need to change this in your PHP config file too
define('ALLOWED_SIZE', 2000000); // 1000 = 1 kilobyte, 1000000 = 1 megabyte

