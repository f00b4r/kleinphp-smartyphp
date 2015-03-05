<?php

use Klein\Klein;

# Constants
define('DEBUG', TRUE);
define('APP_DIR', __DIR__);
define('CACHE_DIR', APP_DIR . '/cache');
define('VENDOR_DIR', APP_DIR . '/vendor');
define('VIEW_DIR', APP_DIR . '/view');

// Register loaders
require_once APP_DIR . '/vendor/autoload.php';
require_once APP_DIR . '/loader.php';

// Create klein.php
$klein = new Klein();
$service = $klein->service();

// Register Smarty
$smarty = new SmartyService();
$smarty->setCacheDir(CACHE_DIR . '/cache');
$smarty->setCompileDir(CACHE_DIR . '/compile');
$smarty->setCaching(defined('CACHE_DIR'));
$smarty->setCachingLifetime(120);
$service->smarty = $smarty->create();
$service->smartyParams = [
    'basePath' => trim($_SERVER['REQUEST_URI'], '/'),
];

// Register parameters
$service->cacheDir = CACHE_DIR;
$service->viewDir = VIEW_DIR;

// Register routers
(new PortfolioRouter())->create($klein);

// Run!
$klein->dispatch();
