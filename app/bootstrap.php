<?php
  // load config
  require_once 'config/config.php';
  require_once 'helpers/AppSessionHandler.php';
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';
  // Autoload Core Libraries
  spl_autoload_register(function($className) {
    require_once 'libraries/'.$className.'.php';
  });

  $db =new Database();
  $registry = new Registry();
  $registry->set('db',$db);

  //$dbclass =$registry->get('db');