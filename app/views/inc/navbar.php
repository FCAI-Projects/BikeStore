<?php
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
  $link = "https"; 
  else
  $link = "http"; 

  // Here append the common URL characters. 
  $link .= "://"; 

  // Append the host(domain name, ip) to the URL. 
  $link .= $_SERVER['HTTP_HOST']; 

  // Append the requested resource location to the URL 
  $link .= $_SERVER['REQUEST_URI']; 
  
  if ($link != URLROOT.'/users/register' && $link != URLROOT.'/users/login' && $link != URLROOT.'/users'):
?>
<!-- Start Navbar -->

<nav class="navbar navbar-expand-lg navbar-darl bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT ?>">Bike Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/pages/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/posts/blog">Blog</a>
        </li>
        <?php if (!isLoggedIn()): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT ?>/users/register">Register</a>
          </li>
        <?php endif; ?>
        <?php if (isLoggedIn()): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/shopping/show">Shopping Cart</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo getUsername() ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if (isAdmin()): ?>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/admin/edit">Setting</a>
            <?php else: ?>
              <a class="dropdown-item" href="<?php echo URLROOT ?>/users/edit">Setting</a>
            <?php endif; ?>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/allOrders">All Orders</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/payment">Add Payment</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/allRents">Renting</a>
            <?php if(!isAdmin()): ?>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/service">Service</a>
            <?php endif; ?>
            <?php if(isAdmin()): ?>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/admin/services">Services Orders</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/admin/users">All Users</a>
            <?php endif; ?>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/products/show/<?php echo getUsername()?>">My Products</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/products/add">Add Product</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/posts/add">Add Post</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/posts/allposts">All My Posts</a>
            <a class="dropdown-item" href="<?= URLROOT ?>/users/activites">Download Acticties</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/logout">Log Out</a>
          </div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

  <!-- End Navbar -->
<?php endif; ?>
