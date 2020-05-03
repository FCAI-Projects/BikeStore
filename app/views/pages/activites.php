<?php require APPROOT . '/views/inc/header.php'?>
  <table class="table mx-auto mt-5 text-center" style="width: 90%" id="el">
  <h2 class="text-center mb-5 mt-5" style="color: #333">All Your Payments</h2>
    <thead class="thead-dark custom-thead">
      <tr>
        <th>Product ID</th>
        <th>Title</th>
        <th>Features</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($data['products'] as $product) {
          echo '<tr>';
            echo '<th>' . $product->productId . '</th>';
            echo '<th>' . $product->name . '</th>';
            echo '<th>' . $product->features . '</th>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
<?php require APPROOT . '/views/inc/footer.php'?>
<script>
  var element = document.getElementById('el');
  var opt = {
    margin:       1,
    filename:     'myfile.pdf',
    jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
  };

  // New Promise-based usage:
  html2pdf().set(opt).from(element).save();

</script>