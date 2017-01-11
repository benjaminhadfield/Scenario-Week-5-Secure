<div class="mb-4">
  <h1 class="m-0">Hackify Blog!</h1>
  <small>
    <?php echo sizeof($blogs) ?> article<?php echo sizeof($blogs) != 1 ? 's' : '' ?>
  </small>
</div>

<section>
  <ul class="list-group d-inline-block">
    <?php foreach($blogs as $blog) { ?>
      <a class="list-group-item" href="?controller=blog&action=show&id=<?php echo $blog->id ?>">
        <?php echo $blog->title ?>
      </a>
    <?php } ?>
  </ul>
</section>