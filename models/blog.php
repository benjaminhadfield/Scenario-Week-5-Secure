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

    // populate list from DB results
    foreach($req->fetchAll() as $blog) {
      $list[] = new Blog($blog['id'], $blog['title'], $blog['content']);
    }

    return $list;
  }

  public static function filter($query) {
    $list = [];
    $db = Db::getInstance();
    // validate
    $query = strval($query);
    // make a secure SQL statement using parameters -> No SQL injection!
    $req = $db->prepare('SELECT * FROM blog WHERE title LIKE :query');
    // lets replace params with actual value (to be interpreted as a value and not SQL)
    $req->bindValue(':query', "%{$query}%");
    $req->execute();

    // populate list from DB results
    foreach($req->fetchAll() as $blog) {
      $list[] = new Blog($blog['id'], $blog['title'], $blog['content']);
    }

    return $list;
  }

  public static function find($id) {
    $db = Db::getInstance();
    // validate
    $id = intval($id);
    // make a secure SQL statement using parameters -> No SQL injection!
    $req = $db->prepare('SELECT * FROM blog WHERE id = :id');
    // lets replace params with actual value (to be interpreted as a value and not SQL)
    $req->execute(array(':id' => $id));
    $blog = $req->fetch();

    return new Blog($blog['id'], $blog['title'], $blog['content']);
  }
}
