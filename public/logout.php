<?php
require('config.php');
require('common.php');
// destroy user's session
session_unset();
session_destroy();
setcookie("Session", "", time()-3600);
exit_message(LOGOUT_SUCCESS);