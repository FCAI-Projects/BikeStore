<?php

namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

/**
 * Class Admin
 * @package MVCPHP\controllers
 */
class Admin extends Controller {
  public function __construct() {
    $this->userModel = $this->model('user');
  }
  
  public function index() {
    $this->users();
  }

  public function services() {
    $data = ['services' => $this->userModel->allServices()];
    $this->view('admin/services', $data);
  }

  public function edit() {
    $manipulation = new Manipulation();
    $manipulation->edit();
  }

  public function users() {
    $data = ['usres' => $this->userModel->list()];
    $this->view('admin/users', $data);
  }

}