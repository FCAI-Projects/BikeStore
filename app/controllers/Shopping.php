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

    public function buy($id) {
      if (isLoggedIn()) {
        if ($this->shopModel->search(getUsername(), $id)) {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
              'username' => getUsername(),
              'productId' => $id,
              'item' => $this->itemModel->getProductById($id),
              'payments' => $this->shopModel->getPaymentsForUsername(getUsername()),
              'quantity' => $_POST['quantity'],
              'payment' => $_POST['payment'],
              'payment_err' => ''
            ];
            $neededMoney =  ($data['item']->price) * $data['quantity'];
            $visaNumber = substr($data['payment'], 0, 16);
            $visaMoney = substr($data['payment'], 19, -1);
            if ($data['payment'] == '0') {
              $data['payment_err'] = 'Please choose paument method';
            } elseif ($neededMoney > $visaMoney) {
              $data['payment_err'] = 'There is no enough money';
            }

            if (empty($data['payment_err'])) {

              $visaMoney -= $neededMoney;
              $data2 = [
                'username' => getUsername(),
                'productId' => $id,
                'newQuantity' => $data['item']->quantity - $_POST['quantity'],
                'quantity' => $_POST['quantity'],
                'visaNumber' => $visaNumber,
                'visaMoney' => $visaMoney
              ];

              $this->shopModel->makeOrder($data2);
              redirect('pages');
              
            } else {
              $this->view('users/buy', $data);
            }
          } else {
            $data = [
              'username' => getUsername(),
              'item' => $this->itemModel->getProductById($id),
              'payments' => $this->shopModel->getPaymentsForUsername(getUsername())
            ];
            $this->view('users/buy', $data);
          }
        } else {
          flash('error', 'Sorry, The Item Is not in your cart', 'alert alert-danger');
          redirect('pages/index');
        }
        
          
      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
    }

  }