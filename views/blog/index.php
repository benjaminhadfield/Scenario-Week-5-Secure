<?php require_once 'controllers/utils/format/date.php'; ?>

<div class="mb-4">
  <h1 class="m-0">Hackify Blog!</h1>
  <small>
    <?php echo count($blogs) ?> article<?php echo count($blogs) != 1 ? 's' : '' ?>
  </small>
</div>

<section>
  <ul class="list-group d-inline-block">
    <?php foreach($blogs as $blog) { ?>
      <a class="list-group-item d-block" href="?controller=blog&action=show&id=<?php echo $blog->id ?>">
        <div><?php echo $blog->title ?></div>
        <small><?php echo format_date($blog->created); ?></small>
      </a>
    <?php } ?>
  </ul>
</section>