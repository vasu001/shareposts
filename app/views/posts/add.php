<?php require_once APPROOT.'/views/inc/header.php'; ?>
<a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class="fas fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">
            <h2 class="text-primary">Add Post</h2>
            <p>Create a post with this form</p>
            <form action="<?php echo URLROOT.'/posts/add'; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Title: <sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="name">Body: <sup>*</sup></label>
                    <textarea type="text" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>""><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                </div>
                <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add Post">
                </div>
            </form>
        </div>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>