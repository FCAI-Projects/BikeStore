<?php


namespace MVCPHP\models;


interface strategy {
  public function add($data);

  public function edit($data);

  public function list();
}