<?php
class BlogController {
  public function index() {
    $search_term = $_GET['search'];

    if (!$search_term) {
      $blogs = Blog::all();
    } else {
      $blogs = Blog::filter($search_term);
    }
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