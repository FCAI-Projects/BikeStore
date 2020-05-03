<?php


namespace MVCPHP\models;


interface rule {
  public function add($data);

  public function edit($data);

  public function list();
}