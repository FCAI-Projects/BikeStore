<?php

  class Users extends Controller {
    public function __construct() {
      $this->userModel = $this->model('user');
    }

    public function index() {
      $this->register();
    }

    public function register() {
      if (isLoggedIn()) {
        redirect('pages');
      } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'firstName' => $_POST['userFirstName'],
            'lastName' => $_POST['userLastName'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'pass' => $_POST['firstPassword'],
            'repass' => $_POST['secondPassowrd'],
            'phone' => $_POST['phone'],
            'gender' => $_POST['gender'],
            'firstName_err' => '',
            'lastName_err' => '',
            'username_err' => '',
            'email_err' => '',
            'pass_err' => '',
            'repass_err' => '',
            'phone_err' => '',
          ];
          if (empty($data['firstName'])) {
            $data['firstName_err'] = 'Please fill the first name field';
          }
          if (empty($data['lastName'])) {
            $data['lastName_err'] = 'Please fill the last name field';
          }
          if (empty($data['username'])) {
            $data['username_err'] = 'Please fill the username field';
          } elseif ($this->userModel->usernameExist($data['username'])) {
            $data['username_err'] = 'The username exist';
          }
          if (empty($data['email'])) {
            $data['email_err'] = 'Please fill the email field';
          } elseif ($this->userModel->emailExist($data['email'])) {
            $data['email_err'] = 'The email exist';
          }
          if (empty($data['pass'])) {
            $data['pass_err'] = 'Please fill the password field';
            $data['repass_err'] = 'Please fill the password field';
          } elseif ($data['pass'] != $data['repass']) {
            $data['repass_err'] = 'Password doesn\'t match';
          }
          if (empty($data['phone'])) {
            $data['phone_err'] = 'Please fill the phone number field';
          }
          if (!empty($data['firstName_err']) || !empty($data['lastName_err']) || !empty($data['email_err']) || !empty($data['pass_err']) || !empty($data['repass_err']) || !empty($data['phone_err'])) {
            $this->view('users/register', $data);
          } else {
            $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
            if ($this->userModel->register($data)) {
              $_SESSION['username'] = $data['username'];
              $_SESSION['isAdmin'] = false;
              redirect('pages');
            } else {
              flash('error', 'something went wrong', 'alert alert-danger');
              redirect('pages/index');
            }
          }
        } else {
          $data = [
            'firstName' => '',
            'lastName' => '',
            'username' => '',
            'email' => '',
            'pass' => '',
            'repass' => '',
            'phone' => '',
            'gender' => '1',
            'firstName_err' => '',
            'lastName_err' => '',
            'username_err' => '',
            'email_err' => '',
            'pass_err' => '',
            'repass_err' => '',
            'phone_err' => '',
          ];
          $this->view('users/register', $data);
        }
      }
    }

    public function login() {
      if (isLoggedIn()) {
        redirect('pages');
      } else {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'username_err' => '',
            'password_err' => ''
          ];
          if (empty($data['username'])) {
            $data['username_err'] = 'please fill the email field';
          } elseif (!$this->userModel->usernameExist($data['username'])) {
            $data['username_err'] = 'The username not exist';
          }
          if (empty($data['password'])) {
            $data['password_err'] = 'please fill the password field';
          }
          if (empty($data['password_err']) && empty($data['username_err'])) {
            if ($this->userModel->login($data)) {
              $_SESSION['username'] = $data['username'];
              $_SESSION['isAdmin'] = $this->userModel->isAdmin($data['username']);
              redirect('pages');
            } else {
              $data['password_err'] = 'the password is wrong';
              $this->view('users/login', $data);
            }
          } else {
            $this->view('users/login', $data);
          }
        } else {
          $data = [
            'username' => '',
            'password' => '',
            'username_err' => '',
            'password_err' => ''
          ];
          $this->view('users/login', $data);
        }
      }
    }

    public function logout() {
      if (isLoggedIn()) {
        unset($_SESSION['username']);
        unset($_SESSION['isAdmin']);
        session_destroy();
        redirect('users/login');
      } else {
        redirect('users/login');
      }
    }

    public function edit() {
      if(isLoggedIn()) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'firstName' => $_POST['userFirstName'],
            'lastName' => $_POST['userLastName'],
            'username' => getUsername(),
            'email' => $_POST['email'],
            'password' => $_POST['firstPassword'],
            'phone' => $_POST['phone'],
            'photo' => '',
            'gender' => $_POST['gender'],
            'firstName_err' => '',
            'lastName_err' => '',
            'username_err' => '',
            'email_err' => '',
            'phone_err' => '',
          ];
          $photoName = $_FILES['photo']['name'];
          $photoSize = $_FILES['photo']['name'];
          $photoTmp = $_FILES['photo']['tmp_name'];
          $photoType = $_FILES['photo']['type'];

          $photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
          $photoExtention = explode('.', $photoName);
          $photoExtention = end($photoExtention);
          $photoExtention = strtolower($photoExtention);
          if (empty($data['firstName'])) {
            $data['firstName_err'] = 'Please fill the first name field';
          }
          if (empty($data['lastName'])) {
            $data['lastName_err'] = 'Please fill the last name field';
          }
          if (empty($data['email'])) {
            $data['email_err'] = 'Please fill the email field';
          }
          if (empty($data['phone'])) {
            $data['phone_err'] = 'Please fill the phone number field';
          }
          if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
            $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
          }

          if (empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['email_err']) && empty($data['phone_err']) && empty($data['photo_err'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if (!empty($photoName)) {
              $randomNum = rand(0, 100000);
              move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
              $data['photo'] = $randomNum . '_' . $photoName;
            }
            if ($this->userModel->update($data)) {
              redirect('users/edit');
            } else {
              flash('error', 'something went wrong', 'alert alert-danger');
              redirect('pages/index');
            }
          } else {
            $this->view('users/edit', $data);
          }
  
  
  
        } else {
          $row = $this->userModel->usernameExist($_SESSION['username']);
          $data= [
            'firstName' => $row->firstName,
            'lastName' => $row->lastName,
            'username' => $row->username,
            'email' => $row->email,
            'pass' => '',
            'phone' => $row->telephone,
            'gender' => $row->gender,
            'firstName_err' => '',
            'lastName_err' => '',
            'username_err' => '',
            'email_err' => '',
            'pass_err' => '',
            'repass_err' => '',
            'phone_err' => '',
          ];
          $this->view('users/edit', $data);
        }

      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }

    }

    public function service() {
      if (isLoggedIn()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'serviceDate' => $_POST['serviceDateTime'],
            'serviceDate_err' => '',
            'services' => $this->userModel->allServiceForUsername(getUsername())
          ];
          $dateTime =  $_POST['serviceDateTime'];
          $date = substr($dateTime, 0, 10);
          $time = substr($dateTime, 11, 5);
          $dateTime = $date . ' ' . $time . ':00';
          if($this->userModel->checkServiceDate($dateTime)) {
            $this->userModel->addService($dateTime);
            flash('service-added', 'Service Added Successfully :)');
            redirect('users/service');
          } else {
            flash('service-added', 'This time isn\'t available try another time :(', 'alert alert-danger');
            $this->view('users/service', $data);
          }
        } else {
          $data = [
            'serviceDate' => date("Y-m-d") . 'T' . date("H:i") ,
            'serviceDate_err' => '',
            'services' => $this->userModel->allServiceForUsername(getUsername())
          ];
          $this->view('users/service', $data);
        }
      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }

    }

    public function payment() {
      if (isLoggedIn()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = [
            'payments' => $this->userModel->allPayment(getUsername()),
            'username' => getUsername(),
            'visaNum' => $_POST['visa'],
            'pin' =>  $_POST['pin'],
            'money' =>  $_POST['money'],
            'visaNum_err' => '',
            'pin_err' => '',
            'money_err' => '',
          ];

          if (empty($data['visaNum'])) {
            $data['visaNum_err'] = 'The VISA Number field can\'t be empty';
          } elseif (strlen($data['visaNum']) != 16) {
            $data['visaNum_err'] = 'The VISA Number must be from 16 number';
          }

          if (empty($data['pin'])) {
            $data['pin_err'] = 'The PIN field can\'t be empty';
          } elseif ($data['pin'] <= 0) {
            $data['pin_err'] = 'The PIN can\'t be less then or equal 0';
          }

          if (empty($data['money'])) {
            $data['money_err'] = 'The PIN field can\'t be empty';
          } elseif ($data['money'] <= 0) {
            $data['money_err'] = 'The PIN can\'t be less then or equal 0';
          }

          if ( empty($data['visaNum_err']) && empty($data['pin_err']) && empty($data['money_err']) ) {
            if($this->userModel->addPayment($data)){
              redirect('users/payment');
            } else {
              flash('error', 'something went wrong', 'alert alert-danger');
              redirect('pages/index');
            }
          } else {
            $this->view('users/payment', $data);
          }

        } else {
          $data = [
            'payments' => $this->userModel->allPayment(getUsername()),
            'username' => getUsername(),
            'visaNum' => '',
            'pin' => '',
            'money' => '',
            'visaNum_err' => '',
            'pin_err' => '',
            'money_err' => '',
          ];
          $this->view('users/payment', $data);
        }
      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
    }

    public function allOrders() {
      if (isLoggedIn()) {
        $data = [
          'products' => $this->userModel->getOrdersForUser(getUsername())
        ];

        $this->view('users/orders', $data);
      } else { 
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
    }

    public function allRents() {
      if (isLoggedIn()) {
        $data = [
          'rents' => $this->userModel->getRents(getUsername())
        ];
        $this->view('users/rent', $data);
      } else {
        flash('error', 'Sorry, You need to login first', 'alert alert-danger');
        redirect('pages/index');
      }
    }
  }