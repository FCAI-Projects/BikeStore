<?php

  class shop {
    private $db;
    public function __construct() {
      global $registry;
      $this->db = $registry->get('db');
    }
    public function add($data) {
      $this->db->query('SELECT * FROM shoppingcart WHERE username = :user AND productId = :id');
      $this->db->bind(':user', $data['username']);
      $this->db->bind(':id', $data['productId']);
      $this->db->execute();
      if ($this->db->rowCount() > 0) {
        return false;
      } else {
        $this->db->query('INSERT INTO shoppingcart(username, productId) VALUES(:user, :id)');
        $this->db->bind(':user', $data['username']);
        $this->db->bind(':id', $data['productId']);
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        } 
      }
      
    }


    public function getAllForUsername($username) {
      $this->db->query('SELECT shoppingcart.* , products.* FROM shoppingcart INNER JOIN products ON shoppingcart.productId = products.productId WHERE shoppingcart.username = :user');
      $this->db->bind(':user', $username);
      return $this->db->resultSet();
    }

    public function search($username, $id) {
      $this->db->query('SELECT * FROM shoppingcart WHERE username = :user AND productId = :id');
      $this->db->bind(':user', $username,);
      $this->db->bind(':id', $id);
      $this->db->execute();
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }


    public function getPaymentsForUsername($username) {
      $this->db->query('SELECT * FROM payment WHERE username = :user');
      $this->db->bind(':user', $username);
      return $this->db->resultSet();
    }

    public function makeOrder($data) {
      $this->db->query('INSERT INTO orders(productId, username, orderQuantity) VALUES(:id, :user, :quantity)');
      $this->db->bind(':id', $data['productId']);
      $this->db->bind(':user', $data['username']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->execute();
      $this->db->query('UPDATE products SET quantity = :quantity WHERE productId = :id');
      $this->db->bind(':id', $data['productId']);
      $this->db->bind(':quantity', $data['newQuantity']);
      $this->db->execute();
      $this->db->query('UPDATE payment SET money = :money WHERE username = :user AND visaNumber = :visa');
      $this->db->bind(':money', $data['visaMoney']);
      $this->db->bind(':user', $data['username']);
      $this->db->bind(':visa', $data['visaNumber']);
      $this->db->execute();
    }

  }