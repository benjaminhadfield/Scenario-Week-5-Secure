<?php
class BlogController {
  public function index() {
    $blogs = Blog::all();
    require_once('views/blog/index.php');
  }

  public function show() {
    // expect URL with structure ?controller=post&action=show&id=<i>
    if (!isset($_GET['id'])) {
      call('pages', 'error');
    } else {
      $blog = Blog::find($_GET['id']);
      require_once('views/blog/show.php');
    }
  }
}