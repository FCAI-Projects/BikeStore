<?php 

  class Products extends Controller {

    public function __construct() {
      $this->userModel = $this->model('product');
    }

    public function index() {
      $this->add();
    }

    public function add() {
      if (isLoggedIn()) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $data = [
            'username' => getUsername(),
            'name' => $_POST['name'],
            'feature' => $_POST['feature'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
            'photo' => '',
            'forRent' => $_POST['renting'],
            'isBike' => $_POST['isBike'],
            'isNew' => $_POST['new'],
            'name_err' => '',
            'feature_err' => '',
            'price_err' => '',
            'quantity_err' => '',
            'photo_err' => '',
          ];

          $photoName = $_FILES['photo']['name'];
          $photoSize = $_FILES['photo']['name'];
          $photoTmp = $_FILES['photo']['tmp_name'];
          $photoType = $_FILES['photo']['type'];

          $photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
          $photoExtention = explode('.', $photoName);
          $photoExtention = end($photoExtention);
          $photoExtention = strtolower($photoExtention);

          if (empty($data['name'])) {
            $data['name_err'] = 'Please fill the name field';
          }
          if (empty($data['feature'])) {
            $data['feature_err'] = 'Please fill the feature field';
          }
          if (empty($data['quantity'])) {
            $data['quantity_err'] = 'Please fill the quantity field';
          } elseif ($data['quantity'] <= 0) {
            $data['quantity_err'] = 'Please fill the quantity field with values more than 0';
          }
          if (empty($data['price']) || $data['price'] <= 0) {
            $data['price_err'] = 'Please fill the price field';
          } elseif ($data['price'] <= 0) {
            $data['price_err'] = 'Please fill the price field with values more than 0';
          }

          if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
            $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
          } elseif (empty($photoName)) {
            $data['photo_err'] = 'Please add a photo for the product';
          }

          if (empty($data['name_err']) && empty($data['feature_err']) && empty($data['quantity_err']) && empty($data['photo_err'])) {
            $randomNum = rand(0, 100000);
            move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
            $data['photo'] = $randomNum . '_' . $photoName;
            if($this->userModel->addProduct($data)) {
              redirect('pages');
            } else {
              die('something went wrong');
            }
            
          } else {
            $this->view('products/add', $data);
          }
        } else  {
          $data = [
            'username' => getUsername(),
            'name' => '',
            'feature' => '',
            'quantity' => '',
            'forRent' => 1,
            'isBike' => 1,
            'isNew' => 1,
            'name_err' => '',
            'feature_err' => '',
            'quantity_err' => '',
          ];
          $this->view('products/add', $data);
        }

      }
    }

    public function show($username) {
      $data = [
        'username' => $username,
        'products' =>$this->userModel->allProductsByUsername($username)
      ];
      $this->view('products/show', $data);
    }

    public function edit($id) {
      if (isLoggedIn()) {
        $item = $this->userModel->getProductById($id);
        if ($item->username == getUsername()) {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
              'username' => getUsername(),
              'id' => $id,
              'name' => $_POST['name'],
              'features' => $_POST['feature'],
              'price' => $_POST['price'],
              'quantity' => $_POST['quantity'],
              'photo' => '',
              'rentStatus' => $_POST['renting'],
              'isBike' => $_POST['isBike'],
              'isNew' => $_POST['isNew'],
              'name_err' => '',
              'features_err' => '',
              'price_err' => '',
              'quantity_err' => '',
              'photo_err' => '',
            ];
  
            $photoName = $_FILES['photo']['name'];
            $photoSize = $_FILES['photo']['name'];
            $photoTmp = $_FILES['photo']['tmp_name'];
            $photoType = $_FILES['photo']['type'];
  
            $photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
            $photoExtention = explode('.', $photoName);
            $photoExtention = end($photoExtention);
            $photoExtention = strtolower($photoExtention);
  
            if (empty($data['name'])) {
              $data['name_err'] = 'Please fill the name field';
            }
            if (empty($data['features'])) {
              $data['features_err'] = 'Please fill the feature field';
            }
            if (empty($data['quantity'])) {
              $data['quantity_err'] = 'Please fill the quantity field';
            } elseif ($data['quantity'] <= 0) {
              $data['quantity_err'] = 'Please fill the quantity field with values more than 0';
            }
            if (empty($data['price']) || $data['price'] <= 0) {
              $data['price_err'] = 'Please fill the price field';
            } elseif ($data['price'] <= 0) {
              $data['price_err'] = 'Please fill the price field with values more than 0';
            }
  
            if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
              $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
            }
  
            if (empty($data['name_err']) && empty($data['features_err']) && empty($data['quantity_err']) && empty($data['photo_err'])) {
              if (!empty($photoName)) {
                $randomNum = rand(0, 100000);
                move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
                $data['photo'] = $randomNum . '_' . $photoName;
              }
              if($this->userModel->editProduct($data)) {
                redirect('pages');
              } else {
                die('something went wrong');
              }
              
            } else {
              $this->view('products/add', $data);
            }
  
  
          } else {
            $data = [
              'id' => $id,
              'name' => $item->name,
              'features' => $item->features,
              'price' => $item->price,
              'quantity' => $item->quantity,
              'photo' => $item->photoName,
              'rentStatus' => $item->rentStatus,
              'isBike' => $item->isBike,
              'isNew' => $item->isNew,
              'name_err' => '',
              'features_err' => '',
              'price_err' => '',
              'quantity_err' => '',
              'photo_err' => '',
            ];
            $this->view('products/edit', $data);        
          }
  
  
        } else {
          die('You are not allow to get here');
        }
      } else {
        die('You are not allow to get here');
      }

    }

    public function delete($id) {
      if (isLoggedIn()) {
        $item = $this->userModel->getProductById($id);
        if ($item->username == getUsername()) {
          if($this->userModel->deleteProduct($id)) {
            redirect('pages');
          } else {
            die('something went wrong');
          }
        } else {
          die('You are not allow to get here');
        }
      } else {
        die('You are not allow to get here');
      }
    }
  }