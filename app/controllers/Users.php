<?php

  class Users extends Controller {
    public function __construct() {
      $this->userModel = $this->model('User');
    }

    public function register() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            redirect('pages');
          } else {
            die('something went wrong');
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

    public function login() {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    public function logout() {
      unset($_SESSION['username']);
      session_destroy();
      redirect('users/register');
    }
  }