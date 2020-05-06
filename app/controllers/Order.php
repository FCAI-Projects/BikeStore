<?php


namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Order extends Controller {
  private $users;
  private $product;
  public function __construct() {
    $this->users = new Users();
    $this->products = new Products();
//    $this->shopModel = $this->model('shop');
//    $this->itemModel = $this->model('product');
//    $this->userModel = $this->model('User');
  }
  
  public function index() {
    $this->allOrders();
  }
  
  public function buy($id) {
    if (isLoggedIn()) {
      if ($this->products->shopModel->search(getUsername(), $id)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $data = [
            'username' => getUsername(),
            'productId' => $id,
            'item' => $this->products->itemModel->getProductById($id),
            'payments' => $this->products->shopModel->getPaymentsForUsername(getUsername()),
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

            $this->products->shopModel->makeOrder($data2);
            redirect('pages');

          } else {
            $this->view('users/buy', $data);
          }
        } else {
          $data = [
            'username' => getUsername(),
            'item' => $this->products->itemModel->getProductById($id),
            'payments' => $this->products->shopModel->getPaymentsForUsername(getUsername())
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

  public function allOrders() {
    if (isLoggedIn()) {
      $data = ['products' => $this->users->userModel->getOrdersForUser(getUsername())];

      $this->view('users/orders', $data);
    } else {
      flash('error', 'Sorry, You need to login first', 'alert alert-danger');
      redirect('pages/index');
    }
  }
  
}