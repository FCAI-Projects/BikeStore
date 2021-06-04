<?php


namespace MVCPHP\models;


class PostAdd implements Strategy
{

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
}