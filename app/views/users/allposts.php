<?php require APPROOT . '/views/inc/header.php'?>
<table class="table mx-auto mt-5 text-center" style="width: 40%">
<h2 class="text-center mb-5 mt-5" style="color: #333">All Your Posts</h2>
  <thead class="thead-dark custom-thead">
    <tr>
      <th>Post ID</th>
      <th>Post Title</th>
      <th>Control</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach($data['posts'] as $post) {
        echo '<tr>';
          echo '<th>' . $post->postId . '</th>';
          echo '<th>' . $post->postTitle . '</th>';
          echo '<th>' .
                   '<a href="'.URLROOT.'/posts/remove/'.$post->postId.'" class="btn btn-danger">Delete</a>' 
                  . '<a href="'.URLROOT.'/posts/edit/'.$post->postId.'" class="btn btn-info ml-1">Edit</a>'
                  .'</th>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>

<?php require APPROOT . '/views/inc/footer.php'?>