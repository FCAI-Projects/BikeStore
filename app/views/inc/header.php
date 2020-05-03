<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/all.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <title><?php echo SITENAME; ?></title>
  </head>
<body>
  <?php require APPROOT .'/views/inc/navbar.php' ?>
  <div class="settings">
    <div class="setting-icon">
      <i class="fas fa-cogs"></i>
    </div>
    <div class="setting-options">
      <div class="option-box">
        <ul class="color-list">
          <h3>Change Color</h3>
          <li data-color="#3498db"></li>
          <li data-color="#9b59b6"></li>
          <li data-color="#34495e"></li>
          <li data-color="#2ecc71"></li>
          <li data-color="#1abc9c"></li>
          <li data-color="#f1c40f"></li>
          <li data-color="#e74c3c"></li>
          <li data-color="linear-gradient(-45deg, #5e72e4, #2dce89)"></li>
          <li data-color="linear-gradient(-45deg, #DA4453, #89216B)"></li>
          <li data-color="linear-gradient(-45deg, #cc2b5e, #753a88)"></li>
        </ul>
      </div>
    </div>
  </div>

  