<?php require APPROOT . '/views/inc/header.php' ?>
<div class="forms">
  <!-- Start Sign In Form -->

  <section class="login-form">
    <div class="container">
      <div class="row">
        <a href='<?php echo URLROOT ?>/users/register' class="signup text-uppercase col btn btn-light mr-2">
          Sign Up
        </a>
        <a href='<?php echo URLROOT ?>/users/login' class="login text-uppercase col btn btn-light ml-2 active">
          Log In
        </a>
        <form class="row" method="POST" action="<?php echo URLROOT ?>/users/login">
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
          <input class=" form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : '' ?>" type="text" name="username" id="username" placeholder="Type your username" value="<?php echo $data['username']; ?>"/>
          <div class="invalid-feedback"><?php echo $data['username_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2 mb-4">
          <input class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" type="password" name="password" id="password" placeholder="Type Password" value="<?php echo $data['password']; ?>"/>
          <div class="invalid-feedback"><?php echo $data['password_err'] ?></div>
          </div>
          <input class="form-control form-control-lg col mr-2"  type="submit" value="Submit" />
          <button type="button" class="btn col log-forget-pass ml-2" data-toggle="modal" data-target="#exampleModal">Forget Password</button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Forget Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="col-12">
                  <input class="col-12 form-control form-control-lg mb-4" type="email" name="email" id="email" placeholder="example@example.com" />
                  <input class="col-12 form-control form-control-lg" id="log-submit" type="submit" value="Submit" />
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
      </div>
    </div>
  </section>
</div>
<!-- End Forms Container -->
<?php require APPROOT . '/views/inc/footer.php' ?>