<?php
class Blog {
  public $id;
  public $title;
  public $content;

  public function __construct($id, $title, $content) {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }

  public static function all() {
    $list = [];
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM blog');

    // create a list of all DB results
    foreach($req->fetchAll() as $blog) {
      $list[] = new Blog($blog['id'], $blog['title'], $blog['content']);
    }

    return $list;
  }

  public static function find($id) {
    $db = Db::getInstance();

    // check ID is valid
    $id = intval($id);
    // make a secure SQL statement using parameters -> No SQL injection!
    $req = $db->prepare('SELECT * FROM blog WHERE id = :id');
    // lets replace params with actual value (to be interpreted as a value and not SQL)
    $req->execute(array('id' => $id));
    $blog = $req->fetch();

    return new Blog($blog['id'], $blog['title'], $blog['content']);
  }
}
