<?php require APPROOT . '/views/inc/header.php' ?>
<h1 class="text-center mt-4 mb-5" style="color: #333">Add New Post</h1>
<form style="width: 40%" class="mx-auto" method="POST" action="<?php echo URLROOT ?>/posts/edit/<?php echo $data['id'] ?>" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control <?php echo (!empty($data['title_err']))? 'is-invalid' : '' ?>" name="title" id="title" value="<?php echo $data['title'] ?>">
    <div class="invalid-feedback"><?php echo $data['title_err'] ?></div>
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control <?php echo (!empty($data['content_err']))? 'is-invalid' : '' ?>" id="content" rows="12" name="content"><?php echo $data['content'] ?></textarea>
    <div class="invalid-feedback"><?php echo $data['content_err'] ?></div>
  </div>

  <div class="custom-file mt-2 mb-3">
    <input type="file" class="custom-file-input" name="photo" id="photo">
    <label class="custom-file-label <?php echo (!empty($data['photo_err']))? 'is-invalid' : '' ?>" for="photo">Choose file</label>
    <div class="invalid-feedback"><?php echo $data['photo_err'] ?></div>
  </div>
  <button type="submit" class="btn btn-primary customBtn btn-block mt-3" style="border-radius: 5px;padding: 8px 0;">Add The Post</button>
</form>
<?php require APPROOT . '/views/inc/footer.php' ?>
<script>
  $(function (){
    $('#photo').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
  });

</script>