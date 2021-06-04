<?php


namespace MVCPHP\models;


class UserAdd implements Strategy
{

  private $db;

  public function __construct() {
    global $registry;
    $this->db = $registry->get('db');
  }

    public function add($data)
    {
      $this->db->query('INSERT INTO users(username, firstName, lastName, email, password, gender, telephone) VALUES(:username, :fname, :lname, :email, :pass, :gender, :phone)');
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':fname', $data['firstName']);
      $this->db->bind(':lname', $data['lastName']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':pass', $data['pass']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':phone', $data['phone']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
}