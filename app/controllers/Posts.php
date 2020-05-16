<?php


namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Posts extends Controller {
  public function __construct() {
    $this->postModel = $this->model('post');
    $this->comments = new Comments();
  }

  public function index() {
    $this->blog();
  }

  public function add() {
    if (isLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = ['username' => getUsername(), 'title' => $_POST['title'], 'content' => $_POST['content'], 'photo' => $_FILES['photo'], 'title_err' => '', 'content_err' => '', 'photo_err' => '',];

        $photoName = $_FILES['photo']['name'];
        $photoSize = $_FILES['photo']['name'];
        $photoTmp = $_FILES['photo']['tmp_name'];
        $photoType = $_FILES['photo']['type'];

        $photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
        $photoExtention = explode('.', $photoName);
        $photoExtention = end($photoExtention);
        $photoExtention = strtolower($photoExtention);

        if (empty($data['title'])) {
          $data['title_err'] = 'Please fill the title field';
        }
        if (empty($data['content'])) {
          $data['content_err'] = 'Please fill the content field';
        }
        if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
          $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
        } elseif (empty($photoName)) {
          $data['photo_err'] = 'Please add a photo for the product';
        }

        if (empty($data['title_err']) && empty($data['content_err']) && empty($data['photo_err'])) {
          $randomNum = rand(0, 100000);
          move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
          $data['photo'] = $randomNum . '_' . $photoName;
          if ($this->postModel->add($data)) {
            redirect('pages');
          } else {
            die('something went wrong');
          }
        } else {
          $this->view('users/addPost', $data);
        }

      } else {
        $data = ['username' => getUsername(), 'title' => '', 'content' => '', 'photo' => '', 'title_err' => '', 'content_err' => '', 'photo_err' => '',];
        $this->view('users/addPost', $data);
      }
    } else {
      die('you need to sign in');
    }
  }

  public function blog() {
    $data = ['posts' => $this->postModel->list()];

    $this->view('pages/blog', $data);
  }


  public function show($id = -1) {
    if ($id == -1) {
      redirect('pages');
    } else {
      $data = ['post' => $this->postModel->getPostById($id), 'comments' => $this->postModel->getPostComments($id),];
      $this->view('pages/post', $data);
    }

  }

  public function comment($id = -1) {
    $this->comments->comment($id);
  }


  public function allPosts() {
    if (isLoggedIn()) {
      $data = ['posts' => $this->postModel->getPostsByUsername(getUsername())];
      $this->view('users/allposts', $data);
    }
  }

  public function remove($id = -1) {
    if ($id == -1) {
      redirect('pages');
    } else {
      if (isLoggedIn()) {
        $post = $this->postModel->getUsernameOfPost($id);
        if ($post->username == getUsername()) {
          $this->postModel->delete($id);
          redirect('pages/blog');
        } else {
          die('you are not allowed');
        }
      } else {
        die('you are not allowed, you need to sign in');
      }
    }

  }

  public function edit($id = -1) {
    if ($id == -1) {
      redirect('pages');
    } else {
      if (isLoggedIn()) {
        $post = $this->postModel->getUsernameOfPost($id);
        if ($post->username == getUsername()) {

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = ['username' => getUsername(), 'id' => $id, 'title' => $_POST['title'], 'content' => $_POST['content'], 'photo' => $_FILES['photo'], 'title_err' => '', 'content_err' => '', 'photo_err' => '',];

            $photoName = $_FILES['photo']['name'];
            $photoSize = $_FILES['photo']['name'];
            $photoTmp = $_FILES['photo']['tmp_name'];
            $photoType = $_FILES['photo']['type'];

            $photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
            $photoExtention = explode('.', $photoName);
            $photoExtention = end($photoExtention);
            $photoExtention = strtolower($photoExtention);

            if (empty($data['title'])) {
              $data['title_err'] = 'Please fill the title field';
            }
            if (empty($data['content'])) {
              $data['content_err'] = 'Please fill the content field';
            }
            if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
              $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
            }

            if (empty($data['title_err']) && empty($data['content_err']) && empty($data['photo_err'])) {
              if (!empty($photoName)) {
                $randomNum = rand(0, 100000);
                move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
                $data['photo'] = $randomNum . '_' . $photoName;
              } else {
                $data['photo'] = '';
              }
              if ($this->postModel->edit($data)) {
                redirect('pages');
              } else {
                die('something went wrong');
              }
            } else {
              $this->view('users/addPost', $data);
            }

          } else {
            $data = ['username' => getUsername(), 'id' => $id, 'title' => $post->postTitle, 'content' => str_replace('<br />', '', $post->postContent), 'photo' => '', 'title_err' => '', 'content_err' => '', 'photo_err' => '',];
            $this->view('users/editPost', $data);
          }


        } else {
          die('you are not allowed');
        }
      } else {
        die('you are not allowed, you need to sign in');
      }
    }

  }

}