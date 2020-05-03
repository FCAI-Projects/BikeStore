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
  <footer class="footer mt-5">
    <p class="text-center">All Copyright Reserved © 2010-2020</p>
  </footer>
  <?php endif; ?>
  <script src="<?php echo URLROOT; ?>/js/jquery-3.4.1.slim.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/popper.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/html2pdf.bundle.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/main.js"></script>

  </body>
</html>