<?php require_once APPROOT.'/views/inc/header.php'; ?>
 <?php flash('post_message'); ?>
<div class="row">
	<div class="col-md-6 float-left">
		<h1>Posts</h1>
	</div>
	<div class="col-md-6">
		<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-lg btn-primary float-right"><i class="fas fa-pen-nib"></i> Add Posts</a>
	</div>
</div>

<?php foreach ($data['posts'] as $post): ?>

	<div class="card card-body my-3">
		<h3 class="card-title"><?php echo $post->title; ?></h3>
		<div class="bg-light p-2 mb-3">
			Written By <?php echo $post->name; ?> on <?php echo $post->post_created; ?>
		</div>
		<p class="card-text"><?php echo $post->body; ?></p>
		<a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Read More</a>
	</div>
<?php endforeach; ?>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>