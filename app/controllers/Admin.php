<?php

namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Admin extends Controller {
  public function __construct() {
    $this->userModel = $this->model('user');
  }

  public function services() {
    $data = ['services' => $this->userModel->allServices()];
    $this->view('admin/services', $data);
  }


  public function users() {
    $data = ['usres' => $this->userModel->allUsers()];
    $this->view('admin/users', $data);
  }

}