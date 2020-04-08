<?php require APPROOT . '/views/inc/header.php' ?>
<h1 class="text-center mt-4 mb-5" style="color: #333">Bike Servicing</h1>
<form style="width: 40%" class="mx-auto mb-5" action="<?php echo URLROOT?>/users/service" method="POST">
  <?php flash('service-added') ?>
  <input class="form-control form-control-lg" type="datetime-local" id="serviceDateTime" name="serviceDateTime" min="<?php echo $data['serviceDate']?>" value="<?php echo $data['serviceDate']?>">
  <small class="form-text text-muted">MM/DD/YYYY HH:MM AM/PM</small>
  <input class="form-control form-control-lg customBtn mx-auto mt-4 mb-5" name="serviceSubmit" style="border-radius: 5px" type="submit" value="Submit" />
</form>

<h2 class="text-center mb-5 mt-5" style="color: #333">All Submitted Services</h2>
<table class="table mx-auto mt-5" style="width: 40%">
  <thead class="thead-dark custom-thead">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $current = date("Y-m-d") . ' ' . date("H:i");
      foreach($data['services'] as $service) {

        echo '<tr>';
          echo '<th scope="id">' . $service->serviceId . '</th>';
          echo '<th>' . $service->serviceDate . '</th>';
          echo ($service->serviceDate > $current )? '<th style="color: green">' . 'Running' . '</th>' : '<th style="color: red">' . 'Done' . '</th>';
        echo '</tr>';

      }
    
    
    ?>
  </tbody>
</table>

<?php require APPROOT . '/views/inc/footer.php' ?>