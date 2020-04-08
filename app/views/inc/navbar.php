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
  
  if ($link != URLROOT.'/users/register' && $link != URLROOT.'/users/login'):
?>
<!-- Start Navbar -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT ?>">Bike Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo URLROOT ?>/pages/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>">Blog</a>
        </li>
        <?php if (!isLoggedIn()): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT ?>/users/register">Register</a>
          </li>
        <?php endif; ?>
        <?php if (isLoggedIn()): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo getUsername() ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/edit">Setting</a>
            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/service">Service</a>
            <a class="dropdown-item" href="#">Add Item</a>
            <a class="dropdown-item" href="#">Add Post</a>
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
