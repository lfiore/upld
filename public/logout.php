<?php

require('config.php');
require('common.php');

// destroy user's session
session_unset();
session_destroy();

exit_message('You have been logged out');

