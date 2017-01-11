<h1>Our Blog!</h1>
<small><?php echo sizeof($blogs) ?> articles.</small>

<section>
  <ul>
    <?php foreach($blogs as $blog) { ?>
      <li>
        <a href="?controller=blog&action=show&id=<?php echo $blog->id ?>">
          <?php echo $blog->title ?>
        </a>
      </li>
    <?php } ?>
  </ul>
</section>