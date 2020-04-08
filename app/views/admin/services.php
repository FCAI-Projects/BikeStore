<?php require APPROOT . '/views/inc/header.php' ?>
<h1 class="text-center mb-5 mt-5" style="color: #333">All Services</h1>
<table class="table mx-auto mt-5" style="width: 40%">
  <thead class="thead-dark custom-thead">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
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
          echo '<th>' . $service->username . '</th>';
          echo '<th>' . $service->serviceDate . '</th>';
          echo ($service->serviceDate > $current )? '<th style="color: green">' . 'Running' . '</th>' : '<th style="color: red">' . 'Done' . '</th>';
        echo '</tr>';
      }
    
    
    ?>
  </tbody>
</table>

<?php require APPROOT . '/views/inc/footer.php' ?>