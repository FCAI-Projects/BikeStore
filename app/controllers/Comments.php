<?php


namespace MVCPHP\controllers;


use MVCPHP\libraries\Controller;

class Comments extends Controller {
  
  public function __construct() {
    $this->postModel = $this->model('post');
  }

  public function comment($id = -1) {
    if ($id == -1) {
      redirect('pages');
    } else {
      if (isLoggedIn()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $data = ['username' => getUsername(), 'postId' => $id, 'comment' => $_POST['comment'], 'comment_err' => '',];
          if (empty($data['comment'])) {
            $data['comment_err'] = 'Comment can not be empty :(';
          }

          if (empty($data['comment_err'])) {
            $this->postModel->addComment($data);
            flash('post-message', 'Comment Seccessfully Added :)');
            redirect('posts/blog');
          } else {
            flash('post-message', $data['comment_err'], 'alert alert-danger');
            redirect('posts/blog');
          }

        } else {
          flash('error', 'you are not allowed to get here', 'alert alert-danger');
          redirect('pages/index');
        }
      } else {
        flash('error', 'you are not allowed you should sign in', 'alert alert-danger');
        redirect('pages/index');
      }
    }

  }
  
}