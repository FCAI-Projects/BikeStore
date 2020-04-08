<?php
  class Pages extends Controller {
    
    public function __construct() {
      # code ...
    } 

    public function index() {
      $data = ['title' => 'Homepage'];
      $this->view('pages/index', $data);
    }

    public function about() {
      $data = ['title' => 'About'];
      $this->view('pages/about');
    }
  }