<?php


namespace MVCPHP\libraries;

/**
 * Class Autoload can autoload any class in app dir
 * @package MVCPHP\libraries
 *
 */
class  Autoload {
  /**
   * this fun require file witch have class
   * @param $className <p>
   * this parameter is class name with name space can
   * fun delete 'MVCPHP' and use after this as dir to
   * class
   * </p>
   */
  public static function autoload($className) {

    $className = str_replace('MVCPHP', '', $className);   // class name is MVCPHP\folder\class= file name without .php

    $className .= '.php';  //add  .php

    if (!file_exists(APPROOT . $className)) {
      //if file class not found so file not found to require do nothing
      return;
    }
    require_once APPROOT . $className; // require file in index.php

  }
}

spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');// sent class name  to function with namesapce (__NAMESPACE__.)'\Autoload
