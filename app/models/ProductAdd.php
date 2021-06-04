<?php


namespace MVCPHP\models;


class ProductAdd implements Strategy
{

  private $db;

  public function __construct() {
    global $registry;
    $this->db = $registry->get('db');
  }

  public function add($data) {
    $this->db->query('INSERT INTO products(username, name, photoName, features, price, quantity, rentStatus, isBike, isNew) VALUES(:user, :name, :photo, :feature, :price, :quantity, :renting, :isBike, :isNew)');
    $this->db->bind(':user', $data['username']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':photo', $data['photo']);
    $this->db->bind(':feature', nl2br($data['feature']));
    $this->db->bind(':price', $data['price']);
    $this->db->bind(':quantity', $data['quantity']);
    $this->db->bind(':renting', $data['forRent']);
    $this->db->bind(':isBike', $data['isBike']);
    $this->db->bind(':isNew', $data['isNew']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
}