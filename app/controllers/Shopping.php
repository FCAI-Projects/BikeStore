<?php
namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;
  class Shopping extends Controller {
    public function __construct() {
      $this->shopModel = $this->model('shop');
      $this->itemModel = $this->model('product');
    }
    
    public function index() {
      $this->show();
    }

    public function add($id) {
      if (isLoggedIn()) {
        $data = [
          'username' => getUsername(),
          'productId' => $id,
        ];
        $item = $this->itemModel->getProductById($data['productId']);
        if ($item->username == $data['username']) {
          die('sorry, this is your item');
        } else {
          if ($this->shopModel->add($data)) {
            flash('error', 'The Product Added Successfully in your cart');
            redirect('pages');
          } else {
            flash('error', 'It is already in your shopping cart', 'alert alert-warning');
            redirect('pages/index');
          }
        }
        
      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
    }


    public function show() {
      if (isLoggedIn()) {
        $data = [
          'username' => getUsername(),
          'products' => $this->shopModel->getAllForUsername(getUsername())
        ];

        $this->view('users/cart', $data);

      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
      
    }



  }