<?php

namespace MVCPHP\models;
// add delete edit list  
class post implements Strategy {
  private $db;
  private $context;

  public function __construct() {
    global $registry;
    $this->db = $registry->get('db');
    $this->context = new Context(new PostAdd());
  }

  public function add($data) {
    return $this->context->executeStrategy($data);
  }

  public function edit($data) {
    if (empty($data['photo'])) {
      $this->db->query('UPDATE posts SET postTitle = :title, postContent = :content WHERE postId = :id');
    } else {
      $this->db->query('UPDATE posts SET postTitle = :title, postContent = :content, photoName = :name WHERE postId = :id');
      $this->db->bind(':name', $data['photo']);
    }
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':content', nl2br($data['content']));
    $this->db->bind(':id', $data['id']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function list() {
    $this->db->query('SELECT * FROM posts ORDER BY postDate DESC');
    return $this->db->resultSet();
  }

  public function getPostById($id) {
    $this->db->query('SELECT * FROM posts WHERE postId = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  public function addComment($data) {
    $this->db->query('INSERT INTO comments(postId, username, commentContent) VALUES(:id, :username, :content)');
    $this->db->bind(':id', $data['postId']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':content', nl2br($data['comment']));
    $this->db->execute();
  }

  public function getPostComments($id) {
    $this->db->query('SELECT comments.*, users.avatarName FROM comments INNER JOIN users ON comments.username = users.username  WHERE comments.postId = :id ORDER BY comments.commentDate DESC');
    $this->db->bind(':id', $id);
    return $this->db->resultSet();
  }


  public function delete($id) {
    $this->db->query('DELETE FROM posts WHERE postId = :id');
    $this->db->bind(':id', $id);
    $this->db->execute();
  }

  public function getPostsByUsername($username) {
    $this->db->query('SELECT * FROM posts WHERE username = :user');
    $this->db->bind(':user', $username);
    return $this->db->resultSet();
  }

  public function getUsernameOfPost($id) {
    $this->db->query('SELECT * FROM posts WHERE postId = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  

}