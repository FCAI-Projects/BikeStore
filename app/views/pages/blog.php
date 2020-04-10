<?php require APPROOT . '/views/inc/header.php' ?>
<main class="blog">

  <div class="container">
  <?php flash('post-message'); ?>
  <?php  foreach($data['posts'] as $post): ?>
    <div class="row">
      <div class="col-9 mx-auto">
        <div class="card-horizontal align-items-center row">
          <div class="img-square-wrapper col-lg-4 col-sm-12">
            <img class="" src="<?php echo URLROOT ?>/img/uploads/<?php echo $post->photoName ?>" alt="Card image cap">
          </div>
          <div class="card-body  col-lg-7 col-sm-12">
            <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->postId ?>">
              <h5 class="card-title"><?php echo $post->postTitle ?></h5>
            </a>
            <i class="fas fa-user"></i><span><?php echo $post->username ?></span>
            <p class="card-text"><?php echo substr($post->postContent, 0, 360) ?>...</p>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>


  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>