<?php
class Account {
  public $id;
  public $username;
  public $password;

  public function __construct($id, $username, $password) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }

  public static function register($username, $password) {
    $db = Db::getInstance();
    $username = strval($username);
    $password = strval($password);

    $req = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password);');
    $req->bindValue(':username', $username);
    $req->bindValue(':password', $password);
    $success = $req->execute();

    return $success;
  }

  public static function getUser($username) {
    $db = Db::getInstance();
    $username = strval($username);

    $req = $db->prepare('SELECT * FROM users WHERE username = :username;');
    $req->bindValue(':username', $username);
    $req->execute();
    $user = $req->fetch();

    if ($user) {
      return new Account($user['id'], $user['username'], $user['password']);
    } else {
      return false;
    }
  }
}