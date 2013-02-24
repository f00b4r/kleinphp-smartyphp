<?php

define('APP_DIR', __DIR__);
define('LIBS_DIR', APP_DIR . '/../libs');
define('TEMP_DIR', APP_DIR . '/../temp');

require_once(LIBS_DIR . '/smarty/Smarty.class.php');
require_once(LIBS_DIR . '/kleinphp/klein.php');
require_once(APP_DIR . '/Application.php');

$application = new Application();
$application->boot();
$application->setApplicationDir('/klein-smarty');

return $application;

