<?php require APPROOT . '/views/inc/header.php' ?>

<div class="post">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-12 post_page_column mx-auto">
          <h2>
            <?php echo $data['post']->postTitle; ?>
          </h2>
          <div class="user">
            <i class="fas fa-user"></i><span class="ml-2"><?php echo $data['post']->username; ?></span>
          </div>
          <div class="post_img text-center">
            <img src="<?php echo URLROOT ?>/img/uploads/<?php echo $data['post']->photoName ?>" alt="photo" />
          </div>
          <p>
            <?php echo $data['post']->postContent; ?>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="comment">
    <h2 class="text-center mt-5 mb-5">COMMENTS</h2>
    <div class="container">
      <?php foreach($data['comments'] as $comment): ?>
      <div class="row mb-5">
        <div class="col-md-9 col-sm-12 comment-container mx-auto">
          <div class="comment-box d-flex">
            <span class="comment-date"><?php echo $comment->commentDate ?></span>
            <img src="<?php echo URLROOT ?>/img/uploads/<?php echo $comment->avatarName ?>" />
            <div class="comment-body ml-3">
              <h3 class="mb-2"><?php echo $comment->username ?></h3>
              <p>
              <?php echo $comment->commentContent ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php if (isLoggedIn()): ?>
  <button type="button" class="write-comment mx-auto mt-4" data-toggle="modal" data-target="#coment">
    write a comment
  </button>

  <!-- Modal -->
  <div class="modal fade" id="coment" tabindex="-1" role="dialog" aria-labelledby="coment" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="submitComment" method="POST" action="<?php echo URLROOT ?>/posts/comment/<?php echo $data['post']->postId ?>">
          <div class="modal-body d-flex justify-content-center">
            <textarea rows="20" cols="60" placeholder="Type your comment" name="comment"></textarea>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <input for="submitComment" name="submit" type="submit" class="write-comment" value="Submit">
            <button type="button" class="writeComment--cancleButton" data-dismiss="modal">cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php require APPROOT . '/views/inc/footer.php' ?>