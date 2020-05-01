<?php

namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Pages extends Controller {

  public function __construct() {
    $this->userModel = $this->model('product');
  }

  public function index() {
    $data = ['products' => $this->userModel->allProducts()];
    $this->view('pages/index', $data);
  }
}