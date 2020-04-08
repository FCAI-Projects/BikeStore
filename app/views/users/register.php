<?php require APPROOT . '/views/inc/header.php' ?>
<div class="forms">
  <!-- Start Sign Up Form -->
  <section class="main-form">
    <div class="container">
      <div class="row">
        <a href='<?php echo URLROOT ?>/users/register' class="signup text-uppercase col btn btn-light mr-2 active">
          Sign Up
        </a>
        <a href='<?php echo URLROOT ?>/users/login' class="login text-uppercase col btn btn-light ml-2">
          Log In
        </a>
        <form class="row" method="POST" action="<?php echo URLROOT; ?>/users/register">
          <div class="col-12 pl-0 pr-0 mb-2 mt-2 ">
            <input class="form-control form-control-lg <?php echo (!empty($data['firstName_err'])) ? 'is-invalid' : '' ?>" type="text" name="userFirstName" id="firstName" placeholder="First Name" value="<?php echo $data['firstName'] ?>" />
            <div class="invalid-feedback"><?php echo $data['firstName_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['lastName_err'])) ? 'is-invalid' : '' ?>" type="text" name="userLastName" id="lastName" placeholder="Last Name" value="<?php echo $data['lastName'] ?>" />
            <div class="invalid-feedback"><?php echo $data['lastName_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : '' ?>" type="text" name="username" id="username" placeholder="johndoe" value="<?php echo $data['username'] ?>" />
            <div class="invalid-feedback"><?php echo $data['username_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" type="email" name="email" id="email" placeholder="example@example.com" value="<?php echo $data['email'] ?>" />
            <div class="invalid-feedback"><?php echo $data['email_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>" type="password" name="firstPassword" id="password" placeholder="Type Password" value="<?php echo $data['pass'] ?>" />
            <div class="invalid-feedback"><?php echo $data['pass_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['repass_err'])) ? 'is-invalid' : '' ?>" type="password" name="secondPassowrd" id="secpassword" placeholder="Retype Password" value="<?php echo $data['repass'] ?>" />
            <div class="invalid-feedback"><?php echo $data['repass_err'] ?></div>
          </div>
          <div class="col-12 pl-0 pr-0 mb-2 mt-2">
            <input class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : '' ?>" type="text" name="phone" id="phone" placeholder="Type your phone numbre" value="<?php echo $data['phone'] ?>" />
            <div class="invalid-feedback"><?php echo $data['phone_err'] ?></div>
          </div>

          <div class="col-12 form-check mt-2 mb-1">
            <input class="form-check-input" type="radio" id="male" name="gender" value="1" <?php if ($data['gender'] == '1') {
                                                                                              echo "checked";
                                                                                            } ?> />
            <label for="male" class="form-check-label">Male</label>
          </div>

          <div class="col-12 form-check mt-1 mb-2">
            <input class="form-check-input" type="radio" id="female" name="gender" value="2" <?php if ($data['gender'] == '2') {
                                                                                                echo "checked";
                                                                                              } ?> />
            <label for="female" class="form-check-label">Female</label>
          </div>

          <input class="form-control form-control-lg col-12" type="submit" value="Submit" />

        </form>
      </div>
    </div>
  </section>

  <!-- End Sign Up Form -->

</div>
<!-- End Forms Container -->
<?php require APPROOT . '/views/inc/footer.php' ?>