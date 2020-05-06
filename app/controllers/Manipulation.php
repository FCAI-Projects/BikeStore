<?php


namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Manipulation extends Controller {
  public function __construct() {
    $this->userModel = $this->model('User');
  }
  
  public function edit() {
    if (isLoggedIn()) {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = ['firstName' => $_POST['userFirstName'], 'lastName' => $_POST['userLastName'], 'username' => getUsername(), 'email' => $_POST['email'], 'password' => $_POST['firstPassword'], 'phone' => $_POST['phone'], 'photo' => '', 'gender' => $_POST['gender'], 'firstName_err' => '', 'lastName_err' => '', 'username_err' => '', 'email_err' => '', 'phone_err' => '',];
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
          if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          }
          if (!empty($photoName)) {
            $randomNum = rand(0, 100000);
            move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
            $data['photo'] = $randomNum . '_' . $photoName;
          }
          if ($this->userModel->edit($data)) {
            flash('sucess-edit', 'Changes Saved Successfully');
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
        $data = ['firstName' => $row->firstName, 'lastName' => $row->lastName, 'username' => $row->username, 'email' => $row->email, 'pass' => '', 'phone' => $row->telephone, 'gender' => $row->gender, 'firstName_err' => '', 'lastName_err' => '', 'username_err' => '', 'email_err' => '', 'pass_err' => '', 'repass_err' => '', 'phone_err' => '',];
        $this->view('users/edit', $data);
      }

    } else {
      flash('error', 'Sorry, You need to login first', 'alert alert-danger');
      redirect('pages/index');
    }

  }
}