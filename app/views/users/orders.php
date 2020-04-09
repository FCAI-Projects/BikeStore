<?php require APPROOT . '/views/inc/header.php'?>
<div class="container">
  <h1 class="text-center mt-4 mb-5" style="color: #333">All My Orders</h1>
  <div class="row mt-5">
    
  <?php

      foreach ($data['products'] as $item) {
        echo '<div class="col-4 mb-4">';
          echo '<div class="card custom-card">';
            echo '<span class="price">$'.$item->price.'</span>';
            echo '<img src="'.URLROOT.'/img/uploads/'. $item->photoName .'" class="card-img-top" alt="..." style="width: 100%;height: 200px;">';
            echo '<div class="card-body">';
              echo '<h5 class="card-title">'.$item->name.'</h5>';
              echo '<hr>';
              echo 'You bought: ' . $item->orderQuantity;
              echo '<div  class="row">';
                echo '<button type="button" class="btn btn-link custom-link ml-1 col" data-toggle="modal" data-target="#exampleModal'.$item->productId.'">See Features</button>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';

        // model
        echo '<div class="modal fade" id="exampleModal'.$item->productId.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
          echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
              echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModalLabel">'.$item->name.'</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                  echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
              echo '</div>';
              echo '<div class="modal-body">';
                echo '<img src="'.URLROOT.'/img/uploads/'. $item->photoName .'" alt="..." style="width: 100%;height: 100%;">';
                echo '<hr>';
                echo $item->features;
                echo '<br><br>';
                echo '<span style="color: red">Left: ' . $item->quantity . '</span>';
              echo '</div>';
              echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                echo '<button type="button" class="btn btn-primary">Save changes</button>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';


              

      }



  ?>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'?>