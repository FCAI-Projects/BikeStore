<?php require APPROOT . '/views/inc/header.php'?>
<?php flash('removed-payment'); ?>
<h1 class="text-center mt-4 mb-5" style="color: #333">Add New Payment</h1>
<form class="mx-auto" style="width: 40%" method="POST" action="<?php echo URLROOT; ?>/users/payment">
  <div class="form-group">
    <label for="visa">VISA Number</label>
    <input type="number" class="form-control <?php echo (!empty($data['visaNum_err']))? 'is-invalid' : '' ?>" id="visa" name="visa" value="<?php echo $data['visaNum'] ?>">
    <div class="invalid-feedback"><?php echo $data['visaNum_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="pin">PIN</label>
    <input type="number" class="form-control <?php echo (!empty($data['pin_err']))? 'is-invalid' : '' ?>" id="pin" name="pin" value="<?php echo $data['pin'] ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your pin with anyone else.</small>
    <div class="invalid-feedback"><?php echo $data['pin_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="money">Money Amount</label>
    <input type="number" class="form-control <?php echo (!empty($data['money_err']))? 'is-invalid' : '' ?>" id="money" name="money" value="<?php echo $data['money'] ?>">
    <div class="invalid-feedback"><?php echo $data['money_err'] ?></div>
  </div>
  <button type="submit" class="btn btn-primary customBtn mt-2" style="border-radius: 4px">Add</button>
</form>

<table class="table mx-auto mt-5 text-center" style="width: 40%">
<h2 class="text-center mb-5 mt-5" style="color: #333">All Your Payments</h2>
  <thead class="thead-dark custom-thead">
    <tr>
      <th>VISA Number</th>
      <th>PIN</th>
      <th>Money</th>
      <th>Control</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach($data['payments'] as $payment) {
        echo '<tr>';
          echo '<th>' . $payment->visaNumber . '</th>';
          echo '<th>' . $payment->pin . '</th>';
          echo '<th>$' . $payment->money . '</th>';
          echo '<th><a href="'.URLROOT.'/users/rpayment/'.$payment->visaNumber.'" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></th>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>

<?php require APPROOT . '/views/inc/footer.php'?>