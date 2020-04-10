<?php require APPROOT . '/views/inc/header.php' ?>
<table class="table mx-auto mt-5 text-center" style="width: 40%">
<h1 class="text-center mb-5 mt-5" style="color: #333">All Your Rents</h1>
  <thead class="thead-dark custom-thead">
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach($data['rents'] as $rent) {
        if ($rent->rentDate == date('Y-m-d')) {
          echo '<tr style="color: green">';
        } else {
          echo '<tr style="color: red">';
        }
            echo '<th>' . $rent->productId . '</th>';
            echo '<th>' . $rent->name . '</th>';
            echo '<th>' . $rent->rentDate . '</th>';
          echo '</tr>';
      }
    ?>
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php' ?>