<?php

namespace MVCPHP\libraries;
require("Immutable.php");
/*
 * PDO Database Class
 * Connect to database
 * Bind Values
 * Return rows and results
 */

class Database {
  
  private $immutable;
  private $dbh;
  private $stmt;
  private $error;

  public function __construct() {
    $this->immutable = new ImmutableDB();
    // Set DNS
    $dns = 'mysql:host=' . $this->immutable->getHost() . ';dbname=' . $this->immutable->getDBName();
    $options = array(\PDO::ATTR_PERSISTENT => true, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,);
    // Create PDO instance
    try {
      $this->dbh = new \PDO($dns, $this->immutable->getUser(), $this->immutable->getPassword(), $options);

    } catch (\PDOException $e) {
      die($this->immutable->getHost());
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  // Prepare statement with query
  public function query($sql) {
    $this->stmt = $this->dbh->prepare($sql);
  }

  // Bind Values
  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = \PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = \PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = \PDO::PARAM_NULL;
          break;
        default:
          $type = \PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  // Execute the prepared statement
  public function execute() {
    return $this->stmt->execute();
  }

  // Get result as array of objects
  public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // Get single record as object
  public function single() {
    $this->execute();
    return $this->stmt->fetch(\PDO::FETCH_OBJ);
  }

  // Get row count
  public function rowCount() {
    return $this->stmt->rowCount();
  }
}