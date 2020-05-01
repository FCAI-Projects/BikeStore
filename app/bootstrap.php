<?php

use MVCPHP\helpers\AppSessionHandler;
use MVCPHP\libraries\Database;
use MVCPHP\libraries\Registry;

require_once 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once 'helpers' . DS . 'URL_helper.php';
require_once 'helpers' . DS . 'session_helper.php';
require_once 'helpers' . DS . 'AppSessionHandler.php';
require_once 'libraries' . DS . 'Autoload.php';

require_once 'libraries' . DS . 'Autoload.php';

$session = new AppSessionHandler();
$session->start();

$db = new Database();
$registry = new Registry();
$registry->set('db', $db);
