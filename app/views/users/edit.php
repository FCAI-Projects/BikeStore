<?php require APPROOT . '/views/inc/header.php' ?>
<div class="container">
  <?php flash('sucess-edit'); ?>
</div>
<h1 class="text-center mt-4 mb-5" style="color: #333">Edit Profile</h1>
<form class="mx-auto" method="POST" action="<?php echo URLROOT; ?>/users/edit" style="width: 40%" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['firstName_err'])) ? 'is-invalid' : '' ?>" type="text" name="userFirstName" id="firstName" placeholder="First Name" value="<?php echo $data['firstName'] ?>" />
    <div class="invalid-feedback"><?php echo $data['firstName_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['lastName_err'])) ? 'is-invalid' : '' ?>" type="text" name="userLastName" id="lastName" placeholder="Last Name" value="<?php echo $data['lastName'] ?>" />
    <div class="invalid-feedback"><?php echo $data['lastName_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="username">Username (can't be changed)</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : '' ?>" type="text" name="username" id="username" placeholder="johndoe" value="<?php echo $data['username'] ?>" disabled/>
    <div class="invalid-feedback"><?php echo $data['username_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" type="email" name="email" id="email" placeholder="example@example.com" value="<?php echo $data['email'] ?>" />
    <div class="invalid-feedback"><?php echo $data['email_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="password">Password (if you want change it type the new one)</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>" type="password" name="firstPassword" id="password" placeholder="Type Password" value="<?php echo $data['pass'] ?>" />
    <div class="invalid-feedback"><?php echo $data['pass_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="phone">Phone Number</label>
    <input class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : '' ?>" type="text" name="phone" id="phone" placeholder="Type your phone numbre" value="<?php echo $data['phone'] ?>" />
    <div class="invalid-feedback"><?php echo $data['phone_err'] ?></div>
  </div>
  <div class="custom-file mt-2 mb-3">
    <input type="file" class="custom-file-input" name="photo" id="photo">
    <label class="custom-file-label <?php echo (!empty($data['photo_err']))? 'is-invalid' : '' ?>" for="photo">Choose file</label>
    <div class="invalid-feedback"><?php echo $data['photo_err'] ?></div>
  </div>

  <div class="form-check mt-2 mb-1">
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

  <input class="form-control form-control-lg customBtn mx-auto mt-4" type="submit" value="Save Changes" />

</form>
<!-- End Forms Container -->
<?php require APPROOT . '/views/inc/footer.php' ?>
<script>
  $(function (){
    $('#photo').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
  });

</script>