<?php
  class Pages extends Controller {
    
    public function __construct() {
      $this->userModel = $this->model('product');
    } 

    public function index() {
      $data = [
        'products' => $this->userModel->allProducts()
      ];
      $this->view('pages/index', $data);
    }

    public function about() {
      $data = ['title' => 'About'];
      $this->view('pages/about');
    }
  }