<?php


namespace MVCPHP\models;


class Context {
  private $strategy;

  public function __construct($strategy) {
    $this->strategy = $strategy;
  }
  
  public function executeStrategy($data): bool
  {
    return $this->strategy->add($data);
  }
}