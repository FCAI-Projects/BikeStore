<?php require APPROOT . '/views/inc/header.php' ?>


<table class="table mx-auto mt-5 text-center" style="width: 60%">
<h1 class="text-center mb-5 mt-5" style="color: #333">All Usres</h1>
  <?php flash('user-dlt'); ?>
  <thead class="thead-dark custom-thead">
    <tr>
      <th scope="col">username</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Gender</th>
      <th>Created At</th>
      <th>control</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach($data['usres'] as $user) {
        if ($user->username == getUsername()) {
          echo '<tr class="table-active">';
        } else {
          echo '<tr>';
        }
          echo '<th>' . $user->username . '</th>';
          echo '<th>' . $user->firstName . ' ' . $user->lastName . '</th>';
          echo '<th>' . $user->email . '</th>';
          echo '<th>' . $user->telephone . '</th>';
          echo '<th>' . (($user->gender == 1)? 'Male' : 'Female') . '</th>';
          echo '<th>' . $user->createdAt . '</th>';
          echo '<th><a href="'.URLROOT.'/admin/ruser/'.$user->username .'" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></th>';
        echo '</tr>';

      }
    
    
    ?>
  </tbody>
</table>

<?php require APPROOT . '/views/inc/footer.php' ?>