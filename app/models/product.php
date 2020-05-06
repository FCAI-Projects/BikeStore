<?php

namespace MVCPHP\models;
// add edit list delete

class product implements rule {
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

  public function edit($data) {
    if (!empty($data['photo'])) {
      $this->db->query('UPDATE products SET name = :name, photoName=:photo, features=:feature, price=:price, quantity=:quantity, rentStatus=:renting, isBike=:isBike, isNew=:isNew WHERE productId = :id');
      $this->db->bind(':photo', $data['photo']);
    } else {
      $this->db->query('UPDATE products SET name = :name, features=:feature, price=:price, quantity=:quantity, rentStatus=:renting, isBike=:isBike, isNew=:isNew WHERE productId = :id');
    }
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':feature', nl2br($data['features']));
    $this->db->bind(':price', $data['price']);
    $this->db->bind(':quantity', $data['quantity']);
    $this->db->bind(':renting', $data['rentStatus']);
    $this->db->bind(':isBike', $data['isBike']);
    $this->db->bind(':isNew', $data['isNew']);
    $this->db->bind(':id', $data['id']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function list() {
    $this->db->query('SELECT * FROM products ORDER BY productId DESC');
    return $this->db->resultSet();
  }

  public function allProductsByUsername($username, $select = '*') {
    $this->db->query("SELECT $select FROM products WHERE username = :username");
    $this->db->bind(':username', $username);
    return $this->db->resultSet();
  }

  public function getProductById($id) {
    $this->db->query('SELECT * FROM products WHERE productId = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  public function delete($id) {
    $this->db->query('DELETE FROM products WHERE productId = :id');
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function renting($data) {
    $this->db->query('INSERT INTO rentbike(username, productId) VALUES(:username, :id)');
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':id', $data['productId']);
    $this->db->execute();
  }

  public function search($search) {
    $this->db->query('SELECT * FROM products WHERE name like :search ORDER BY productId DESC');
    $this->db->bind(':search', '%' . $search . '%');
    return $this->db->resultSet();
  }

  public function getOrdersForSeller($username) {
    $this->db->query('SELECT orders.orderQuantity, products.*  FROM orders INNER JOIN products ON orders.productId = products.productId  WHERE products.username = :user ORDER BY orderDate DESC');
    $this->db->bind(':user', $username);
    return $this->db->resultSet();
  }

}