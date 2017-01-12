<?php if ($blog) { ?>
  <h1><?php echo $blog->title ?></h1>
  <p><?php echo $blog->content ?></p>
<?php } else { ?>
  <p>This blog doesn't exist :(</p>
  <a href="?controller=blog&action=index">See All Blogs</a>
<?php } ?>

<a href="?controller=blog&action=index">Back</a>