<?php

namespace MVCPHP\models;
class post {
  private $db;

  public function __construct() {
    global $registry;
    $this->db = $registry->get('db');
  }

  public function add($data) {
    $this->db->query('INSERT INTO posts(username, postTitle, postContent, photoName) VALUES(:username, :title, :content, :photo)');
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':content', nl2br($data['content']));
    $this->db->bind(':photo', $data['photo']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function allPosts() {
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


  public function removePost($id) {
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

  public function editPost($data) {
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

}