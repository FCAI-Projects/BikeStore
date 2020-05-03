<?php

namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Pages extends Controller {

  public function __construct() {
    $this->productModel = $this->model('product');
  }

  public function index() {
    if (isset($_GET['search'])) {
      $data = ['products' => $this->productModel->search($_GET['search'])];
      $this->view('pages/index', $data);
    }
    $data = ['products' => $this->productModel->list()];
    $this->view('pages/index', $data);
  }
  
}